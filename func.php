<?php session_start();

require_once 'config.php';

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
		$limRec = RECORD_SHOW;
		global $wpdb;
		$sql    = "SELECT * FROM $tblnm limit $limRec offset 1";
		$result = $wpdb->get_results($sql);
		return $result;
	}
	/* $pgLim is the variable that gets the value of the number that was clicked when the user click of one page number on the front-end */
	function getAllMemberLim($pgLim,$tblnm)
	{
		if($pgLim == 1)
		{
			$pgLim = 1;
		}
		else
		{
			$pgLim = $pgLim*10+$pgLim*10;
			
		}
		$limRec = RECORD_SHOW;
		global $wpdb;
		$sql    = "SELECT * FROM $tblnm limit $limRec offset $pgLim";
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