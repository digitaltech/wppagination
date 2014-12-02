<?php
/*
Plugin name: Pagination plugin
Description: This is a simple plugin to create pagination
Author: Sourabh Kumar Sharma
*/ 
require_once 'func.php';
$funcCls = new Func();
$totMem  = $funcCls->getTotRow($tblnm);
//die("Total members:".($totMem[0]->totMem));
/* $_SESSION['liDat'] is the variable that is used to store the values of the page number data that is the page numbers which when clicked load the data  */
if (!isset($_SESSION['liDat'])){
	$_SESSION['liDat'] = ' ';
}
$totPgAtTm = 20;  //this is the variable that is used to set the total no of page numbers that should appear at a time to the users

 
if (isset($_REQUEST['pgno'])){
		
		$presPgNo  = $_REQUEST['pgno'];
		if ( ($presPgNo) == 1 )
		{
			$countNew = $presPgNo+1;
			$lstPnNo  = $presPgNo+$totPgAtTm;
			$_SESSION['liDat'] = '';
			for ( $i = $presPgNo; $i <= $totPgAtTm; $i++ )
			{
			   $_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url()."/life-member?pgno=$i".">".$i."</a></li>";
		    }
		}
		else if ( ($presPgNo%$totPgAtTm) == 0 )
		{
			$countNew = $presPgNo+1;
			$lstPnNo  = $presPgNo+$totPgAtTm;
			$_SESSION['liDat'] = '';
			for ( $i = $countNew; $i <= $lstPnNo; $i++ )
			{
				//echo "This is a test so please ignore this test here as this is a test to test the functionality here".$i;
			   $_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url()."/life-member?pgno=$i".">".$i."</a></li>";
			   
		    }
		}
		else if ( ($presPgNo%$totPgAtTm) == 1 )
		{
			//die("Remainder is 1");
			$countNew = $presPgNo-20;
			$lstPnNo  = 20;
			$lstPnNo2 = $countNew+$lstPnNo;
			$_SESSION['liDat'] = '';
			for ( $i = $countNew; $i < $lstPnNo2; $i++ )
			{
				//echo "This is a test so please ignore this test here as this is a test to test the functionality here".$i;
			   $_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url()."/life-member?pgno=$i".">".$i."</a></li>";  
		    }
		}
		$usrFulDat = $funcCls->getAllMemberLim($tblnm,$_REQUEST['pgno']);
		$tbData    = '';
		
		foreach($usrFulDat as $echDat){
			$tbData2 = "<tr><td>".$echDat->membership_id."</td><td>".$echDat->firstname."</td><td>".$echDat->lastname."</td><td>".$echDat->spouse_firstname."</td></tr>";
			$tbData = $tbData.$tbData2;
		}
	}
	/*
	The below else if block will execute only when the user loads the page for the first time without clicking on any page
	*/
else if (isset($_REQUEST['data']) && $_REQUEST['data'] == 'all'){
		$usrFulDat = $funcCls->getAllMember($tblnm);
		$tbData = '';
		$cou = 1;
		foreach ( $usrFulDat as $echDat )
		{
			$tbData2 = "<tr><td>".$echDat->membership_id."</td><td>".$echDat->firstname."</td><td>".$echDat->lastname."</td><td>".$echDat->spouse_firstname."</td></tr>";
			$tbData = $tbData.$tbData2;
		}
		for ( $cou = 1; $cou <= $totPgAtTm; $cou++)
		{
			$_SESSION['liDat'] = $_SESSION['liDat']."<li class = 'liStNone'><a href = ".site_url()."/life-member?pgno=$cou".">".$cou."</a></li>";
			
		}
	}
?>