<?php
/*
Template Name: xlsgen
Author : Sourabh Kumar Sharma
*/
/*
This is a xls file generator file that can be used universally to generate the xls file for the users
*/

$filename = "filename.xls";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='.$filename);
header('Pragma: no-cache');
header('Expires: 0');
global $wpdb;

require_once('adminfunc.php');
$funcCls  = new AdminFunc(); /*Declare the object of the AdminFunc class that contains the member function to query the required database table */
$xlsClass = new XLSGen(); /*Initialize the class here so that the constructor gets called*/
class XLSGen
{
		
	function __construct() {
		if ( isset($_REQUEST['lifememb']) )
		 {
			$tblname = "nats_membership";
			$this->createXLS($tblname);
		 }
	 }
	function createXLS($tblname)
	{
		$countt = 1; /* this variable is used in the condition where if the value is 1 then we will extract the column name from the resultant query object */
		global $funcCls;
		$totDat  = $funcCls->generateXLS($tblname);
		$listDat = '';
		/* The below if block of code is to get the column names */
		if ( $countt == 1 )
		{
			foreach($totDat as $eachDat)
			{
				$tempBuf = '';
				/* The below foreach block of code with iterate through each value in the object */
				foreach($eachDat as $key => $value)
				{
					$tempBuf = $tempBuf.$key."\t";
				}
				$tempBuf = $tempBuf."\n";
				$colNm   = $tempBuf;
				$countt++;
				break; /*Once we extract the column name from the first loop just break-out from the loop*/
			}
		}
		$tempBuf = '';
		$tempBuf = $tempBuf.$colNm; /*Append the column name headings here*/
		/* This first foreach loop for the main array of the objects, in each of the array of objects there are values that belong to single user */
		foreach($totDat as $eachDat)
		{
			/* The below foreach block of code with iterate through each value in the object */
			foreach($eachDat as $key => $value)
			{
				
				$tempBuf = $tempBuf.$value."\t";
			}
			$tempBuf = $tempBuf."\n";
			$listDat = $listDat.$tempBuf;
			$tempBuf = '';
		}
		echo $listDat;
	}
}
?>