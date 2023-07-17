<?php
session_start();

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

// Retrieve the user's email from the session
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];

    // Fetch the user's first name and surname from the database
    $query = "SELECT first_name, surname FROM accounts WHERE email = '$user_email'";
    $userResult = $conn->query($query);

    // Check if the user query was successful
    if ($userResult && $userResult->num_rows > 0) {
        $row = $userResult->fetch_assoc();
        $firstName = $row['first_name'];
        $surname = $row['surname'];
    } else {
        $firstName = 'N/A';
        $surname = 'N/A';
    }
} else {
    // Handle the case when the user email is not set in the session
    $firstName = 'N/A';
    $surname = 'N/A';
}

// Fetch chama data from the database
$chamaQuery = "SELECT * FROM chama";
$chamaResult = $conn->query($chamaQuery);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Chama Investment</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    /* Add new CSS rules for the updated layout */
    * {
      box-sizing: border-box;
    }
    
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #1B6B93;
      padding: 10px;
      color: #fff;
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

    .notification-bell {
      margin-right: 10px;
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

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 200px;
      background-color: white;
      color: black;
      padding: 20px;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.hidden {
      transform: translateX(-100%);
    }

    .toggle-sidebar-btn {
      color:white;
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
      margin-top:40;
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

    .dashboard {
      flex: 1;
      padding: 20px;
      background-color: whitesmoke;
      transition: margin-left 0.3s ease-in-out;
    }

    .cards-section {
      display: flex;
      flex-wrap: wrap;
      margin-top: 20px;
    }
   

    .card {
      background-color: white;
      width: calc(33.33% - 20px); /* Distribute cards evenly in each row with a margin of 20px */
      margin: 0 10px 20px;
      height: 200px;
      border-radius: 2px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: grid;
      grid-template-rows: auto 1fr auto;
    }

    .card .upper-section {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      margin-bottom: 10px;
      background-color: #1B6B93;
      height: 100px;
    }

    .card .upper-section .chama-name {
      font-size: 18px;
      font-weight: bold;
      margin-top: 10px;
      color: white;
    }

    .card .organization-logo img {
      margin-top: 10px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: white;
      padding: 5px;
    }

    .card .lower-section {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card .lower-section .show-details-button {
      padding: 8px 16px;
      background-color: #1B6B93;
      color: white;
      border-radius: 3px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .card .lower-section .show-details-button:hover {
      background-color: #155266;
    }
    .card1 {
  background-color: #FFFFFF;
  width: 350px;
  height: 200px;
  border-radius: 1px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: box-shadow 0.3s;
}

.card1 .upper-section {
  background-color: #1B6B93;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 110px;
}

.card1 .upper-section .chama-name {
  font-weight: bold;
  font-size: 20px;
  color: #FFFFFF;
  margin-top: 10px;
}

.card1 .organization-logo {
  display: flex;
  justify-content: center;
  align-items: center;
}

.card1 .organization-logo img {
  width: 60px;
  height: 60px;
}

.card1 .middle-section {
  padding: 20px;
}

.card1 .lower-section {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  background-color: #1B6B93;
}

.card1 .lower-section a {
  color: #FFFFFF;
  text-decoration: none;
  font-weight: bold;
  padding: 10px 20px;
  border-radius: 3px;
  transition: background-color 0.3s ease;
}

.card1 .lower-section a:hover {
  background-color: #155266;
}
footer {
        background-color: white;
        padding: 20px;
        text-align: center;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
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
      <?php
      if ($chamaResult && $chamaResult->num_rows > 0) {
          while ($row = $chamaResult->fetch_assoc()) {
              $chamaName = $row["name"];
              $chamaLogo = "img/icons8-business-64.png";

              // Display the chama card
              echo '
              <div class="card">
                <div class="upper-section">
                  <div class="chama-name">'.$chamaName.'</div>
                  <div class="organization-logo">
                    <img src="'.$chamaLogo.'" alt="Organization Logo" />
                  </div>
                </div>
                <div class="middle-section">
                  <!-- Add the middle section content here -->
                </div>
                <div class="lower-section">
                  <a href="details.php?id='.$row["id"].'" class="show-details-button">Show Details</a>
                </div>
              </div>';
          }
      } else {
          echo '<p>No chamas found.</p>';
      }
      ?>
      
      <!-- Create New Chama card -->
      <a href="create_chama.php" class="card-link">
        <div class="card1">
          <div class="upper-section">
            <div class="chama-name">Create New Chama</div>
          </div>
          <div class="middle-section">
            <div class="organization-logo">
              <img src="img/add.png" alt="Organization Logo" />
            </div>
            <!-- Add the middle section content here -->
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<footer>
        <!-- Footer content goes here -->
        <div class="footer-content">

    <div class="footer-social">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
  </div>
  <div class="footer-text">
    &copy; 2023 kezzy chama All rights reserved. | Designed by Kezzy Ngotho
  </div>
    </footer>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  <script>
    const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
    const sidebar = document.querySelector('.sidebar');

    toggleSidebarBtn.addEventListener('click', () => {
      sidebar.classList.toggle('hidden');
    });

   

  </script>
</body>
</html>
