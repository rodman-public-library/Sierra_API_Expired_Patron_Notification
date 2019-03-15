<?php
//include our functions file
if (!$_POST['submit']){
	header('loginForm.html');
}
$barcodeForm = $_POST['barcode'];
$pinForm = $_POST['pin'];
include('includes/functions.php');

// change the code below this to customize the body of the email that is being sent to the patron

//date ranges to use in the json string
$lastMonday = date('Y-m-d', strtotime('-7 days',strtotime('previous monday')));
$lastSunday = date('Y-m-d', strtotime('-7 days',strtotime('this sunday')));
$today              = strtotime('today');
$yesterday          = date('Y-m-d', strtotime('-1 day', $today));
$firstDayOfNextMonth = date("Y-m-d", strtotime("first day of next month midnight"));
$lastDayOfNextMonth = date("Y-m-d", strtotime("last day of next month midnight"));
$thirtydaysfromtoday = date('Y-m-d',strtotime('+30 days',$today));
$threeWeeksAfterThisWeekStart = date('Y-m-d',strtotime('28 days',strtotime('monday this week')));
$threeWeeksAfterThisWeekEnd = date('Y-m-d',strtotime('34 days',strtotime('monday this week')));

$patronsEmailed = array();

//json query built from Sierra Create Lists that gets a list of expiring patrons
//that will expire the next month.

$query_string = '
{
  "barcode": "' . $barcodeForm . '",
  "pin": "' . $pinForm . '"
}
';
//echo "Showing records for patrons who are expiring between " . $firstDayOfNextMonth . " and " . $lastDayOfNextMonth;
//echo "<br />";

//uri that is unique to your Sierra environment to do a patron query
  $uri = 'https://';
  $uri .= appServer;
  $uri .= ':443/iii/sierra-api/v';
  $uri .= apiVer;
  $uri .= '/patrons/validate';
  $uri .= '?limit=' . numberOfResults; //use this to limit the # of results
  $uri .= '&offset=' . resultOffset;


//setup the API access token
setApiAccessToken();

//get the access token we just created
$apiToken = getCurrentApiAccessToken();

//build the headers that we are going to use to post our json to the api
$headers = array(
    "Authorization: Bearer " . $apiToken,
    "Content-Type:  application/json"
);

//use the headers, url, and json string to query the api
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
$curl_error = curl_error($ch);
$outputCheck = '{"code":108,"specificCode":0,"httpStatus":400,"name":"Invalid parameter","description":"Invalid parameter : Invalid barcode or PIN"}';
$check = strcmp($output, $outputCheck);
if ($check == 1){
	header('Location: http://local.rodmanlibrary.com/scripts/patronRenewal/loginForm.php?check=1');

}
else{
	$_POST['cats'] = 1;
	$_POST['barcode2'] = $barcodeForm;
	header("Location: http://local.rodmanlibrary.com/scripts/patronRenewal/update.php?barcode={$_POST['barcode2']}");
}
curl_close($ch);

?>
