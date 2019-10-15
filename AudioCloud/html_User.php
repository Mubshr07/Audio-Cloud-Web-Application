<?php

class HTML_User {

	public $baseurl;

	public $myplaylist;
	public $manageplaylist;
	public $managePost;
	public $myallpost;
	public $myprofile;
	
	public $uploadSection;
	public $db_Obj;
	public $userProfile;
	public $category;

	public function __construct()
	{
		$this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";

		$this->db_Obj = new DB_Class();

		if(isset($_SESSION['userid']))
		{
			$this->userProfile = $this->db_Obj->Get_UserProfile($_SESSION['userid']);
			$this->category = $this->db_Obj->Get_Categories();
		}


		$this->uploadSection = '';
		$this->uploadSection = '<div id="content_wrapper">

		<div class="featured_image">
		<div class="head_box">Upload Form</div>
		</div>
		<div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		<form method="post" name="form_upload" id="form_upload">


		<div class="form-group row">
		<label for="title" class="col-sm-3 col-form-label">Title<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="title"  name="title" maxlength="220" placeholder="File Title" required>
		</div></div>

		<div class="form-group row">
		<label for="discription" class="col-sm-3 col-form-label">Discription<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="discription" name="discription"  maxlength="220"  placeholder="File Discription"  required>
		</div> </div>

		<div class="form-group row">
		<label for="category" class="col-sm-3 col-form-label">File Category</label>
		<div class="col-sm-9">
		<select name="category" class="select-field custom-select" id="category"  required>';

		if(!empty($this->category))
		{
			foreach ($this->category as $key) {
				$this->uploadSection .= '<option value="'.$key['name'].'">'.$key['name'].'</option>';
			}

		}else{
			$this->uploadSection .= '<option value="Quran">Quran</option>
			<option value="naat">Naat</option> ';
		}


		$this->uploadSection .= '</select>
		</div> </div>

		<div class="form-group row">
		<label for="type" class="col-sm-3 col-form-label">File Type</label>
		<div class="col-sm-9">
		<select name="type" class="select-field custom-select" id="type"  required>
		<option value="mp3">mp3</option>
		<option value="wav">wav</option>
		</select>
		</div> </div>

		<div class="form-group row">
		<label for="type" class="col-sm-3 col-form-label">Public or Private</label>
		<div class="col-sm-9">
		<select name="public" class="select-field custom-select" id="type"  required>
		<option value="0">Public</option>
		<option value="1">Private</option>
		</select>
		</div> </div>

		<div class="form-group row">
		<label for="remarks" class="col-sm-3 col-form-label">Remarks </label>
		<div class="col-sm-9">
		<textarea class="form-control" id="remarks" name="remarks"  maxlength="220"  placeholder="Your Remarks about file"></textarea>
		</div>  </div>

		<div class="form-group row">
		<label for="file" class="col-sm-3 col-form-label">Audio File<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="file" name="file1" id="file1" accept="audio/*" onchange="return fileValidation()" required style="width:100%">
		</div> </div>

		<input type="hidden"  class="hidden" name="fileUpload" value="fileUpload"> 
		<div>
		<input type="button" value="Upload" onclick="Upload(this)"  class="btn btn-primary btn-lg btn-block" />
		</div>
		<br>
		<div id="upload_responseDiv" style="display:none">
		<span>Uploading Progress :  </span>
		<progress id="progressBar" value="0" max="100" style="width:60%;"></progress>
		<h3 id="status">status</h3>
		<p id="loaded_n_total"> loaded </p>
		</div>
		<div id="output"></div>

		</form>

		</div> </div></div></div>';


		$this->myprofile = '	<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">My Profile</div>
		</div>
		<div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">

		<form method="post" name="form_myprofile" id="form_myprofile">
		<div class="form-group row">
		<label for="username" class="col-sm-3 col-form-label">Username</label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="username" readonly value="'.$this->userProfile["username"].'">
		</div></div>

		<div class="form-group row">
		<label for="firstName" class="col-sm-3 col-form-label">First Name</label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="firstName" name="firstName" value="'.$this->userProfile["firstName"].'" maxlength="20" required>
		</div></div>

		<div class="form-group row">
		<label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="lastName" name="lastName" value="'.$this->userProfile["lastName"].'" maxlength="20" required>
		</div></div>

		<div class="form-group row">
		<label for="email" class="col-sm-3 col-form-label">Email</label>
		<div class="col-sm-9">
		<input type="email" class="form-control" id="email"  value="'.$this->userProfile["email"].'" readonly>
		</div></div>

		<div class="form-group row">
		<label for="email_confirm" class="col-sm-3 col-form-label">Email Verification </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="email_confirm"  value="'. ($this->userProfile["email_Confirm"] ? ' Verified ' : ' Not Verified ') .'" readonly>
		</div></div>

		<div class="form-group row">
		<label for="user_confirm" class="col-sm-3 col-form-label"> Profile Approved </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="user_confirm"  value="'. ($this->userProfile["user_Approval"] ? ' Approved ':' Not Approved ' ).'" readonly>
		</div></div>

		<div class="form-group row">
		<label for="date_Join" class="col-sm-3 col-form-label"> Date of Joining </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="date_Join"  value="'.$this->userProfile["date_of_join"].'" readonly>
		</div></div>

		<div class="form-group row">
		<label for="date_login" class="col-sm-3 col-form-label"> Date of Last Login </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="date_login"  value="'.$this->userProfile["last_login"].'" readonly>
		</div></div>


		<input type="hidden"id="userID" name="userID"  value="'.$this->userProfile["id"].'" readonly>

		<input type="hidden"  class="hidden" name="myprofile" value="myprofile">

		<input type="button" onclick="MyProfile(this)" class="btn btn-primary btn-lg btn-block" value="Update">
		</form><br>

		<div id="output"></div>
		</div>
		</div></div></div>';

		$this->myplaylist = '	<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">My Playlists</div>
		</div>
		<div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">

		<form name="form_myplaylist" id="form_login" method="post">
		<div class="form-group">
		<input type="hidden" name="delete" value="1">
		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" name="1" value="Delete">
		</div>
		</form>
		<form name="form_myplaylist" id="form_login" method="post">
		<div class="form-group">
		<input type="hidden" name="manage">
		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" name="manage" value="Manage">
		</div>
		</form>

		<div id="output"></div>
		</div>
		</div></div></div>';



		$this->manageplaylist = ' <div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">Manage Playlist Name : abcTest</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">

		<form method="post" name="form_signup" id="form_signup">
		<div class="form-group">
		<label for="username">Song Name</label>
		<input type="text" class="form-control" id="username" placeholder="username" required="">
		</div>

		<input type="hidden"  class="hidden" name="signup" value="signup">

		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" value="SIGNUP">
		</form><br>
		<div id="output"></div>
		</div></div></div></div>  ';



		$this->managePost = '<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">Post Name</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">

		<form method="post" name="form_signup" id="form_signup">
		<div class="form-group">
		<label for="username">Song Name</label>
		<input type="text" class="form-control" id="username" placeholder="username" required="">
		</div>

		<input type="hidden"  class="hidden" name="signup" value="signup">

		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" value="SIGNUP">
		</form><br>
		<div id="output"></div>
		</div></div></div></div> ';

		$this->myallpost = '<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">Managing my All Posts</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">

		<form method="post" name="form_signup" id="form_signup">
		<div class="form-group">
		<label for="username">Song Name</label>
		<input type="text" class="form-control" id="username" placeholder="username" required="">
		</div>

		<input type="hidden"  class="hidden" name="signup" value="signup">

		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" value="SIGNUP">
		</form><br>
		<div id="output"></div>
		</div></div></div></div> ';
	} // end of contructor


	public function GiveMe_Upload()
	{
		if(isset($_SESSION["approved"]))
		{
			if($_SESSION["approved"] == 1)
			{
				echo $this->uploadSection;
			}
			else
			{
				echo '<div id="content_wrapper">
				<div class="featured_image"> <div class="head_box">Upload Form</div> </div>
				<div> <div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; "> <div class="agileits-top">

				<div id="audioDetails"><ul><li> Your account is not approved for uploading. Please wait till your account approval. </li></ul></div>
				</div> </div></div></div>';
			}
		}
		else
		{
			echo '<div id="content_wrapper">
			<div class="featured_image"> <div class="head_box">Upload Form</div> </div>
			<div> <div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; "> <div class="agileits-top">

			<div id="audioDetails"><ul><li> Your account is not approved for uploading. Please wait till your account approval. </li></ul></div>
			</div> </div></div></div>';
		}
	}

	public function GiveMe_Myplaylist() {

		echo ' <div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box"> My Playlists </div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 10px; padding-right: 5px; padding-bottom: 10px; padding-left: 10px; ">
		<div class="agileits-top"> ' ;

		$playlistNames = $this->db_Obj->Get_UserPlaylistsNames($_SESSION['userid']);
		$counter = 0;
		if(!empty($playlistNames))
		{
			foreach ($playlistNames as $oneplaylist) {
				echo "Playlist Name : <span class='font-weight-bolder'>".$oneplaylist['playlistName'] . "</span>";
				//echo "  Songs are : " . $oneplaylist['audio'];
				echo "<br>";
				$songs = explode(" ", $oneplaylist['audio']);
				for( $i=0; $i< sizeof($songs); $i++){ 
					$row = $this->db_Obj->Get_AudioFile($songs[$i]);
					if(!empty($row))
					{
						$counter = $counter + 1;

						echo ' <div id="audioDetails2"> <ul>';

						echo '<li style="padding-bottom:0px;"> <div id="userpost'.$row['id'].'" style="width:100%;"> <div class="" style="width:100%;"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$counter.'&nbsp;&nbsp;'.$row['title'].'</span> </div>';
					
						echo '<div class="row" style="font-size:11px; margin-left:5px; padding:0; display:inline-block;"> '
						.'<div style="margin-left:10px;"><span> Listen Count: '.$row['listenCount'].'</span></div>'
						.'<div style="margin-left:10px;"> <span> Private: '.$row['publicPrivate'].' </span></div>'
						.'<div style="margin-left:10px;"><span> Like Count: '.$row['liked'].' </span>  </div>'
						.'<div style="margin-left:10px;"> <span> Dislike Count: '.$row['disliked'].' </span></div>'
						.'<div style="margin-left:10px;"><span> Share Count: '.$row['Shared'].'     &nbsp;</span> </div> </div>';

					
					echo '<div class="row" style="font-size:11px; margin-left:5px;   display:inline-block;">'
					.'<div style="margin-left:10px; padding-bottom:0px;">  Dated : '.$row['uploadingDate'] ;

					echo '<div style=" margin-left:5px;" > <form name="form_deletefromPlaylist'.$row['id'].'" id="form_deletefromPlaylist'.$row['id'].'"><input type="hidden" class="hidden" name="deletePlaylistName" value="'.$row['id'].'"> <button type="button" style="margin: 0; border: none; padding: 0; background: transparent; color:red;" id="delete'.$row['id'].'" alt="Delete"  value="'.$row['id'].'" onclick="delete_thisPlaylist(this)">Delete</button> </form> </div> </div>'
					
					.' </div></li>'; 

					echo '</ul></div>';

					} // end of if ( empty())

					} // end of for loop
					echo "<br>";
			} // end of foreach loop
		}
		else
		{
			echo " You Donot have any playlist ";
		}


		echo '<br><br><br>
		<div class="form-group row justify-content-center">
		<span class="font-weight-bolder" > Create New Playlist </span>
		</div>
		<form   name="form_createPlaylistcc" id="form_createPlaylistcc">

		<div class="form-group row">
		<label for="type" class="col-sm-3 col-form-label">Name : </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="createPlaylist" name="createPlaylist" placeholder="Enter Name of New playlist" required>
		</div> </div>

		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" value="Create" onclick="createNewPlaylist(this)">
		</form>

		<div id="output"></div>
		</div></div></div></div> ';

	}

	public function GiveMe_Manageplaylist()
	{
		echo $this->manageplaylist;
	}

	public function GiveMe_managePost()
	{
		echo $this->managePost;
	}

	public function GiveMe_myallpost ()
	{
		//echo $this->myallpost;
		echo  '<div id="content_wrapper"> <div class="featured_image">
		<div class="head_box">My Uploaded Files </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%; padding-right: 3%; padding-bottom: 1%; padding-left: 3%;  "> <div class="agileits-top">';
		if(isset($_SESSION['userid']))
		{
			$rows = $this->db_Obj->Get_myAllPosts($_SESSION['userid']);
			if(!empty($rows))
			{

				echo ' <div id="audioDetails">
				<ul>';

				foreach ($rows as $row)
				{

					echo '<li style="padding-bottom:0px;"> <div id="userpost'.$row['id'].'" style="width:100%;"> <div class="" style="width:100%;"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$row['title'].'</span> </div>';
					if($row['publicPrivate'] == 0)
					{

						echo '<div class="row" style="font-size:11px; margin-left:5px; padding:0; display:inline-block;"> '
						.'<div style="margin-left:10px;"><span> Listen Count: '.$row['listenCount'].'</span></div>'
						.'<div style="margin-left:10px;"> <span> Private: '.$row['publicPrivate'].' </span></div>'
						.'<div style="margin-left:10px;"><span> Like Count: '.$row['liked'].' </span>  </div>'
						.'<div style="margin-left:10px;"> <span> Dislike Count: '.$row['disliked'].' </span></div>'
						.'<div style="margin-left:10px;"><span> Share Count: '.$row['Shared'].'     &nbsp;</span> </div> </div>';

					}
					else
					{
						echo '<div class="row" style="font-size:11px; margin-left:5px; padding:0; display:inline-block;"> '
						.'<div style="margin-left:10px;"><span> Marked as your private file  &nbsp;</span></div> </div>';
					}
					echo '<div class="row" style="font-size:11px; margin-left:5px;   display:inline-block;">'
					.'<div style="margin-left:10px; padding-bottom:0px;">  Dated : '.$row['uploadingDate'] ;
					if($row['approved'] == 1 )
					{
						echo ' &nbsp; <span style="color:green;"> Approved </span>';
					}
					else
					{
						echo ' &nbsp; <span style="color:red;"> Not Approved </span>';
					}

					/*
					echo '</div>  <div style="margin-left:10px;">  <form name="form_edit'.$row['id'].'" id="form_edit'.$row['id'].'"><input type="hidden" class="hidden" name="edit" value="'.$row['id'].'"> <button type="button"   style="margin: 0; border: none; padding: 0; background: transparent; color:green;" id="edit'.$row['id'].'" alt="Edit"  value="'.$row['id'].'" onclick="edit_this(this)">Edit</button> </form>  </div>';
					*/
					
					echo '<div style=" margin-left:5px;" > <form name="form_delete'.$row['id'].'" id="form_delete'.$row['id'].'"><input type="hidden" class="hidden" name="delete" value="'.$row['id'].'"> <button type="button" style="margin: 0; border: none; padding: 0; background: transparent; color:red;" id="delete'.$row['id'].'" alt="Delete"  value="'.$row['id'].'" onclick="delete_this(this)">Delete</button> </form> </div> </div>'

					.' </div></li>'; 

			    } // end of foreach loop

			} // end of if empty($rows)
			else
			{
				echo '<li><a href="">No Songs are available in DataBase. Please upload some files.</a></li>';
			}
			echo '</ul> </div>   ';
		}
		else
		{
			echo '<div id="audioDetails"><ul><li><a href="">No Songs are available in DataBase. Please upload some files.</a></li></ul><div>';
		}

		echo ' </div></div></div> ';
	}

	public function GiveMe_myprofile ()
	{
		echo $this->myprofile;
	}


} // end of class


?>