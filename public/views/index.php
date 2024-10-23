<?php
$imageUrl=$_ENV["PICTURE_URL"];
use Mvc\Controllers\Setting;
$headerController = new Setting();

$header = $headerController->fetchHeaderData();
include('includes/header.php');
include('includes/nav.php');

require_once "pages/" . $data["page"] . ".php";

include('includes/scripts.php');

//Fetch data footer
$footerController = new Setting();
$footer = $footerController->fetchFooterData();
include('includes/footer.php');
?>