<?php
//session_start();
include 'DB_Class.php';

class HTML_Generator {


	public $baseurl;
	public $headSection;
	public $footer;

	public $loginSection;
	public $registerSection;
	public $homeSection;
	public $db_Obj;

	public function __construct()
	{
		$this->db_Obj = new DB_Class();
		$this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";


		$this->headSection = '<!DOCTYPE html>
		<html lang="en" nighteye="active" style="background-image: none !important;" ne="0.32044710471749926">
		<head>

		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="bootstrap.css" type="text/css">
		<script type="text/javascript" src="jquery.js"></script>

		<title>AudioCloud Project</title>
		</head>
		<body>
		<header>
		<nav class="navbar">

		<div class="main_search row" style="margin-left:50%;"> 

		<span class="">  </span>

		
		</div>
		<div class="nav_brand align-content-center"><div id="logo"><a href="'. $this->baseurl .'?val=home"> <img  class="align-self-center" src="logoPNG.png" width="350" height="61" > </a></div>
		</div>
		</nav>
		</header> <div class="main_wrapper"><div id="content">';



		$this->homeSection = '	<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">Home Page</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		<p> Welcome to Audio Cloud </p>

		<div id="output"></div>

		</div>

		</div></div></div>';




		$this->loginSection = '	<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box" >Login Form</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		<form name="formlogin" id="formlogin" method="post">
		<div class="form-group">
		<label for="username">Username or Email Addess</label>
		<input type="text" class="form-control" id="username" placeholder="Email Enter Here" name="login_username"  maxlength="20"  required>
		</div>
		<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" placeholder="Your password here" name="login_password" maxlength="20" required>
		</div>
		<input type="hidden"  class="hidden" name="login" value="login">
		<input type="button" onclick="Login(this)" class="btn btn-primary btn-lg btn-block" value="LOGIN">
		</form><br>
		<p>Don\'t have an Account? <a href="#"> Registor Now!</a></p>

		<div id="output"></div>

		</div>

		</div></div></div>';


		$this->registerSection = ' <div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">Register Form</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		<form method="post" name="form_signup" id="form_signup">
		<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" id="username"  name="username" placeholder="username" required="">
		</div>
		<div class="form-group">
		<label for="firstName">First Name</label>
		<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required="">
		</div>
		<div class="form-group">
		<label for="lastName">Last Name</label>
		<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required="">
		</div>
		<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required="">
		</div>
		<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Your password here" required="">
		</div>
		<div class="form-group">
		<label for="repassword">Password</label>
		<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-enter password here" required="">
		</div>
		<input type="hidden"  class="hidden" name="signup" value="signup">

		<input type="button" class="btn btn-primary btn-lg btn-block" value="SIGNUP" onclick="Register(this)">
		</form><br>
		<p>Don\'t have an Account? <a href="'. $this->baseurl . '?val=registor"> Registor Now!</a></p>
		<div id="output"></div>
		</div>
		</div></div></div> ';




		$this->footer = ' <!-- Modal -->
		<div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalCenteredLabel">Modal title</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body" id="modal-body" >
		<span class="w-100" id="abcc"> </span>

		<br> 
		<div  id="modaltable">  
		</div> 


		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div> ';
		$this->footer .= '<script type="text/javascript" src="JS_form.js"></script> </div> <footer>Copyright © AudioCloud </footer> </div> </body></html>';



	}

	

	public function GiveMe_headerSection()
	{ 
		//setcookie ("username", 'username' ,time()+ (10 * 365 * 24 * 60 * 60));  
    	//setcookie ("password", 'password' ,time()+ (10 * 365 * 24 * 60 * 60));
		
		echo $this->headSection;
	}
	public function GiveMe_footerSection()
	{
		echo $this->footer;
	}

	public function GiveMe_HomeSection()
	{
		//echo $this->homeSection;

		$rows = $this->db_Obj->Get_NewUpdates();

		echo  '<div id="content_wrapper"> <div class="featured_image">
		<div class="head_box">Recently Updates </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 5px; padding-right: 10px; padding-bottom: 5px; padding-left: 20px; "> <div class="agileits-top">';

		if(!empty($rows))
		{

			$ro = $rows->fetch_array();
			echo '  <audio id="audioPlayer" controls="controls" loop >

			<source id="audiosrc" src="audioBank\\'.$ro['filename'].'">

			Your browser does not support the
			<code>audio</code> element.
			</audio> ';





			echo ' <div id="audioDetails">
			<ul>';


			foreach ($rows as $row)
			{
                        //var_dump($row);
                      //echo __DIR__ .'\\audioBank\\'.$row['filename'];
				if($row['publicPrivate'] == 0){
					echo '<li> <div class=" block-ellipsis"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$row['title'].'</span> </div> '
					.'<div class="d-flex" style="margin-left:10%;" >'
					.'<div class="p-2 flex-fill" > <a class="audioButton" href="audioBank\\'.$row['filename'].'" download> <img src="img/download" title="DOWNLOAD" /></a> </div>'

					.'<div class="p-2 flex-fill" > <form method="post" name="form_play'.$row['id'].'" id="form_play'.$row['id'].'"><input type="hidden"  class="hidden" name="play" value="'.$row['id'].'"/>  <span class="" id="played'.$row['id'].'"> '.$row['listenCount'].' </span>   <button type="button" class="audioButton" id="play" alt="Play" title="Play"  value="'.$row['id'].'" onclick="play_this(this)" > <img src="img/play.png"></button></form></div>';

					if(isset($_SESSION['log'])){
						echo  '<div class="p-2 flex-fill" > <form method="post" name="form_like'.$row['id'].'" id="form_like'.$row['id'].'"> <span class=""  id="liked'.$row['id'].'"> '.$row['liked'].' </span> <input type="hidden"  class="hidden" name="like" value="'.$row['id'].'"> <button type="button" class="audioButton" id="like'.$row['id'].'" alt="Like"  title="Like" value="'.$row['id'].'" onclick="like_this(this)"> <img  id="like_image'.$row['id'].'" src="img/like-1" alt="Like" > <img  id="like_imagee'.$row['id'].'" src="img/like-2" alt="Like" style="display:none;" > </button></form> </div>'

						.'<div class="p-2 flex-fill" > <form name="form_dislike'.$row['id'].'" id="form_dislike'.$row['id'].'"><input type="hidden" class="hidden" name="dislike" value="'.$row['id'].'">  <span class=""  id="disliked'.$row['id'].'"> '.$row['disliked'].' </span>    <button type="button" class="audioButton" id="dislike'.$row['id'].'" alt="Dislike" title="Dislike"  value="'.$row['id'].'" onclick="dislike_this(this)"> <img  id="dislike_image'.$row['id'].'" src="img/dislike-1" alt="Dislike"> <img  id="dislike_imagee'.$row['id'].'" src="img/dislike-2" alt="DisLike" style="display:none;" ></button> </form> </div>';


						echo '<div class="p-2 flex-fill" > <form name="form_playlist'.$row['id'].'" id="form_playlist'.$row['id'].'"><input type="hidden" class="hidden" name="playlist" value="'.$row['id'].'"> <button type="button" class="audioButton" id="playlist'.$row['id'].'" alt="playlist" title="Add To Playlist"  value="'.$row['id'].'"  data-toggle="modal" data-target="#exampleModalCentered" onclick="addToPlaylist_this(this)"  > <img src="img/playlist" alt="playlist">  </button> </form> </div>';
					}


					echo '<div class="p-2 flex-fill" > <form name="form_share'.$row['id'].'" id="form_share'.$row['id'].'"><input type="hidden"  class="hidden" name="share" value="'.$row['id'].'">  <span class=""  id="shared'.$row['id'].'"> '.$row['Shared'].' </span>    <button type="button" class="audioButton" id="share" alt="Share" title="Share" value="'.$row['id'].'"  data-toggle="modal" data-target="#exampleModalCentered" onclick="share_this(this)" > <img src="img/share" alt="Share" > </button> </form> </div> </div>'

					.'<span class="text-muted" style="font-size:11px; margin:0; padding:0;"> <span class="block-ellipsis">'.$row['description'].'</span> By <span class="font-italic font-weight-bold"> '.$row['userName'].'</span> '
					.' Dated : <span class="font-italic ">'.$row['uploadingDate'].'</span>  </span></li>';
		        } // end of publicPrivate if

		    } // end of foreach loop

		} // end of if empty($rows)
		else
		{
			echo '<li><a href="">No Songs are available in DataBase. Please upload some files.</a></li>';
		}



		echo '</ul> </div></div></div></div>';

	} // end of Get_NewUpdates
	public function GiveMe_login()
	{
		echo $this->loginSection;
	} // end of GiveMe_login
	public function GiveMe_registerForm()
	{
		echo $this->registerSection;
	} // end of GiveMe_registerForm






	public function GiveMe_aside ($user = false, $admin = false)
	{ 

		echo '<aside>';
				//var_dump($_SESSION);
		if(isset($_SESSION["log"]) && isset($_SESSION["usertype"]) )
		{
				//echo $_COOKIE["log"]."<br>";
				//echo $_SESSION["log"];
				//echo date('Y-m-d H:i:s', time());

			if($_SESSION["log"])
			{
				if(isset($_SESSION["fullname"]) && isset($_SESSION["usertype"])){
					echo '<div class="box-head"> Welcome '. $_SESSION["usertype"] . '  ' . $_SESSION["fullname"] . '</div>';
				}else{
					echo '<div class="box-head"> Links </div>';
				}

				echo '<div id="categoriesContent">
				<ul>
				<li><a href="'; echo $this->baseurl; echo '?val=myprofile">My Profile</a></li>
				<li><a href="'; echo $this->baseurl; echo '?val=upload"> Upload New File</a></li>
				<li><a href="'; echo $this->baseurl; echo '?val=myAllPosts">My All Files</a></li>';

				if(isset($_SESSION["usertype"])){
					if($_SESSION["usertype"] == "admin"){
						echo '<li><a href="'; echo $this->baseurl; echo '?val=appNewUser"> Approve New Users</a></li>';
						echo '<li><a href="'; echo $this->baseurl; echo '?val=appNewPost"> Approve New Posts</a></li>';
						echo '<li><a href="'; echo $this->baseurl; echo '?val=mgmtUser"> Manage Users</a></li>';
						echo '<li><a href="'; echo $this->baseurl; echo '?val=mgmtPost"> Manage Posts</a></li>';
						echo '<li><a href="'; echo $this->baseurl; echo '?val=singleuserPosts"> Search User Posts</a></li>';
						echo '<li><a href="'; echo $this->baseurl; echo '?val=categories"> Categories </a></li>';
					}
				}

				echo ' <li><a href="'; echo $this->baseurl; echo '?val=playlist">My Playlists</a></li>  <li><a href="'; echo $this->baseurl; echo '?val=logout" >Logout</a></li>
				</ul></div>';
			}
				} // end of if(isset($_COOKIE["log"]) && isset($_COOKIE["usertype"]) && $_COOKIE["log"] )

//------------------------------------------
				echo '<div class="box-head">Links</div>
				<div id="categoriesContent">
				<ul>';
				if(!isset( $_SESSION["log"])){
					echo '<li><a href="'; echo $this->baseurl; echo '?val=login">Login</a></li>
					<li><a href="'; echo $this->baseurl; echo '?val=registor">Register Yourself</a></li> ';
				}
				echo '<li><a href="'. $this->baseurl .'?search=home">Search</a></li></ul></div> ';
//------------------------------------------

				echo '<div class="box-head">Categories </div>
				<div id="categoriesContent"> <ul>';
				
				$categories = $this->db_Obj->Get_Categories();
				if(!empty($categories)){
					foreach ($categories as $category ) {
						echo '<li><a href="'. $this->baseurl .'?search='.$category['name'].'">'.$category['name'].'</a></li>';	
					}
				}
				else
				{
					echo '<li> Donot have any categories </li>';	
				}
				echo '</ul> </div>';
				echo '<br> </aside>';

	} // end of GiveMe_aside




} // end of class


?>