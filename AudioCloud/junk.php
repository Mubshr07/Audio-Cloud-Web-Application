<?php
include "DB_Class.php";
echo "<center><h1> This is Junk File </h1>";
$db = new DB_Class();



$playlistID = 5;
$audioID = 24;

$playlist = $db->Get_PlaylistDetails($playlistID);

var_dump($playlist);
echo "<br><br>";

if(!empty($playlist))
{
	$songlist = $playlist['audio'];
	if($songlist == 0)
	{
		$array = $audioID ;
		$db->Update_Playlist($playlistID, $array);
	}
	else
	{
		//$array = "";
		$array = explode(" ", $songlist);
		if(!in_array($audioID , $array))
		{
			$str = " ". $audioID ;
			array_push($array, $str);
			$db->Update_Playlist($playlistID, $array);
		}
		else
		{
			echo "Audio file already Exist in the Playlist";
		}
		
	}
}
else
{
	echo "Playlis is empty()";
}















echo "</center>";


?>