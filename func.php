<?php session_start();

class Func
{
	
	
	function getTotRow($tblnm)
	{
		global $wpdb;
		$sql 	= "SELECT COUNT(*) as totMem FROM $tblnm";
		$result = $wpdb->get_results($sql);
		return $result;
	}

	function getAllMember($tblnm)
	{
		global $wpdb;
		$sql    = "SELECT * FROM $tblnm limit 20 offset 1";
		$result = $wpdb->get_results($sql);
		return $result;
	}
	/* $pgLim is the variable that gets the value of the number that was clicked when the user click of one page number on the front-end */
	function getAllMemberLim($tblnm,$pgLim)
	{
		if($pgLim == 1)
		{
			$pgLim = 1;
		}
		else
		{
			$pgLim = $pgLim*10+$pgLim*10;
			
		}
		global $wpdb;
		$sql    = "SELECT * FROM $tblnm limit 20 offset $pgLim";
		$result = $wpdb->get_results($sql);
		return $result;
	}
	function generateXLS($tblnm)
	{
		global $wpdb;
		$sql    = "SELECT * FROM $tblnm";
		$result = $wpdb->get_results($sql);
		return $result;
	}
}

?>