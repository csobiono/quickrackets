<?php
/**
 * Third Party Smarty plugin
 */
 
/**
 * Smarty      {ci_form} function plugin
 * CodeIgniter form_helper
 *             http://codeigniter.com/user_guide/helpers/form_helper.html
 *
 * Type:       function<br>
 * Name:       ci_form<br>
 * Purpose:    Bridge all usable CodeIgniter form_helper functions to Smarty
 *
 * @package    aSPl CodeIgniter - Smarty Plugin
 * @author     Bertrand Kintanar <bertrand.kintanar@gmail.com>
 * @version    $Id: function.ci_form.php 33 2011-03-26 10:35:31Z bertrand.kintanar@gmail.com $
 * @copyright  &copy; 2011 aSPl Group
 *
 */
function smarty_function_ci_form( $params, &$smarty )
{
    //check if the needed function exists otherwise try to load it
    if ( !function_exists( 'form_open' ) )
    {
        //return error message in case we can't get CI instance
        if ( !function_exists( 'get_instance') )
        {
        	return "Can't get CI instance";
        }
        $CI = &get_instance();
        $CI->load->helper( 'form' );
    }
    
    $data = array();

    if ( isset( $params['name'] ) )
    {
        $data['name']  = $params['name'];
    }
    if ( isset( $params['value'] ) )
    {
        $data['value'] = $params['value'];
    }
    
    if ($params['type'] != 'hidden')
    {
        if(isset($params['id']))
        {
            $data['id'] = $params['id'];
        }
        if (isset($params['style']))
        {
            $data['style'] = $params['style'];
        }
    }
    
    switch ( $params['type'] )
    {
        // {ci_form type="checkbox" name="" id="" value="" checked="" style="" extra=""}
        // {ci_form type="radio" name="" id="" value="" checked="" style="" extra=""}
        case 'checkbox':
        case 'radio':
            
            $data['checked'] = isset( $params['checked'] ) ? $params['checked'] : '';
            
            if( $params['type'] == 'radio' )
            {
                $data['type'] = 'radio';
            }
        
            if ( isset( $params['extra'] ) )
            {   
                return form_checkbox( $data, '', '', $params['extra'] );
            }
            else
            {
                return form_checkbox( $data );
            }
            
            break;
            
        // {ci_form type="dropdown" name="" options="" value="" extra=""}
        case 'dropdown':
            
            if ( isset( $params['extra'] ) )
            {
                return form_dropdown( $data['name'], $params['options'], $data['value'], $params['extra'] );
            }
            else
            {
                return form_dropdown( $data['name'], $params['options'], $data['value'] );
            }
        
        // {ci_form type="hidden" name="" value=""}
        case 'hidden':
        
            return form_hidden( $data['name'], $data['value'] );
            
        // {ci_form type="input" name="" id="" value="" maxlength="" size="" style="" extra=""}
        // {ci_form type="password" name="" id="" value="" maxlength="" size="" style="" extra=""}
        // {ci_form type="upload" name="" id="" value="" maxlength="" size="" style="" extra=""}
        // {ci_form type="textarea" name="" id="" value="" rows="" cols="" style="" extra=""}
        case 'input':
        case 'password':
        case 'upload':
        case 'textarea':
        
            if ( $params['type'] == 'password' )
            {
                $data['type'] = 'password';
            }
            elseif( $params['type'] == 'upload' )
            {
                $data['type'] = 'file';
            }
            elseif( $params['type'] == 'textarea' )
            {
                $data['type'] = 'textarea';

                if (isset($params['rows']))
                {
                    $data['rows'] = $params['rows'];
                }
                if (isset($params['cols']))
                {
                    $data['cols'] = $params['cols'];
                }
            }
            
            if ( $params['type'] != 'textarea' )
            {
                if (isset($params['maxlength']))
                {
                    $data['maxlength'] = $params['maxlength'];
                }
                if (isset($params['size']))
                {
                    $data['size'] = $params['size'];
                }
            }
            
            if ( isset( $params['extra'] ) )
            {
                return form_input( $data, '', $params['extra'] );
            }
            else
            {
                return form_input( $data );
            }
            
        // {ci_form type="multiselect" name="" options="" value="" extra=""}
        case 'multiselect':
        
            if ( isset( $params['extra'] ) )
            {
                return form_multiselect( $data['name'], $params['options'], $data['value'], $params['extra'] );
            }
            else
            {
                return form_multiselect( $data['name'], $params['options'], $data['value'] );
            }
            
        // {ci_form type="submit" name="" value="" extra=""}
        // {ci_form type="reset" name="" value="" extra=""}
        case 'submit':
        case 'reset':
        
            if ( $params['type'] == 'submit' )
            {
                $form_func = 'form_submit';
            }
            else
            {
                $form_func = 'form_reset';
            }
            
            if ( isset( $params['extra'] ) )
            {   
                return $form_func( $data['name'], $data['value'], $params['extra'] );
            }
            else
            {
                return $form_func( $data['name'], $data['value'] );
            }
        
        // {ci_form type="label" text="" id="" attr=""}
        case 'label':
        
            if ( isset( $params['attr'] ) )
            {
                return form_label( $params['text'], $params['id'], $params['attr'] );
            }
            else
            {
                return form_label( $params['text'], $params['id'] );
            }
        
        // {ci_form type="button" id="" value="" button_type="" content="" extra=""}
        case 'button':
        
            $data['type'] = $params['button_type'];
            
            if ( isset( $params['extra'] ) )
            {
                return form_button( $data, $params['content'], $params['extra'] );
            }
            else
            {
                return form_button( $data, $params['content'] );
            }
                        
        // {ci_form type="fieldset" label="" attr=""}
        // {ci_form type="fieldset" extra=""}
        case 'fieldset':
        
            if ( !isset( $params['label'] ) )
            {
                return form_fieldset_close( isset( $params['extra'] ) ? $params['extra'] : '' );
            }
            
            if ( isset( $params['attr'] ) )
            {
                return form_fieldset( $params['label'], $params['attr'] );
            }
            else
            {
                return form_fieldset( $params['label'] );
            }
            
        // {ci_form type="open" attr=""}
        // {ci_form type="open_multipart" attr=""}
        case 'open':
        case 'open_multipart':
        
            if ($params['type'] == 'open_multipart')
            {
                    if ( is_string($params['attr'] ) )
                    {
                        $params['attr'] .= ' enctype="multipart/form-data"';
                    }
                    else
                    {
                        $params['attr']['enctype'] = 'multipart/form-data';
                    }
            }
        
            if ( isset( $params['attr'] ) )
            {
                return form_open( $params['url'], $params['attr'] );
            }
            else
            {
                return form_open( $params['url'] );
            }
            
        // {ci_form type="close" extra=""}
        case 'close':
        
            return form_close( isset( $params['extra'] ) ? $params['extra'] : '' );

    } // END switch ( $params['type'] )
}

?>
