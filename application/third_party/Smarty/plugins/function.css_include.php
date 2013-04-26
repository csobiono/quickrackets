<?php
/**
 * Third Party Smarty plugin
 */
 
/**
 * Smarty      {css_include} function plugin
 *
 * Type:       function<br>
 * Name:       css_include<br>
 * Purpose:    Include css file.
 *
 * @package    NaCl CodeIgniter - Smarty Plugin
 * @author     Bertrand Kintanar <bertrand.kintanar@gmail.com>
 * @version    $Id: function.css_include.php 130 2011-09-06 01:21:31Z bertrand.kintanar@gmail.com $
 * @copyright  &copy; 2011 aSPl Group
 *
 */
function smarty_function_css_include( $params, &$smarty )
{
    $filename = $params['src'];
    
    if(preg_match("/http:/", $filename) || preg_match("/https:/", $filename))
    {
        $to_return = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$filename\">";
    }
    else
    {
        $to_return = "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . base_url() . "themes/css/" . $filename . "\">";
    }
    
    return $to_return;
}

?>
