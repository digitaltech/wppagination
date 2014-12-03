<?php
/*
Plugin name: Wordpress Pagination
Description: This is a simple plugin to create pagination
Author: Sourabh Kumar Sharma
*/ 
/*config.php was already included in the file func.php*/
require_once 'func.php';
class PGnate
{
	
	function __construct()
	{
		$funcCls = new Func();
		$totMem  = $funcCls->getTotRow($tblnm);
		/* $_SESSION['liDat'] is the variable that is used to store the values of the page number data that is the page numbers which when clicked load the data  */
		if (!isset($_SESSION['liDat'])){
			$_SESSION['liDat'] = '';
		}
		
	}

	 
	function nextPages($pagenum,$tblnm,$pgUrl)
	{ 
		$totPgAtTm = PAGE_ONCE;  
		/*$totPgAtTm is the variable that is used to set the total no of page numbers that should appear at a time to the users */
		$presPgNo  = $pagenum;
		if ( ($presPgNo) == 1 )
		{
			$countNew = $presPgNo+1;
			$lstPnNo  = $presPgNo+$totPgAtTm;
			$_SESSION['liDat'] = '';
			for ( $i = $presPgNo; $i <= $totPgAtTm; $i++ )
			{
			   $_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url().$pgUrl."&pgno=".$i.">".$i."</a></li>";
			}
		}
		else if ( ($presPgNo%$totPgAtTm) == 0 )
		{
			$countNew = $presPgNo+1;
			$lstPnNo  = $presPgNo+$totPgAtTm;
			$_SESSION['liDat'] = '';
			for ( $i = $countNew; $i <= $lstPnNo; $i++ )
			{
			   $_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url().$pgUrl."&pgno=".$i.">".$i."</a></li>";
			   
			}
		}
		else if ( ($presPgNo%$totPgAtTm) == 1 )
		{
			$countNew = $presPgNo-20;
			$lstPnNo  = 20;
			$lstPnNo2 = $countNew+$lstPnNo;
			$_SESSION['liDat'] = '';
			for ( $i = $countNew; $i < $lstPnNo2; $i++ )
			{
			   $_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url().$pgUrl."&pgno=".$i.">".$i."</a></li>";  
			}
		
		}
		$funcCls = new Func();
		$usrFulDat = $funcCls->getAllMemberLim($pagenum,$tblnm);
		$tbData    = '';
		
		foreach($usrFulDat as $echDat)
		{
			$tbData2 = "<tr><td>".$echDat->membership_id."</td><td>".$echDat->firstname."</td><td>".$echDat->lastname."</td><td>".$echDat->spouse_firstname."</td></tr>";
			$tbData = $tbData.$tbData2;
		}
		return $tbData;
	}
	/*
	The below  block will execute only when the user loads the page for the first time without clicking on any page
	*/
	function firstPage($tblnm,$colNms,$pgUrl)
	{
		$totPgAtTm = PAGE_ONCE;
		$funcCls = new Func();
		$usrFulDat = $funcCls->getAllMember($tblnm,$colNms);
		$tbData = '';
		$cou = 1;
		$echDats = '';
		foreach($colNms as $colNm)
		{
			$echDats = $echDats.$echDat->$colNm; 
		}
		foreach ( $usrFulDat as $echDat )
		{
			$tbData2 = "<tr><td>".$echDat->membership_id."</td><td>".$echDat->firstname."</td><td>".$echDat->lastname."</td><td>".$echDat->spouse_firstname."</td></tr>";
			$tbData = $tbData.$tbData2;
		}
		for ( $cou = 1; $cou <= $totPgAtTm; $cou++)
		{
			$_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url().$pgUrl."&pgno=".$cou.">".$cou."</a></li>";
			
		}
		return $tbData; 
	}
}
?>