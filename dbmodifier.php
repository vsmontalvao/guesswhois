<?php
include 'database.php';
insertUser("1", "'Victor Montalvao'", $db);
insertUser("2", "'Victor Montalvao'", $db);
insertUser("3", "'Victor Montalvao'", $db);
insertUser("4", "'Victor Montalvao'", $db);
insertUser("5", "'Victor Montalvao'", $db);
insertUser("6", "'Victor Montalvao'", $db);
insertUser("7", "'Victor Montalvao'", $db);
insertUser("8", "'Victor Montalvao'", $db);
insertUser("9", "'Victor Montalvao'", $db);
insertUser("10", "'Victor Montalvao'", $db);
if($row = getUser($user=1, $db)){
		updateUser($user, "punctuation=10, victories=".($row["victories"] +1), $db);
}

// echo "<h1>".createMatch("8", "1", "3", "4", "5", "6", $db)["lastval"]."</h1>";

// echo "<h1>".getMatch(3, $db)["p2_id"]."</h1>";

// updateMatch(1, "venceu=1, punctuation1=200", $db);
?>