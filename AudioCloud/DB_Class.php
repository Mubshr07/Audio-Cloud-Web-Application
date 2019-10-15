<?php

class DB_Class{
	
	public $host = "localhost";
	public $user = "root";
	public $pass = "";
	public $db = "audiocloud";

	public $userTable = "user";

	protected $conn ; // = new mysqli("localhost", "root", "", "audiocloud");


	public function __construct( ){ 
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
		if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    } 
	} // end of __construct



  public function Search_AudioFile_Date($title)
  {
    $sqlt = "SELECT * FROM audiobank WHERE uploadingDate LIKE '%$title%' AND publicPrivate = 0 ";
    $result = mysqli_query($this->conn, $sqlt);

    if(mysqli_num_rows($result) > 0){
      return $result;
    }else{
      return null;
    }
  } // end of GiveMe_UserProfile




  public function Search_AudioFile_title($title)
  {
    //$sql = "SELECT * FROM audiobank WHERE title='$title' ORDER BY id DESC "; 

    $sqlt = "SELECT * FROM audiobank WHERE title LIKE '%$title%' AND publicPrivate = 0 ";
    $result = mysqli_query($this->conn, $sqlt);

    if(mysqli_num_rows($result) > 0){
      return $result;
    }else{
      return null;
    }
  } // end of GiveMe_UserProfile

  

  public function Get_AudioFile_Category($categoryValue)
  {
    $sql = "SELECT * FROM audiobank WHERE category='$categoryValue' ORDER BY id DESC ";
    $result = null;
    $result = mysqli_query($this->conn, $sql);

    if(!empty($result)){
      return $result;
    }else{
      return null;
    }
  } // end of GiveMe_UserProfile





  public function Get_UserPlaylistsNames($userid)
  {
    $sql = "SELECT * FROM playlist WHERE userID='$userid' ORDER BY id DESC";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result))
    {
      //return mysqli_fetch_array($result);
      return ($result);
    }
    else
    {
      return null;
    }
  } // end of GiveMe_UserProfile


  public function Get_PlaylistDetails($id)
  {
    $sql = "SELECT * FROM playlist WHERE id='$id'";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result))
    {
      return mysqli_fetch_array($result);
      //return ($result);
    }
    else
    {
      return null;
    }
  } // end of Get_PlaylistDetails


  public function Update_Playlist ($id, $audio)
  {
    //$sql = "SELECT * FROM playlist WHERE id='$id'";
    $str = "";
    if(is_array($audio))
    {
      foreach ($audio as $file) {
        $str .= " " . $file;
      }

    }
    else
    {
      $str = $audio;
    }

    $sql = "UPDATE playlist SET audio = '$str' WHERE id = ".$id; 
    return mysqli_query($this->conn, $sql);
  } // end of Update_Playlist
  
  public function Insert_NewPlaylist ($userID, $audio)
  { 
    $sqlt = "INSERT INTO playlist (userID, playlistName ) VALUES ( '$userID','$audio' )";
    return mysqli_query($this->conn, $sqlt);
  } // end of Insert_NewPlaylist


  public function Insert_NewCategory ($name)
  { 
    $sqlt = "INSERT INTO audiocategories ( name ) VALUES ( '$name' )";
    return mysqli_query($this->conn, $sqlt);
  } // end of Insert_NewCategory

  public function Delete_this_Category($id)
  {
    $sql = "DELETE FROM audiocategories WHERE id = ".$id; 
    return mysqli_query($this->conn, $sql); 
  } // end of Delete_thisCategory










  public function Login_Credential($uuser, $ppass)
  {
    $sql = "SELECT * FROM $this->userTable WHERE username='$uuser'";
    $result = mysqli_query($this->conn, $sql);

    if(!empty($result)){
      $rr = mysqli_fetch_array($result); 
      $hash = $rr['password'];
      if( password_verify( $ppass , $hash ) ) {
        $newDate = date('Y-m-d H:i:s', time());
        $sql = "UPDATE user SET last_login = '$newDate' WHERE id = ".$rr['id']; 
        $update_result = mysqli_query($this->conn, $sql); 
        return $rr;
      }else{
                    return NULL; // array('error' => "else statement");
                  }
                }else{
                  return null;
                }
	} // end of Login_Credentials


  public function Register_New_User($username, $email, $firstName, $lastName, $password )
  {
    $verifyHash = md5( rand(0,1000) );
    $hash_pass = password_hash($password,PASSWORD_BCRYPT);
    $sqlt = "INSERT INTO user (username, firstName, lastName, email, password, hash ) VALUES ('$username', '$firstName', '$lastName', '$email', '$hash_pass','$verifyHash' )";

    $flag =  mysqli_query($this->conn, $sqlt);

    if($flag){
      $baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";
      $subject = 'Signup | Verification'; // Give the email a subject 
      $message = '
                  Thanks for signing up!
                  Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                   
                  ------------------------
                  Username: '.$username.'
                  ------------------------
                   
                  Please click this link to activate your account:
                  '.$baseurl.'?emailVerify='.$verifyHash.'
                   <br><br><br><br><br>
                  '; // Our message above including the link
                           
      $headers = 'From:noreply@audiocloud.com' . "\r\n"; // Set from headers
      mail($email, $subject, $message, $headers); // Send our email

      return $flag;
    }else{
      return $flag;
    }
	} // end of Login_Credentials


	public function Get_UserProfile($userid)
	{
    $sql = "SELECT * FROM $this->userTable WHERE id='$userid'";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result))
    {
      return mysqli_fetch_array($result);
    }
    else
    {
      return null;
    }
	} // end of GiveMe_UserProfile

  public function Update_UserProfile($userID, $firstName, $lastName)
  {
    $sql = "UPDATE user SET firstName = '$firstName' , lastName = '$lastName' WHERE id = ".$userID; 
    return mysqli_query($this->conn, $sql); 
	} // end of Execute_this


  public function Execute_this($query)
  {
    $result = null;
    if(!empty($query))
    {
      $result=mysqli_query($this->conn, $query); 
      return mysqli_fetch_array($result); 
    }
    else
    {
      return null;
    }
	} // end of Execute_this

  public function Secure_This_String($str)
  {
    $string = preg_replace("/\%/", "\%", $str);
    $string = preg_replace("/\_/", "\_", $string);

    return mysqli_real_escape_string($this->conn,trim($string));
  } // end of Secure_This_String


  public function Insert_NewFile($userID, $userName, $title, $desc, $catorgy, $type, $private, $remarks, $fileName, $filePath)
  {
    $title = $this->Secure_This_String($title );
    $desc = $this->Secure_This_String( $desc);
    $catorgy = $this->Secure_This_String($catorgy );
            //$type = $this->Secure_This_String($type );
    $remarks = $this->Secure_This_String($remarks );


    $sql = "INSERT INTO audiobank (userID, userName, title, description, remarks, filename, filepath, filetype, category, publicPrivate ) "
    . "VALUES ('$userID', '$userName', '$title', '$desc', '$remarks', '$fileName', '$filePath', '$type', '$catorgy' , '$private' )";


    return mysqli_query($this->conn, $sql); 
	} // end of Execute_this


  public function Get_NewUpdates()
  {
    $sql = "SELECT * FROM audiobank ORDER BY id DESC LIMIT 12 ";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result)){
      return ($result);
    }else{
      return null;
    }
  	} // end of Get_NewUpdates




    public function Get_Categories()
    {
      $sql = "SELECT * FROM audiocategories";
      $result=mysqli_query($this->conn, $sql);

      if(!empty($result)){
        return ($result);
      }else{
        return null;
      }
    } // end of Get_Categories


    public function Increment_listenCount($id)
    {
    //return 20 + $id;
      $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
      $sql = "SELECT * FROM audiobank WHERE id='$id'";
      $result = mysqli_query($this->conn, $sql);

      if(!empty($result)){
        $resul = mysqli_fetch_array($result);
        $incremented = $resul['listenCount'] + 1;
        $sql = "UPDATE audiobank SET listenCount = '$incremented'   WHERE id = ".$id; 
        if(mysqli_query($this->conn, $sql)){
          return $incremented;
        }else{
          return null;
        }
      }else{
        return null;
      }
  } // end of Increment_listenCount

  public function Increment_Liked($id)
  {
    //return 20 + $id;
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    $sql = "SELECT * FROM audiobank WHERE id='$id'";
    $result = mysqli_query($this->conn, $sql);

    if(!empty($result)){
      $resul = mysqli_fetch_array($result);
      $incremented = $resul['liked'] + 1;
      $sql = "UPDATE audiobank SET liked = '$incremented'   WHERE id = ".$id; 
      if(mysqli_query($this->conn, $sql)){
        return $incremented;
      }else{
        return null;
      }
    }else{
      return null;
    }
  } // end of Increment_listenCount

  public function Increment_Disliked($id)
  {
    //return 20 + $id;
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    $sql = "SELECT * FROM audiobank WHERE id='$id'";
    $result = mysqli_query($this->conn, $sql);

    if(!empty($result)){
      $resul = mysqli_fetch_array($result);
      $incremented = $resul['disliked'] + 1;
      $sql = "UPDATE audiobank SET disliked = '$incremented'   WHERE id = ".$id; 
      if(mysqli_query($this->conn, $sql)){
        return $incremented;
      }else{
        return null;
      }
    }else{
      return null;
    }
  } // end of Increment_Disliked

  public function Get_AudioFile($id)
  {
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    $sql = "SELECT * FROM audiobank WHERE id='$id'";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result)){
      return mysqli_fetch_array($result);
    }else{
      return null;
    }
  } // end of Get_NewUpdates

  public function Increment_Shared($id)
  {
    //return 20 + $id;
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    $sql = "SELECT * FROM audiobank WHERE id='$id'";
    $result = mysqli_query($this->conn, $sql);

    if(!empty($result)){
      $resul = mysqli_fetch_array($result);
      $incremented = $resul['Shared'] + 1;
      $sql = "UPDATE audiobank SET Shared = '$incremented'   WHERE id = ".$id; 
      if(mysqli_query($this->conn, $sql)){
        return $incremented;
      }else{
        return null;
      }
    }else{
      return null;
    }
  } // end of Increment_Disliked



  public function Get_myAllPosts($id)
  {
    $sql = "SELECT * FROM audiobank WHERE userID='$id' ORDER BY id DESC ";
    $result = null;
    $result = mysqli_query($this->conn, $sql);

    if(!empty($result)){
      return $result;
    }else{
      return null;
    }
  } // end of GiveMe_UserProfile

  public function Remove_AudioFile($id)
  {
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    $sql = "DELETE FROM audiobank WHERE id='$id'";
    return mysqli_query($this->conn, $sql);
  } // end of Get_NewUpdates


  public function Get_NotApprovedUsers()
  {
    $sql = "SELECT * FROM user WHERE user_Approval = 0 ORDER BY id DESC ";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result)){
      return ($result);
    }else{
      return null;
    }
  } // end of Get_NotApprovedUsers

  public function Approve_thisUser($id)
  {
    $sql = "UPDATE user SET user_Approval = 1  WHERE id = ".$id; 
    return mysqli_query($this->conn, $sql); 
  }

  public function Delete_thisUser($id)
  {
    $sql = "DELETE FROM user WHERE id = ".$id; 
    return mysqli_query($this->conn, $sql); 
  }


  public function Get_NotApprovedPosts()
  {
    $sql = "SELECT * FROM audiobank WHERE approved = 0 ORDER BY id DESC ";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result)){
      return ($result);
    }else{
      return null;
    }
  } // end of Get_NotApprovedUsers
  public function Approve_thisPost($id)
  {
    $sql = "UPDATE audiobank SET approved = 1  WHERE id = ".$id; 
    return mysqli_query($this->conn, $sql); 
  }

  public function Delete_thisPost($id)
  {
    $sql = "DELETE FROM audiobank WHERE id = ".$id; 
    return mysqli_query($this->conn, $sql); 
  }


  public function UserManagement()
  {
    $sql = "SELECT *  FROM user ORDER BY id DESC "; 
    return mysqli_query($this->conn, $sql); 
  }

  public function Get_totaluploads($id)
  {
    
    $sql = "SELECT * FROM audiobank WHERE userID='$id'";
    $result=mysqli_query($this->conn, $sql);

    if(!empty($result)){
      return mysqli_num_rows ($result);
    }else{
      return null;
    }
  } // end of Get_totaluploads

  public function PostManagement()
  {
    $sql = "SELECT *  FROM audiobank ORDER BY id DESC "; 
    return mysqli_query($this->conn, $sql); 
  }

   


} // end of class

?>