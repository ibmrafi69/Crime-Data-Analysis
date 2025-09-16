<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $division   = $_POST['division'] ?? '';
    $district   = $_POST['district'] ?? '';
    $thana      = $_POST['thana'] ?? '';
    $crime_type = $_POST['crime_type'] ?? '';
    $details    = $_POST['details'] ?? '';
    $date       = $_POST['date'] ?? '';
    $source     = $_POST['source'] ?? '';

    if ($division && $district && $thana && $crime_type && $details && $date) {
        $stmt = $conn->prepare("INSERT INTO news (division, district, thana, crime_type, details, date, source) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $division, $district, $thana, $crime_type, $details, $date, $source);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'News added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database error']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields']);
    }
}
$conn->close();
?>
