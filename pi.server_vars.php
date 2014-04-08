<?php

$plugin_info = array(
	'pi_name'		=> 'Server Vars',
	'pi_version'		=> '1.0',
	'pi_author'		=> 'Adam Plante',
	'pi_author_url'		=> 'https://github.com/sarcastron/server_vars',
	'pi_description'	=> "Get variables from PHP's \$_SERVER superglobal",
	'pi_usage'		=> server_vars::usage()
	);



class server_vars 
{
	
	public $return_data = "";
	
	public function __construct()
	{	
		
		$response = null;
		
		$this->EE =& get_instance();
		$this->key = $this->EE->TMPL->fetch_param('key', null);
		
		if ($this->key == 'ALL') {
			$response = print_r($_SERVER, true);
		}
		
		if (array_key_exists($this->key, $_SERVER)) {
			$response = $_SERVER[$this->key];
		}
		
		$this->return_data = $response;
		
	}
	
	public function usage()
	{
		ob_start(); 
		?>
This plugin allows a user to get information out of the PHP $_SERVER superglobal. It takes a single parameter called 'key'. The key should be whatever the key is for the $_SERVER array that you want to pull. 

If you need to list out the entire $_SERVER array, use the value 'ALL' as the key.

Examples

<pre>{exp:server_vars key="ALL"}</pre>

<p>Holy cow dude! We are on {exp:server_vars key="SERVER_NAME"}!!!</p>

<p>The remote address is {exp:server_vars key="REMOTE_ADDR"}. Isn't that just swell?</p>
		<?php
		$buffer = ob_get_contents();

		ob_end_clean(); 

		return $buffer;
	}
	
}