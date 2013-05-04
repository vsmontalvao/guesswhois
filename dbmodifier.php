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
if($row = getUser($user=3, $db)){
		updateUser($user, "punctuation=10, victories=".($row["victories"] +1), $db);
}

// createMatch("8", "2", "3", "4", "5", "6", $db);
updateMatch("1", "venceu=2, puctuation1=100", $db);
?>