<?php
function insertUser($uid, $uname, $db){
	$query = "INSERT INTO users( "
			."user_id, user_name, tmp, punctuation, tips, victories, loses) "
			."VALUES (".$uid.", ".$uname.", 0, 0, 0, 0, 0);";
	$result = $db->query($query);
}
function getUser($uid, $db){
	$query = "SELECT user_id, user_name, tmp, punctuation, tips, victories, loses "
		. "FROM users WHERE user_id =".$uid." ORDER BY user_id ASC, user_name ASC";
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

$dsn = "pgsql:"
    . "host=localhost;"
    . "dbname=friendpop;"
    . "user=friendpop;"
    . "port=5432;"
    . "password=123456";

$db = new PDO($dsn);
?>

<!-- <html> -->
<!--  <head> -->
<!--   <title>User</title> -->
<!--  </head> -->
<!--  <body> -->
<!--   <table> -->
<!--    <thead> -->
<!--     <tr> -->
<!--      <th>User ID</th> -->
<!--      <th>User Name</th> -->
<!--      <th>Time</th> -->
<!--      <th>Punctuation</th> -->
<!--      <th>Tips</th> -->
<!--      <th>Victories</th> -->
<!--      <th>Loses</th> -->
<!--     </tr> -->
<!--    </thead> -->
<!--    <tbody> -->
 <?php

// // $query = "SELECT user_id, user_name, tmp, punctuation, tips, victories, loses "
// //     . "FROM users ORDER BY user_id ASC, user_name ASC";
// // $result = $db->query($query);
// // while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
// //     echo "<tr>";
// //     echo "<td>" . $row["user_id"] . "</td>";
// //     echo "<td>" . htmlspecialchars($row["user_name"]) . "</td>";
// //     echo "<td>" . $row["tmp"] . "</td>";
// //     echo "<td>" . $row["punctuation"] . "</td>";
// //     echo "<td>" . $row["tips"] . "</td>";
// //     echo "<td>" . $row["victories"] . "</td>";
// //     echo "<td>" . $row["loses"] . "</td>";
// //     echo "</tr>";
// // }
// // $result->closeCursor();

// // // executa apenas quando o usuario ainda nao existe
// // insertUser("3", "'Victor Montalvao'", $db);

// // // identifica se o usuario ja existe
// // // if(getUser("16", $db))
// // // 	echo "Existe";

// // // identifica se o usuario ja existe
// // $result = $db->query($query);
// // if($row = getUser($user=3, $db)){
// // 		echo "<h1>".htmlspecialchars($row["victories"])."</h1>";
// // 		updateUser($user, "punctuation=10, victories=".($row["victories"] +1), $db);
// // }

 ?>
<!--    </tbody> -->
<!--   </table> -->
<!--  </body> -->
<!-- </html> -->