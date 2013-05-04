<?php
    $user_id = $_GET['user_id'];
    $friend_id = $_GET['friend_id'];
    $user_name = $_GET['user_name'];
    $friend_name = $_GET['friend_name'];


    // pega user do db. se n existir, coloca ele no db.
    // pega friend do db. se n existir, coloca ele no db.
    // faz o cõdigo de pegar as infos da match
    include 'database.php';
    insertUser($user_id, "'".$user_name."'", $db);
    insertUser($friend_id, "'".$friend_name."'", $db);
?>





<html>
<head>
    <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>     
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

    function getMatchInfo() {
        FB.api('/me/mutualfriends/<?php echo $_GET["friend_id"] ?>', function(response) {
            var friends = new Array();
            var friends_name = new Array();
            if(response.data) {
                $.each(response.data,function(index,friend) {                                       
                    friends[index]=friend.id;
                    friends_name[index]=friend.name;
                });

                var f_size = friends.length;
                var rdm_index = new Array();
                for (var i = 0; i <= 3; i++) {
                  rdm_index[i] = Math.round(f_size * Math.random());
                  //alert(rdm_index[i]);
                };

                // colocando as variaveis aleatoriamente
                var f1 = friends[rdm_index[0]];
                var f2 = friends[rdm_index[1]];
                var f3 = friends[rdm_index[2]];
                var f4 = friends[rdm_index[3]];
                var f1name = friends_name[rdm_index[0]];
                var f2name = friends_name[rdm_index[1]];
                var f3name = friends_name[rdm_index[2]];
                var f4name = friends_name[rdm_index[3]];

                $.post(
                    'insert_match.php',
                    {'user_id':parseInt(<?php echo $user_id ?>), 'friend_id':parseInt(<?php echo $friend_id ?>), 'f1':f1, 'f2':f2, 'f3':f3, 'f4':f4,
                        'f1name':encodeURIComponent(f1name), 'f2name':encodeURIComponent(f2name), 'f3name':encodeURIComponent(f3name), 'f4name':encodeURIComponent(f4name)},
                    function (response) {
                       // alert(response);
                        window.location.assign(response);
                    }
                );

            } else {
                alert('entrou no else');
            }
        });




        // FB.api('/me/friends', function(response) {
        //     if(response.data) {
        //         alert('meus amigos');
        //         var friends = new Array();
                
        //         $.each(response.data,function(index,friend) {
        //             friends[index]=friend.id;
        //         });
        //         alert(friends[0]);
        //         FB.api('/<?php //echo $_GET["friend_id"]; ?>/friends', function(response){

        //             if(response.data) {
        //                 alert('amigos do amigo');
        //                 var mutual_friends = new Array();
        //                 var i =0;
        //                 $.each(response.data,function(index,friend) {
        //                     if ($.inArray(friend.id,friends)){
        //                         mutual_friends[i]=friend.id;
        //                         i=i+1;
        //                     }
        //                 });
        //                 alert(mutual_friends[0]);

        //             } else {
        //                 alert("Error on friends of friends!");
        //             }            
        //         });  
                
        //     } else {
        //         alert("Error on friends!");
        //     }
        // });
    }


    // Here we run a very simple test of the Graph API after login is successful. 
    // This testAPI() function is only called in those cases. 
    function testAPI() {
      getMatchInfo();
      console.log('Welcome!  Fetching your information.... ');
      FB.api('/me', function(response) {
        console.log('Good to see you, ' + response.name + '.');
      });
    }
  </script>
  <!--Below we include the Login Button social plugin. This button uses the JavaScript SDK to-->
  <!--present a graphical Login button that triggers the FB.login() function when clicked.-->
  <!-- <fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button> -->
  <h1> ...Yes, we're loading. So what? </h1>
  
  
  <div id="friends_list">
  </div>
  
</body>
</html>
