<!DOCTYPE html>
<html>
<head>
	<title>Yorestl</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script>
		$(function() 
			{
				$( "#datepicker" ).datepicker
				(
					{
					changeMonth: true,
					changeYear: true
					}
				 );
			}
		);
	</script>
</head>
<body>
<header id="head" >
<!-- START BLOCK : header -->
	<p class="title"><a href="/wall/index.php">Yorestl</a></p>
<!-- END BLOCK : header -->
			 
<!-- START BLOCK : create -->
	<p class="sign">Create an account!</p>
	<p class="free">It's free and always will be.</p>
<!-- END BLOCK : create -->

<!-- START BLOCK : header_thx -->
	<p class="thx">Thank you for your Registration!</p>
	<div class="box"></div>
<!-- END BLOCK : header_thx -->
</header>

<!-- START BLOCK : login -->
<form method="post" action="index.php?actie=login" style="width: 460px;">
 <ul>
	 <li class="user">
		 <input placeholder=" Email" type="text" name="email" required /><br>
	 </li>
	 <li class="password">
		 <input placeholder=" Password" type="password" name="passwoord" required /><br>
	 </li>
	 <li class="buttons">
		 <input class="login" type="submit" name="login" value="Log in" />
	 </li>
 </ul>
</form>
<!-- END BLOCK : login -->

<!-- START BLOCK : text_thx -->
<p class="text">Thank you for registering on Yorestl, the one and only website for people with things on their mind! Your account has been created and is ready to be used. Please login with the emailadress and password, you used while filling in the registration form. Having trouble accessing your account? Please contact one of the admins.<p>
 <!-- END BLOCK : text_thx -->

<!-- START BLOCK : error -->
<div class="error">
<!-- END BLOCK : error -->

<!-- START BLOCK : end_error -->
</div>
<!-- END BLOCK : end_error -->

<!-- START BLOCK : form -->
<div class="reg">
	<form action="index.php?actie=registreren" method="POST" >
		<input class="reg" id="voornaam" placeholder=" first name" type=" text" name="voornaam"required/>
		<input class="reg" id="achternaam" placeholder=" last name" type=" text" name="achternaam" required/><br>
		<input class="reg" id="datepicker" placeholder=" birthday" type=" text" name="geboortedatum" required/><br>
		<input class="reg" id="adress" placeholder=" address" type=" text" name="adres" required/>
		<input class="reg" id="zipcode" placeholder=" postalcode" type=" text" name="postcode" required/><br>
		<input class="reg" id="country" placeholder=" residence" type=" text" name="woonplaats" required/><br>
		<input class="reg" id="tel" placeholder=" telephone number" type=" text" name="telefoon"/>
		<input class="reg" id="mobiel" placeholder=" mobile number" type=" text" name="mobiel"/><br><br>
		<input class="rege" id="email" placeholder=" email" type="email" name="email" required/><br>
		<input class="rege" id="email2" placeholder=" re-enter email" type="email" name="email2" required /><br><br>
		<input class="rege" id="nickname" placeholder=" username" type=" text" name="nicknaam" required /><br>
		<input class="rege" id="passwoord" placeholder=" password" type="password" name="passwoord" required /><br>
		<input class="rege" id="passwoord2" placeholder=" re-enter password" type="password" name="passwoord2" required/><br><br>
		<p class="regf"><input type="radio" name="geslacht" value="female" required>Female</p>
		<p class="regm"><input type="radio" name="geslacht" value="male" required>Male</p>
		<p class="rego"><input type="radio" name="geslacht" value="other" required>Other</p>
		<input class="but_reg" type="submit" value="Create an account" name="submit" />
	</form>
</div>
<!-- END BLOCK : form -->

<!-- START BLOCK : edit -->
<div class="bge">
	<div class="infoe">
		<form action="profile.php?actie=edit&id='".persoon_id."'" method="post" enctype = "multipart/form-data"> 
		    <label>first name:</label><input type="text" value= "{voornaam}" name="voornaam"  /><br />
		    <label>last name:</label><input type="text" value= "{achternaam}"  name="achternaam"><br />
		    <label>day of birth:</label><input id="datepicker" type="text" value= "{geboortedatum}" name="geboortedatum"><br />
		    <label>adress:</label><input type="text" value= "{adres}"  name="adres"><br />
			<label>avatar:</label> <input id="edit" type="file" name="file" id="file" size="60"/></br>
		</div>

	  	<div class="infoe2">
		    <label>postal code:</label><input type="text" value= "{postcode}"  name="postcode"><br />
		    <label>residence:</label><input type="text" value= "{woonplaats}"  name="woonplaats"><br />
		  	<label>telephone:</label><input type="text" value= "{telefoon}" name="telefoon"><br />
		  	<label>mobile:</label><input type="text" value= "{mobiel}" name="mobiel"><br />
		   	<input type="hidden" name="id" value="{id}" />
		    <div id="bute"><input type="submit" name="submit" value="submit"></div>
		</div>
	</form>
</div>
<!-- END BLOCK : edit-->

<!-- START BLOCK : inlog -->
<p class="naam"><a href="profile.php?id=<?php echo $id; ?>"><?php echo  $voornaam ." ". $achternaam; ?></a></p>
<p class="home"><a href="home.php">home</a></p>
<p class="loguit"><a href="index.php?actie=loguit">log uit</a></p> 
<!-- END BLOCK : inlog -->

</body>
</html>