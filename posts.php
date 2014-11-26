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
		default:
			Loggedin();
			$hpl ->newBlock("boxa");
			$results = postpage($_GET['id']);
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
							$hpl ->assign('postid', $postid);
							$hpl ->assign('CONTENT', $new_str); 
						}
				}
		break;
	}
	$tpl->printToScreen();
	$hpl->printToScreen();
?>

