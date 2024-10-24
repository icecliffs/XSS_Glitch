<?php
$timeNow = date('Y-m-d-H-i-s');
$requestHeaders = getallheaders();
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$requestQuery = $_SERVER['QUERY_STRING'];
function uuid() {  
    $chars = md5(uniqid(mt_rand(), true));  
    $uuid = substr ( $chars, 0, 8 ) . '-'
    . substr ( $chars, 8, 4 ) . '-' 
    . substr ( $chars, 12, 4 ) . '-'
    . substr ( $chars, 16, 4 ) . '-'
    . substr ( $chars, 20, 12 );  
    return $uuid ;  
}  
$httpReqData = "Captured HTTP Request Information: \n------------------\n"; 
$httpReqData .= "Method: " . $requestMethod . "\n";
$httpReqData .= "Uri   : " . $requestUri. "\n";
$httpReqData .= "Query : " . $requestQuery. "\n\n";
foreach ($requestHeaders as$key => $value) {
    $httpReqData .= $key . ": " .$value . "\n";
}
if ($requestMethod === 'POST') {
    $httpReqData .= "\nPOST Data:\n";
    foreach ($_POST as$key => $value) {
        $httpReqData .=$key . ": " . $value . "\n";
    }
}
$httpReqData .= "------------------\n";
$outputFileName = $timeNow . '-' . uuid() . '.txt';
file_put_contents($outputFileName, $httpReqData, FILE_APPEND | LOCK_EX);