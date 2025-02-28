<?php
session_start();
include 'db_connect.php';

// Redirect to login if not logged in
if (!isset($_SESSION['mobile_number']) || !isset($_SESSION['aadhar_number'])) {
    header("Location: 2.html");
    exit();
}

// Optionally, you can also fetch additional details from the database using the mobile number.
$mobile_number = $_SESSION['mobile_number'];

$stmt = $conn->prepare("SELECT voter_name, voter_address, date_of_birth, mobile_number, aadhar_number FROM voters WHERE mobile_number = ?");
$stmt->bind_param("s", $mobile_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $voter = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
< lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="vot.js">
  <title>Voting App</title>
  <style>
    body {  
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }
    header { 
      background: linear-gradient(#f66e05, #f0f0f0, #31840d);
      color: #fcf8f8;
      text-align: center;
      padding: 20px 0;
    }
    main {  
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    .voting-section {
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      background-image: url(https://img.freepik.com/free-vector/decorative-tricolor-indian-flag-theme-texture_1055-7757.jpg?w=740&t=st=1694520528~exp=1694521128~hmac=9c5140b10b5a0c85d9d2854fa8bba5cd221c0d622fa1c26252c0ccc4ae852ed5);
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
    }
    h1 {
      color: #57158c;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      font-size: 48px;
    }
    h2 {  
      color: #1a1919;
    }
    form {   
      margin-top: 20px;
    }
    label {  
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="date"],
    select {  
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
    input[readonly] {
      background-color: #e9ecef;
      cursor: not-allowed;
    }
    button {
      background-color: #000000;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    button:hover {
      background-color: #555;
    }
    footer {  
      text-align: center;
      background: linear-gradient(#e8700e, #fcf8f8, #169a05);
      color: #57128c;
      padding: 10px 0;
    }
  </style>
</head>
<body>
<header>
  <h1>Voting Ease &#9763;</h1>
</header>
<main>
  <section class="voting-section">
    <h2><strong><em>Vote for Your Candidate</em></strong></h2>
    <form id="vote-form" action="./5.html" method="POST">
      <label for="name">Voter's Name:</label>
      <input type="text" id="name" name="voter_name" value="<?php echo htmlspecialchars($voter['voter_name']); ?>" readonly>
      
      <label for="Address">Voter's Address:</label>
      <input type="text" id="Address" name="voter_address" value="<?php echo htmlspecialchars($voter['voter_address']); ?>" readonly>
      
      <br>
      <div>
        <label for="Dateofbirth">Voter's DOB:</label>
        <input type="date" id="Dateofbirth" name="date_of_birth" value="<?php echo htmlspecialchars($voter['date_of_birth']); ?>" readonly>
      </div>
      <br>
      <label for="Phone">Voter's Mobile Number:</label>
      <input type="text" id="Phone" name="mobile_number" value="<?php echo htmlspecialchars($voter['mobile_number']); ?>" readonly>
      
      <label for="aadhar">Voter's Aadhar card Number:</label>
      <!-- Here, we display the original Aadhaar from the session, not the hashed version from the database -->
      <input type="text" id="aadhar" name="aadhar_number" value="<?php echo htmlspecialchars($_SESSION['aadhar_number']); ?>" readonly>
      
      <label for="candidates">Select a Candidate:</label>
      <select id="candidates" name="candidate_id" required>
        <option value="">Select Candidate</option>
        <option value="1">Candidate1</option>
        <option value="2">Candidate2</option>
        <option value="3">Candidate3</option>
        <option value="4">Candidate4</option>
        <option value="5">Candidate5</option>
      </select>
      
      <button type="reset">Clear</button>
      <a href="./5.html"><button type="submit">Vote</button></a>
      
    </form>
  </section>
</main>
<footer>
  <div><span>&copy; 2023 Voting Ease</span></div>
  <span>By UP15 Coders</span>
</footer>
</body>
<?php exit(); ?>
</html>
