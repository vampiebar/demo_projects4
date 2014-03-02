<?php
    /**
     * Project: Form Processor Pro
     * File: email.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Executors
     */

    /**
     * Simple SMTP emailer
     * 
     * @package FPP5
     */
    class email_action extends Executor {
        
        /**
         * MIME email headers
         *
         * @var string
         */
        var $headers = '';
        
        /**
         * Multipart body content
         *
         * @var string
         */
        var $multipart;
        
        /**
         * MIME email content
         *
         * @var string
         */
        var $mime;
        
        /**
         * Email body
         *
         * @var string
         */
        var $body;
        
        /**
         * Multipart email parts
         *
         * @var string
         */
        var $parts = array();
        
        var $crlf = "\n";
        
        /**
         * Body setter
         *
         * @param string $content
         */
        function setBody($content) {
            $this->body = $content;
        }

        /**
         * Builds multipart body
         *
         * @param string $orig_boundary
         * @param string $mail_format plain || html
         * @param string $charset
         */
        function buildBody($orig_boundary, $mail_format = 'plain', $charset = 'utf-8') {
            $this->multipart .= '--' . $orig_boundary . $this->crlf;
            $this->multipart .= 'Content-Type: text/' . $mail_format . '; charset=' . $charset . $this->crlf;
            if ($mail_format == 'html'){
                $this->multipart .= ('Content-Transfer-Encoding: Quot-Printed' . $this->crlf . $this->crlf);
            } else {
            	$this->multipart .= $this->crlf;
            }
            $this->multipart.= $this->body. $this->crlf . $this->crlf;
        }

        /**
         * Adda an attached file
         *
         * @param string $file_name File name
         * @param string $c_type Content type
         */
        function addAttachment($file_name, $c_type = 'application/octet-stream'){
            $file = new File($file_name);
            $this->parts[] = array('body' => $file->getContent(), 'name' => basename($file_name), 'c_type' => $c_type);
        }

        /**
         * Builds email part
         *
         * @param integer $i
         * @return string
         */
        function buildPart($i) {
            $message_part  = '';
            $message_part .= 'Content-Type: ' . $this->parts[$i]['c_type'];
            $message_part .= empty($this->parts[$i]['name']) ? $this->crlf : '; name="' . $this->parts[$i]['name'] . '"' . $this->crlf;
            $message_part .= 'Content-Transfer-Encoding: base64' . $this->crlf;
            $message_part .= 'Content-Disposition: attachment; filename="' . $this->parts[$i]['name'] . '"' .$this->crlf . $this->crlf;
            $message_part .= chunk_split(base64_encode($this->parts[$i]['body'])).$this->crlf;
            return $message_part;
        }

        /**
         * Builds email message
         *
         * @param string $mail_format plain || html
         * @param string $charset
         */
        function buildMessage($mail_format = 'plain', $charset = 'utf-8') {
            $boundary = '=_' . md5(uniqid(time()));
            //$this->headers = rtrim($this->headers, "\r\n");
            $this->headers .= 'MIME-Version: 1.0' . $this->crlf;
            $this->headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary. '"' . $this->crlf;
            $this->multipart  = '';
            $this->multipart .= 'This is a MIME encoded message.'. $this->crlf . $this->crlf;
            $this->buildBody($boundary, $mail_format, $charset);
            for ($i=(count($this->parts)-1); $i>=0; $i--){
                $this->multipart.='--' . $boundary . $this->crlf . $this->buildPart($i);
            }
    
            $this->mime = $this->multipart . '--' . $boundary . '--' . $this->crlf;
        }

        /**
         * Sends email message
         *
         * @param string $to
         * @param string $from
         * @param string $subject
         */
        function send($to, $from, $subject = '') 
        {
        	global $lang;
        	
            if ($this->getSetting('smtp_server')){
            	@ini_set('SMTP', $this->getSetting('smtp_server'));
            }
            
            if ($this->getSetting('smtp_port')){
            	@ini_set('smtp_port', $this->getSetting('smtp_port'));
            }
            
            if ($this->getSetting('sendmail_from')){
            	@ini_set('sendmail_from', 'test@mitridat.com');
            }
            //echo $this->mime;exit;
            if (!@mail($to, $subject, $this->mime, $this->headers)){
                $e = new Error($lang->getValue('err_failed_mail_send', ini_get('SMTP'), ini_get('smtp_port')));
            }
        }
         
        function execute(){
            $file = new File($this->getParsedArgument());
            $tpl = $file->getContent();
            
            $match = preg_split('/\n\s*\r?\n/', $tpl, 2);
            
            $tpl_header = $match[0];
            $tpl_body = (isset($match[1])) ? $match[1] : '';
            
            $parser = new Parser();
            $parser->callbackFunc = '';
            $parser->assignVarList($this->getRequestData());

            /**
             * Parsing email headers
             */
            $header = array();
            $tpl_header_arr = explode("\n", $tpl_header);
            foreach ($tpl_header_arr as $tpl_header_row){
                $tpl_header_row = trim($tpl_header_row);
                
                if (preg_match('/^(.+):(.*)$/iU', $tpl_header_row, $match)){
                    $parser->setTemplate($match[2]);
                    $parser->parse();
                    $header_value = trim($parser->getOutput());
                    //$parser->setTemplate($header_value);
                    //$parser->parse();
                    $header_value = trim($parser->getOutput());
                    $header_value = str_replace("\r", '', $header_value);
                    $header_value = str_replace("\n", '', $header_value);
                    
                    $header[strtolower($match[1])] = $header_value;
                }
            }

            /**
             * Parsing email body
             */
            if (isset($header['format']) && $header['format'] == 'HTML'){
            	$parser->callbackFunc = 'htmlspecialchars_ent_quotes';
            }
            
            $parser->setTemplate($tpl_body);
            $parser->parse();
            $body = $parser->getOutput();

            foreach ($header as $header_name => $header_val){
                if (in_array($header_name, array('from', 'cc', 'bcc'))) {
                	$this->headers .= ucfirst($header_name) . ': ' . $header_val .$this->crlf;
                	
                	if (strtolower($header_name) == 'from'){
                		@ini_set('sendmail_from', $header_val);
                		$header['from'] = $header_val;
                	}
                	if (strtolower($header_name) == 'subject'){
                		$header['subject'] = $header_val;
                	}                	
                	                	
                }
            }

            /**
             * Additional tags
             */
            $this->headers .= 'Reply-To: '. $header['from'] .$this->crlf;
            $this->headers .= 'X-Mailer: Form Mail: eMail Form Processor Pro Script'.$this->crlf;
            
            $this->setBody($body);
            
            /**
             * Adding attachments
             */
            if (isset($header['attachment'])){
            	$attachments = explode(',', $header['attachment']);
            	$attachments = array_map('trim', $attachments);
            	
            	foreach ($attachments as $attachment){
            	    $file = new File($attachment);
            	    if ($file->fileExists() && $file->fileReadable()){
            	    	$this->addAttachment($attachment);
            	    }
            	}
            }
            
            /**
             * Building message
             */
            $mail_format  = isset($header['format']) && strtoupper($header['format']) == 'HTML' ? 'html' : 'plain';
            $mail_charset = isset($header['charset']) ? $header['charset'] : 'ISO-8859-1';
            $this->buildMessage($mail_format, $mail_charset);
            
            
            /**
             * Sending
             */

            $this->send((trim($header['to'])!='') ? $header['to'] : '',
                        (trim($header['from'])!='') ? $header['from'] : '',
                        (trim($header['subject'])!='') ? $header['subject'] : '');
        }
    }
?>