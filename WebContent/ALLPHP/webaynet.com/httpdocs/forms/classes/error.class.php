<?php
    /**
     * Project: Form Processor Pro
     * File: error.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */
    
    /**
     * Critical errors handler
     * 
     * @package FPP5
     */
    class Error{
        
        /**
         * Constructor
         * 
         * @param string $error_message
         * @param integer $error_code
         * @return none
         */
        function Error($error_message, $error_code = 0){
            echo '<center>';
            echo '<table border="1" width="600">';
            echo '<tr>';
            echo '<td align="center"><b>Form Processor Pro. Fatal Error</b></td></tr><tr>';
            echo '<td align="center">'.$error_message.'</td>';
            echo '</tr>';
            echo '</table>';
            echo '</center>';
            exit();
        }
    }
?>