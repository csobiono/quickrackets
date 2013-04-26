<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

		$x = 1; 
		$y = 2;
	}
	
	function index()
	{
		$here = "/home/httpd/html/test";
list ($j1,$j2,$j3,$j4) = split('/',$here);
print "$j3";
    }

    function testeron(){
    	if ($x < 2) { echo "1"; } 
elseif ($x < 6) { echo "2"; } 
elseif ($x < 4) { echo "3"; } 
elseif ($x > 4) { echo "4"; } 
elseif ($x < 10) { echo "5"; } 
else { echo "6"; }
    }

    function a(){
    	echo 5+FALSE;
    }
    function b(){
    	echo addslashes("~`!@#$%^&*()_-+=|\}]{[\"':;<,>.?/\\");
    }

    function c(){
    	$x = $this->foo(6);
    	echo $x;
    }

    function d(){
    	$valid = TRUE;
		$cnt = 0;
		while ($valid == TRUE) 
		{
			$cnt++;
			if ($cnt > 10)
			{ 
				$valid = FALSE; 
			}
		}
		echo "$cnt";
    }

    function foo ($i) { return ((($i*2)-3)%3);}

    function e(){
    	$x = $y = 10;
$z = ($x++)-2;
$a = (++$y)*2;
echo "$x $y $z $a";
    }

    function f(){

    	$x = 'merlin eats apples';

    	if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$", $x)) {
		print "Found1";
		} elseif (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*[a-z0-9-]+(\.[a-z0-9-]+)*$", $x)) {
		print "Found2";
		} elseif (eregi("^[_a-z 0-9-]+$", $x)) {
		print "Found3";
		} elseif (eregi("^[a-zA-Z 0-9-]+$", $x)) {
		print "Found4";
		} else {
		print "Found5";
		}
    }

    function g(){
    	$x = $y = 10;
$z = $x++;
$a = ++$y;
echo "$x $y $z $a";
    }

    function h(){
    	$x = 10 - "2 elephants";
    	echo $x;
	}

	function i(){
		$x = 5;
if ($x > 5) { print "Fruit"; }
elseif ($x = 6) { print "Ice cream"; }
elseif ($x < 6) { print "Vegetables"; }
else { print "Diamond"; }
	}

	function j(){
		$a = ($b = $c = 1) + 2;
echo "$a $b $c";
	}

	function testing(){
		echo $this->z(3);
	}
	function z ($z)
	{ 
		global $x; 
		echo "$x 0 $y 0 $z"; 
	}

	function k(){
		for ($i = 0; $i < 5; ++$i) {
		if ($i == 2)
		continue
		print "$i ";
		}
	}

	function l(){
		$x = "";
switch ($x) {
case "0": echo "String"; break;
case 0: echo "Integer"; break;
case NULL: echo "NULL"; break;
case FALSE: echo "Boolean"; break;
case "": echo "Empty string"; break;
default: echo "Something else"; break;
}
	}
}
?>