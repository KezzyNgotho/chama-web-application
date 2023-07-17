<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Assuming you have a database connection established
// Replace the database credentials with your own
$servername = "sql205.infinityfree.com";
$username = "if0_34576153";
$password = "O2p634SC8vzOn";
$dbname = "if0_34576153_kezzy_chama";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$chamaName = $_GET['chama_name'] ?? '';

if (empty($chamaName)) {
    die("Chama name not provided.");
}

$sql = "SELECT * FROM chama WHERE name = '$chamaName'";
$result = $conn->query($sql);

if ($result === false) {
    die("Query execution failed: " . $conn->error);
}


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $chamaId = $row['chama_id'];
    /* $chamaDate = $row['date_created'];
    $chamaNumber = $row['chama_number']; */
    $chamaBio = $row['chama_bio'];

    // Count the total members based on the user email
    $user_email = $_SESSION['user_email'];
    $memberCountQuery = "SELECT COUNT(*) AS total_members FROM accounts WHERE chama_id = '$chamaId' AND email = '$user_email'";
    $memberCountResult = $conn->query($memberCountQuery);

    if ($memberCountResult === false) {
        die("Query execution failed: " . $conn->error);
    }

    if ($memberCountResult->num_rows > 0) {
        $memberCountRow = $memberCountResult->fetch_assoc();
        $memberCount = $memberCountRow['total_members'];
    } else {
        $memberCount = 0; // Default to 0 if no members found
    }
} else {
    echo "Chama not found.";
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
    .card {
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 1px;
    
      margin-bottom: 20px;
      display: inline-block;
      width: 290px;

      vertical-align: top;
    }
  
    .upper-section {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      background-color: #1B6B93;
      height: 80px;
    }
    .card1 {
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 1px;
    
      margin-bottom: 20px;
      display: inline-block;
      width: 290px;

      vertical-align: top;
    }
  
   .card1 .upper-section {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      background-color: darkcyan;
      height: 80px;
    }
    .card2 {
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 1px;
    
      margin-bottom: 20px;
      display: inline-block;
      width: 290px;

      vertical-align: top;
    }
  
   .card2 .upper-section {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      background-color: darkgreen;
      height: 40px;
    }
  
    .chama-name {
      font-size: 18px;
      font-weight: bold;
      margin-right: 10px;
      margin-left: 30px;
    }
  
    .organization-logo img {
      width: 40px;
      height: 40px;
    }
  
    .middle-section {
      margin-bottom: 10px;
    }
  
    .chama-info {
      font-size: 14px;
      margin-left: 5px;
    }
  
    .lower-section {
      text-align: center;
    }
  
    .show-details-button {
      display: inline-block;
      background-color: #4caf50;
      color: #ffffff;
      padding: 10px 20px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
    }
    
    .cards-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
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
    <div class="user-name">code cove</div>
  </div>
</div>

<div class="container">
  <div class="sidebar">
    <div class="user-section">
        <div class="user-profile">
          <img src="img/people.png" alt="User Profile" />
        </div>
        <div class="user-name">code cove</div>
      </div>
    <ul>
      <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
      <li><a href="#"><i class="fas fa-users"></i> Members</a></li>
      <li><a href="deposit.php"><i class="fas fa-tachometer-alt"></i>Home</a></li>
      <li><a href="get_feedback.php"><i class="fas fa-comments"></i> Feedback</a></li>
      <li class="active"><a href="get_help.php"><i class="fas fa-question-circle"></i> Get Help</a></li>
      <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
      <li><a href="#"><i class="fas fa-file-contract"></i> Terms and Conditions</a></li>
    </ul>
   
  </div>
  
   
  <div class="dashboard" id="dashboard">
    <h2>User Chamas</h2>
    <div class="cards-section">
      <div class="card" data-chama-id="<?php echo $chamaId; ?>">
        <div class="upper-section">
          <div class="chama-name"><?php echo $chamaName; ?></div>
          <div class="organization-logo">
            <img src="img/icons8-business-64.png" alt="Organization Logo" />
          </div>
        </div>
        <div class="middle-section">
          <div class="chama-info">
         
          </div>
        </div>
      </div>
      <div class="card1" data-chama-id="<?php echo $chamaId; ?>">
        <div class="upper-section">
          <div class="chama-name">Total Members</div>
          <div class="organization-logo">
            <img src="img/group.png" alt="Organization Logo" />
          </div>
        </div>
        <div class="middle-section">
          <div class="chama-info">
            <div class="member-count">Number of Members: <?php echo $memberCount; ?></div>
          </div>
        </div>
      </div>
      <div class="card2" data-chama-id="<?php echo $chamaId; ?>">
        <div class="upper-section">
          <div class="chama-name">Chama Bio</div>
        </div>
        <div class="middle-section">
          <div class="chama-info">
            <div class="chama-bio"><?php echo $chamaBio; ?></div>
          </div>
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
