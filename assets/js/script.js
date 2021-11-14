
/*var chatBox = document.querySelector(".users-box");
var incoming_id = "";
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          //if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            
          //}
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);*/





$(document).ready(function(){ 

    if (navigator.geolocation) { 
        navigator.geolocation.getCurrentPosition(showLocation); 
    } else { 

        $('#location').html('Geolocation is not supported by this browser.'); 

    } 

}); 

function showLocation(position) { 
var latitude = position.coords.latitude; 
var longitude = position.coords.longitude; 
$.ajax({ 
type:'POST', 
url:'../inc/getLocation.php', 
data:'latitude='+latitude+'&longitude='+longitude, 
success:function(msg){ 
            if(msg){ 
               $("#location").html(msg); 
            }else{ 
                $("#location").html('Not Available'); 

            } 

} 

}); 

} 

