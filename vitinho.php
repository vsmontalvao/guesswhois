<?php
    $user1data = 'https://graph.facebook.com/1703431647?fields='.urlencode('id,name,friends.fields(birthday,age_range,education,id,name)').'&access_token=BAACEdEose0cBAAeJZAc1nUwOfOoxxfe0yWa90OhiPgqZATbfUpCBpnlHqpWLtYtrDsgAwtFfouxocwhoDQMGw8XgxXJfqL34HJpfShPdZBK8SQea0uOrmNkbx2PSsyZCH1eZCMuT4vX6fqCPn67PFk20FB1DlIGfuao8yQW27ZA41xSHqRClWV7gBxPT1KdlfyYOU5eDElJV02nrcF10eeoxwuMH44VCAZD';
    $json1 = file_get_contents($user1data);

    //echo $json1;
    
    $user2data = 'https://graph.facebook.com/100002147061985?fields='.urlencode('friends').'&access_token=BAACEdEose0cBAAeJZAc1nUwOfOoxxfe0yWa90OhiPgqZATbfUpCBpnlHqpWLtYtrDsgAwtFfouxocwhoDQMGw8XgxXJfqL34HJpfShPdZBK8SQea0uOrmNkbx2PSsyZCH1eZCMuT4vX6fqCPn67PFk20FB1DlIGfuao8yQW27ZA41xSHqRClWV7gBxPT1KdlfyYOU5eDElJV02nrcF10eeoxwuMH44VCAZD';
    $json2 = file_get_contents($user2data);

    $mutual_friends = array();
    
    foreach(json_decode($json1)->friends->data as $friend1) 
        foreach(json_decode($json2)->friends->data as $friend2) 
            if ($friend1->id==$friend2->id)
            {
              array_push($mutual_friends, $friend1);
            }
    echo '</br>';
    $random_friend=$mutual_friends[rand(0,count($mutual_friends)-1)];
    echo 'amigo randomico escolhido: '.$random_friend->name.'</br>';
    echo 'age range: '.$random_friend->age_range.'</br>';    
    echo 'aniversario: '.$random_friend->birthday.'</br>';    
    //foreach($mutual_friends as $f) echo $f->name.'</br>';
    
?>
<html>
    <head>
    </head>
    <body>
        
        <script type="text/javascript">
	     /*   function blur(img) {
		        //var img2 = Pixastic.process(img, "blurfast", {amount:4.0});
		        Pixastic.process(img, "blurfast", {amount:4.0});
		        //img2.onmouseout = function() {
			    //    Pixastic.revert(this);
		        //}
	        }
	        */
	        var img = new Image();
            img.onload = function() {
   	            Pixastic.process(img, "blurfast", {amount:16.0});
            }
            document.body.appendChild(img);
            img.src = "http://www.marieclaire.com/cm/marieclaire/images/Hn/Salma-Hayek-face-wi-new-lg.jpg";
        </script>

     <!--   <img src="http://www.marieclaire.com/cm/marieclaire/images/Hn/Salma-Hayek-face-wi-new-lg.jpg" onmouseover="blur(this);"/> -->
        
        <script type="text/javascript" src="javascript/pixastic.core.js"></script>
        <script type="text/javascript" src="javascript/actions/blurfast.js"></script>
    </body>
 
</html>
 
