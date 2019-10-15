<?php 

class HTML_Admin {

	public $baseurl;

	public $db_Obj;
	public $category;

	public function __construct()
	{
	    $this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";

	  	$this->db_Obj = new DB_Class();
	  	$this->category = $this->db_Obj->Get_Categories();

	} // end of contructor


	public function GiveMe_approveNewUser()
	{
		echo '<div id="content_wrapper"> <div class="featured_image">
            <div class="head_box">Not approved users</div> </div> <div >
			<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%; padding-right: 3%; padding-bottom: 1%; padding-left: 3%; "> <div class="agileits-top">';

			echo ' <div id="audioDetails">
	  			<ul>';


		
	  		$rows = $this->db_Obj->Get_NotApprovedUsers();
	  		if(!empty($rows))
	  		{
	  			foreach ($rows as $row)
	  			{
	  				echo '<li style="padding-bottom:0px;"> <div style="width:100%;"> <div class="" style="width:100%;"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$row['firstName'].' '.$row['lastName'].'     <span class="font-weight-bold" style="color:grey; opacity:0.5;" > Username : </span>      <span class="font-weight-bold "  style="color:crimson; opacity:0.5;" >'.$row['username'].' </span>   </span>  </div>';
	  				
	  				
	  				echo '<div class="row"  id="user'.$row['id'].'"  style="font-size:11px; margin-left:5px;   display:inline-block;">'

	  				.'<div style="margin-left:10px; padding-bottom:0px;">  Registered Dated : '.$row['date_of_join'] 

	  				.'</div>  <div style="margin-left:10px;">  <form name="form_approveUser'.$row['id'].'" id="form_approveUser'.$row['id'].'"><input type="hidden" class="hidden" name="approveUser" value="'.$row['id'].'"> <button type="button"   style="margin: 0; border: none; padding: 0; background: transparent; color:green;" id="approveUser'.$row['id'].'" alt="approveUser"  value="'.$row['id'].'" onclick="approve_this(this)">Approve</button> </form>  </div>'

	  				.'<div style=" margin-left:5px;" > <form name="form_delete'.$row['id'].'" id="form_delete'.$row['id'].'"><input type="hidden" class="hidden" name="deleteUser" value="'.$row['id'].'"> <button type="button" style="margin: 0; border: none; padding: 0; background: transparent; color:red;" id="delete'.$row['id'].'" alt="Delete"  value="'.$row['id'].'" onclick="delete_this(this)">Delete</button> </form> </div> </div>'

	  				.' </div></li>'; 

			    } // end of foreach loop

			} // end of if empty($rows)
			else
			{
				echo '<li><a href=""> Every user is approved to upload file on this platform. </a></li>';
			}
			echo '</ul> </div>   ';
		







		echo '<div id="output"></div></div></div></div></div>';
	}

	public function GiveMe_approveNewPost()
	{
		//echo $this->approveNewPost;

		echo '<div id="content_wrapper"> <div class="featured_image">
            <div class="head_box">Not approved posts</div> </div> <div >
			<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%; padding-right: 3%; padding-bottom: 1%; padding-left: 3%; "> <div class="agileits-top">';

			echo ' <div id="audioDetails">
	  			<ul>';

	  		$rows = $this->db_Obj->Get_NotApprovedPosts();
	  		if(!empty($rows))
	  		{
	  			$ro = $rows->fetch_array();
				echo '  <audio id="audioPlayer" controls="controls" loop >

				<source id="audiosrc" src="audioBank\\'.$ro['filename'].'">

				Your browser does not support the
				<code>audio</code> element.
				</audio> ';


	  			foreach ($rows as $row)
	  			{
	  				if($row['publicPrivate'] == 0)
	  				{
	  					echo '<li style="padding-bottom:0px; width:100%;"> <div style="width:100%;"> <div class="" style="width:100%;"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$row['title'].'</span> </div>';
	  				

	  					echo '<div id="post'.$row['id'].'"  style="width:100%;"><div class="row" style="font-size:11px; margin-left:5px; padding:0; display:inline-block;"> '
	  					.'<div style="margin-left:10px;" ><span class="text-break block-ellipsis"> <span style="color:red"> Description: </span> '.$row['description'].'     &nbsp;</span> </div> </div>';

	  					if(strlen($row['remarks']) > 1) {
	  						echo '<div class="row" style="font-size:11px; margin-left:5px; padding:0; display:inline-block;"> '
	  						.'<div style="margin-left:10px;"><span class="text-break block-ellipsis"> <span style="color:red"> Remarks: </span>'.$row['remarks'].'     &nbsp;</span> </div> </div>';
	  					}

	  					echo '<div class="row" style="font-size:11px; margin-left:5px;   display:inline-block;">'

	  				.'<div style="margin-left:10px; padding-bottom:0px;">  Dated : '.$row['uploadingDate'] 

	  				.'<div class="" style="margin-left:10px;" > <form method="post" name="form_play'.$row['id'].'" id="form_play'.$row['id'].'"><input type="hidden"  class="hidden" name="play" value="'.$row['id'].'"/>  <span class="" id="played'.$row['id'].'"> '.$row['listenCount'].' </span>   <button type="button" class="audioButton" id="play" alt="Play" title="Play"  value="'.$row['id'].'" onclick="play_this(this)" > <img src="img/play.png"></button></form></div>'

	  				.'</div>  <div style="margin-left:10px;">  <form name="form_approvePost'.$row['id'].'" id="form_approvePost'.$row['id'].'"><input type="hidden" class="hidden" name="approvePost" value="'.$row['id'].'"> <button type="button"   style="margin: 0; border: none; padding: 0; background: transparent; color:green;" id="approvePost'.$row['id'].'" alt="Approve"  value="'.$row['id'].'" onclick="approve_this(this)">Approve</button> </form>  </div>'

	  				.'<div style=" margin-left:5px;" > <form name="form_deletePost'.$row['id'].'" id="form_deletePost'.$row['id'].'"><input type="hidden" class="hidden" name="deletePost" value="'.$row['id'].'"> <button type="button" style="margin: 0; border: none; padding: 0; background: transparent; color:red;" id="delete'.$row['id'].'" alt="Delete"  value="'.$row['id'].'" onclick="delete_this(this)">Delete</button> </form> </div> </div> </div>';

	  				echo ' </div></li>'; 
	  				}

			    } // end of foreach loop

			} // end of if empty($rows)
			else
			{
				echo '<li><a href=""> Every Post is approved. No new file is uploaded yet </a></li>';
			}
			echo '</ul> </div>   ';
		
		echo '<div id="output"></div></div></div></div></div>';
	}

	public function GiveMe_manageUsers()
	{
		echo '<div id="content_wrapper"> <div class="featured_image">
            <div class="head_box">User Management</div> </div> <div >
			<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding: 1%;"> <div class="agileits-top">';

		echo ' <div id="audioDetails" ><table class="table table-hover table-responsive "  style="font-size:11pt; " ><thead>
			        <tr>
			            <th>ID</th>
			            <th>username</th>
			            <th>Full Name</th>
			            <th>Approved</th>
			            <th>Uploads</th>
			            <th> </th>

			        </tr> </thead> <tbody>';

	  		$rows = $this->db_Obj->UserManagement();
	  		if(!empty($rows))
	  		{
	  			foreach ($rows as $row)
	  			{
	  				echo '<tr>';

				        echo '<td>'.$row['id'].'</td>'; 
				        echo '<td>'.$row['username'].'</td>'; 
				        echo '<td>'.$row['firstName'].' '.$row['lastName'].'</td>';

				        if($row['user_Approval'] == 1) { echo '<td><span style="color:green; font-size:10pt;"> Approved </span></td>'; }
				        else { echo '<td> <span style="color:red; font-size:10pt;"> Not Approved </span></td>'; }
				        
				        $totalUploads = $this->db_Obj->Get_totaluploads($row['id']);
				        if($totalUploads > 0){ echo '<td>'. $totalUploads .' </td>';  }
				        else { echo '<td> 0 </td>';  }
				        

				        echo '<td>  <div  id="user'.$row['id'].'" style="font-size:11px; " > <form name="form_delete'.$row['id'].'" id="form_delete'.$row['id'].'"><input type="hidden" class="hidden" name="deleteUser" value="'.$row['id'].'"> <button type="button" style="margin: 0; border: none; padding: 0; background: transparent;" id="delete'.$row['id'].'" alt="Delete"  value="'.$row['id'].'" onclick="delete_this(this)">Delete</button> </form> </div> </td>'; 
	  			    
	  			    echo '</tr> '; 
			    } // end of foreach loop

			} // end of if empty($rows)
			else
			{
				echo '<tr> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th></th> </tr> ';
			}
			echo '</tbody> </table> </div>';
		echo '</div></div></div></div> ';
	}

	public function GiveMe_managePosts ()
	{
		//echo $this->managePosts;

		echo '<div id="content_wrapper"> <div class="featured_image">
            <div class="head_box">Post Management</div> </div> <div >
			<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%;"> <div class="agileits-top">';

		echo ' <div id="audioDetails"><table  class="table table-hover table-responsive "  style="font-size:11pt; "><thead>
			        <tr>
			            <th>ID</th>
			            <th>User Name</th>
			            <th>File Title</th>
			            <th>Uploading Time</th>
			            <th>Category</th>
			            <th>Privacy</th>
			            <th>Listen</th>
			            <th>Like</th>
			            <th>Dislike</th>
			            <th>Share</th>
			            <th>Approved</th>
			            <th> </th>

			        </tr> </thead> <tbody>';

	  		$rows = $this->db_Obj->PostManagement();
	  		if(!empty($rows))
	  		{
	  			foreach ($rows as $row)
	  			{
	  				echo '<tr>';

				        echo '<td>'.$row['id'].'</td>'; 
				        echo '<td>'.$row['userName'].'</td>'; 
				        echo '<td> <span class="text-break  block-ellipsis"> '.$row['title'].'</span> </td>';
				        echo '<td> '.$row['uploadingDate'].' </td>';
				        echo '<td> '.$row['category'].' </td>'; 

				        if($row['publicPrivate'] == 0) { echo '<td><span style="color:green; font-size:10pt;"> Public </span></td>'; }
				        else { echo '<td> <span style="color:red; font-size:10pt;"> Private </span></td>'; }
				        
				        echo '<td> '.$row['listenCount'].' </td>'; 
				        echo '<td> '.$row['liked'].' </td>'; 
				        echo '<td> '.$row['disliked'].' </td>'; 
				        echo '<td> '.$row['Shared'].' </td>';  
				         
				        if($row['approved'] == 1) { echo '<td><span style="color:green; font-size:10pt;"> Approved </span></td>'; }
				        else { echo '<td> <span style="color:red; font-size:10pt;"> Not Approved </span></td>'; }

				        echo '<td>  <div style=" margin-left:5px;" id="post'.$row['id'].'" > <form name="form_deletePost'.$row['id'].'"  id="form_deletePost'.$row['id'].'"><input type="hidden" class="hidden" name="deletePost" value="'.$row['id'].'"> <button type="button" style="margin: 0; border: none; padding: 0; background: transparent; color:red;" id="delete'.$row['id'].'" alt="Delete"  value="'.$row['id'].'" onclick="delete_this(this)">Delete</button> </form> </div>  </td>'; 
	  			    
	  			    echo '</tr> '; 
			    } // end of foreach loop

			} // end of if empty($rows)
			else
			{
				echo '<tr> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th></th> </tr> ';
			}
			echo '</tbody> </table> </div>';
		echo '</div></div></div></div> ';
	}

	public function GiveMe_seeOneuserPosts ()
	{
		echo '<div id="content_wrapper">
        	<div class="featured_image">
            <div class="head_box">Select User to See his/her all Posts </div>
	        </div> 
			<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 10px; padding-right: 20px; padding-bottom: 0px; padding-left: 20px; ">
				<div class="agileits-top">';



				echo ' <div id="audioDetails"><table  id="userPostsTable" class="table table-hover table-responsive "  style="font-size:11pt; display:none;"><thead>
			        <tr>
			            <th>S/N</th>
			            <th>File Title</th>
			            <th>Uploading Time</th>
			            <th>Category</th>
			            <th>Privacy</th>
			            <th>Listen</th>
			            <th>Like</th>
			            <th>Dislike</th>
			            <th>Share</th>
			            <th>Approved</th>

			        </tr> </thead> <tbody>';

	  		
				echo '</tbody> </table> </div>';



				echo '<div id="outputMain">
				<form method="post" name="form_oneUserPosts" id="form_oneUserPosts">
				  
				  <div class="row form-group">
				    <label for="userid" class="col-sm-3 col-form-label"> <span style="color:red"> *</span> Enter User ID : </label>
					<div class="col-sm-9">
				    	<input type="number" class="form-control" name="userid" placeholder="id" required ></div>
				  </div>
				  <input type="hidden"  class="hidden" name="oneUserPosts" value="oneUserPosts">

				  <input type="button" class="btn btn-primary btn-lg btn-block" value="Check Posts" onclick="Get_userPosts(this)">
				</form> 
				
				<br> <div id="output"> </div>

			</div></div></div></div> ';
	}



	public function Get_CategoriesPage()
	{
		echo  '<div id="content_wrapper"> <div class="featured_image">
		<div class="head_box">All Categories </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%; padding-right: 3%; padding-bottom: 1%; padding-left: 3%;  "> <div class="agileits-top">';
		if(isset($_SESSION['userid']))
		{
			$rows = $this->category;
			if(!empty($rows))
			{
				echo ' <div id="audioDetails">
				<ul>';
				$counter = 0;
				foreach ($rows as $row)
				{
					$counter = $counter + 1;
					echo '<li style="padding-bottom:0px;"> <div id="category'.$row['id'].'" style="width:100%;"> <div class="" style="width:100%;"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$counter.' &nbsp;'.$row['name'].'</span> </div>';
					
					echo '<div class="row" style="font-size:11px; margin-left:5px;   display:inline-block;">'
					.'<div style="margin-left:10px; padding-bottom:0px;">  Dated : '.$row['datetime'] .' &nbsp;';
					

					echo '<div style=" margin-left:5px;" > <form name="form_deleteCategory'.$row['id'].'" id="form_deleteCategory'.$row['id'].'"> <input type="hidden" class="hidden" name="deleteCategory" value="'.$row['id'].'"> <button type="button" style="margin: 0; border: none; padding: 0; background: transparent; color:red;" id="deleteCategory'.$row['id'].'" alt="Delete"  value="'.$row['id'].'" onclick="delete_thisCategory(this)">Delete</button> </form> </div> </div>'

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
			echo '<div id="audioDetails"><ul><li><a href=""> There are no Category enters in the platform.</a></li></ul><div>';
		}




		echo '<br>
		<div class="form-group row justify-content-center">
		<span class="font-weight-bolder" > Create New Category </span>
		</div>
		<form   name="form_createCategory" id="form_createCategory">

		<div class="form-group row">
		<label for="type" class="col-sm-3 col-form-label">Name : </label>
		<div class="col-sm-9">
		<input type="text" name="createCategory" class="form-control" id="createCategory" placeholder="Enter Name of New Category" required>
		</div> </div>

		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" value="Create" onclick="createNewCategory(this)">
		</form>
		<div id="output"></div> ';

		echo ' </div></div></div> ';
	} // end of function Get_CategoriesPage
} // end of class


?>