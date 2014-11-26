<?php
// configuration
$dbhost 	= "localhost";
$dbname		= "wall";
$dbuser		= "root";
$dbpass		= "";
 
// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

function Regi()
{
	global $conn;
	$errmsg_arr = array();
	$errflag = false;

	// new data
	$nicknaam = htmlentities($_POST['nicknaam']);
	$passwoord = $_POST['passwoord'];
	$passwoord2 = $_POST['passwoord2'];
	$voornaam = htmlentities($_POST['voornaam']);
	$achternaam = htmlentities( $_POST['achternaam']);
	$email = $_POST['email'];
	$email2 = $_POST['email2'];
	$geboortedatum = $_POST['geboortedatum'];
	$adres = htmlentities($_POST['adres']);
	$postcode = htmlentities($_POST['postcode']);
	$woonplaats = htmlentities($_POST['woonplaats']);
	$telefoon = $_POST['telefoon'];
	$mobiel = $_POST['mobiel'];
	$geslacht = $_POST['geslacht'];


	if($nicknaam == '') 
	{
		$array[] = 'nickname';
		$errflag = true;
	}
	if($passwoord == '') 
	{
		$array[] = 'passwoord';
		$errflag = true;
	}
	if($passwoord2 == '') 
	{
		$array[] = 'passwoord2';
		$errflag = true;
	}
	if ($passwoord != $passwoord2)
	{
		$array[] = 'passwoordcheck';
		$errflag = true;
	}
	if($voornaam == '') 
	{
		$array[] = 'voornaam';
		$errflag = true;
	}
	if($achternaam == '') 
	{
		$array[] = 'achternaam';
		$errflag = true;
	}
	if($email == '') 
	{
		$array[] = 'email';
		$errflag = true;
	}
	if($email2 == '')
	{
		$array[] = 'email2';
		$errflag = true;
	}
	if ($email != $email2) 
	{
		$array[] = 'emailcheck';
		$errflag = true;
	}
	if($geboortedatum == '') 
	{
		$array[] = 'birthday';
		$errflag = true;
	}
	if($adres == '') 
	{
		$array[] = 'adress';
		$errflag = true;
	}
	if($postcode == '') 
	{
		$array[] = 'zipcode';
		$errflag = true;
	}
	if($woonplaats == '') 
	{
		$array[] = 'country';
		$errflag = true;
	}
	if($telefoon == '') 
	{
		$array[] = 'tel';
		$errflag = true;
	}
	if($mobiel == '') 
	{
		$array[] = 'mob';
		$errflag = true;
	}
	if($geslacht == '') 
	{
		$array[] = 'gender';
		$errflag = true;
	}

	$passwoord=md5($passwoord);
	$query = "SELECT * FROM gebruiker where email = '".$_POST['email']."'";
	$result = $conn->query($query);

	foreach($result as $row)
	{
		$emailVerif = $row['email'];
	}

	$query = "SELECT * FROM gebruiker where nicknaam = '".$_POST['nicknaam']."'";
	$result = $conn->query($query);
		
	foreach($result as $row)
	{
		$userVerif = $row['nicknaam'];
	}

	if(!isset($emailVerif))
	{
		$emailVerif = '';
	}
	if(!isset($userVerif))
	{
		$userVerif = '';
	}

	if($emailVerif != $email && $userVerif != $nicknaam)
		{
			$sql = "INSERT INTO persoon (voornaam,achternaam,geslacht,geboortedatum,adres,postcode,woonplaats,telefoon,mobiel,avatar) VALUES (:sas,:asas,:gena,:asafs,:adre,:zasa,:casa,:atel,:amob,'http://l-stat.livejournal.net/img/userpics/userpic-anonymous.png?v=15821')";
			$mql = "INSERT INTO gebruiker (persoon_id,groep_id,email,nicknaam,passwoord,status) VALUES (:ian,2,:ean,:san,:pan,1)";

			$q = $conn->prepare($sql);
			$q->bindParam(':sas', $voornaam, PDO::PARAM_INT);
			$q->bindParam(':asas', $achternaam, PDO::PARAM_INT);
			$q->bindParam(':gena', $geslacht, PDO::PARAM_INT);
			$q->bindParam(':asafs', $geboortedatum, PDO::PARAM_INT);
			$q->bindParam(':adre', $adres, PDO::PARAM_INT);
			$q->bindParam(':zasa', $postcode, PDO::PARAM_INT);
			$q->bindParam(':casa', $woonplaats, PDO::PARAM_INT);
			$q->bindParam(':atel', $telefoon, PDO::PARAM_INT);
			$q->bindParam(':amob', $mobiel, PDO::PARAM_INT);
			$q->execute();

			$ID = $conn->lastInsertId();

			$r = $conn->prepare($mql);
			$r->bindParam(':ian', $ID, PDO::PARAM_INT);
			$r->bindParam(':ean', $email, PDO::PARAM_INT);
			$r->bindParam(':san', $nicknaam, PDO::PARAM_INT);
			$r->bindParam(':pan', $passwoord, PDO::PARAM_INT);
			$r->execute();
		}
		if($emailVerif == $email)
		{
			$array[] = 'emailuse';
			$errflag = true;
			echo "This email adress is already in use";
		}
		if($userVerif == $nicknaam)
		{
			$array[] = 'useruse';
			$errflag = true;
			echo "This username is already in use";
		}
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['ERRTAG_ARR'] = $array;
		session_write_close();
		header("location: index.php");
		exit();
		}
}

function Login()
{
	global $db;
	global $conn;

	$user = $_POST['email'];
	$password= md5($_POST['passwoord']);
	 
	// query
	$result = $conn->prepare("SELECT *, count(*) as bla FROM gebruiker WHERE email= :hjhjhjh AND passwoord= :asas and status = 1");
	$result->bindParam(':hjhjhjh', $user);
	$result->bindParam(':asas', $password);
	$result->execute();
	
	foreach ($result as $row) 
	{
		$bla = $row['bla'];
	}

	if ($bla == 1) 
	{
		    $_SESSION['loggedin'] = true;
	        $_SESSION['email'] = $user;
	        $_SESSION['voornaam'] = $voornaam;
	        $_SESSION['gebruiker_id']=$row['id'];
	        $_SESSION['persoon_id']=$row['persoon_id'];
	        $_SESSION['groep_id']=$row['groep_id']; 
	        $_SESSION['SESS_CUSTOMERS_KENNEL'];
			header("location: home.php");
	}
	else
	{
	?>
	  <script type="text/javascript">
	    alert("Your emailaddress or password is incorrect, it is also possible that you have been banned");
	    history.back();
	  </script>
	<?php
	}
}

function Loguit()
{
	session_destroy();
	header("location: index.php");
}

function Loggedin()
{
	global $conn;
	$gebruiker_id=$_SESSION['gebruiker_id'];
	$persoon_id=$_SESSION['persoon_id'];
	$query = "select voornaam, achternaam, avatar from persoon where id= '".$persoon_id."'";
	$result=$conn->query($query);

	foreach ($result as $row) 
	{
	  $avatar = $row['avatar']; 
	  $voornaam = htmlentities($row['voornaam']);
	  $achternaam = htmlentities( $row['achternaam']);
	}

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
	   ?><img class="imgt" src="<?php echo $avatar; ?>"/><?php
	   ?><p class="naam"><a href="profile.php?id=<?php echo $gebruiker_id; ?>"><?php echo  $voornaam ." ". $achternaam; ?></a></p><?php
	   ?><p class="home"><a href="home.php">home</a></p><?php
	   ?><p class="loguit"><a href="index.php?actie=loguit">log uit</a></p><?php  
	} 
	else 
	{
	    echo "Please log in first to see this page.";
	}

	if ($_SESSION['groep_id'] == 1)
	{
		   ?><p class="admin"><a href="admin.php">admin</a></p><?php
	}
} 

function Wall($id)
{
	global $conn;

	$queryr = "select gebruiker.persoon_id as persoon_id, gebruiker.nicknaam as nicknaam,
	groep.type as type from gebruiker left join groep on gebruiker.groep_id = groep.id where gebruiker.id= '".$id."'";
	$result=$conn->query($queryr);

	foreach ($result as $row) 
	{
		$nicknaam = $row{'nicknaam'}; 
		$groupid = $row{'type'}; 
		?><div class="nickname"> 
		<?php echo $nicknaam ." (". $groupid .")"; ?></div><?php
	}

	$query = "select * from gebruiker
	left join persoon on gebruiker.persoon_id = persoon.id
	where gebruiker.id = '".$id."'";
	$result=$conn->query($query);

	foreach ($result as $row) 
	{
		$voornaam = htmlentities($row['voornaam']);
		$achternaam = htmlentities( $row['achternaam']);
		$geslacht = $row{'geslacht'};
		$geboortedatum = $row{'geboortedatum'};
		$adres = htmlentities($row['adres']);
		$postcode = htmlentities($row['postcode']);
		$woonplaats = htmlentities($row['woonplaats']);
		$telefoon = $row{'telefoon'};	 
		$mobiel = $row{'mobiel'};
	    $avatar = $row{'avatar'};

		?><div class="info"><div class="bg"></div>
		<table class="table">
		<div class="image"><img class="img" src="<?php echo $avatar; ?>"/></div>
		<tr>
		    <td><?php echo "Name: " ?> <br></td>
		    <td class="info"><?php echo $voornaam ." ". $achternaam; ?></td> 
		</tr>
		<tr>
			<tr>
				<td><?php echo "Gender: " ?> <br></td>
		    	<td class="info"><?php echo $geslacht; ?></td> 
		  	</tr>
		  	<tr>
		    	<td><?php echo "Day of birth: " ?> <br></td>
		    	<td class="info"><?php echo $geboortedatum; ?></td> 
		  	</tr>
		  	<tr>
		    	<td><?php echo "Address: " ?> <br></td>
		    	<td class="info"><?php echo $adres; ?></td> 
		  	</tr>
		    <tr>
		    	<td><?php echo "Postal code: " ?> <br></td>
		    	<td class="info"><?php echo $postcode; ?></td> 
		  	</tr>
		  	<tr>
		    	<td><?php echo "Residence: " ?> <br></td>
		    	<td class="info"><?php echo $woonplaats; ?></td> 
		  	</tr>
		  	<tr>
		    	<td><?php echo "Telephone: " ?> <br></td>
		    	<td class="info"><?php echo $telefoon; ?></td> 
		  	</tr>
		  	<tr>
		    	<td><?php echo "Mobile: " ?> <br></td>
		    	<td class="info"><?php echo $mobiel; ?></td> 
		  	</tr>
		</table> 
		</div><?php

		if ($id == $_SESSION['gebruiker_id']) 
		{
			?><p class="edit"><a href="profile.php?actie=edit&id=<?php echo $id; ?>">edit information</a></p><?php
		}
		if ($id != $_SESSION['gebruiker_id']) 
		{
			?><p class="editpost"><a href="posts.php?actie=post&id=<?php echo $id; ?>" input type="hidden" value="<?php echo $id; ?>" name="id">show posts from this user</a></p><?php
		}

		$_SESSION['blocked']=$row['status']; 
		if ($_SESSION['blocked'] == 0)
		{
			?><p class="blocked">this user is banned</p><?php
		}
		else
		{
			if ($_SESSION['groep_id'] == 1)
			{
				if ($id != $_SESSION['gebruiker_id']) 
				{
				?>	<form action="admin.php?actie=ban" method="post">
						<input type="hidden" value="<?php echo $id; ?>" name="xxid">
						<input type="submit" value="ban this user" name="submit" style="left: 880px; top: -241px; width: 70;position: relative;margin-bottom: -30px;"></div>
					</form><?php 
				}
			}
		}
	}
}

function getId ($id)
{
	global $conn;
	$sql = 'select * from gebruiker where gebruiker.id = '.$id;
	$result = $conn->query($sql);
	return $result->fetch(PDO::FETCH_ASSOC);
}

function loginhead()
{
	global $conn;
	$queryb = "SELECT * from persoon where id = ".$id;
	return $result=$conn->query($queryb);
} 


function updateId($voornaam,$achternaam,$geboortedatum,$adres,$postcode,$woonplaats,$telefoon,$mobiel,$avatar,$id)
{
	global $conn;
	$sql = "UPDATE persoon SET voornaam = '".$voornaam."',achternaam = '".$achternaam."',geboortedatum = '".$geboortedatum."',adres = '".$adres."',postcode = '".$postcode."',woonplaats = '".$woonplaats."',telefoon = '".$telefoon."',mobiel = '".$mobiel."',avatar = '".$avatar."' WHERE id = $id";
	$affected_rows = $conn->exec($sql);
}

function addComment($content,$post_id)
{
	global $conn;
	$gebruiker_id=$_SESSION['gebruiker_id'];
	$sql =	"INSERT INTO comment (content, datum, status, post_id, gebruiker_id) VALUES (:sas,:datum,'1',:asafs,:adre)";
	$q = $conn->prepare($sql);
	$time = time();

	$q->bindParam(':sas', $content, PDO::PARAM_INT);
	$q->bindParam(':asafs', $post_id, PDO::PARAM_INT);
	$q->bindParam(':adre', $gebruiker_id, PDO::PARAM_INT);
	$q->bindParam(':datum', $time, PDO::PARAM_INT);
	$q->execute();
}

function addPost($content)
{
	global $conn;
	$gebruiker_id=$_SESSION['gebruiker_id'];
	$sql =	"INSERT INTO post (content, datum, status, gebruiker_id) VALUES (:sas,:datum,'1',:adre)";
	$q = $conn->prepare($sql);
	$time = time();

	$q->bindParam(':sas', $content, PDO::PARAM_INT);
	$q->bindParam(':adre', $gebruiker_id, PDO::PARAM_INT);
	$q->bindParam(':datum', $time, PDO::PARAM_INT);
	$q->execute();
}

function editComment($content, $c_id)
{
	global $conn;
	$sql = "UPDATE comment SET content = '".$content."' WHERE id = ".$c_id."";
	$affected_rows = $conn->exec($sql);
}

function editPostComment($content, $postid)
{
	global $conn;
	$sql = "UPDATE post SET content = '".$content."' WHERE id = ".$postid."";
	$affected_rows = $conn->exec($sql);
}

function deletePost($postid)
{
	global $conn;
	$sql = "UPDATE post SET status = 0 WHERE id = ".$postid."";
	$affected_rows = $conn->exec($sql);
}

function deleteComment($postid)
{
	global $conn;
	$sql = "UPDATE comment SET status = 0 WHERE id = ".$postid."";
	$affected_rows = $conn->exec($sql);
}

function Ban($id)
{
	global $conn;
	$sql = "UPDATE gebruiker SET status = 0 WHERE id = ".$id."";
	$affected_rows = $conn->exec($sql);
}
function unBan($id)
{
	global $conn;
	$sql = "UPDATE gebruiker SET status = 1 WHERE id = ".$id."";
	$affected_rows = $conn->exec($sql);
}


function countlikes($id,$type)
{
	global $conn;
	$sql = "select count(*) as counted from liketable where type = '$type' and type_id = $id";
	$stmt = $conn->query($sql);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row['counted'];
}

function Banc($id)
{
	global $conn;
	$sql = "UPDATE gebruiker SET status = 0 WHERE id = ".$id."";
	$affected_rows = $conn->exec($sql);
}

function unBanc($id)
{
	global $conn;
	$sql = "UPDATE gebruiker SET status = 1 WHERE id = ".$id."";
	$affected_rows = $conn->exec($sql);
}

function smileys()
{
	global $conn;

	$chars = array(":hug:", "<3", ":france:", ":banana:", ":bla:", ":bignews:", ":grin:", ":bored:", "D:<", "8)", ":bro:", ":butterfly:", ":clap:", ":cloud9:", ":pc:", ":confused:", ":crazy:", ":cow:", ":lmfao:", ":evil:", ":duck:",":duh:",":getalife:", ":handkiss:",":headphones:", ":S", ";)", ":D", ":LOL:", ":cold:", ":nerd:", ":|", ":coffee:",":party:", ":X", ":thnx:", ":P", "):", ":WTF:", ":woot:",";*","XD","(a)","(A)",":brrr:");
	$icons = array(
					"<img src='http://www.freesmileys.org/smileys/smiley-hug002.gif' style='width: 47px; height: 18px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_heartbounce.gif' style='width: 16px; height: 14px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_baguette.gif' style='width: 32px; height: 32px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_banana.gif' style='width: 33px; height: 35px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_blablabla.gif' style='width: 60px; height: 60px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_bignews.gif' style='width: 49px; height: 27px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_blink.gif' style='width: 18px; height: 18px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_bored.gif' style='width: 34px; height: 24px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_boos.gif' style='width: 15px; height: 15px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_bro.gif' style='width: 15px; height: 15px; border: none;'>", 
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_bro.gif' style='width: 21px; height: 20px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_butterfly.gif' style='width: 35px; height: 27px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_clap.gif' style='width: 31px; height: 25px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_cloudnine.gif' style='width: 26px; height: 26px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_throwpc.gif' style='width: 60px; height: 26px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_confused_scheel.gif' style='width: 20px; height: 20px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_crazy.gif' style='width: 28px; height: 28px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_cow.gif' style='width: 30px; height: 20px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_crocodile.gif' style='width: 35px; height: 30px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_duivels.gif' style='width: 15px; height: 15px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_duck.gif' style='width: 24px; height: 31px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_duh.gif' style='width: 18px; height: 18px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_getalife.gif' style='width: 60px; height: 60px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_handkiss.gif' style='width: 42px; height: 27px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_headphones.gif' style='width: 26px; height: 24px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_indewar.gif' style='width: 18px; height: 18px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_knipoog.gif' style='width: 18px; height: 18px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_lach.gif' style='width: 18px; height: 18px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_lolonground.gif' style='width: 20px; height: 20px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_acold.gif' style='width: 34px; height: 36px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_nerd.gif' style='width: 20px; height: 16px; border: none;'>",
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_neutraal.gif' style='width: 15px; height: 15px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_newcoffee.gif' style='width: 44px; height: 40px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_party.gif' style='width: 20px; height: 30px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_sealed.gif' style='width: 16px; height: 15px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_thnx.gif' style='width: 52px; height: 54px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_tong2.gif' style='width: 15px; height: 15px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_verdrietig.gif' style='width: 16px; height: 15px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_wtf.gif' style='width: 33px; height: 37px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_woot.gif' style='width: 36px; height: 22px; border: none;'>",	
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_winkkiss.gif' style='width: 18px; height: 18px; border: none;'>",		
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_XD.gif' style='width: 20px; height: 20px; border: none;'>",		
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_angelic002.gif' style='width: 18px; height: 18px; border: none;'>",		
					"<img src='http://hyves-smileys.immerblei.com/img/smiley_angelic004.gif' style='width: 18px; height: 18px; border: none;'>",
					"<img src='http://yoursmiles.org/tsmile/cold/t09003.gif' style='width: 25px; height: 32px; border: none;'>"
				);
		$array = array($chars, $icons);
		return $array;
}
 
function editprofile($id)
{
	global $conn;
	$query = "select * from gebruiker
	left join persoon on gebruiker.persoon_id = persoon.id
	where gebruiker.id =".$id;
	$result=$conn->query($query);
	return $result;
}

function post()
{
	global $conn;
	$queryb = "SELECT post.id as postid, post.status, post.content, 
	persoon.avatar, post.datum AS datum, gebruiker.nicknaam, gebruiker.id as xxid FROM post 
	LEFT JOIN gebruiker ON post.gebruiker_id = gebruiker.id
	LEFT JOIN persoon ON gebruiker.persoon_id = persoon.id 
	where post.status = 1 ORDER BY datum DESC";
	$results=$conn->query($queryb);
	return $results;
}

function postpage($id)
{
	global $conn;

	$queryb = "SELECT post.id as postid, post.status, persoon.id as persoonid, post.content, persoon.avatar, post.datum AS datum, gebruiker.nicknaam, gebruiker.id as xxid FROM post 
	LEFT JOIN gebruiker ON post.gebruiker_id = gebruiker.id 
	LEFT JOIN persoon ON gebruiker.persoon_id = persoon.id where post.gebruiker_id = ".$id." and post.status = 1 ORDER BY datum DESC";
	$results=$conn->query($queryb);
	return $results;
}

function commentq($postid)
{
	global $conn;
	$queryb = "SELECT comment.id as commentid, comment.status, persoon.id as persoonid, comment.gebruiker_id as xxid, comment.content as content, comment.datum as datum, persoon.avatar, gebruiker.nicknaam FROM comment 
	LEFT JOIN gebruiker ON comment.gebruiker_id = gebruiker.id 
	LEFT JOIN post ON comment.post_id = post.id
	LEFT JOIN persoon ON gebruiker.persoon_id = persoon.id 
	WHERE comment.post_id = ".$postid."  and comment.status = 1 ORDER BY comment.id";
	$results=$conn->query($queryb);
	return $results;
}

function uploadimage()
{
	global $conn;

	$echo = '';
  	$allowedExts = array("gif", "jpeg", "jpg", "png");
  	$temp = explode(".", $_FILES["file"]["name"]); 
  	$extension = end($temp);

	  	if ((($_FILES["file"]["type"] == "image/gif")
	  || ($_FILES["file"]["type"] == "image/jpeg")
	  || ($_FILES["file"]["type"] == "image/jpg")
	  || ($_FILES["file"]["type"] == "image/pjpeg")
	  || ($_FILES["file"]["type"] == "image/x-png")
	  || ($_FILES["file"]["type"] == "image/png"))
	  && ($_FILES["file"]["size"] < 2000000000)
	  && in_array($extension, $allowedExts)) {
	    if ($_FILES["file"]["error"] > 0) {
	      $echo .= "Return Code: " . $_FILES["file"]["error"] . "<br>";
	    } else {
	      $echo .= "Upload: " . $_FILES["file"]["name"] . "<br>";
	      $echo .= "Type: " . $_FILES["file"]["type"] . "<br>";
	      $echo .= "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	      $echo .= "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
	      if (file_exists("css/media/" . $_FILES["file"]["name"])) {
	        $echo .=$_FILES["file"]["name"] . " already exists. ";
	      } else {
	        move_uploaded_file($_FILES["file"]["tmp_name"],
	        "css/media/" . $_FILES["file"]["name"]);
	        $echo .="Stored in: " . "css/media/" . $_FILES["file"]["name"];
	      }
	    }
	  }
	$avatar = 'css/media/'.$_FILES['file']['name'];
	return $avatar;
}

function like()
{
	global $conn;
	$type = $_GET['type'];
	$postid = $_GET['typeid'];
	$sql = "SELECT count(*) as count, value FROM liketable where gebruiker_id= ".$_SESSION["gebruiker_id"]." and liketable.type= '".$type."' and liketable.type_id = ".$postid.""; 
	$results = $conn->query($sql);
	
	foreach($results as $row)
	{
			$count = $row['count'];
			$value = $row['value'];
	}

	if($count == 0 )
	{
		$sql = "insert into liketable (gebruiker_id, type, type_id, datum, value) VALUES (:gebruiker_id, :type, :type_id, :datum, 1)";	
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':gebruiker_id', $_SESSION['gebruiker_id'], PDO::PARAM_INT);
		$stmt->bindParam(':type', $_GET['type'], PDO::PARAM_STR);
		$stmt->bindParam(':type_id', $_GET['typeid'], PDO::PARAM_INT);
		$stmt->bindParam(':datum', $date, PDO::PARAM_STR);		

		$date = time();
		$stmt->execute();
		header( "refresh:0;url=home.php");
	}
}

function unlike()
{
	global $conn;
	$type = $_GET['type'];
	$postid = $_GET['typeid'];
	$sql = "DELETE FROM liketable WHERE gebruiker_id= ".$_SESSION["gebruiker_id"]." and liketable.type= '".$type."' and liketable.type_id = ".$postid; 
	$results = $conn->query($sql);
	header( "refresh:0;url=home.php");
}

function likepost($postid)
{
	global $conn;
	$queryl = "select liketable.value from liketable where type = 'post' and liketable.type_id = ".$postid." and liketable.gebruiker_id = ".$_SESSION['gebruiker_id'];
	$resultl=$conn->query($queryl);
	$value = NULL;

	foreach ($resultl as $rowl) 
	{
	$value = $rowl['value'];
	}
	return $value;
}

function likecomment($c_id)
{
	global $conn;			
	$queryc = "select liketable.value from liketable where type = 'comment' and liketable.type_id = ".$c_id." and liketable.gebruiker_id = ".$_SESSION['gebruiker_id'];
	$resultc=$conn->query($queryc);
	$value = NULL;

	foreach ($resultc as $rowc) 
	{
	$value = $rowc['value'];
	}
	return $value;
}