<?php defined('BASEPATH') OR exit('No direct script access allowed');

class  MY_Controller  extends  CI_Controller  {

    public $em; 
    
    function __construct()
    {
        parent::__construct();
        
        // Check if user logged in.
        if ($this->tank_auth->is_logged_in())
        {
            $this->smarty->assign('is_logged_in', true);
            $this->smarty->assign('user_id', $this->tank_auth->get_user_id());
            $this->smarty->assign('user_login', $this->tank_auth->get_username());
            $this->smarty->assign('user_role_id', $this->session->userdata('user_role_id'));
        }
        else
        {
            $this->smarty->assign('is_logged_in', false);
        }

        $this->key = "E4HD9h4DhS23DYfhHemkS3Nf";// 24 bit Key
        $this->iv = "fYfhHeDm";// 8 bit IV
        $this->bit_check=8;// bit amount for diff algor.
    }
    
    // retrieves the controller's js file if it exists.
    function _get_script($_file)
    {
        $_array = explode(DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR, $_file);
        $cnt = count($_array);
        
        if ( strpos($_array[$cnt-1], '.') === false )
        {
            $_array[$cnt-1] .= '.php';
        }
        $script_name = substr($_array[$cnt-1], 0, -4);
        $script_name = str_replace('\\', '/', $script_name);

        if(fopen(FCPATH.'themes/js/' . $script_name . '.js', 'r'))
        {
            $jscript = base_url() . 'themes/js/' . $script_name . '.js';
            $this->smarty->assign('controller_js', $jscript);
        }
        
        if(fopen(FCPATH.'themes/css/' . $script_name . '.css', 'r'))
        {
            $css_file = base_url() . 'themes/css/' . $script_name . '.css';
            $this->smarty->assign('controller_css', $css_file);
        }
    }
    
    function _get_error_ldelim()
    {
        return '<div class="ui-widget" id="error_login" style="">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                    <p>
                        <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                        <strong>Alert:</strong> ';
    }
    
    function _get_error_rdelim()
    {
        return '</p>
                </div>
            </div>';
    }
    
    function _getSVNRevision()
    {
        $entries = BASEPATH.'../.svn/entries';
        if( !file_exists( $entries ) ) {
            return false;
        }
        $lines = file( $entries );
        if ( !count( $lines ) ) {
            return false;
        }
        // check if file is xml (subversion release <= 1.3) or not (subversion release = 1.4)
        if( preg_match( '/^<\?xml/', $lines[0] ) ) {
            // subversion is release <= 1.3
            if( !function_exists( 'simplexml_load_file' ) ) {
                // We could fall back to expat... YUCK
                return false;
            }

            // SimpleXml whines about the xmlns...
            wfSuppressWarnings();
            $xml = simplexml_load_file( $entries );
            wfRestoreWarnings();

            if( $xml ) {
                foreach( $xml->entry as $entry ) {
                    if( $xml->entry[0]['name'] == '' ) {
                        // The directory entry should always have a revision marker.
                        if( $entry['revision'] ) {
                            return array( 'checkout-rev' => intval( $entry['revision'] ) );
                        }
                    }
                }
            }

            return false;
        }


        // Subversion is release 1.4 or above.
        if ( count( $lines ) < 11 ) {
            return false;
        }

        $info = array(
            'checkout-rev' => intval( trim( $lines[3] ) ),
            'url' => trim( $lines[4] ),
            'repo-url' => trim( $lines[5] ),
            'directory-rev' => intval( trim( $lines[10] ) )
        );
        
        return $info;
    }
    
    public function _urlSafe($str)
    {
        $str = strtolower( trim( strip_tags( $str ) ) );
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        
        return $str;
    }

    function _encrypt($text,$key,$iv,$bit_check)
    {
        $text_num =str_split($text,$bit_check);
        $text_num = $bit_check-strlen($text_num[count($text_num)-1]);

        for ($i=0;$i<$text_num; $i++) 
        {
            $text = $text . chr($text_num);
        }
        $cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
        mcrypt_generic_init($cipher, $key, $iv);
        $decrypted = mcrypt_generic($cipher,$text);
        mcrypt_generic_deinit($cipher);

        return base64_encode($decrypted);
    }

    function _decrypt($encrypted_text,$key,$iv,$bit_check)
    {
        $cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
        mcrypt_generic_init($cipher, $key, $iv);
        $decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
        mcrypt_generic_deinit($cipher);
        $last_char=substr($decrypted,-1);
        for($i=0;$i<$bit_check-1; $i++)
        {
            if(chr($i)==$last_char)
            {
                $decrypted=substr($decrypted,0,strlen($decrypted)-$i);
                break;
            }
        }

        return $decrypted;
    }
}