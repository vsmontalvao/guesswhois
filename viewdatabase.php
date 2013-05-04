<html>
 <head>
  <title>User</title>
 </head>
 <body>
  <table>
   <thead>
    <tr>
     <th>User ID</th>
     <th>User Name</th>
     <th>Time</th>
     <th>Punctuation</th>
     <th>Tips</th>
     <th>Victories</th>
     <th>Loses</th>
    </tr>
   </thead>
   <tbody>
<?php
include 'database.php';

$query = "SELECT * "
    . "FROM users ORDER BY user_id ASC, user_name ASC";
$result = $db->query($query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row["user_id"] . "</td>";
    echo "<td>" . htmlspecialchars($row["user_name"]) . "</td>";
    echo "<td>" . $row["tmp"] . "</td>";
    echo "<td>" . $row["punctuation"] . "</td>";
    echo "<td>" . $row["tips"] . "</td>";
    echo "<td>" . $row["victories"] . "</td>";
    echo "<td>" . $row["loses"] . "</td>";
    echo "</tr>";
}
$result->closeCursor();
?>
   </tbody>
  </table>
  
  <table>
   <thead>
    <tr>
     <th>Game ID</th>
     <th>Player1 ID</th>
     <th>Player2 ID</th>
     <th>Time P1</th>
     <th>Time P2</th>
     <th>Punctuation P1</th>
     <th>Punctuation P2</th>
     <th>Tips P1</th>
     <th>Tips P2</th>
     <th>Victorious</th>
     <th>P1 Finished</th>
     <th>P2 Finished</th>
     <th>Answer ID</th>
     <th>Opt2 ID</th>
     <th>Opt3 ID</th>
     <th>Opt4 ID</th>
    </tr>
   </thead>
   <tbody>
<?php


$query = "SELECT * "
  ."FROM matches ORDER BY game_id ASC";
$result = $db->query($query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row["game_id"] . "</td>";
    echo "<td>" . $row["p1_id"] . "</td>";
    echo "<td>" . $row["p2_id"] . "</td>";
    echo "<td>" . $row["tmp1"] . "</td>";
    echo "<td>" . $row["tmp2"] . "</td>";
    echo "<td>" . $row["punctuation1"] . "</td>";
    echo "<td>" . $row["punctuation2"] . "</td>";
    echo "<td>" . $row["tips1"] . "</td>";
    echo "<td>" . $row["tips2"] . "</td>";
    echo "<td>" . $row["venceu"] . "</td>";
    echo "<td>" . $row["terminou1"] . "</td>";
    echo "<td>" . $row["terminou2"] . "</td>";
    echo "<td>" . $row["answer"] . "</td>";
    echo "<td>" . $row["opt2"] . "</td>";
    echo "<td>" . $row["opt3"] . "</td>";
    echo "<td>" . $row["opt4"] . "</td>";
    echo "</tr>";
}
$result->closeCursor();

?>
   </tbody>
  </table>
 </body>
</html>
