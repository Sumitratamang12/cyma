<?php

// Define your valid API key
$validApiKey = "12345"; // Replace with your actual API key

// Check if the API key is provided in the request headers
$apiKey = isset($_SERVER['HTTP_API_KEY']) ? $_SERVER['HTTP_API_KEY'] : null;

if ($apiKey === $validApiKey) {
    include 'config.php';
    try {
        if (isset($_GET['group_id'])) {
            // Get specific data by group_id
            $id = $_GET['group_id'];
            $sql = "SELECT * FROM branch_yma WHERE group_id = :id"; // Fixed SQL query
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Get all data
            $sql = "SELECT * FROM branch_yma";
            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(["error" => "An error occurred: " . $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Unauthorized. Invalid API key."]);
}
?>
