<?php

session_start();

  include 'redirect.php';

	$redirectObj = new Redirect();
	if((!empty($_GET)) && (isset($_GET['val']))) {

		$urlVar = $_GET['val'];
		//var_dump($urlVar);
		if($urlVar == 'logout')
		{
			//echo "in Logout session";
			//session_destroy();
			session_unset();
			//$redirectObj->Go_to_LogOut();

			$redirectObj->Go_to_HOME_Page();
		}
		else if($urlVar == 'home')
		{
			$redirectObj->Go_to_HOME_Page() ;
		}
		else if($urlVar == 'registor')
		{
			$redirectObj->Go_to_Registration();
		}
		else if($urlVar == 'login')
		{
			$redirectObj->Go_to_Login() ;
		}
		else if($urlVar == 'upload')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_Upload();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'myprofile')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_myProfile();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'myAllPosts')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_User_All_Posts();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}



		else if($urlVar == 'appNewUser')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_User_Approval();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'appNewPost')
		{
			if(isset($_SESSION['log']) && ($_SESSION['log'] === true)){
				$redirectObj->Go_to_Post_Approval();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'mgmtUser')
		{
			$redirectObj->Go_to_manageUser();
		}
		else if($urlVar == 'mgmtPost')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_managePost();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'playlist')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_myplaylist();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}

		else if($urlVar == 'singleuserPosts')
		{
			$redirectObj->singleuserPosts();
		}
		else if($urlVar == 'categories')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_Categories();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}



		else
		{
			$redirectObj->Go_to_HOME_Page();
		}
	}

	else if(isset($_GET['search'])) {
		$variable_Value = $_GET['search'];

		if($variable_Value == 'home')
		{
			$redirectObj->Go_to_Search_HOME_Page();
		}
		else
		{
			$redirectObj->Go_to_Search_Results($variable_Value);
		}
	}
	else
	{
		$redirectObj->Go_to_HOME_Page();
	}

	

?>