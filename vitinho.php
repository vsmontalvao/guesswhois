<?php
    $url = 'https://graph.facebook.com/1703431647?fields='.urlencode('id,name,friends').'&access_token=CAACEdEose0cBADPfeZBHqjIwZBevVZB3vFpYnZA0WHHvsZAdnyZCZAxESsQ8zNjglERfZAn16VlvcCwxhVftVGgRp6RAt6ZAhnJbR5lopalJNBEukhHwLtKVMdFKaEUtaB3ce2W8hv0EkVwBW8VP9ad8vVyqW5Fkrr1MZD';
    $json = file_get_contents($url);
    echo $json;
//foreach(json_decode($url)->friends->data as $it) echo $it->name;
?>
