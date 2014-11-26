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
		case 'post':
			if (isset($_POST['submit']))
			{

				addPost($_POST['content']);; 
				header( "refresh:0;url=home.php");
			}
			break;			
		case 'comment':
			if (isset($_POST['submit']))
			{

				addComment($_POST['content'],$_POST['postid']);
				header( "location:home.php");
			}
			break;
		case 'edit':
			if (isset($_POST['submit']))
			{
				editComment($_POST['content'],$_POST['c_id']); 
				//header( "refresh:0;url=home.php");
			}
			break;
		case 'pedit':
			if (isset($_POST['submit']))
			{
				editPostComment($_POST['content'],$_POST['postid']); 
				header( "refresh:0;url=home.php");
			}
			break;
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
		case 'like':
			like();
			break;

		case 'unlike':
			unlike();
			break;

    	default:
		Loggedin();
		$hpl ->newBlock("box");
		$results = post();
		$p = 0;
		$i = 0;
		$c = 1;

	    foreach ($results as $row) 
			{
			    $avatar = $row['avatar']; 
			    $nicknaam = $row['nicknaam'];
			    $pcontent = $row['content'];
			    $postid = $row['postid'];
			    $datum = $row['datum'];
			    $id = $row['xxid'];
			    $date = date("l j F Y, g:i:s A", $datum);

			    $value = likepost($row['postid']);
				$likes = countlikes($postid,'post');

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
				$hpl ->assign('PCONTENT', $new_str);
				$hpl ->assign('postid', $postid);
				$hpl ->assign('counted', $likes);

				$hpl ->assign('P', $p);
				$p++;

				if ($id == $_SESSION['gebruiker_id']) {
				$hpl ->newBlock("editpost");
				$hpl ->assign('PCONTENT', $pcontent);
				$hpl ->assign('postid', $postid);					 
				$hpl ->assign('P', $p);
				$p++;
				$hpl ->newBlock("delete");
				$hpl ->assign('postid', $postid);
				$hpl ->gotoBlock("post");
				}

				if($value == NULL)
				{
				$hpl ->newBlock("not_liked");
				$hpl ->assign('postid', $postid);
				$hpl ->assign('id', $id);
				$hpl ->gotoBlock("post");				 	
				}
				elseif($value != NULL)
				{
				$hpl ->newBlock("liked");
				$hpl ->assign('postid', $postid);
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
					
					$value = likecomment($row['commentid']);
					$like = countlikes($c_id,'comment');

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
					$hpl ->assign('counted', $like);

					if ($id == $_SESSION['gebruiker_id']) 
					{
					$hpl ->assign('CONTENT', $new_str); 													
					$hpl ->newBlock("deletec");
					$hpl ->assign('c_id', $c_id);					
					$hpl ->newBlock("editcomment");
					$hpl ->assign('CONTENT', $content);
					$hpl ->assign('c_id', $c_id);
					$hpl ->assign('I', $i);
					$i++; 
					$hpl ->gotoBlock("comment");
					}

					if($value == NULL)
					{
					$hpl ->newBlock("not_likedc");
					$hpl ->assign('commentid', $c_id );
					$hpl ->assign('id', $id);
					$hpl ->gotoBlock("comment");				 	
					}
					elseif($value != NULL )
					{
					$hpl ->newBlock("likedc");
					$hpl ->assign('commentid',  $c_id );
					$hpl ->assign('id', $id);
					$hpl ->gotoBlock("comment");	
					}
					$hpl -> gotoBlock("post");
				}
			}
		break;
	}
	$tpl->printToScreen();
	$hpl->printToScreen();
?>

