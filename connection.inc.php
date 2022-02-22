<?php
session_start();
$con=mysqli_connect("localhost","oyti","1234","ecom");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/admin/');
define('SITE_PATH','http:/localhost/admin/');
define('PRODUCT_IMAGE_SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/media/product/');
define('PRODUCT_IMAGE_SITE_PATH','http://localhost/'.'/media/product/');

?>