<?php


class RegistrationNew
{
	public $db_Obj;
	public $json_Msg = [];	



	public $username;
	public $email;
	public $firstName;
	public $lastName;
	public $psw;
	public $repsw;

	function __construct( )
	{
		# code...
		$this->db_Obj = new DB_Class();
	}
	public function Register($POST)
	{
		$this->json_Msg["signup"] = true;
		if (isset($POST['username'])) 
		{
			$this->username = $this->db_Obj->Secure_This_String($POST['username']);
            //$this->json_Msg["username"] = $username;
		}
		if (isset($POST['email'])) {
			$this->email = $this->db_Obj->Secure_This_String($POST['email']);
                                //$this->json_Msg["email"] = $email;
		}

		if (isset($POST['firstName'])) {
			$this->firstName = $this->db_Obj->Secure_This_String($POST['firstName']);
                                //$this->json_Msg["firstName"] = $firstName;
		} 

		if (isset($POST['lastName'])) {
			$this->lastName = $this->db_Obj->Secure_This_String($POST['lastName']);
                                //$this->json_Msg["lastName"] = $lastName;
		} 

		if (isset($POST['password'])) {
			$this->psw = $this->db_Obj->Secure_This_String($POST['password']);
                               // $this->json_Msg["psw"] = $psw;
		}

		if (isset($POST['repassword'])) {
			$this->repsw = $this->db_Obj->Secure_This_String($POST['repassword']);
                                //$this->json_Msg["repsw"] = $repsw;
		}

		if(!empty($this->username) && !empty($this->email) && !empty($this->firstName) && !empty($this->lastName) && !empty($this->psw) && !empty($this->repsw) )
		{
			if($this->psw == $this->repsw)
			{ 
				$sql = "select * from user where (username='$this->username' or email='$this->email');";

				$res = $this->db_Obj->Execute_this($sql);
				$this->json_Msg["empty"] = $res['username'] ;
				if (!empty($res)) {

					$row = ($res);
					if ($this->username == $row['username'])
					{
                                            //echo "Username already exists";
						$this->json_Msg["successMsg"] = " Username already exist ";
					}
                    elseif($this->email==$row['email']) // change it to just else
                    {
                    	$this->json_Msg["successMsg"] = " Email already exist ";
                    }
                    else{
                    	$this->json_Msg["successMsg"] = " else statement already exist ";
                    }
                }
                else{
                                        // valid registration data so insert it into database
                	$insertResult = $this->db_Obj->Register_New_User($this->username, $this->email, $this->firstName, $this->lastName, $this->psw );
                	if($insertResult)
                	{
                		$this->json_Msg["signup_success"] = true;
                		$this->json_Msg["successMsg"] =  " Congratulations ! You are sucessfully registered. ";
                	}else{
                		$this->json_Msg["signup_success"] = FALSE;
                		$this->json_Msg["successMsg"] =  "Please Contact to the admin, you are not registered. ";
                	}
                }
            }
            else {
                                    // password didnot matched
            	$this->json_Msg["signup_success"] = FALSE;
            	$this->json_Msg["successMsg"] = " Password did not matched ";
            }
        } else {
        	$this->json_Msg["signup_success"] = FALSE;
        	$this->json_Msg["successMsg"] = " Some Fields are Empty ";
        }
        return $this->json_Msg;
	} // end of function Register
}



class Approve_thisUser{
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct()
	{
		$this->db_Obj = new DB_Class();
	}
	public function approve($id)
	{
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "user".$id;
		if($this->db_Obj->Approve_thisUser($id))
		{
			$this->json_Msg['approveuser'] = true;
			$this->json_Msg['msg'] = " Approved ";
		}
		else
		{
			$this->json_Msg['approved'] = false;
			$this->json_Msg['msg'] = " Not Approved ";
		}
		return $this->json_Msg;
	}


} // end of class Approve_thisUser


class Delete_thisUser{
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct()
	{
		$this->db_Obj = new DB_Class();
	}
	public function delete($id)
	{
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "user".$id;
		if($this->db_Obj->Delete_thisUser($id))
		{
			$this->json_Msg['deleteuser'] = true;
			$this->json_Msg['msg'] = " Deleted ";
		}
		else
		{
			$this->json_Msg['delete'] = false;
			$this->json_Msg['msg'] = " Not Deleted ";
		}

		return $this->json_Msg;
	}
} // end of class Approve_thisUser




class Approve_thisPost{
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct( )
	{
		$this->db_Obj = new DB_Class();
	}
	public function approve($id)
	{
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "post".$id;
		if($this->db_Obj->Approve_thisPost($id))
		{
			$this->json_Msg['approvepost'] = true;
			$this->json_Msg['msg'] = " Approved ";
		}
		else
		{
			$this->json_Msg['approvepost'] = false;
			$this->json_Msg['msg'] = " Not Approved ";
		}
		return $this->json_Msg;
	}
} // end of class Approve_thisUser


class Delete_thisPost{
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct( )
	{
		$this->db_Obj = new DB_Class();
	}
	public function delete($id)
	{
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "post".$id;
		if($this->db_Obj->Delete_thisPost($id))
		{
			$this->json_Msg['deletepost'] = true;
			$this->json_Msg['msg'] = " Deleted ";
		}
		else
		{
			$this->json_Msg['deletepost'] = false;
			$this->json_Msg['msg'] = " Not Deleted ";
		}
		return $this->json_Msg;
	}
} // end of class Approve_thisUser




class Get_UserPosts{
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct( )
	{
		$this->db_Obj = new DB_Class();
	}
	public function userPosts($id)
	{
		$this->json_Msg['userID'] = $id ;
		$posts = null;

		$booli = true;
		$counter = 0;

		$posts = $this->db_Obj->Get_myAllPosts($id);
		$this->json_Msg['length'] = mysqli_num_rows($posts);

		if(!empty($posts))
		{
			$this->json_Msg['output_id'] = "output" ;
			$this->json_Msg['msg'] = "error ! No posts of this user"; 
			$this->json_Msg['hasposts'] = false ;

			foreach ($posts as $post ) {

				if($booli == true){
					$this->json_Msg['output_id'] = "outputMain";
					$this->json_Msg['hasposts'] = true ;
					$booli = false;
				}	
	 			//$this->json_Msg[$post['id']] = $post['id'];

				$this->json_Msg[$counter] = $counter;


				$stringg = 'post' . $counter;
				$this->json_Msg[$counter] = $post;  
				$counter = $counter + 1;
			}

		}
		else
		{
			$this->json_Msg['output_id'] = "output" ;
			$this->json_Msg['msg'] = "error ! No posts of this user"; 
		}
		return $this->json_Msg;
	}
} // end of class Approve_thisUser




class Add_NewCategory{
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct( )
	{
		$this->db_Obj = new DB_Class();
	}
	public function New_Category($Name)
	{
		$this->json_Msg['name'] = $Name ;
		 
		if($this->db_Obj->Insert_NewCategory($Name))
		{
			$this->json_Msg['output_id'] = "output" ;
			$this->json_Msg['msg'] = $Name. " is added as new Category";  

		}
		else
		{
			$this->json_Msg['output_id'] = "output" ;
			$this->json_Msg['msg'] = "error ! Did not added, Please report to admin"; 
		}
		return $this->json_Msg;
	}
} // end of class Approve_thisUser

class Delete_thisCategory {
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct( )
	{
		$this->db_Obj = new DB_Class();
	}
	public function delete($id)
	{
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "category".$id;
		if($this->db_Obj->Delete_this_Category($id))
		{
			$this->json_Msg['deletepost'] = true;
			$this->json_Msg['msg'] = " Deleted ";
		}
		else
		{
			$this->json_Msg['deletepost'] = false;
			$this->json_Msg['msg'] = " Not Deleted ";
		}
		return $this->json_Msg;
	}
} // end of class Delete_thisCategory






class Search {
	public $db_Obj;
	public $json_Msg = [];	
	public function __construct( )
	{
		$this->db_Obj = new DB_Class();
	}

	public function Search_Title($title)
	{
		
		$this->json_Msg['titleValue'] = $title ;
		$this->json_Msg['length'] = 0 ;
		$counter = 0;
		$posts = $this->db_Obj->Search_AudioFile_title($title);
		
		if(!empty($posts))
		{
			$lines = mysqli_num_rows($posts);

			if($lines > 0)
			{
				$this->json_Msg['title'] = true ;
				$this->json_Msg['length'] = $lines;

				foreach ($posts as $post ) {
					$stringg = 'title' . $counter;
					$this->json_Msg[$counter] = $post;  
					$counter = $counter + 1;
				}
			}
			else
			{
				$this->json_Msg['title'] = false ;
				$this->json_Msg['msg'] = "error ! i donot have rows"; 
			}

			
		}
		else
		{
			$this->json_Msg['title'] = false ;
			$this->json_Msg['msg'] = "error ! No posts of this user"; 
		}
		return $this->json_Msg;
	} // end of Search_title Method


	public function Search_Date($title)
	{
		$this->json_Msg['dateValue'] = $title ;
		$this->json_Msg['length'] = 0 ;
		$counter = 0;
		$posts = $this->db_Obj->Search_AudioFile_Date($title);
		
		if(!empty($posts))
		{
			$lines = mysqli_num_rows($posts);

			if($lines > 0)
			{
				$this->json_Msg['date'] = true ;
				$this->json_Msg['length'] = $lines;
				
				foreach ($posts as $post ) {
					$stringg = 'title' . $counter;
					$this->json_Msg[$counter] = $post;  
					$counter = $counter + 1;
				}
			}
			else
			{
				$this->json_Msg['date'] = false ;
				$this->json_Msg['msg'] = "error ! i donot have rows"; 
			}			
		}
		else
		{
			$this->json_Msg['date'] = false ;
			$this->json_Msg['msg'] = "error ! No posts of this user"; 
		}
		return $this->json_Msg;
	} // end of Search_title Method


} // end of class Approve_thisUser






?>