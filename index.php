<?php
include_once ( "class.TemplatePower.inc.php" );
$tpl = new TemplatePower( "wall.tpl" );
$tpl->prepare();

include 'config.php';
require('db.php');


if(isset($_GET['actie']))
{
	$actie = $_GET['actie'];
}
else 
{ 
	$actie = null;
}

if(isset($_GET['id']))
{
	$id = $_GET['id'];
}
else 
{ 
	$id = null;
}

	switch ($actie) 
	{	
		case 'registreren':
			if (!isset($_POST['submit'])) 
			{
			$tpl ->newBlock("end_error");
			$tpl ->newBlock("form");
			}  
		else
			{
			Regi();
			header("location:succes.php");
			}
		break;
		case 'login':
			if (!isset($_POST['submit']))
			{
			Login();
			}
		break;
		case 'loguit':
			if (!isset($_POST['submit']))
			{
			Loguit();
			}
		break;
		default:
		$tpl ->newBlock("header");
		$tpl ->newBlock("create");
		$tpl ->newBlock("login");
		$tpl ->newBlock("form");	
		$tpl ->newBlock("error");
		$tpl ->newBlock("end_error");
		break;
	}
	$tpl->printToScreen();
?>
<script>
	$(function()
		{
			<?php
				foreach($_SESSION['ERRTAG_ARR'] as $tag) 
				{
					if($tag == 'emailcheck'){
					echo '$( "#email" ).switchClass( "rege", "errore");';
					echo '$( "#email" ).attr("placeholder","the emailaddress do not match");';
					echo '$( "#email2" ).switchClass( "rege", "errore");';
					echo '$( "#email2" ).attr("placeholder","the emailaddress do not match");';
					} elseif($tag == 'passwoordcheck'){
					echo '$( "#passwoord" ).switchClass( "rege", "errore");';
					echo '$( "#passwoord" ).attr("placeholder","the passwords do not match");';
					echo '$( "#passwoord2" ).switchClass( "rege", "errore");';
					echo '$( "#passwoord2" ).attr("placeholder","the passwords do not match");';
					} elseif($tag == 'emailuse'){
					echo '$( "#email" ).switchClass( "rege", "errore");';
					echo '$( "#email" ).attr("placeholder","this emailaddress is already in use");';
					echo '$( "#email2" ).switchClass( "rege", "errore");';
					echo '$( "#email2" ).attr("placeholder","this emailaddress is already in use");';
					} elseif($tag == 'useruse'){
					echo '$( "#nickname" ).switchClass( "rege", "errore");';
					echo '$( "#nickname" ).attr("placeholder","this username is already in use");';
					} 
					else{
					echo '$( "#'.$tag.'" ).switchClass( "reg", "error");';
					}
				}
				$_SESSION['ERRTAG_ARR'] = '';
			?>
		}
	);
</script>