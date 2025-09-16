<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM news ORDER BY date DESC");
$news = [];
while($row = $result->fetch_assoc()) {
    $news[] = $row;
}
echo json_encode($news);
$conn->close();
?>
