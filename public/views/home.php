<?php
use Mvc\Controllers\Footer;
$footerController = new Footer();

$header = $footerController->fetchHeaderData();
include('includes/head.php');
include('includes/nav.php');
// unset($data[]);
 require_once"pages/".$data["page"].".php"?>
<?php
include('includes/scripts.php');

//Fetch data footer
$footer = $footerController->fetchFooterData();
include('includes/footer.php');
?>