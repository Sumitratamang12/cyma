<?php

// Define your valid API key
$validApiKey = "12345"; // Replace with your actual API key

// Check if the API key is provided in the request headers
$apiKey = isset($_SERVER['HTTP_API_KEY']) ? $_SERVER['HTTP_API_KEY'] : null;

if ($apiKey === $validApiKey) {
    include 'config.php';

    try {
        if (isset($_GET['branch_id'])) {
            // Get a specific user by id
            $id = $_GET['branch_id'];
            $sql = "SELECT * FROM yma WHERE branch_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                // Convert TINYINT values to boolean
                $data["isHeadquarter"] = (bool)$data["isHeadquarter"];
                $data["isSubHeadquarter"] = (bool)$data["isSubHeadquarter"];
                $data["isBranch"] = (bool)$data["isBranch"];

                // Return the data as JSON
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                header('Content-Type: application/json');
                echo json_encode(["error" => "i zawn tum hi a awmlo"]);
            }
        } else {
            // Determine the filter based on query parameters
            $isHeadquarter = isset($_GET['isHeadquarter']) ? filter_var($_GET['isHeadquarter'], FILTER_VALIDATE_BOOLEAN) : false;
            $subHeadquarterId = isset($_GET['sub_headquarter_id']) ? $_GET['sub_headquarter_id'] : null;

            if ($isHeadquarter) {
                // Get only rows where "isHeadquarter" is true
                $sql = "SELECT * FROM yma WHERE isHeadquarter = 1";
                $stmt = $pdo->query($sql);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($subHeadquarterId !== null) {
                // Get only rows where "isSubHeadquarter" is true
                $sql = "SELECT * FROM yma WHERE sub_headquarter_id = :subHeadquarterId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':subHeadquarterId', $subHeadquarterId, PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                // Get all data
                $sql = "SELECT * FROM yma";
                $stmt = $pdo->query($sql);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            // Convert TINYINT values to boolean
            foreach ($data as &$raw) {
                $raw["isHeadquarter"] = (bool)$raw["isHeadquarter"];
                $raw["isSubHeadquarter"] = (bool)$raw["isSubHeadquarter"];
                $raw["isBranch"] = (bool)$raw["isBranch"];
            }

            // Return the data as JSON
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(["error" => "An error occurred: " . $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Unauthorized. Invalid API key."]);
}
?>
