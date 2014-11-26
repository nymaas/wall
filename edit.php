<?Php
include_once ( "class.TemplatePower.inc.php" );
$tpl = new TemplatePower( "wall.tpl" );
$tpl->prepare();

include 'config.php';
require('db.php');

	$tpl ->newBlock("header");	
	$tpl ->newBlock("inlog");
	$tpl->printToScreen();
	Wall();

if(isset($_GET['actie'])){
	$actie = $_GET['actie'];
}
else 
{ 
	$actie = null;
}

switch ($actie) {
			
	case 'edit':
		if (!isset($_POST['submit'])) {

		$tpl ->newBlock("edit");
		$tpl ->assign("nickname", "var");
		}  
		else
		{
		Edit();
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
?>