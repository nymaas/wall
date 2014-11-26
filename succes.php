<?php
include_once ( "class.TemplatePower.inc.php" );
$tpl = new TemplatePower( "wall.tpl" );
$tpl->prepare();

include 'config.php';
require('db.php');

if(isset($_POST['submit']))
{
header("Location:index.php");
}
	
$tpl ->newBlock("header");
$tpl ->newBlock("login");	
$tpl ->newBlock("error");
$tpl ->newBlock("end_error");
$tpl ->newBlock("header_thx");
$tpl ->newBlock("text_thx");

$tpl->printToScreen();
?>
	

