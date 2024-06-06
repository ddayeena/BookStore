<?php
// get_books.php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "book_store";

// Створюємо з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевіряємо з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, author, description, price, img_src FROM book";
$result = $conn->query($sql);

$books = array();

if ($result->num_rows > 0) {
    // Витягуємо дані з кожного рядка результату
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
} else {
    echo json_encode([]);
}

$conn->close();

echo json_encode($books);
?>
