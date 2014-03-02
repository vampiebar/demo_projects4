<?php
    /**
     * Project: Form Processor Pro
     * File: response.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */
    
    /**
     * Response class
     * 
     * @static
     * @package FPP5
     */
    class Response{
        /**
         * Content to reponse
         * 
         * @var string
         */
        var $content = '';
        
        /**
         * Output offset number
         * 
         * @var integer
         */
        var $output_offset = -1;
        
        /**
         * Constructor
         *
         * @return boolean
         */
        function Response(){
            return true;
        }
        
        /**
         * Content setter
         *
         * @param string $content
         */
        function setContent($content){
            $this->content = $content;
        }
        
        /**
         * Form data encoder
         * 
         * @param array
         */
        function encodeFormData($form_data){
            return base64_encode(serialize($form_data));
        }
        
        /**
         * FPP output number setter
         * 
         * @param integer
         * @return boolean
         */
        function setOuputOffset($output_offset){
            return $this->output_offset = intval($output_offset);
        }
        
        /**
         * Outputs content
         * 
         * @return void
         */
        function printOut(){
        	global $request;
            
            $fpp_data = $request->data;
            
            if ($this->output_offset == -1){
            	$fpp_data['fpp_output'] = $fpp_data['fpp_output']+1;
            }
            else{
                $fpp_data['fpp_output'] = $this->output_offset;
            }
            
            $fpp_data['fpp_files'] = $request->getFiles();
            
            $hidden = '<input type="hidden" name="fpp_data" value="' . $this->encodeFormData($fpp_data) . '"/>'."\n";
            
            $this->content = preg_replace('/\<\/form\>/si', $hidden . '$0', $this->content);
            
            echo $this->content;
            exit();
        }
    }
?>