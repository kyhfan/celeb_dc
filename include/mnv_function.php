<?
/*
*
*	php function
*
*/
class mnv_function extends mnv_dbi
{
	var $winner_flag;

	var $script; //-- 페이지관련 자바스크립트

	
	public function InsertTrackingInfo($gubun)
	{
        global $my_db;
        $log_query	= "INSERT INTO tracking_info(tracking_media, tracking_refferer, tracking_ipaddr, tracking_date, tracking_gubun) values('".$_SESSION['ss_media']."','".$_SERVER['HTTP_REFERER']."','".$_SERVER['REMOTE_ADDR']."',now(),'".$gubun."')";
        $q_result 	= mysqli_query($my_db, $log_query);

        return $log_query;
	}

	public function MobileCheck()
	{
		$mobile_agent = array("iPhone","iPod","iPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini", "Windows ce", "Nokia", "sony" );
		$check_mobile = "PC";

		for($i=0; $i<sizeof($mobile_agent); $i++){
			if(stripos( $_SERVER['HTTP_USER_AGENT'], $mobile_agent[$i] )){
				$check_mobile = "MOBILE";
				break;
			}
		}
		return $check_mobile;
	}

	public function IPhoneCheck()
	{
        if(stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" ))
        	$iPhone	    = "Y";
        else
        	$iPhone	= "N";
        return $iPhone;
	}
	public function BrowserCheck()
	{
        if(stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE 8" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE 9" ))
        	$OB	    = "Y";
        else
        	$OB	= "N";
        return $OB;
	}
	public function IECheck()
	{
        if(stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "Trident" ))
        	$IE	    = "Y";
        else
        	$IE	= "N";
        return $IE;
	}
	public function SafariCheck()
	{
        if(stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "Chrome" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "Trident" ))
        	$Safari	    = "N";
        else
        	$Safari	= "Y";
        return $Safari;
	}

	public function SaveMedia()
	{
		$_SESSION['ss_media']		= $_REQUEST['media'];
	}

	 // 쇼핑몰 기본 설정 가져오기
	public function select_shop_config_info()
	{
	    global $my_db;
	
		$query		= "SELECT * FROM site_option WHERE 1 AND option_load='Y'";
        $result		= mysqli_query($my_db, $query);
        
		while ($data = mysqli_fetch_array($result))
		{
			$res_data[$data['option_name']][]	= $data['option_value'];
			$res_data[$data['option_name']][]	= $data['option_use'];
		}
	
		return $res_data;
	}
	

}
