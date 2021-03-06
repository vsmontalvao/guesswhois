<!DOCTYPE html>
<html>
  <head>
     <title>
        Guess who is
    </title>   
    <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Bad+Script' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" charset="utf-8" href="/stylesheets/bootstrap.css">
    <link rel="stylesheet" type="text/css" charset="utf-8" href="/stylesheets/custom.css">   
  </head>
  <body>  
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
      FB.init({
        appId      : '579790928720973', // App ID
        channelUrl : '//guesswhois/channel.html', // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });

      // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
      // for any auth related change, such as login, logout or session refresh. This means that
      // whenever someone who was previously logged out tries to log in again, the correct case below 
      // will be handled. 
      FB.Event.subscribe('auth.authResponseChange', function(response) {
        // Here we specify what we do with the response anytime this event occurs. 
        if (response.status === 'connected') {
          // The response object is returned with a status field that lets the app know the current
          // login status of the person. In this case, we're handling the situation where they 
          // have logged in to the app.
          testAPI();
        } else if (response.status === 'not_authorized') {
          // In this case, the person is logged into Facebook, but not into the app, so we call
          // FB.login() to prompt them to do so. 
          // In real-life usage, you wouldn't want to immediately prompt someone to login 
          // like this, for two reasons:
          // (1) JavaScript created popup windows are blocked by most browsers unless they 
          // result from direct user interaction (such as a mouse click)
          // (2) it is a bad experience to be continually prompted to login upon page load.
          FB.login();
        } else {
          // In this case, the person is not logged into Facebook, so we call the login() 
          // function to prompt them to do so. Note that at this stage there is no indication
          // of whether they are logged into the app. If they aren't then they'll see the Login
          // dialog right after they log in to Facebook. 
          // The same caveats as above apply to the FB.login() call here.
          FB.login();
        }
      });
      };

      // Load the SDK asynchronously
      (function(d){
       var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement('script'); js.id = id; js.async = true;
       js.src = "//connect.facebook.net/en_US/all.js";
       ref.parentNode.insertBefore(js, ref);
      }(document));

      function listFriends() {
          FB.api('/me', function(response) {
              var user_id = response.id;
              var user_name = response.name;
              FB.api('/me/friends', function(response) {
                  if(response.data) {
                      
                      $('#user_info').append("<h3>"+ user_name +"</h3><img src='http://graph.facebook.com/"+ user_id +"/picture?type=small'>");
                      $.each(response.data,function(index,friend) {
                          $('#friends_container').append("<a href='loader.php?friend_id="+friend.id+"&user_id="+user_id+"&friend_name="+encodeURIComponent(friend.name)+"&user_name="+encodeURIComponent(user_name)+"'> <div class='span3'> <img src='http://graph.facebook.com/"+ friend.id +"/picture?type=small'> "+friend.name+"  </div> </a>"); 
                          //$('#friends_list').append('<li><a href="loader.php?friend_id='+friend.id+'&user_id='+user_id+'">'+friend.name+'</a></li>');
                      });
                      
                  } else {
                      alert("Error!");
                  }
              });
          });
          
      }

      function loadBaseHTML (argument) {
        $('.container').show();
        $("#fb_login_button").hide();
      }

      // Here we run a very simple test of the Graph API after login is successful. 
      // This testAPI() function is only called in those cases. 
      function testAPI() {
        loadBaseHTML();
        listFriends();
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
          console.log('Good to see you, ' + response.name + '.');
        });

      }
    </script>
    <!--Below we include the Login Button social plugin. This button uses the JavaScript SDK to-->
    <!--present a graphical Login button that triggers the FB.login() function when clicked.-->
    <div id="fb_login_button">
        <fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
    </div>
    
    <div id="friends_list">
    </div>
    <div class="container" style="display:none">
        <div class="hero-unit">
            <div class="row">
                <div class="span3">
                    <h1 class="logo">Guess who is</h1>
                </div>
                <div class="span3">
                    <div id="user_info"></div>
                </div>
            </div>
            <div class="well friends" id="friends_container">
                
            </div>
        <div>
    </div>
  </body>
</html>
