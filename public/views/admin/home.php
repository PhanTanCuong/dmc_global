<?php
$imageUrl=$_ENV["PICTURE_URL"];
use Mvc\Controllers\Footer;
$footerController = new Footer();

$header = $footerController->fetchHeaderData();
include ('includes/header.php');
include ('includes/nav.php');
include_once('includes/Notification.php');
?>
<?php require_once"pages/".$data["page"].".php"?>
  <?php
include ('includes/scripts.php');
include ('includes/footer.php');
?>