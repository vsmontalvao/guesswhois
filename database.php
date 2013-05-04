<?php
function insertUser($uid, $uname, $db){
	$query = "INSERT INTO users( "
			."user_id, user_name, tmp, punctuation, tips, victories, loses) "
			."VALUES (".$uid.", ".$uname.", 0, 0, 0, 0, 0);";
	$result = $db->query($query);
}
function getUser($uid, $db){
	$query = "SELECT user_id, user_name, tmp, punctuation, tips, victories, loses "
			. "FROM users WHERE user_id =".$uid." ORDER BY user_id ASC, user_name ASC;";
	$result = $db->query($query);
	return $result->fetch(PDO::FETCH_ASSOC);
}
function updateUser($uid, $modifications, $db){
	$query = "UPDATE users "
			."SET ".$modifications." "
					."WHERE user_id=".$uid.";";
	$result = $db->query($query);
	return $result->fetch(PDO::FETCH_ASSOC);
}
function createMatch($p1, $p2, $answer, $opt2, $opt3, $opt4, $db){
	$query = "INSERT INTO matches( "
			."p1_id, p2_id, tmp1, tmp2, punctuation1, punctuation2, tips1, tips2, venceu, terminou1, terminou2, "
			."answer, opt2, opt3, opt4) "
			."VALUES (".$p1.", ".$p2.", 0, 0, 0, 0, 0, 0, 0, 0, 0, ".$answer.", ".$opt2.", ".$opt3.", ".$opt4.");";
	$result = $db->query($query);
	
	$query = "SELECT LASTVAL() LIMIT 1";
	$result = $db->query($query);
	return $result->fetch(PDO::FETCH_ASSOC);	
}
function getMatch($gid, $db){
	$query = "SELECT game_id, p1_id, p2_id, tmp1, tmp2, punctuation1, punctuation2, tips1, tips2, venceu, terminou1, terminou2, "
			."answer, opt2, opt3, opt4 "
			. "FROM matches WHERE game_id =".$gid.";";
	$result = $db->query($query);
	return $result->fetch(PDO::FETCH_ASSOC);
}
function updateMatch($gid, $modifications, $db){
	$query = "UPDATE matches "
			."SET ".$modifications." "
					."WHERE game_id=".$gid.";";
	$result = $db->query($query);
	return $result->fetch(PDO::FETCH_ASSOC);
}

$dsn = "pgsql:"
    . "host=ec2-54-225-84-29.compute-1.amazonaws.com;"
    . "dbname=d2jo8smkrl4dc6;"
    . "user=mpzsdtwivytwlt;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=fjHXKAxagKfu1vtbknXpCJCDeF";

$db = new PDO($dsn);

// // executa apenas quando o usuario ainda nao existe
// insertUser("3", "'Victor Montalvao'", $db);

// // identifica se o usuario ja existe
// // if(getUser("16", $db))
// 	// 	echo "Existe";

// 	// identifica se o usuario ja existe
// 	if($row = getUser($user=3, $db)){
// 			echo "<h1>".htmlspecialchars($row["victories"])."</h1>";
// 			updateUser($user, "punctuation=10, victories=".($row["victories"] +1), $db);
// 	}
?>

