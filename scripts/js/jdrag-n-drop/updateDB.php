<?php 
require("../../php/funcoes_bd.php");
$drive->conecta();
$action 				= $_POST['action']; 
$updateRecordsArray 	= $_POST['recordsArray'];
$table					= $_POST['tab'];
$recordId				= $_POST['recId'];
$recordPosition			= $_POST['recPos'];

if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {	
		$query = "UPDATE ".$table." SET ".$recordPosition." = " . $listingCounter . " WHERE ".$recordId." = " . $recordIDValue;
		$drive->pedido($query);
		$listingCounter = $listingCounter + 1;	
	}
}
$drive->close();
?>