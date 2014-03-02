<?php
    /**
     * Project: Form Processor Pro
     * File: page.action.php
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
    class page_action extends Outputer {
        function execute(){
            $parser = new Parser();

            $template_file = new File($this->getParsedArgument());
            
            $parser->setTemplate($template_file->getContent());
            $parser->assignVarList($this->getRequestData());
            $parser->parse();
            
            $this->output($parser->getOutput());
        }
    }
?>