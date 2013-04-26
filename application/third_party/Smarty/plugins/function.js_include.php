<?php
/**
 * Third Party Smarty plugin
 */
 
/**
 * Smarty      {js_include} function plugin
 *
 * Type:       function<br>
 * Name:       js_include<br>
 * Purpose:    Include javascript file.
 *
 * @package    NaCl CodeIgniter - Smarty Plugin
 * @author     Bertrand Kintanar <bertrand.kintanar@gmail.com>
 * @version    $Id: function.js_include.php 130 2011-09-06 01:21:31Z bertrand.kintanar@gmail.com $
 * @copyright  &copy; 2011 aSPl Group
 *
 */
function smarty_function_js_include( $params, &$smarty )
{
    $filename = $params['src'];
    
    if(preg_match("/http:/", $filename) || preg_match("/https:/", $filename))
    {
        $to_return = "<script type=\"text/javascript\" src=\"$filename\"></script>";
    }
    else
    {
        $to_return = "<script type=\"text/javascript\" src=\"" . base_url() . "themes/js/" . $filename . "\"></script>";
    }
    
    return $to_return;
}

?>
