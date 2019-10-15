<?php
include 'DB_Class.php';
include 'audioProperties.php';
include 'Users_Posts_Class.php'; 

session_start();
/**
 * 
 */
class XhrRequest // extends AnotherClass
{ 

	public $login_username = "";	
	public $login_password = "";	
	public $json_Msg = [];	
	public $current_user;


    public $registerObj;


    public $playObj;
    public $likeObj;
    public $dislikeObj;
    public $embeddedObj;
    public $shareObj;
    public $deleteObj;

    public $approve_userObj;
    public $delete_userObj;
    public $approve_postObj;
    public $delete_postObj;
    
    public $get_userPostsObj;
    public $add_audioObj;
    public $add_NewCategoryObj;
    public $delete_CategoryObj;

    public $search_Obj;

    public $db_obj;

    function __construct()
    {
        $this->db_obj = new DB_Class();

        $this->login_username = "";
        $this->login_password = "";
        $this->current_user = "";

        $this->registerObj = new RegistrationNew();

        $this->playObj = new Play_it();
        $this->likeObj = new Like_it();
        $this->dislikeObj = new Dislike_it();
        $this->shareObj = new Share_it();
        $this->playlistObj = new PlaylistsName();
        $this->deleteObj = new Delete_it();

        $this->approve_userObj = new Approve_thisUser();
        $this->delete_userObj = new Delete_thisUser();
        $this->approve_postObj = new Approve_thisPost();
        $this->delete_postObj = new Delete_thisPost();

        $this->get_userPostsObj = new Get_UserPosts();

        $this->add_audioObj = new Add_Audio();
        $this->add_NewCategoryObj = new Add_NewCategory();
        $this->delete_CategoryObj = new Delete_thisCategory();

        $this->search_Obj = new Search();


    }

    public function Run()
    {

		//var_dump($_POST);
      if(!empty($_POST))
      {

         if(isset($_POST['login'])){
            $this->login_username =  $_POST['login_username'] ;
            $this->login_password =  $_POST['login_password'] ;
            $this->login_username  = $this->db_obj->Secure_This_String($this->login_username);
            $this->login_password = $this->db_obj->Secure_This_String($this->login_password);
            $this->current_user = $this->db_obj->Login_Credential($this->login_username, $this->login_password);


            if(!empty($this->current_user))
            {
                //if($this->current_user['email_Confirm'] == 1) 
                //{ 
                    $this->json_Msg["login"] = true;
                    $this->json_Msg["username"] = $this->current_user['username'];
                    $this->json_Msg["fullname"] = $this->current_user['firstName'].' '. $this->current_user['lastName'];
                    //$this->json_Msg["password"] = $this->current_user['password'];
                    $this->json_Msg["usertype"] = $this->current_user['type'];
                    $this->json_Msg["log"] =  true ;
                    $this->json_Msg["login_success"] = true;

                    $_SESSION["userid"] = $this->current_user['id'];
                    $_SESSION["username"] = $this->current_user['username'];
                    $_SESSION["fullname"] = $this->current_user['firstName'].' '. $this->current_user['lastName'];
                    //$_SESSION["password"] = $this->current_user['password'];
                    $_SESSION["usertype"] = $this->current_user['type'];
                    $_SESSION["approved"] = $this->current_user['user_Approval'];
                    $_SESSION["log"] =  true ;

                    $_SESSION["last_login"] =  date('m/d/Y H:i:s', time());
               /* }
                else{
                   $this->json_Msg["error"] = "Account Not Verified, Please Check your email inbox / spam folder for verification link";
                   $this->json_Msg["login_success"] = FALSE;
               } */

           }else{
               $this->json_Msg["error"] = "Please Check your Username/Email or Password";
               $this->json_Msg["login_success"] = FALSE;

           }

           echo json_encode($this->json_Msg);

			} // end of login form

			else if(isset($_POST['signup'])){
                $this->json_Msg = $this->registerObj->Register($_POST);
                echo json_encode($this->json_Msg );
			} // $_POST['signup']
			
            else if(isset($_POST['myprofile'])){

                //$db_obj = new DB_Class();
                $this->json_Msg["myprofile"] = true;

                if (isset($_POST['userID'])) {
                    $userID = $this->db_obj->Secure_This_String($_POST['userID']); 
                } 
                if (isset($_POST['firstName'])) {
                    $firstName = $this->db_obj->Secure_This_String($_POST['firstName']); 
                } 

                if (isset($_POST['lastName'])) {
                    $lastName = $this->db_obj->Secure_This_String($_POST['lastName']); 
                } 

                if( !empty($userID) &&  !empty($firstName) &&  !empty($lastName) ){ 
                    $updateResult = $this->db_obj->Update_UserProfile( $userID, $firstName, $lastName );
                    if($updateResult)
                    {
                        $this->json_Msg["myprofile_success"] = true;
                        $this->json_Msg["successMsg"] =  " Profile Updated "; 
                    }else{
                        $this->json_Msg["myprofile_success"] = FALSE;
                        $this->json_Msg["successMsg"] =  "Please Contact to the admin, you are not updated your profile . ";
                    }

                }
                else
                {
                    $this->json_Msg["myprofile_success"] = FALSE;
                    $this->json_Msg["successMsg"] =  " Some Fields are empty . ";
                }

                echo json_encode( $this->json_Msg );
			} // end of myprofile form request 


			else if(isset($_POST['fileUpload'])) 
            {

                $output_dir = __DIR__ . "\\audioBank\\";
                //$db_obj = new DB_Class();
                if(isset($_FILES["file1"]) && isset($_POST["title"]) && isset($_POST['discription']) && isset($_POST['category']) && isset($_POST['type']) && isset($_POST['public']) && isset($_POST['remarks']) )
                {
                    if ($_FILES["file1"]["error"] > 0)
                    {
                      $this->json_Msg["successMsg"] = "Error: " . $_FILES["file1"]["error"] . " GOt it...... <br>";
                  }
                  else 
                  {
                    $file_tempN = $_FILES["file1"]["tmp_name"];
                    $file_realN = $_FILES["file1"]["name"];
                    $file_realN = $this->db_obj->Secure_This_String($file_realN);
                    $file_time = time() ."_".  $file_realN ;
                    $destinationPath = $output_dir . $file_time;

                    $allowed =  array('wav','mp3' ,'ogg' ,'flac' ,'webm' ,'mpeg'); 
                    $ext = pathinfo($file_realN, PATHINFO_EXTENSION);
                    if(in_array($ext,$allowed) && isset($_SESSION["userid"]) && isset($_SESSION["username"]) ) 
                    { 
                        $movedd = @move_uploaded_file( $file_tempN , $destinationPath );
                        if($movedd)
                        {  
                            $insertBool = $this->db_obj->Insert_NewFile($_SESSION["userid"], $_SESSION["fullname"], $_POST["title"], $_POST['discription'], $_POST['category'], $_POST['type'], $_POST['public'], $_POST['remarks'], $file_time, $destinationPath);
                            $this->json_Msg["form"] = $_POST;
                            $this->json_Msg["upload_success"] = $insertBool;
                            $this->json_Msg["successMsg"] = " File Uploaded Successfully " ;
                        }
                        else
                        {
                            $this->json_Msg["upload_success"] = false;
                        }

                    }
                    else
                    {
                        $this->json_Msg["successMsg"] = " file extension is : " . $ext . " which is not allowed " ;                                
                    }

                    } // end of else statement
                } // end of isset()
                else
                {
                    $this->json_Msg["successMsg"] =  " Some Fields are empty . ";
                }
                //$this->json_Msg["successMsg"] =  " Some Fields are empty . ";
                echo json_encode( $this->json_Msg );
            } // end of isset( fileUpload )


            else if(isset($_POST['play'])){  
                $this->json_Msg = $this->playObj->play($_POST['play']);
                echo json_encode( $this->json_Msg );
            } // end of Play form request 

            else if(isset($_POST['like'])){ 
                $this->json_Msg = $this->likeObj->like($_POST['like']);
                echo json_encode( $this->json_Msg );
            } // end of like form request

            else if(isset($_POST['dislike'])){ 
                $this->json_Msg = $this->dislikeObj->dislike($_POST['dislike']);
                echo json_encode( $this->json_Msg );
            } // end of dislike form request

            else if(isset($_POST['playlist'])){ 
                $this->json_Msg = $this->playlistObj->playlist($_POST['playlist']);
                echo json_encode( $this->json_Msg);
            } // end of dislike form request

            else if(isset($_POST['share'])){ 
                $this->json_Msg = $this->shareObj->share($_POST['share']);
                echo json_encode( $this->json_Msg );
            } // end of share form request

            else if(isset($_POST['edit'])){ 
                //$this->json_Msg = $this->deleteObj->delete($_POST['edit']);
                $this->json_Msg["edit"] = true;
                $this->json_Msg['output_id'] = "userpost".$_POST['edit'];
                $this->json_Msg["msg"] =  " Eidt Feature work is still remaining ";
                echo json_encode( $this->json_Msg );
            } // end of delete form request

            else if(isset($_POST['delete'])){ 
                $this->json_Msg = $this->deleteObj->delete($_POST['delete']);
                echo json_encode( $this->json_Msg );
            } // end of delete form request

            else if(isset($_POST['approveUser'])){ 
                $this->json_Msg = $this->approve_userObj->approve($_POST['approveUser']);
                echo json_encode( $this->json_Msg );
            } // end of approveUser form request

            else if(isset($_POST['deleteUser'])){ 
                $this->json_Msg = $this->delete_userObj->delete($_POST['deleteUser']);
                echo json_encode( $this->json_Msg );
            } // end of deleteUser form request

            else if(isset($_POST['approvePost'])){ 
                $this->json_Msg = $this->approve_postObj->approve($_POST['approvePost']);
                echo json_encode( $this->json_Msg );
            } // end of approvePost form request

            else if(isset($_POST['deletePost'])){ 
                $this->json_Msg = $this->delete_postObj->delete($_POST['deletePost']);
                echo json_encode( $this->json_Msg );
            } // end of deletePost form request

            else if(isset($_POST['oneUserPosts'])){ 
                $this->json_Msg = $this->get_userPostsObj->userPosts($_POST['userid']);
                echo json_encode( $this->json_Msg );
            } // end of oneUserPosts form request

            else if(isset($_POST['playlistName'])){ 
                $this->json_Msg = $this->add_audioObj->Add($_POST['playlistName'], $_POST['audio']);
                echo json_encode( $this->json_Msg );
            } // end of oneUserPosts form request

            else if(isset($_POST['createPlaylist'])){ 
                $this->json_Msg = $this->add_audioObj->Create($_POST['createPlaylist'] );
                echo json_encode( $this->json_Msg );
            } // end of oneUserPosts form request

            else if(isset($_POST['createCategory'])){ 
                $this->json_Msg = $this->add_NewCategoryObj->New_Category($_POST['createCategory'] );
                echo json_encode( $this->json_Msg );
            } // end of oneUserPosts form request

            else if(isset($_POST['deleteCategory'])){ 
                $this->json_Msg = $this->delete_CategoryObj->delete($_POST['deleteCategory'] );
                echo json_encode( $this->json_Msg );
            } // end of oneUserPosts form request

            else if(isset($_POST['searchtitle'])){ 
                $this->json_Msg = $this->search_Obj->Search_Title($_POST['title'] );
                echo json_encode( $this->json_Msg );
            } // end of oneUserPosts form request

            else if(isset($_POST['dateValue'])){ 
                $this->json_Msg = $this->search_Obj->Search_Date($_POST['dateValue'] );
                echo json_encode( $this->json_Msg );
            } // end of oneUserPosts form request


            



            else
            {
                $this->json_Msg["Msg"] =  " XhrRequest PHP :  POST has something else. ";
                $this->json_Msg["Form"] = $_POST;
                echo json_encode( $this->json_Msg );
            }

		} // end of if $_POST is not empty
		else
		{
			echo json_encode("Error received from xhr_Request php file");
		}

	} // end of function run
} // end of class

$xhr = new XhrRequest();
$xhr->Run();


?>