<?php
class Play_it extends DB_Class {

	public $audioID;
	public $json_Msg = [];	

	public function __construct( ){ 
		
	}
	public function play($id){
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "played".$id;
		$incrementResponse =  $this->Increment_listenCount($id);
		$file = $this->Get_AudioFile($id); 
		if(!empty($incrementResponse))
		{
			$this->json_Msg['played'] = true;
			$this->json_Msg['listenCount'] = $incrementResponse;
			if(isset($file)){
				$this->json_Msg['path'] = 'audioBank\\' . $file['filename'];
			}
		}
		else
		{
			$this->json_Msg['played'] = false;
			$this->json_Msg['listenCount'] = "Error";
		}
		return $this->json_Msg;
	}
} //end of Play_it Class

class Like_it extends DB_Class {
	public $audioID;
	public $json_Msg = [];
	public function __construct(){ 
		//return ($id-1);
	}
	public function like($id){
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "liked".$id;
		$incrementResponse =  $this->Increment_Liked($id);
		if(!empty($incrementResponse))
		{
			$this->json_Msg['Liked'] = true;
			$this->json_Msg['LikedCount'] = $incrementResponse;
		}
		else
		{
			$this->json_Msg['Liked'] = false; 
			$this->json_Msg['LikedCount'] = "Error";
		}
		return $this->json_Msg;
	}
} //end of Like_it Class

class Dislike_it extends DB_Class {
	public $audioID;
	public $json_Msg = [];
	public function __construct(){ 
		//return ($id-1);
	}
	public function dislike($id){
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "disliked".$id;
		$incrementResponse =  $this->Increment_Disliked($id);
		if(!empty($incrementResponse))
		{
			$this->json_Msg['Disliked'] = true;
			$this->json_Msg['DislikedCount'] = $incrementResponse;
		}
		else
		{
			$this->json_Msg['Disliked'] = false;
			$this->json_Msg['Disliked'] = "Some Error in audioProperties PHP file or DB_Class PHP file";
		}
		return $this->json_Msg;
	}
} //end of Dislike_it Class


class PlaylistsName {
	public $json_Msg = [];
	public $db_Obj;
	public function __construct(){ 
		//return ($id-1);
		$this->db_Obj = new DB_Class();
	}
	public function Playlist($audioID){
		if(isset($_SESSION["userid"]))
		{
			$has = false;
			$playlists =  $this->db_Obj->Get_UserPlaylistsNames($_SESSION["userid"]);
			if(!empty($playlists))
			{
				$this->json_Msg['userID'] = $_SESSION["userid"];
				$this->json_Msg['audio'] = $audioID;
				$this->json_Msg['playlist'] = true;

				$counter = 0;
				foreach ($playlists as $playlist) {

					$this->json_Msg[$counter] = $counter;
					$str = "playlist".$counter;
					$this->json_Msg[$str] = $playlist;
					$counter = $counter + 1;
					$has = true;
				}
				if($counter > 0){$this->json_Msg['length'] = $counter;}
				else {$this->json_Msg['length'] = 1;}
				
				$this->json_Msg['has'] = $has;
				
			}
			else
			{
				$this->json_Msg['playlist'] = true;
				$this->json_Msg['0'] = 0;
				$this->json_Msg['length'] = 1;
				$this->json_Msg['has'] = false;
				$this->json_Msg['playlist0'] = "Playlist1";
			}
		}
		else
		{
			$this->json_Msg['playlist'] = false;
			$this->json_Msg['error'] = "User not logined";
		}

		return $this->json_Msg;
	}
} //end of Dislike_it Class


class Add_Audio {
	public $audioID;
	public $json_Msg = [];
	public $db_Obj;
	function __construct()
	{
		$this->db_Obj = new DB_Class();
	}

	function Add($playlistID , $audio )
	{
		$this->json_Msg['audio_added'] = true;
		if($playlistID == 0)
		{
			if(isset($_SESSION['userid']))
			{
				$this->db_Obj->Insert_NewPlaylist($_SESSION['userid'], $audio);
				$this->json_Msg['msg'] = "audio file ID " . $audio ." added to New playlist";
			}
		}
		else
		{
			$playlist = $this->db_Obj->Get_PlaylistDetails($playlistID);
			if(!empty($playlist))
			{
				$songlist = $playlist['audio'];
				if($songlist == 0)
				{
					$array = $audio;
					$this->db_Obj->Update_Playlist($playlistID, $array);
					$this->json_Msg['msg'] = "audio file ID " . $audio ." added to playlist". $playlistID;
				}
				else
				{
					$array = explode(" ", $songlist);
					if(!in_array($audio , $array))
					{
						$str = " ". $audio ;
						array_push($array, $str);
						$this->db_Obj->Update_Playlist($playlistID, $array);
					}
					$this->json_Msg['msg'] = "audio file ID " . $audio ." added to playlist". $playlistID . " Other audio are : " . $songlist;
				}
			}
			else
			{
				$array = $audio;
				$this->db_Obj->Update_Playlist($playlistID, $array);
			}
		}
		return $this->json_Msg;
	} // end of function

	function Create($playlistName )
	{
		$this->json_Msg['playlist_created'] = true;
		if(isset($_SESSION['userid']))
		{
			$this->db_Obj->Insert_NewPlaylist($_SESSION['userid'], $playlistName); 
			$this->json_Msg['msg'] = "Playlist Name " . $playlistName ." Created";
		}
		
		else
		{
			$this->json_Msg['playlist_created'] = false;
			$this->json_Msg['msg'] = "Error in creating new Playlist";
		}
		return $this->json_Msg;
	} // end of function




} // end of class



class Share_it extends DB_Class {

	public $audioID;
	public $json_Msg = [];


	public function __construct(){ 
		//return ($id-1);
	}
	public function share($id){
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "shared".$id;
		$incrementResponse =  $this->Increment_Shared($id);
		if(!empty($incrementResponse))
		{
			$this->json_Msg['Shared'] = true;
			$this->json_Msg['SharedCount'] = $incrementResponse;

			$file =  $this->Get_AudioFile($id);
			if(!empty($file))
			{
				$this->json_Msg['code'] = true;
				$this->json_Msg['filename'] = 'audioBank\\'.$file['filename'];
			}
			else
			{
				$this->json_Msg['code'] = false;
				$this->json_Msg['embeded'] = "Some Error in audioProperties PHP file or DB_Class PHP file";
			}


		}
		else
		{
			$this->json_Msg['Shared'] = false;
			$this->json_Msg['SharedCount'] = "Some Error in audioProperties PHP file or DB_Class PHP file";
		}
		return $this->json_Msg;
	}

} //end of Share_it Class


class Delete_it extends DB_Class {
	public $json_Msg = [];

	public function __construct(){ 
		//return ($id-1);
	}
	public function delete($id){
		$this->json_Msg['id'] = $id;
		$this->json_Msg['output_id'] = "userpost".$id;
		$res =  $this->Remove_AudioFile($id);
		if($res)
		{
			$this->json_Msg['delete'] = true;
			$this->json_Msg['msg'] = "File is deleted successfully";
		}
		else
		{
			$this->json_Msg['delete'] = false;
			$this->json_Msg['msg'] = "Some Error in audioProperties PHP file or DB_Class PHP file";
		}
		return $this->json_Msg;
	}

} //end of Share_it Class







?>