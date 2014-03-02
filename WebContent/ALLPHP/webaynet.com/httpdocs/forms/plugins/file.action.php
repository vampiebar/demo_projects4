<?php
    /**
     * Project: Form Processor Pro
     * File: file.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Outputers
     */

    /**
     * Page outputer
     * 
     * @package FPP5
     */
    class file_action extends Outputer {
        function execute(){
			$filename = $this->getParsedArgument();
            
			$file = new File($filename);
			$content = $file->getContent();

			header('Content-Length: ' . strlen($content));
			header('Content-Type: application/force-download');
			header('Content-Disposition: attachment; filename=' . $filename);
			header('Content-Transfer-Encoding: binary');
            
			echo $content;
			exit();
        }
    }
?>