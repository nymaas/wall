<?Php
include_once ( "class.TemplatePower.inc.php" );
$tpl = new TemplatePower( "wall.tpl" );
$tpl->prepare();
$hpl = new TemplatePower( "home.tpl" );
$hpl->prepare();

include 'config.php';
require('db.php');

$hpl ->newBlock("home");	
$tpl ->newBlock("header");	
$tpl ->newBlock("error");
$tpl ->newBlock("end_error");
$tpl ->newBlock("inlog");

if(!isset($_SESSION['email']))
{
header("Location:index.php");
}

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
		case 'delete':
			if (isset($_POST['submit']))
			{
				deletePost($_POST['postid']);
				header( "refresh:0;url=home.php");
			}
		break;
		case 'deletecomment':
			if (isset($_POST['submit']))
			{
				deleteComment($_POST['c_id']);
				header( "refresh:0;url=home.php");
			}
		break;
		case 'ban':
			if (isset($_POST['submit']))
			{
				Ban($_POST['id']);
				header( "refresh:0;url=admin.php");
			}
		break;
		case 'unban':
			if (isset($_POST['submit']))
			{
				unBan($_POST['id']);
				header( "refresh:0;url=admin.php");
			}
		break;
		case 'banc':
			if (isset($_POST['submit']))
			{
				Ban($_POST['id']);
				header( "refresh:0;url=admin.php");
			}
		break;
		case 'unbanc':
			if (isset($_POST['submit']))	
			{
			unBan($_POST['id']);
			header( "refresh:0;url=admin.php");
			}
		break;
	}
	Loggedin();
	$hpl ->newBlock("boxa");
	$results = post();
	$p = 0;
	$i = 0;

	foreach ($results as $row) 
	{
		$avatar = $row['avatar']; 
		$nicknaam = $row['nicknaam'];
		$pcontent = $row['content'];
		$postid = $row['postid'];
		$datum = $row['datum'];
		$id = $row['xxid'];
		$date = date("l j F Y, g:i:s A", $datum);
		$blocked = $row['status'];

		$db_str = $pcontent;
		$stuff = smileys();
		$icons = $stuff[1];
		$chars = $stuff[0];
		$new_str = str_replace($chars,$icons,$db_str);

		$hpl ->newBlock("post");
		$hpl ->assign('AVATAR', $avatar);
		$hpl ->assign('ID', $id);
		$hpl ->assign('NICKNAAM', $nicknaam);
		$hpl ->assign('DATUM', $datum);
		$hpl ->assign('DATE', $date);
		$hpl ->assign('postid', $postid);
		$hpl ->assign('PCONTENT', $new_str); 	
		$hpl ->assign('P', $p);
		$p++;

		$hpl ->newBlock("deletea");
		$hpl ->gotoBlock("post");

		if ($blocked == 0)
		{
			$hpl ->newBlock("unban");
			$hpl ->assign('id', $id);
			$hpl ->gotoBlock("post");
		} 
		else
		{
			$hpl ->newBlock("ban");
			$hpl ->assign('id', $id);
			$hpl ->gotoBlock("post");
		}


		$results = commentq($row['postid']);

		foreach ($results as $row) 
		{
			$avatar = $row['avatar']; 
			$nicknaam = $row['nicknaam'];
			$content = $row['content'];
			$datum = $row['datum'];
			$id = $row['xxid'];
			$c_id = $row['commentid'];
			$date = date("l j F Y, g:i:s A", $datum);

			$db_str = $content;
			$stuff = smileys();
			$icons = $stuff[1];
			$chars = $stuff[0];
			$new_str = str_replace($chars,$icons,$db_str);

			$hpl ->newBlock("comment");
			$hpl ->assign('ID', $id);
			$hpl ->assign('AVATAR', $avatar);
			$hpl ->assign('c_id', $c_id);
			$hpl ->assign('NICKNAAM', $nicknaam);
			$hpl ->assign('DATUM', $datum);
			$hpl ->assign('DATE', $date);
			$hpl ->assign('CONTENT', $new_str); 
			$hpl ->assign('postid', $postid);
			$blockedc = $row['status'];
						
			$hpl ->newBlock("deleteac");
			$hpl ->assign('c_id', $c_id);					
			$hpl ->assign('I', $i);
			$i++; 
			$hpl ->gotoBlock("comment");

			$hpl -> gotoBlock("post");

			if ($blockedc == 0)
			{
				$hpl ->newBlock("unbanc");
				$hpl ->assign('id', $id);
				$hpl ->gotoBlock("post");
			} 
			else
			{
				$hpl ->newBlock("banc");
				$hpl ->assign('id', $id);
				$hpl ->gotoBlock("post");
			}				
		}
	}
	$tpl->printToScreen();
	$hpl->printToScreen();
?>

