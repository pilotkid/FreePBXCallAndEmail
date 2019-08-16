<?php
header("Access-Control-Allow-Origin: *");

//Perform Checks

if(!isset($_REQUEST['exten']) || !isset($_REQUEST['number'])){
	header("HTTP/1.0 404 Not Found");
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
	echo "Please include exten and number in request";
	die();	
}

#ip address that asterisk is on.
$strHost = "127.0.0.1";

$strUser = "connectcall"; #specify the asterisk manager username you want to login with
$strSecret = "<Super_Secret_Password>";#specify the password for the above user

#Specify the Extension that you wish to call before connecting to client
# PJSIP/XXX, SIP/XXX, IAX2/XXXX, ZAP/XXXX

$strChannel = $_REQUEST['exten'];
$strContext = "from-internal";

#specify the amount of time you want to try calling the specified channel before hangin up

$strWaitTime = "30";

#specify the priority you wish to place on making this call
$strPriority = "1";

#specify the maximum amount of retries

$strMaxRetry = "2";
$number=strtolower($_REQUEST['number']);

$pos = strpos($number,"local");


if ($number == null){
	exit() ;
}

if ($pos===false) 
{
	$errno=0 ;
	$errstr=0 ;
	$strCallerId = "Answer to call" . $number;

	$netSocket = fsockopen ("localhost", 5038, $errno, $errstr, 20);
	if (!$netSocket) 
	{
		echo $errstr." (".$errno.")<br>\n";
	} 
	else 
	{
		fputs($netSocket, "Action: login\r\n");
		fputs($netSocket, "Events: off\r\n");
		fputs($netSocket, "Username: $strUser\r\n");
		fputs($netSocket, "Secret: $strSecret\r\n\r\n");
		fputs($netSocket, "Action: originate\r\n");
		fputs($netSocket, "Channel: $strChannel\r\n");
		fputs($netSocket, "WaitTime: $strWaitTime\r\n");
		fputs($netSocket, "CallerId: $strCallerId\r\n");
		fputs($netSocket, "Exten: $number\r\n");
		fputs($netSocket, "Context: $strContext\r\n");
		fputs($netSocket, "Priority: $strPriority\r\n\r\n");
		fputs($netSocket, "Action: Logoff\r\n\r\n");
		sleep(2);
		fclose($netSocket);
	}
	echo "Extension $strChannel should be calling $number." ;
}
else
{
	exit();
}
?>