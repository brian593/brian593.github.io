window.fbAsyncInit = function() {
    FB.init({
      appId            : '819360642543487',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v15.0'
    });
  };

(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "http://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function loginCallback(response) {
    
    if (response.authResponse) {
        console.log("Authorized :)");
        
        var profilePic = new Image();
        profilePic.setAttribute('crossOrigin', 'anonymous');
        
        profilePic.src = "http://graph.facebook.com/" + response.authResponse.userID + "/picture?type=square&width=500&height=500";
        
        profilePic.onload = function() {
            canvas = document.createElement("canvas");
            canvas.width = 500;
            canvas.height = 500;
            var context = canvas.getContext("2d");
            context.drawImage(profilePic, 0, 0, profilePic.width, profilePic.height, 0, 0, canvas.width, canvas.height);
            var overlay = new Image();
            overlay.src = "../overlay.png";
            overlay.onload = function() {
                context.drawImage(overlay, 0, 0);
                var newProfPic = canvas.toDataURL();
                document.getElementById("newprofpic").src = newProfPic;
                
                $.ajax({
                    type: "POST",
                    url: "php/overlay-upload.php",
                    data: {
                        "img": newProfPic
                    },
                    success: function(url) {
                        alert(url);
                        
                        var fileNameBegin = url.lastIndexOf('/') + 1;
                        var fileNameEnd = url.lastIndexOf('.png');
                        var fileName = url.substring(fileNameBegin, fileNameEnd);
                        
                        $.ajax({
                            type: "POST",
                            url: "php/overlay-delete.php",
                            data: {
                                "img": fileName
                            },
                            success: function(response) {
                                alert(response);
                            }
                        });
                    }
                });
            }
        }
    } else {
        console.log("Not authorized :(");
    }
}

function login(){
    FB.login(loginCallback, {scope: "user_photos"});
}