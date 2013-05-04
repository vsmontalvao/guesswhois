<?php

    include 'database.php';
    $match_id = $_GET['match_id'];
    //echo "<h1>".$match_id."</h1>";
    $match = getMatch($match_id, $db);
    $player = getUser($match['p1_id'], $db);
    $opponent = getUser($match['p2_id'], $db);
    $answer = getUser($match['answer'], $db);
    $opt2= getUser($match['opt2'], $db);
    $opt3 = getUser($match['opt3'], $db);
    $opt4 = getUser($match['opt4'], $db);
    
    if($match['terminou1']==1){
        $aux = $player;
    	$player = $opponent;
        $opponent = $aux;
    }
    //dar um getMatch e verificar se eh a vez do primeiro ou do segundo player
    //setar alguma flag que diz de quem eh a vez
    //teremos uma variavel chamada $match
    $answer_pos = rand(0,3);
    
?>



<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
        <title>
            Guess who is
        </title>
        <link href='http://fonts.googleapis.com/css?family=Bad+Script' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" charset="utf-8" href="/stylesheets/bootstrap.css">
        <link rel="stylesheet" type="text/css" charset="utf-8" href="/stylesheets/custom.css">

        <meta charset="UTF-8">
    </head>
    <body>
    	<div id="fb-root"></div>
	    <script>
        var inicio;
        $(document).ready(function(){
            inicio = new Date();
        });
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
	              FB.api('/me/friends', function(response) {
	                  if(response.data) {
	                      
	                      $.each(response.data,function(index,friend) {
	                          $('#friends_container').append("<a href='loader.php?friend_id="+friend.id+"&user_id="+user_id+"'> <div class='span3'> <img src='http://graph.facebook.com/"+ friend.id +"/picture?type=small'> "+friend.name+"  </div> </a>"); 
	                          //$('#friends_list').append('<li><a href="loader.php?friend_id='+friend.id+'&user_id='+user_id+'">'+friend.name+'</a></li>');
	                      });
	                      
	                  } else {
	                      alert("Error!");
	                  }
	              });
	          });
	          
	      }
	
	      function loadMatchInfo (argument) {
	    	  FB.api('/me', function(response) {
	              var user_id = response;
	              FB.api('/me/friends', function(response) {
	                  if(response.data) {
	                    //  var chosen = response.data[<?php echo $match->answer ?>];
	                    //  var opt2 = response.data[<?php echo $match->opt2 ?>];
	                    //  var opt3 = response.data[<?php echo $match->opt3 ?>];
	                    //  var opt4 = response.data[<?php echo $match->opt4 ?>];
	                    //  var opponent = response.data[<?php echo $opponent ?>];
	                      
	                      
	                  } else {
	                      alert("Error!");
	                  }
	              });
	          });
	      }
	
	      // Here we run a very simple test of the Graph API after login is successful. 
	      // This testAPI() function is only called in those cases. 
	      function testAPI() {
	        loadMatchInfo();
	        listFriends();
	        console.log('Welcome!  Fetching your information.... ');
	        FB.api('/me', function(response) {
	          console.log('Good to see you, ' + response.name + '.');
	        });
	
	      }

            function post_tempo_usuario (match_id, acertou) {
                //alert(inicio);
                var fim = new Date();
                //alert(fim);
                tempo = Math.round((fim - inicio)/1000);
                //alert(tempo);
                $.post(
                    '/concluir_partida.php',
                    {
                        'tempo': tempo,
                        'match_id': match_id,
                        'acertou': acertou
                    },
                    function (resposta) {
                        alert(resposta);
                    }
                );
            }
            
	    </script>
    	
        <div class="container">
            <div class="hero-unit">
                <div class="row">
                    <div class="span3">
                        <h1 class="logo">Guess who is</h1>
                    </div>
                    <div class="span3">
                        <img src="http://graph.facebook.com/<?php echo $player['user_id'] ?>/picture?type=large"> <?php echo $player['user_name'] ?>>
                    </div>
                    <div class="span1">
                        X
                    </div>
                    <div class="span3">
                        <img src="http://graph.facebook.com/<?php echo $opponent['user_id']  ?>/picture?type=large"> <?php echo $opponent['user_name'] ?>
                    </div>
                </div>
                <div class="well">
                    <div class="row">
                        <div class="span2">
                            <h2 class="options">Options</h2>
                            <?php 
                            	if ($answer_pos==0)
                            	{
                            		echo '<a class="resposta" href="#">'.$answer["user_name"].'</a>';
                            	}
                            	echo '<a class="alternativa" href="#">'.$opt2["user_name"].'</a>';
								if ($answer_pos==1)
                            	{
                            		echo '<a class="resposta" href="#">'.$answer["user_name"].'</a>';
                            	}
                            	echo '<a class="alternativa" href="#">'.$opt3["user_name"].'</a>';
								if ($answer_pos==2)
                            	{
                            		echo '<a class="resposta" href="#">'.$answer["user_name"].'</a>';
                            	}	
                            	echo '<a class="alternativa" href="#">'.$opt4["user_name"].'</a>';
								if ($answer_pos==3)
                            	{
                            		echo '<a class="resposta" href="#">'.$answer["user_name"].'</a>';
                            	}
                            ?>
                        </div>
                        <div class="span4">
                            <img id="blurred_picture" src="http://graph.facebook.com/<?php echo $answer['user_id']  ?>/picture?type=large"/>
                        </div>
                        <!-- 
                        <div class="span3">
                            <ul>
                                <li>Born in 1980</li>
                                <li>Lives in São Paulo</li>
                                <li>Like Game of Thrones</li>
                                <li>Work at Facebook</li>
                            </ul>
                        </div>
                         -->
                    </div>
                </div>
            <div>
        </div>

        <script type="text/javascript" src="/js/pixastic.core.js"></script>
        <script type="text/javascript" src="/js/actions/blurfast.js"></script>

        
        <script type="text/javascript">
        $.get("http://graph.facebook.com/100000093981420/picture?type=large", {success: function (e){console.log(e)}})
            function blurPic(x){
                Pixastic.revert(document.getElementById("blurred_picture"));
                Pixastic.process(document.getElementById("blurred_picture"), "blurfast", {amount: x});
                if (x > 5){
                    setTimeout(blurPic, 2, x - 1);
                }
                //console.log(x)
            };
            $(document).ready(function (){
                blurPic(35);
            });
        function alternativa_correta() {
            post_tempo_usuario(<?php echo $match_id ?>, 1);
        }

        function alternativa_errada () {
            post_tempo_usuario(<?php echo $match_id ?>, 0);
        }
        $(document).ready(function () {
            $(".alternativa").click(function (event) {
                alternativa_errada();
                event.preventDefault();
            });

            $(".resposta").click(function (event) {
                alternativa_correta();
                event.preventDefault();
            });
        });
        </script>   
    </body>
</html>
