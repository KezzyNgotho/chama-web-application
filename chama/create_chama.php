<?php
session_start();
// Check if the user is logged in

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$servername = "sql205.infinityfree.com";
$username = "if0_34576153";
$db_password = "O2p634SC8vzOn";
$dbname = "if0_34576153_kezzy_chama";

// Create a database connection
$conn = new mysqli($servername, $username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $chamaName = $_POST["chama_name"];
    $chamaBio = $_POST["chama_bio"];
    $user_email = $_SESSION['user_email'];

    // Prepare the SQL statement to insert data into the "chama" table
    $sql = "INSERT INTO chama (name, bio, user_email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Display the error message
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters and execute the statement
    $stmt->bind_param("sss", $chamaName, $chamaBio, $user_email);
    if ($stmt->execute()) {
        // Insertion successful
        $message = "Chama created successfully";
    } else {
        // Insertion failed
        die("Error creating chama: " . $stmt->error);
    }

    // Close the prepared statement
    $stmt->close();
}


$user_email = $_SESSION['user_email'];

$query = "SELECT first_name, surname FROM accounts WHERE email = '$user_email'";
$result = $conn->query($query);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstName = $row['first_name'];
    $surname = $row['surname'];
} else {
    $firstName = 'N/A';
    $surname = 'N/A';
}

// Close the database connection
$conn->close();
?>







<!DOCTYPE html>
<html>
<head>
  <title>Chama Investment</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #1B6B93;
      padding: 10px;
    }

    .left-section {
      display: flex;
      align-items: center;
    }

    .logo img {
      width: 40px;
      height: 40px;
    }

    .org-name {
      margin-left: 10px;
      font-weight: bold;
    }

    .toggle-bar {
      margin-left: 10px;
      cursor: pointer;
    }

    .right-section {
      display: flex;
      align-items: center;
    }

    .user-profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    .user-name {
      margin-right: 10px;
      font-weight: bold;
    }

    .notification-bell {
      margin-right: 10px;
      cursor: pointer;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 185px;
      background-color: white;
      color: black;
      padding: 20px;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.hidden ~ .dashboard {
      margin-left: 0px;
    }

    .toggle-sidebar-btn {
      color: blue;
      font-size: 20px;
      cursor: pointer;
      margin-bottom: 0;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar li {
      margin-bottom: 10px;
    }

    .sidebar li a {
      color: black;
      text-decoration: none;
    }

    .sidebar .user-section {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #ddd;
    }

    .sidebar .user-section .user-profile img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .sidebar .user-section .user-name {
      font-weight: bold;
    }

    /* Add new CSS rules for the updated layout */

    .dashboard {
      flex: 1;
      padding: 20px;
      background-color: whitesmoke;
      transition: margin-left 0.3s ease-in-out;
    }

    .cards-section {
      display: grid;
      grid-template-columns: 2fr repeat(2, 1fr);
      grid-gap: 20px;
      margin-top: 20px;
    }
    .card {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
      }
    
      .card .upper-section {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
      }
    
      .card .chama-name {
        font-size: 18px;
        font-weight: bold;
        margin-left: 10px;
        margin-bottom:90px;
      
      }
    
      .card .organization-logo img {
        width: 40px;
        height: 40px;
      }
    
      .card .middle-section {
        margin-bottom: 15px;
      }
      .circular-container {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        margin-top: 80px;
        background-color: #1B6B93;
      }
      
      .circular-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        margin-top: 25px;
        margin-left: 20px;
      }
      
      .change-icon-button {
        display: inline-block;
        padding: 4px 19px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 1px;
        margin-top: 30px;
      }
      
    
      .card .chama-details input[type="text"],
      .card .chama-details textarea {
        width: 550px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 1px;
        margin-bottom: 10px;
      }
    
      .card .lower-section {
        display: flex;
        justify-content: flex-end;
      }
    
      .card .lower-section button {
        padding: 10px 110px;
        margin-left: 10px;
        border: none;
        border-radius: 5px;
        background-color: wheat;
        color: #fff;
        cursor: pointer;
      }
    
      .card .lower-section button.discard-button {
        background-color:lightskyblue;
      }
  </style>
</head>
<body>
<div class="top-bar">
  <div class="left-section">
    <div class="logo">
      <img src="img/icons8-business-64.png" alt="Logo" />
    </div>
    <div class="org-name">Chama Investment</div>
    <div class="toggle-bar"><i class="fas fa-bars toggle-sidebar-btn"></i></div>
  </div>
  <div class="right-section">
    <div class="notification-bell"><i class="far fa-bell"></i></div>
    <div class="user-profile">
      <img src="img/people.png" alt="User Profile" />
    </div>
      
    <div class="user-name"><?php echo $firstName . " " . $surname; ?></div>
  </div>
</div>

<div class="container">
  <div class="sidebar">
    <div class="user-section">
        <div class="user-profile">
          <img src="img/people.png" alt="User Profile" />
        </div>
            
        <div class="user-name"><?php echo $firstName . " " . $surname; ?></div>
      </div>
    <ul>
        <li><a href="deposit.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="get_feedback.php"><i class="fas fa-comments"></i> Feedback</a></li>
        <li class="active"><a href="get_help.php"><i class="fas fa-question-circle"></i> Get Help</a></li>
        <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
        <li><a href="#"><i class="fas fa-file-contract"></i> Terms and Conditions</a></li>
    </ul>
   
  </div>
  <div class="dashboard" id="dashboard">
    <h2>User Chamas</h2>
    <div class="cards-section">
        <div class="card">
            <div class="upper-section">
              <div class="chama-name">Chama Name</div>
              <div class="organization-logo">
                <div class="circular-container">
                  <img src="img/icons8-business-64.png" alt="Organization Logo" />
                </div>
              </div>
            </div>
            <div class="middle-section">
              <!-- Add the middle section content here -->
            </div>
            <div class="lower-section">
              <button class="change-icon-button">Change Chama Icon</button>
            </div>
          </div>
          
     
        
      <!-- Card elements -->
      <div class="card">
        <div class="upper-section">
          <div class="chama-name">Chama Details</div>
          <div class="organization-logo">
            <img src="img/icons8-business-64.png" alt="Organization Logo" />
          </div>
        </div>
        <div class="middle-section">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="chama-details">
              <input type="text" name="chama_name" placeholder="Chama Name" />
              <textarea name="chama_bio" placeholder="Chama Bio"></textarea>
            </div>
            <div class="lower-section">
              <button type="submit" class="save-button">Save</button>
              <button class="discard-button">Discard</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
  const sidebar = document.querySelector('.sidebar');
  const dashboard = document.getElementById('dashboard');

  toggleSidebarBtn.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
    dashboard.classList.toggle('sidebar-hidden');
  });
</script>
</body>
</html>