function _(el) {
	return document.getElementById(el);
}




function Search_withDate (sender)
{
	var formName = "formSearchDate" ;

	var frmdta ;
	var xhr = createRequestObject();
	if(document.forms["formSearchDate"].checkValidity())
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		//console.log(frmdta);
		xhr.onload = function(){  
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s); 
					Render_SearchDate(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
			_(formName).reset();
	} // end of if for 
	else
	{
		var output = document.getElementById("outputdate");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}


function Render_SearchDate(data)
{
	if(data['date'] ==  false)
	{
		var output = document.getElementById("outputdate");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> No Files are uploaded with this Date : "+data['dateValue']+"</span><br>");

		var outputmm = document.getElementById("searchdateUL");
		while (outputmm.hasChildNodes()) { outputmm.removeChild(outputmm.firstChild);}
		setTimeout(Romve_element, 2000);
	}
	else if(data['date'] == true)
	{
		var others = _("divTitle");
		others.style.display = "none";
		others = _("divTitle2");
		others.style.display = "none";
		others = _("divCategory");
		others.style.display = "none";
		others = _("divCategory2");
		others.style.display = "none";

		var outputmm = document.getElementById("outputdate");
		while (outputmm.hasChildNodes()) { outputmm.removeChild(outputmm.firstChild);}
		



		var output = document.getElementById("searchdateUL");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		var element = "";
		for (var i = 0; i < data['length']; i++) {
			element  += '<li> <div class=" block-ellipsis"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">' + data[i]['title'] +'</span> </div> '+
						'<div class="d-flex" style="margin-left:10%;" >'+
					'<div class="p-2 flex-fill"> <a class="audioButton" href="audioBank\\'+ data[i]['filename'] +'" download> <img src="img/download" title="DOWNLOAD" /></a> </div>'+
					'<div class="p-2 flex-fill"> <form method="post" name="form_play'+ data[i]['id'] +'" id="form_play'+ data[i]['id'] +'"><input type="hidden"  class="hidden" name="play" value="'+ data[i]['id'] +'"/>  <span class="" id="played'+ data[i]['id'] +'"> '+ data[i]['listenCount'] +' </span>   <button type="button" class="audioButton" id="play" alt="Play" title="Play"  value="'+ data[i]['id'] +'" onclick="play_this(this)" > <img src="img/play.png"></button></form></div>';
			element += '<div class="p-2 flex-fill" > <form name="form_share'+ data[i]['id'] +'" id="form_share'+ data[i]['id'] +'"><input type="hidden" class="hidden" name="share" value="'+ data[i]['id'] +'">  <span class=""  id="shared'+ data[i]['id'] +'"> '+ data[i]['Shared'] +' </span>    <button type="button" class="audioButton" id="share" alt="Share" title="Share" value="'+ data[i]['id'] +'"  data-toggle="modal" data-target="#exampleModalCentered" onclick="share_this(this)" > <img src="img/share" alt="Share" > </button> </form> </div> </div>';
			element +='<span class="text-muted" style="font-size:11px; margin:0; padding:0;"> <span class="block-ellipsis">'+ data[i]['description'] +'</span> By <span class="font-italic font-weight-bold"> '+ data[i]['userName'] +'</span> '
					+' Dated : <span class="font-italic ">'+ data[i]['uploadingDate'] +'</span>  </span></li>';
			output.insertAdjacentHTML('beforeend', element); 
		}
	} // end of else if (data['title'] == true)
}




 function Romve_element()
    {
    	var output = _("outputdate");
    	 
    	while (output.hasChildNodes()) {
    		output.removeChild(output.firstChild);
    	}
    }














































function Search_withTitle (sender)
{
	var formName = "formSearchTitle" ;

	console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.forms["formSearchTitle"].checkValidity())
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		console.log(frmdta);
		xhr.onload = function(){  
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					//console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s); 
					Render_Search(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
			_(formName).reset();
	} // end of if for 
	else
	{
		var output = document.getElementById("outputtitle");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function Render_Search (data)
{
	if(data['title'] ==  false)
	{
		var output = document.getElementById("outputtitle");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> No Files are uploaded with this title </span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
	else if(data['title'] == true)
	{
		var others = _("divDate");
		others.style.display = "none";
		others = _("divDate2");
		others.style.display = "none";
		others = _("divCategory");
		others.style.display = "none";
		others = _("divCategory2");
		others.style.display = "none";

		var output = document.getElementById("searchtitleUL");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		var element = "";
		for (var i = 0; i < data['length']; i++) {
			element  = '<li> <div class=" block-ellipsis"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">' + data[i]['title'] +'</span> </div> '+
						'<div class="d-flex" style="margin-left:10%;" >'+
					'<div class="p-2 flex-fill"> <a class="audioButton" href="audioBank\\'+ data[i]['filename'] +'" download> <img src="img/download" title="DOWNLOAD" /></a> </div>'+
					'<div class="p-2 flex-fill"> <form method="post" name="form_play'+ data[i]['id'] +'" id="form_play'+ data[i]['id'] +'"><input type="hidden"  class="hidden" name="play" value="'+ data[i]['id'] +'"/>  <span class="" id="played'+ data[i]['id'] +'"> '+ data[i]['listenCount'] +' </span>   <button type="button" class="audioButton" id="play" alt="Play" title="Play"  value="'+ data[i]['id'] +'" onclick="play_this(this)" > <img src="img/play.png"></button></form></div>';
			element += '<div class="p-2 flex-fill" > <form name="form_share'+ data[i]['id'] +'" id="form_share'+ data[i]['id'] +'"><input type="hidden" class="hidden" name="share" value="'+ data[i]['id'] +'">  <span class=""  id="shared'+ data[i]['id'] +'"> '+ data[i]['Shared'] +' </span>    <button type="button" class="audioButton" id="share" alt="Share" title="Share" value="'+ data[i]['id'] +'"  data-toggle="modal" data-target="#exampleModalCentered" onclick="share_this(this)" > <img src="img/share" alt="Share" > </button> </form> </div> </div>';
			element +='<span class="text-muted" style="font-size:11px; margin:0; padding:0;"> <span class="block-ellipsis">'+ data[i]['description'] +'</span> By <span class="font-italic font-weight-bold"> '+ data[i]['userName'] +'</span> '
					+' Dated : <span class="font-italic ">'+ data[i]['uploadingDate'] +'</span>  </span></li>';
			output.insertAdjacentHTML('beforeend', element); 
		}
	} // end of else if (data['title'] == true)
} // end of Render_Search function




function delete_thisCategory (sender)
{
	console.log(sender.value);

	var formName = "form_deleteCategory" + sender.value;
	 
	//console.log('id: ' + sender.value + ' Form Name : ' +formName23 );
 
	var frmdta ;
	var xhr = createRequestObject();

	if(_(formName)){
		frmdta = new FormData(document.forms.namedItem(formName));
	 
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					render_NotApprovedUsersPosts(ourData); 
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta); 
		} // end of form
} // end of delete_thisCategory


function createNewPlaylist(sender)
{
	console.log( "form_createPlaylistcc " + sender.value);

	var formName = "form_createPlaylistcc" ;

	console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.forms["form_createPlaylistcc"].checkValidity())
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		console.log(frmdta);
		xhr.onload = function(){  
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					renderHTML(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
			_(formName).reset();
	} // end of if for 
	else
	{
		var output = document.getElementById("output");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}






function createNewCategory(sender)
{
	console.log( "form_createCategory " + sender.value);

	var formName = "form_createCategory" ;

	console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.forms[formName].checkValidity())
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		console.log(frmdta);
		xhr.onload = function(){  

				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					renderUserPost(ourData);
					_(formName).reset();
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
	} // end of if for 
	else
	{
		var output = document.getElementById("output");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}









function addToPlaylist_this(sender) {
	//console.log(sender.value);

	var formName = "form_playlist" + sender.value;
	console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.getElementById(formName))
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					render_Playlists(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
		//Disable_this(formName);
} // end of function addToPlaylist_this(sender)

function render_Playlists(data)
{
	_("exampleModalCenteredLabel").innerHTML = "Your Playlists";
	_("abcc").innerHTML = "Your playlists names " ; // + data['audio'] ;
	var str = "playlist";
	var ff ="";
	var gg = "";
	if(data['playlist'] ==  true){
		for(var i=0; i<data['length']; i++){

			str = "playlist" + i;
			//console.log(str);

			if(data['has']){
				ff = ' <form name="form_playlistName'+
				data[str]['id']+'" id="form_playlistName'+ data[str]['id']+
				'"> <input type="hidden"  class="hidden" name="playlistName" value="'+
				data[str]['id']+'">  <input type="hidden"  class="hidden" name="audio" value="'+
				data['audio']+'">  <button type="button" class="btn btn-primary btn-lg btn-block"  alt="Playlist" title="Playlist" value="'+
				data[str]['id']+'" data-dismiss="modal" onclick="add_this(this)" >'+
				data[str]['playlistName']+' </button> </form> <br>';
			}
			else
			{
				ff = '<form name="form_playlistName'+0
				+'" id="form_playlistName'+ 0 +
				'"><input type="hidden"  class="hidden" name="playlistName" value="'+
				0 +'"> <input type="hidden"  class="hidden" name="audio" value="'+
				data['audio']+'">   <button type="button" class="btn btn-primary btn-lg btn-block"   alt="Playlist" title="Playlist" value="'+
				0 +'" data-dismiss="modal" onclick="add_this(this)" > Playlist 1 </button> </form><br>';
			}


			gg += '<span class="text-break  block-ellipsis">' + ff + "</span>";			
		} // end of for loop
		_("modaltable").innerHTML = gg;

	}
	else
	{  
		_("modaltable").innerHTML = '<span class="text-break  block-ellipsis">' + data['error'] + "</span>";			
	}
}


function add_this(sender)
{
	var formName = "form_playlistName" + sender.value;
	//console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.getElementById(formName))
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					//render_Playlists(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
}




function share_this(sender) {
	//console.log(sender.value);
	var formName = "form_share" + sender.value;
	//console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.getElementById(formName))
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					
					render_Sharethis(ourData)
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
} // end of function share_this(sender)


function render_Sharethis(data)
{

	_("exampleModalCenteredLabel").innerHTML = "Embedded Code to Share this on Social Networks";
	//var emcode = '<xmp> <embed type=\'audio/mpeg\' height=\'auto\' width=\'300px\' src=\'localhost/'+data['filename']+'\' controls />  </xmp>';
	var emcode = '<embed type=\'audio/mpeg\' height=\'auto\' width=\'300px\' src=\'localhost\\audiocloud\\'+data['filename']+'\' controls />  ';
	//_("abcc").innerHTML = '<input type="text" width="100%" value="'+ emcode +'">';

	_("abcc").innerHTML = '<textarea class="w-100" style="font-size:8pt; background-color:lightgray;" type="code" width="100%" height="auto" readonly > '+ emcode +'  </textarea>';
	_("modaltable").innerHTML = "";
	AudioProperty_change(data);
}










function Upload()
{
	var xhr = createRequestObject();
	var frmdta;

	if(document.forms["form_upload"].checkValidity()){
		frmdta = new FormData(document.forms.form_upload);
		var file = document.getElementById("file1").files[0];
		frmdta.append("file1", file);
		_("upload_responseDiv").style.display = "block";

		xhr.upload.addEventListener("progress", progressHandler, false);

		xhr.addEventListener("progress", progressHandler, true);
		xhr.addEventListener("load", completeHandler, false);
		xhr.addEventListener("error", errorHandler, false);
		xhr.addEventListener("abort", abortHandler, false);
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	}
	else
	{
		var output = document.getElementById("output");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function MyProfile()
{
	var xhr = createRequestObject();
	var frmdta ;
	if(document.forms["form_myprofile"].checkValidity()){
		console.log(" form_myprofile validation checked ");
		frmdta = new FormData(document.forms.form_myprofile);
		xhr.onload = function(){ 
			//console.log(xhr.status);
			if(xhr.readyState == 4 && xhr.status==200){
				var s = xhr.responseText;
				//console.log(s); 
				s = Json_Replacable(s);  
				var ourData = JSON.parse(s);
				if(ourData["myprofile"]){
					//console.log("This is the myprofile update form response ");
				}

				renderHTML(ourData);
			}
			else
			{
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function(){
			console.log(" errors in XhrReuest ");


		}; // end of onerror function
		xhr.onprogress =  function(event) {
			//console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
		}; // end of onprogress 
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	}
	else
	{
		var output = document.getElementById("output");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function Login()
{
	var xhr = createRequestObject();
	var frmdta ;

	if(document.forms['formlogin'].checkValidity()){
		//console.log(" form_login validation checked ");
		frmdta = new FormData(document.forms.formlogin);
		xhr.onload = function(){ 
			//console.log(xhr.status);
			if(xhr.readyState == 4 && xhr.status==200){
				var s = xhr.responseText;
				//console.log(s); 
				s = Json_Replacable(s);  
				var ourData = JSON.parse(s);	
				if( ourData["log"]){
					setCookie("log", ourData["log"], 2);
					setCookie("username", ourData["username"], 2);
						//setCookie("fullname", ourData["fullname"], 2);
						//setCookie("usertype", ourData["usertype"], 2);
					}else{
						setCookie("log", ourData["log"], 2);
					}				
					renderHTML(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");

		}; // end of onerror function
		xhr.onprogress =  function(event) {
			//console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
		}; // end of onprogress 
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	}
	else
	{
		var output = document.getElementById("output");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
		
	}
}

function Register()
{
	var xhr = createRequestObject();
	var frmdta ;
	if(document.forms["form_signup"].checkValidity()){
		//console.log(" form_signup validation checked ");
		frmdta = new FormData(document.forms.form_signup);
		xhr.onload = function(){ 
			//console.log(xhr.status);
			if(xhr.readyState == 4 && xhr.status==200){
				var s = xhr.responseText;
				console.log(s); 
				s = Json_Replacable(s);  
				var ourData = JSON.parse(s);					
				renderHTML(ourData);
			}
			else
			{
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function(){
			console.log(" errors in XhrReuest ");

		}; // end of onerror function
		xhr.onprogress =  function(event) {
			//console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
		}; // end of onprogress 
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	}
	else
	{
		var output = document.getElementById("output");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild);}
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
		
	}
}

function AudioProperty_change(data){
	if(data['played'])
	{
		_(data['output_id']).innerHTML = data['listenCount'];
		var player = _("audioPlayer");
		_("audiosrc").remove();		
		player.insertAdjacentHTML('beforeend','<source id="audiosrc" src="'+data['path']+'">');	
		player.load();
		player.play();

	}
	else if(data['Liked']){
		_(data['output_id']).innerHTML = data['LikedCount'];
	}
	else if(data['Disliked']){
		_(data['output_id']).innerHTML = data['DislikedCount'];
	}
	else if(data['playlist']){
		//_(data['output_id']).innerHTML = data['SharedCount'];
		console.log("Embedded HTML Model element not generated ");
	}
	else if(data['Shared']){
		_(data['output_id']).innerHTML = data['SharedCount'];
	}
	else{
		console.log(data);
	}
}

function Disable_this(sender) {
	console.log(sender);
	_(sender).disabled = true; 
}

function Enable_this(sender) { 
	_(sender).disabled = false; 
}


function play_this(sender){ 
	//console.log('playing ' + sender.value);
	var formName = "form_play" + sender.value;
	//console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.getElementById(formName))
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					//console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					AudioProperty_change(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
} // end of function play_this(sender)

function like_this(sender){ 
	Disable_this("dislike" + sender.value);
	Disable_this("like" + sender.value);
	_("like_image" + sender.value).style.display = "none";
	_("like_imagee" + sender.value).style.display = "inline-block";
	var formName = "form_like" + sender.value;
	var frmdta ;
	var xhr = createRequestObject();
	if(_(formName))
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function(){  
			if(xhr.readyState == 4 && xhr.status==200){
				var s = xhr.responseText;
					//console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					AudioProperty_change(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
} // end of function like_this(sender)

function dislike_this(sender) { 
	Disable_this("like" + sender.value);
	Disable_this("dislike" + sender.value);
	_("dislike_image" + sender.value).style.display = "none";
	_("dislike_imagee" + sender.value).style.display = "inline-block";
	var formName = "form_dislike" + sender.value;
	//console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.getElementById(formName))
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					//console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					AudioProperty_change(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
} // end of function dislike_this(sender)





function edit_this(sender) {
	console.log(sender.value);
	var formName = "form_edit" + sender.value;
	//console.log(formName);
	var frmdta ;
	var xhr = createRequestObject();
	if(document.getElementById(formName))
	{
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					render_myAllPostWindow(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
} // end of function share_this(sender)

function delete_this(sender) {
	var formName = "form_delete" + sender.value;
	var formName1 = "form_deleteUser" + sender.value;
	var formName2 = "form_deletePost" + sender.value;
	var formName23 = "form_deletepost" + sender.value;

	console.log('id: ' + sender.value + ' Form Name : ' +formName23 );

	var bb = false;
	var bbb = false;
	var frmdta ;
	var xhr = createRequestObject();

	if(_(formName)){
		frmdta = new FormData(document.forms.namedItem(formName));
		bb = true;
		bbb = true;
	} else if(_(formName1)){
		frmdta = new FormData(document.forms.namedItem(formName1));
		bb = true;
	}

	if(_(formName2)){
		frmdta = new FormData(document.forms.namedItem(formName2));
		bb = true;
	}

	if(bb)
	{
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					//console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					if(bbb) { render_myAllPostWindow(ourData);  }
					else { render_NotApprovedUsersPosts(ourData); }
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
		} // end of if for 
} // end of function share_this(sender)

function approve_this(sender){
	var formName = "form_approveUser" + sender.value;
	var formName1 = "form_approvePost" + sender.value;
	var bb = false;
	var frmdta ;
	var xhr = createRequestObject();

	if(_(formName)){
		frmdta = new FormData(document.forms.namedItem(formName)); 
		bb = true;
	} else if(_(formName1)){
		frmdta = new FormData(document.forms.namedItem(formName1));
		bb = true;
	}

	if(bb)
	{
		
		xhr.onload = function(){ 
				//console.log(xhr.status);
				if(xhr.readyState == 4 && xhr.status==200){
					var s = xhr.responseText;
					//console.log(s); 
					s = Json_Replacable(s); 
					var ourData = JSON.parse(s);
					//console.log(ourData);
					render_NotApprovedUsersPosts(ourData);
				}
				else
				{
					console.log("We connected to the server. but server return an error.");
				}
			};
			xhr.onerror = function(){
				console.log(" errors in XhrReuest ");
			};
			xhr.open('POST', 'xhrRequest.php');
			xhr.send(frmdta);
	} // end of if for 
}

function render_NotApprovedUsersPosts(data){
	if(data["deleteuser"]){
		var output = _(data['output_id']);
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend',"<span class='text-muted' style='font-size:11px; margin:0; padding:0; display:inline-block;'>" + data["msg"] + "</span><br>");	
	} // end of if delete argv is true

	if(data["approveuser"]){
		var output = _(data['output_id']);
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend',"<span class='text-muted' style='font-size:11px; margin:0; padding:0; display:inline-block;'>" + data["msg"] + "</span><br>");	
	} // end of if delete argv is true

	if(data["approvepost"]){
		var output = _(data['output_id']);
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend',"<span class='text-muted' style='font-size:11px; margin:0; padding:0; display:inline-block;'>" + data["msg"] + "</span><br>");	
	} // end of if delete argv is true
	if(data["deletepost"]){
		var output = _(data['output_id']);
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend',"<span class='text-muted' style='font-size:11px; margin:0; padding:0; display:inline-block;'>" + data["msg"] + "</span><br>");	
	} // end of if delete argv is true
}

function render_myAllPostWindow(data){
	if(data["delete"]){
		var output = _(data['output_id']);
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend',"<span class='text-muted' style='font-size:11px; margin:0; padding:0; display:inline-block;'>" + data["msg"] + "</span><br>");	
	} // end of if delete argv is true

	if(data["edit"]){
		var output = _(data['output_id']);
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend',"<span class='text-muted' style='font-size:11px; margin:0; padding:0; display:inline-block;'>" + data["msg"] + "</span><br>");	
	} // end of if delete argv is true
}

function Get_userPosts(sender){
	var formName = "form_oneUserPosts";
	var frmdta ;
	var xhr = createRequestObject();
	if(document.forms[formName].checkValidity()){
		frmdta = new FormData(document.forms.namedItem(formName)); 
		xhr.onload = function(){ 
			if(xhr.readyState == 4 && xhr.status==200){
				var s = xhr.responseText;
				//console.log(s); 
				s = Json_Replacable(s); 
				var ourData = JSON.parse(s);
				//console.log(ourData);
				renderUserPost(ourData);
			}
			else
			{
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function(){
			console.log(" errors in XhrReuest ");
		};
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta); 
	}
	else
	{
		var output = _("output");
		while (output.hasChildNodes()) { output.removeChild(output.firstChild); }
		output.insertAdjacentHTML('beforeend',"<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function renderUserPost(data){
	var output = _(data["output_id"]);
	while (output.hasChildNodes()) {
		output.removeChild(output.firstChild);
	}
	if(data["output_id"] == "output"){
		output.insertAdjacentHTML('beforeend',"<span style='color:cyan; font-size:21px; font-weight:600;'>" + data["msg"] + "</span><br>");	
		setTimeout(Romve_xhrMsg, 2000);
	}
	else if(data["output_id"] == "outputMain"){
		//console.log(data); 
		if(data['hasposts'] ==  true){
			var table = _("userPostsTable");
			table.style.display = "inline-block";
			for(var i=0; i<data['length']; i++){
				var row = table.insertRow(i+1);

				var cell0 = row.insertCell(0);
				var cell1 = row.insertCell(1);
				var cell2 = row.insertCell(2);
				var cell3 = row.insertCell(3);
				var cell4 = row.insertCell(4);
				var cell5 = row.insertCell(5);
				var cell6 = row.insertCell(6);
				var cell7 = row.insertCell(7);
				var cell8 = row.insertCell(8);
				var cell9 = row.insertCell(9);

				cell0.innerHTML = i+1; // data[i]['id'];
				cell1.innerHTML = '<span class="text-break  block-ellipsis">' + data[i]['title'] + "</span>";
				cell2.innerHTML = data[i]['uploadingDate'];
				cell3.innerHTML = data[i]['category'];
				if( data[i]['publicPrivate'] == 0){
					cell4.innerHTML = "Public";
				}else{
					cell4.innerHTML = "Private";
				}
				
				cell5.innerHTML = data[i]['listenCount'];
				cell6.innerHTML = data[i]['liked'];
				cell7.innerHTML = data[i]['disliked'];
				cell8.innerHTML = data[i]['Shared'];
				if(data[i]['approved'] == 1){
					cell9.innerHTML = "Approved";
				}else{
					cell9.innerHTML = "Not Approved";
				}
			}
		}
		//output.insertAdjacentHTML('beforeend',"<span style='color:cyan; font-size:21px; font-weight:600;'>" + data["id"] + "</span><br>");	
	}
	else{
		alert(" Some this else is comming to you. Hahahahahahhaha");
	}
}

function renderHTML(data)
{	
	var output = _("output");
	while (output.hasChildNodes()) {
		output.removeChild(output.firstChild);
	}
	if(data["error"]){
		output.insertAdjacentHTML('beforeend',"<span style='color:cyan; font-size:21px; font-weight:600;'>" + data["error"] + "</span><br>");	
	} 

	 if(data["playlist_created"]){
        	output.insertAdjacentHTML('beforeend',"<span style='color:lime; font-size:21px; font-weight:600;'>" + data["msg"] + "</span><br>");	
    }
        //login form
        if(data["login"]){
        	output.insertAdjacentHTML('beforeend',"<span style='color:lime; font-size:21px; font-weight:600;'>" + data["username"] + "</span><br>");	
        	if(data["login_success"]){
        		window.location = window.location.protocol + "//" +  window.location.host + "/AudioCloud"
        	}
        }
        
        //signup form
        if( data["signup"]){
        	output.insertAdjacentHTML('beforeend',"<span style='color:lime; font-size:21px; font-weight:600;'>" + data["successMsg"] + "</span><br>");	
        	setTimeout(Romve_xhrMsg, 2000);
        	if(ourData["signup_success"] == true){
        		window.location = window.location.protocol + "//" +  window.location.host + "/AudioCloud/?val=login"
        	}
        }
        
        // myProfile Update form
        if( data["myprofile"]){
        	output.insertAdjacentHTML('beforeend',"<span style='color:lime; font-size:21px; font-weight:600;'>" + data["successMsg"] + "</span><br>");	
        }
        if(document.getElementById('form_upload')){
        	output.insertAdjacentHTML('beforeend',"<span style='color:yellow; font-size:21px; font-weight:600;'>" + data["successMsg"] + "</span><br>");	
        	document.getElementById("form_upload").reset();
        }
        setTimeout(Romve_xhrMsg, 2000);
    }

    function Romve_xhrMsg()
    {
    	var output;
    	if(_("outputtitle"))
    	{
    		output = _("outputtitle");
    	}
    	 
    	else
    	{
    		output = _("output");
    	}
    	while (output.hasChildNodes()) {
    		output.removeChild(output.firstChild);
    	}
    }

    function setCookie(cname, cvalue, exdays) {
    	var d = new Date();
    	d.setTime(d.getTime() + (exdays*24*60*60*1000));
    	var expires = "expires="+ d.toUTCString();
    	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

//-------------- File Uploading Events --------------
function fileValidation(){
	var fileInput = document.getElementById('file1');
	var filePath = fileInput.value;
	var allowedExtensions = /(\.wav|\.MP3|\.ogg|\.flac|\.webm|\.mpeg)$/i;
	if(!allowedExtensions.exec(filePath)){
		alert('Please upload file having extensions .wav /.mp3 /.ogg /.flac /.webm  /.mpeg only.');
		fileInput.value = '';
		return false;
	}else{
        //alert(' Great job');
    }
}

function progressHandler(event) {
    //console.log("ProgressHandler method fired");
    
    _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
    var percent = (event.loaded / event.total) * 100;
  //console.log(percent +  " Progress bar Object " + _("progressBar"));
  _("progressBar").value = Math.round(percent);
  _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {
	var s = event.target.responseText;
	//console.log(s);
	s = s.replace(/\\n/g, "\\n")  
	.replace(/\\'/g, "\\'")
	.replace(/\\"/g, '\\"')
	.replace(/\\&/g, "\\&")
	.replace(/\\r/g, "\\r")
	.replace(/\\t/g, "\\t")
	.replace(/\\b/g, "\\b")
	.replace(/\\f/g, "\\f");
            // remove non-printable and other non-valid JSON chars
            s = s.replace(/[\u0000-\u0019]+/g,""); 

            var ourData = JSON.parse(s);

            //console.log(ourData);
            renderHTML(ourData);

            _("status").innerHTML = ""; 
  //_("status").innerHTML = ourData["successMsg"];
  _("loaded_n_total").innerHTML = "";
  _("progressBar").value = 00;
  _("upload_responseDiv").style.display = "none";
  
  //console.log(" CompleteHandler status element value : " + _("status")); 
}

function errorHandler(event) { 
	_("status").innerHTML = "Upload Failed";
}

function abortHandler(event) { 
	_("status").innerHTML = "Upload Aborted";
}

function createRequestObject() {
	var http;
	if (navigator.appName == "Microsoft Internet Explorer") {
		http = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else {
		http = new XMLHttpRequest();
	}
	return http;
}

function Json_Replacable(s) {
	s = s.replace(/\\n/g, "\\n")  
	.replace(/\\'/g, "\\'")
	.replace(/\\"/g, '\\"')
	.replace(/\\&/g, "\\&")
	.replace(/\\r/g, "\\r")
	.replace(/\\t/g, "\\t")
	.replace(/\\b/g, "\\b")
	.replace(/\\f/g, "\\f");
				// remove non-printable and other non-valid JSON chars
				s = s.replace(/[\u0000-\u0019]+/g,""); 
				return s;
			}




