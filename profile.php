<?Php
include_once ( "class.TemplatePower.inc.php" );
$tpl = new TemplatePower( "wall.tpl" );
$tpl->prepare();

include 'config.php';
require('db.php');

if(!isset($_SESSION['email'])){
   header("Location:index.php");
}

if(isset($_GET['actie'])){
	$actie = $_GET['actie'];
}
else { 
	$actie = null;
}

if(isset($_GET['id'])){
	$id = $_GET['id'];}
else
{
	$id = null;
}

switch ($actie) 
{	
	case 'edit':
		if (!isset($_POST['submit']) && $_GET['id'])
		{
			$tpl ->newBlock("header");
			$tpl ->newBlock("inlog");
			$tpl ->newBlock("edit");
			$result = editprofile($_GET['id']);

			foreach ($result as $row) 
			{
				$tpl ->assign("id", $row['id']);
				$tpl ->assign("voornaam", $row['voornaam']);
				$tpl ->assign("achternaam", $row['achternaam']);
				$tpl ->assign("geboortedatum", $row['geboortedatum']);
				$tpl ->assign("adres", $row['adres']);
				$tpl ->assign("postcode", $row['postcode']);
				$tpl ->assign("woonplaats", $row['woonplaats']);
				$tpl ->assign("telefoon", $row['telefoon']);
				$tpl ->assign("mobiel", $row['mobiel']);
				$tpl ->assign("avatar", $row['avatar']);
			}

		}
		elseif ($_POST['submit']) 
		{
		$avatar = uploadimage();
		updateId($_POST['voornaam'],$_POST['achternaam'],$_POST['geboortedatum'],$_POST['adres'],$_POST['postcode'],$_POST['woonplaats'],$_POST['telefoon'],$_POST['mobiel'],$avatar,$_POST['id']);; 
		header( "refresh:0;url=home.php");
		} 
	break;
	default:
		$tpl ->newBlock("error");
		$tpl ->newBlock("end_error");
		$tpl ->newBlock("header");	
		$tpl ->newBlock("inlog");
		Wall($id);
	break;
}
$tpl->printToScreen();
Loggedin();
?>
