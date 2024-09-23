<?php
include('includes/head.php');
include('includes/nav.php');
?>
<?php require_once"pages/".$data["page"].".php"?>
<?php
include('includes/scripts.php');

//Fetch data footer
use Mvc\Controllers\Footer;
$footerController = new Footer();
$data = $footerController->fetchFooterData();
include('includes/footer.php');
?>