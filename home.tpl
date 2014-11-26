
<!-- START BLOCK : home -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Yorestl</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="style01.css" />
</head>
<!-- END BLOCK : home -->

<body>

<!-- START BLOCK : box -->
	<div class="UIComposer_Box">
		<form action="home.php?actie=post" method="post" >
			<textarea class="input" placeholder="what's on your mind?" id="watermark" name="content" 
			style="height: 40px;padding-bottom: 20px;padding-left: 5px;resize: none;margin-top: 80px;margin-left: 438px;width: 630px;margin-bottom: -14px;" cols="60"></textarea>
			<input type="submit" value="submit" name="submit" style="margin-top: 130px; margin-left: -65px;">
		</form>
		<br clear="all" />
	</div>
<!-- END BLOCK : box -->

<!-- START BLOCK : boxa -->
	<p style="height: 40px;padding-bottom: 20px;resize: none;margin-bottom: -14px;"></p>
	<br clear="all" />				
<!-- END BLOCK : boxa -->
	<div align="left" style="height:30px; padding:10px 5px;">
		<div class="content">

<!-- START BLOCK : post -->
 			<div id="commentscontainerpost" style="padding-top: 15px;">
				<div class="comments clearfixpost">
					<div class="avatar">
						<img src="{AVATAR}">
					</div>
					<div class="comment-text pull-leftpost">
						<div class="nicknaam">
							<a href="profile.php?id={ID}">{NICKNAAM}</a>
						</div>
						<div class="ptime">{DATE}</div>

<!-- START BLOCK : delete -->
						<div class="comment-text pull-left"></div>	
						<form action="home.php?actie=delete" method="post">
							<input type="hidden" value="{postid}" name="postid">
							<input type="submit" value="x" name="submit" style="left: 473px; top: -43px; position: relative;margin-bottom: -30px;">
						</form>
<!-- END BLOCK : delete -->

<!-- START BLOCK : deletea -->
						<div class="comment-text pull-left"></div>	
						<form action="home.php?actie=delete" method="post">
							<input type="hidden" value="{postid}" name="postid">
							<input type="submit" value="x" name="submit" style="left: 468px; top: -41px; position: relative;margin-bottom: -30px;">
						</form>
<!-- END BLOCK : deletea -->

<!-- START BLOCK : unban -->
						<form action="admin.php?actie=unban" method="post">
							<input type="hidden" value="{id}" name="id">
							<input type="submit" value="unban this user" name="submit" style="left: 376px; top: -41px; width: 85;position: relative;margin-bottom: -30px;">
						</form>
<!-- END BLOCK : unban -->				

<!-- START BLOCK : ban -->
						<form action="admin.php?actie=ban" method="post">
							<input type="hidden" value="{id}" name="id">
							<input type="submit" value="ban this user" name="submit" style="left: 390px; top: -41px; width: 70;position: relative;margin-bottom: -30px;">
						</form>
<!-- END BLOCK : ban -->
						<div class="pcontent">{PCONTENT}</div>
						<div class="links">
<!-- START BLOCK : not_liked -->
							<a href='home.php?actie=like&type=post&id={id}&typeid={postid}'> Like</a>
<!-- END BLOCK : not_liked -->

<!-- START BLOCK : liked -->
							<a href='home.php?actie=unlike&type=post&id={ID}&typeid={postid}' style="margin-left: -12.5px;">Unlike</a>
<!-- END BLOCK : liked -->	
							<span>{counted}</span>
							&#9812; 
							<a href="javascript:;" id="post_comment">
						 		<a href="javascript:;" onClick="document.getElementById('hideaway{P}').style.display='block';">Comment</a>
							</a>
						</div>

						<div class="comment-text pull-left">
							<form action="home.php?actie=comment" method="post">
								<div id="hideaway{P}" style="display:none;">
									<textarea class="text-holder" placeholder="Write a comment.." name="content"></textarea>
									<input type="hidden" value="{postid}" name="postid">
									<input type="submit" value="submit" name="submit" style="margin-left: 479px; margin-top: -48px;">
								</div>
							</form>
						</div>

<!-- START BLOCK : editpost -->
						<form action="home.php?actie=pedit" method="post">
							<div class="p_link">
								<a href="javascript:;" id="like_post"></a>&nbsp;
								<a href="javascript:;" id="post_comment">
									<a href="javascript:;" onClick="document.getElementById('hidecomment{P}').style.display='block';">Edit post</a>
									<div id="hidecomment{P}" style="display:none; margin-left: 60px;">
										<textarea class="text-holder"  name="content">{PCONTENT}</textarea>
										<input type="hidden" value="{postid}" name="postid">
										<input type="submit" value="submit" name="submit" style="margin-left: 480px; margin-top: -50px;">
									</div>
								</a>
							</div>
						</form>
<!-- END BLOCK : editpost -->
					</div>
				</div>
	
<!-- START BLOCK : comment -->
				<div id="commentscontainer" style="margin-left: 30px;">
					<div class="comments clearfix">
						<div class="pull-left lh-fixpost">
							<img src="{AVATAR}">
						</div>
						<div class="comment-text pull-leftpost">
							<div class="nicknaam">
								<a href="profile.php?id={ID}">{NICKNAAM}</a>
							</div>
							<div class="time">{DATE}</div>
							<div class="comment-text pull-left"></div>	
			 			
<!-- START BLOCK : deletec -->
							<form action="home.php?actie=deletecomment" method="post">
								<input type="hidden" value="{c_id}" name="c_id">
								<input type="submit" value="x" name="submit" style="left: 441px; top: -41px; position: relative;margin-bottom: -30px;">
							</form>
<!-- END BLOCK : deletec -->

 <!-- START BLOCK : deleteac -->
							<div class="comment-text pull-left"></div>	
							<form action="home.php?actie=deletecomment" method="post">
								<input type="hidden" value="{c_id}" name="c_id">
								<input type="submit" value="x" name="submit" style="left: 438px; top: -41px; position: relative;margin-bottom: -30px;">
							</form>
<!-- END BLOCK : deleteac -->
						</div>
	 
<!-- START BLOCK : unbanc -->
						<form action="admin.php?actie=unbanc" method="post">
							<input type="hidden" value="{id}" name="id">
							<input type="submit" value="unban this user" name="submit" style="left: 354px; top: -41px; width: 85;position: relative;margin-bottom: -30px;">
						</form>
<!-- END BLOCK : unbanc -->				

<!-- START BLOCK : banc -->
						<form action="admin.php?actie=banc" method="post">
							<input type="hidden" value="{id}" name="id">
							<input type="submit" value="ban this user" name="submit" style="left: 368px; top: -41px; width: 70; position: relative;margin-bottom: -30px;">
						</form>
<!-- END BLOCK : banc -->
						<div class="pcontent"><p class="content">{CONTENT}</p></div>
						<div class="c_links">

<!-- START BLOCK : not_likedc -->
							<a href='home.php?actie=like&type=comment&id={id}&typeid={commentid}'>{count} Like</a>						
<!-- END BLOCK : not_likedc -->

<!-- START BLOCK : likedc -->
							<a href='home.php?actie=unlike&type=comment&id={ID}&typeid={commentid}' style="margin-left: -12.5px;">Unlike</a>
<!-- END BLOCK : likedc -->
							<span>{counted}</span>
						
<!-- START BLOCK : editcomment -->
							<form action="home.php?actie=edit" method="post">
								<div class="c_link">
									<a href="javascript:;" id="like_post"></a>&nbsp;
									<a href="javascript:;" id="post_comment">
										<a href="javascript:;" onClick="document.getElementById('hidecomment{I}').style.display='block';">Edit comment</a>
									</a>
								</div>
								<div id="hidecomment{I}" style="display:none; margin-left: -210px;">
									<textarea class="text-holder" name="content">{CONTENT}</textarea>
									<input type="hidden" value="{c_id}" name="c_id">
									<input type="submit" value="submit" name="submit" style="margin-left: 479px; margin-top: -48px;">
								</div>
							</form>
<!-- END BLOCK : editcomment -->
						</div>
					</div>
				</div>	
<!-- END BLOCK : comment -->
			</div>
<!-- END BLOCK : post -->
		</div>
	</div>		
</body>
</html>