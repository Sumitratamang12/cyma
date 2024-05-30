<?php
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $conn = new mysqli('localhost', 'root', '', 'login');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("INSERT INTO register (name, phone, address, email, password) VALUES (?, ?, ?, ?, ?)");
        if($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("sssss", $name, $phone, $address, $email, $password);
        if($stmt === false) {
            die('Bind failed: ' . htmlspecialchars($stmt->error));
        }

        $stmt->execute();
        if($stmt === false) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        echo "registration success";
        $stmt->close();
        $conn->close(); 
    }
?>
