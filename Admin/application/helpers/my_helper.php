<?php
/*
 * Created on 2012-9-23
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 /**
  *信息提示方式：1
  *带多行导航链接，不带自动跳转
  *
  *@param string $message
  *@param array	 $gotos 
  *
  */
  function show_message1($message)
  {
  	header("Expires:Mon,26 Jul 1997 05:00:00 GMT");
  	header("Cache-Control: no-cache, must-revalidate");
  	header("Pragma:no-cache");
  	$args = func_get_args();
  	array_shift($args);
  	$CI = get_instance();
  	$data['gotos'] = $args;
  	$data['message'] = (string)$message;
  	$CI->load->view('_show_message1',$data);
  }
  
  //-----------------------------------------------------------------------------------------------------
  /**
   *信息提示方式：2
   *
   *@param string $message
   *@param  string $goto
   */
   function show_message2($message,$goto)
   {
   	header("Expires:Mon,26 Jul 1997 05:00:00 GMT");
  	header("Cache-Control: no-cache, must-revalidate");
  	header("Pragma:no-cache");
  	$CI = get_instance();
  	$data['goto'] = (string)$goto;
  	$data['message'] = (string)$message;
  	$CI->load->view('_show_message2',$data);
   }
   
   //-----------------------------------------------------------------------------------------------------------
   /**
    *返回当前 query string
    *
    *@param string
    */
    function query_string()
    {
    	return $_SERVER['QUERY_STRING'];
    }
    
    //-----------------------------------------------------------------------------------
    /**
     *把当前 QUERY_STRING 分解成数组 
     *
     *@return  array
     */
     function query_string_to_array()
     {
     	$params = array();
     	$query_string = explode('&',query_string());
     	foreach ($query_string as $string)
     	{
        	if (strpos($string, '='))
        	{
            	list($key, $value) = explode('=', $string);
            	$params[$key] = $value;
        	}
    	}
    	return $params;
     }
     
     //---------------------------------------------------------------------------------------------
     /**
      *序列化文本域内容 
      *
      */
     function serial_save($text) 
	{
    	$texts = explode("\n",$text);
		$arr = array();
		foreach($texts as $value):
			if(!empty($value))
				$arr[] = $value;
		endforeach;
		$str = implode(',',$arr);
		return $str;	
	}

	function sreial_show($text)
	{
   	 	$texts = explode(",",$text);
		$arr = array();
		foreach($texts as $value):
			if(!empty($value))
				$arr[] = $value;
		endforeach;
		$str = implode("\n",$arr);
		return $str;	
	}
     
    //--------------------------------------------------------------------------------------------------------
    /**
     *限制字符串长度，中文字节理解成一个字符
     *
     */ 
     function char_limit1($str,$val)
     {
     	$CI = & get_instance();
     	if(function_exists('mb_internal_encoding'))
     	{
     		mb_internal_encoding($CI->config->item('charset'));
     	}
     	return (mb_strlen($str) > $val)?mb_substr($str,0,$val):$str;  //从0开始取到$val个字符
     }
     
     //--------------------------------------------------------------------------------------------------------
     /**
      *限制字符串长度2
      *
      *
      */
      function char_limit2($str,$val)
      {
      	return (strlen($str)>$val) ? substr($str,0,$val) : $str ;
      }
    
     //-------------------------------------------------------------------------------------------------------------
     /**
      *限制字符串长度3 
      * 
      * 
      */
      function chat_limit3($str,$val)
      {
      	$CI = & get_instance();
      	if(function_exists('mb_internal_encoding'))
      	{
      		mb_internal_encoding($CI->config->item('charset'));
      	}
      	return (mb_strlen($str) > $val)?mb_substr($str,0,$val).'...':$str;
      }
      
      //------------------------------------------------------------------------------------
      /**
 	   * 功能：检查权限 
 	   */

	function admin_priv($priv_str)
	{   
		$CI = & get_instance();
		$action_list = $CI->session->userdata('action_list');

    	if (strpos(',' . $action_list . ',', ',' . $priv_str . ',') === false)
    	{                
        	return false;
    	}  
	
    	return true;
}
      
      
      
?>
























