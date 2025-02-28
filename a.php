<?php
session_start();
include 'db_connect.php';  // Connects to your MySQL database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and trim the submitted values
    $mobile = trim($_POST['mobile']);
    $aadhar_input = trim($_POST['aadhar']);  // The plain text Aadhaar entered by the user
    $password_input = trim($_POST['password']);
    
    // Check that all fields are filled
    if (empty($mobile) || empty($aadhar_input) || empty($password_input)) {
        echo "<script>alert('All fields are required!'); window.location.href='2.html';</script>";
        exit();
    }
    
    // Hash the Aadhaar and password for verification
    $hashed_aadhar = hash('sha256', $aadhar_input);
    $hashed_password = hash('sha256', $password_input);
    
    // Prepare SQL to select the voter with the given mobile and hashed Aadhaar
    $stmt = $conn->prepare("SELECT id, mobile_number, aadhar_number, password FROM voters WHERE mobile_number = ? AND aadhar_number = ?");
    $stmt->bind_param("ss", $mobile, $hashed_aadhar);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // If a user is found, verify the password
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($hashed_password === $row['password']) {
            // Login successful: Store necessary session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['mobile_number'] = $row['mobile_number'];
            // Store the original Aadhaar (plain text) in session so it can be displayed later
            $_SESSION['aadhar_number'] = $aadhar_input;
            
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='2.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='2.html';</script>";
    }
    
    $stmt->close();
}
$conn->close();
?>
