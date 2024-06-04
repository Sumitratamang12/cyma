<?php

// Define your valid API key
$validApiKey = "12345"; // Replace with your actual API key

// Check if the API key is provided in the request headers
$apiKey = isset($_SERVER['HTTP_API_KEY']) ? $_SERVER['HTTP_API_KEY'] : null;

if ($apiKey === $validApiKey) {
    include 'config.php';
    try {
     if (isset($_GET['sub_headquarter_id'])) {
            // Get a specific user by id
            $id = $_GET['sub_headquarter_id'];
            $sql = "SELECT * FROM group_yma WHERE sub_headquarter_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
     } else{
         
        $sql = "SELECT * FROM group_yma";
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
