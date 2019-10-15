<?php

class HTML_Search
{
	
	public $db_Obj;
	public $baseurl;

	public function __construct()
	{
		$this->db_Obj = new DB_Class();
		$this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";


	}

	public function Get_Home_Page()
	{
		echo '	<div id="content_wrapper">
		 
		<div class="featured_image" id="divTitle" >
			<div class="head_box" >Search by Audio File Title</div>
		</div>
		<div class="main-agileinfo" id="divTitle2"  style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 10px; padding-right: 1%; padding-bottom: 10px; padding-left: 3%; ">

		<form name="formSearchTitle" id="formSearchTitle" method="post">
		<div class="form-group row">
			<input type="hidden"  class="hidden" name="searchtitle" value="searchtitle">
			<div class="col-sm-2">
					<input type="button" onclick="Search_withTitle(this)" class="btn btn-primary btn-lg btn-block" value="Search">
			</div>
			<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title"  maxlength="40" placeholder="Type Search Title here" required>
			</div>
			
		</div>
		</form>
		<div id="outputtitle"></div>


		<div id="audioDetails"> <ul id="searchtitleUL">
		</ul> </div>


		</div> 

		<br>

 
		<div id="divDate" class="featured_image">
			<div class="head_box" >Search by Uploading Date</div>
		</div>
		<div class="main-agileinfo" id="divDate2" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 10px; padding-right: 1%; padding-bottom: 10px; padding-left: 3%; ">

		<form name="formSearchDate" id="formSearchDate" method="post">
		<div class="form-group row"> 
			<div class="col-sm-2">
					<input type="button" onclick="Search_withDate(this)" class="btn btn-primary btn-lg btn-block" value="Search">
			</div>
			<div class="col-sm-10">
					<input type="date" id="start" name="dateValue" value="2019-10-02" min="2018-01-01" max="2022-12-31">
			</div>
			
		</div>
		</form> 
		<div id="outputdate"></div>
		<div id="audioDetails"> <ul id="searchdateUL">
		</ul> </div>

		</div> 

		<br>



		<div id="divCategory" class="featured_image">
			<div class="head_box"> Search by Audio Categories </div>
		</div>
		<div class="main-agileinfo" id="divCategory2" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 10px; padding-right: 1%; padding-bottom: 10px; padding-left: 3%; "> ';
		
		echo '<div id="categoriesContent"> <ul>';
				
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

		echo '<div id="output"></div>
		</div>  
		<br>



		<div class="featured_image">
			<div class="head_box" >Audio Player</div>
		</div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 10px; padding-right: 1%; padding-bottom: 10px; padding-left: 3%; ">
		 <audio id="audioPlayer" controls="controls" loop >

			<source id="audiosrc" >

			Your browser does not support the
			<code>audio</code> element.
			</audio>  
		</div> 




		</div>';
	} // end of Get_Home_Page

	public function Get_Search_Category($value)
	{
		echo  '<div id="content_wrapper"> <div class="featured_image">
		<div class="head_box"> Audio File category : ' . $value . ' </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%; padding-right: 3%; padding-bottom: 1%; padding-left: 3%;  "> <div class="agileits-top">';
		$rows = $this->db_Obj->Get_AudioFile_Category($value);
			$count = mysqli_num_rows($rows);

		$ro = $rows->fetch_array();
			echo '  <audio id="audioPlayer" controls="controls" loop >

			<source id="audiosrc" src="audioBank\\'.$ro['filename'].'">

			Your browser does not support the
			<code>audio</code> element.
			</audio> ';


		echo ' <div id="audioDetails">
				<ul>'; 
			
			if($count > 0)
			{
				foreach ($rows as $row)
				{
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


			    //echo '<li> No audio file of this category is uploaded yet  </li>';

			} // end of if empty($rows)
			else
			{
				echo '<li> No audio file of this category is uploaded yet </li>';
			}
			echo '</ul> </div>   ';
		

		echo ' </div></div></div> ';
	} // end of Get_Search_Category



}// end of class HTML_Search


?>