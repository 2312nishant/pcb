<?php
//06-Jul-15 |Girish P | Create a robust versioning system for include files
/**
 * This function creates an include file with appropriate SVN version number
 */
if ( ! function_exists('include_url')) {
	function include_url($include_path) {
		$CI = get_instance();
		$SITEPATH = $CI->config->item('pcbPath');
		$url = $SITEPATH.$include_path;
		/*$CI->load->config('include_version');
		$include_version = $CI->config->item('include_version');
		if ( isset($include_version[$include_path])) {
			$url .= "?v=".$include_version[$include_path];
		}*/
		echo $url;
	}
}
?>