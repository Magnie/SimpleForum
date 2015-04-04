<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class My_config extends CI_Config {
 
	function site_url($uri = '')
	{	
		if ($uri == '')
		{
			return $this->slash_item('base_url').$this->item('index_page');
		}
 
		if ($this->item('enable_query_strings') == FALSE)
		{
			$suffix = '';
			if( ! preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri))
			{
				$suffix = '/';				
			}
			return $this->slash_item('base_url').$this->slash_item('index_page').$this->_uri_string($uri).$suffix;				
		}
		else
		{
			return $this->slash_item('base_url').$this->item('index_page').'?'.$this->_uri_string($uri);
		}
	}
 
}
// END MY_Config Class
 
/* End of file MY_Config.php */
/* Location: ./application/libraries/MY_Config.php */
