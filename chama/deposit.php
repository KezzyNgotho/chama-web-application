<?php
session_start();

// Database configurati

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

// Fetch the number of chamas from the Chama table
$query = 'SELECT COUNT(*) AS total_chamas FROM chama';
$result = $conn->query($query);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalChamas = $row['total_chamas'];
} else {
    $totalChamas = 0;
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    
  

    .dashboard {
      flex: 1;
      padding: 20px;
      background-color: whitesmoke;
      transition: margin-left 0.3s ease-in-out;
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
      margin: top 40px;
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
      padding: 20px;
    }

    .cards-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      grid-gap: 20px;
    }

    .card {
      background-color: white;
      width: 200px;
      height: 95px;
      border-radius: 1px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
    }

    .card .section1 {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #1B6B93;
    }

    .card .section1-content {
      color: white;
      font-size: 24px;
    }

    .card .section2 {
      flex: 2;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
      }


.card .section2-content {
  padding: 10px;
  font-size: 14px;
  color: #555;
}

.card .section2-content .icon {
  margin-right: 5px;
}

.card .section2-content .value {
  font-weight: bold;
}

@media screen and (max-width: 768px) {
  .container {
    flex-direction: column;
  }

  .sidebar {
    position: absolute;
    z-index: 1;
    transform: translateX(-250px);
    width: 200px;
    height: 100vh;
    overflow-y: auto;
  }

  .sidebar.hidden {
    transform: translateX(0);
  }


  .toggle-sidebar-btn {
    display: block;
  }
}
.dashboard {
  padding: 20px;
}

.cards-section {
  display: grid;
  grid-template-columns: 2fr repeat(3, 1fr);
  grid-gap: 20px;
}

.card1 {
  display: grid;
  grid-template-rows: 1fr 1fr;
  background-color:white;
  width: 350px;
  height: 220px;
  border-radius: 1px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: box-shadow 0.3s;
}

.card1 .profile-section {
  background-color: #1B6B93;
  display: flex;
  align-items: center;
 height: 110px;
}

.card1 .profile-section .user-profile img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.card1 .profile-section .user-name {
  font-weight: bold;
}

.card1 .button-section {
  display: flex;
  justify-content: space-between;
 
}

.card1 .card-button {
  flex: 1;
  background-color: white;
  border: none;
  padding: 10px;
  border-radius: 1px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: box-shadow 0.3s;
  display: inline-block;
 
  border: 1px solid #ccc;
 
  text-decoration: none;
  color: #333;
}


.card1 .button:hover {
  background-color: #f2f2f2;
}


.card1 .card-button h4 {
  margin-bottom: 5px;
  font-weight: bold;
}

.card1 .card-button p {
  color:white;
}



.card2 {
  background-color: #001C30;
  width: 220px;
  height: 95px;
  border-radius: 1px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
}

.section1 {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}

.section1-content {
  color: white;
  font-size: 24px;
}

.section2 {
  background-color: white;
  flex: 2;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 10px;
}

.section2 h3,
.section2 p {
  color: white;
  margin: 0;
}

.section2 h3 {
  font-size: 18px;
  margin-bottom: 5px;
}

.section2 p {
  font-size: 14px;
}


.card3 {
  background-color:#6554AF;
  width: 220px;
  height: 95px;
  border-radius: 1px;
  box-shadow: 0 2px 4px rgba(73, 54, 54, 0.1);
  display: flex;
}

.section1 {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}

.section1-content {
  color: white;
  font-size: 24px;
}

.section2 {
  background-color: white;
  flex: 2;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 10px;
}

.section2 h3,
.section2 p {
  color: white;
  margin: 0;
}

.section2 h3 {
  font-size: 18px;
  margin-bottom: 5px;
}

.section2 p {
  font-size: 14px;
}
/*card 4*/
.card4 {
  background-color:#FFC95F;
  width: 220px;
  height: 95px;
  border-radius: 1px;
  box-shadow: 0 2px 4px rgba(202, 191, 191, 0.1);
  display: flex;
}

.section1 {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}

.section1-content {
  color: white;
  font-size: 24px;
}

.section2 {
  background-color: white;
  flex: 2;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 10px;
}

.section2 h3,
.section2 p {
  color: white;
  margin: 0;
}

.section2 h3 {
  font-size: 18px;
  margin-bottom: 5px;
}

.section2 p {
  font-size: 14px;
}
/*card 5*/
.card5 {
background-color:#2CD3E1;
width: 220px;
height: 95px;
border-radius: 1px;
box-shadow: 0 2px 4px rgba(202, 191, 191, 0.1);
display: flex;
}

.section1 {
flex: 1;
display: flex;
align-items: center;
justify-content: center;
}

.section1-content {
color: white;
font-size: 24px;
}

.section2 {
background-color: white;
flex: 2;
display: flex;
flex-direction: column;
justify-content: center;
padding: 10px;
}

.section2 h3,
.section2 p {
color: white;
margin: 0;
}

.section2 h3 {
font-size: 18px;
margin-bottom: 5px;
}

.section2 p {
font-size: 14px;
}
/* card 6 */

.card6 {
background-color:#05BFDB;
width: 220px;
height: 95px;
border-radius: 1px;
box-shadow: 0 2px 4px rgba(202, 191, 191, 0.1);
display: flex;
}

.section1 {
flex: 1;
display: flex;
align-items: center;
justify-content: center;
}

.section1-content {
color: white;
font-size: 24px;
}

.section2 {
background-color: white;
flex: 2;
display: flex;
flex-direction: column;
justify-content: center;
padding: 10px;
}

.section2 h3,
.section2 p {
color: white;
margin: 0;
}

.section2 h3 {
font-size: 18px;
margin-bottom: 5px;
}

.section2 p {
font-size: 14px;
}
/*card7 */
.card7 {
background-color:#D864A9;
width: 220px;
height: 95px;
border-radius: 1px;
box-shadow: 0 2px 4px rgba(202, 191, 191, 0.1);
display: flex;
}

.section1 {
flex: 1;
display: flex;
align-items: center;
justify-content: center;
}

.section1-content {
color: white;
font-size: 24px;
}

.section2 {
background-color: white;
flex: 2;
display: flex;
flex-direction: column;
justify-content: center;
padding: 10px;
}

.section2 h3,
.section2 p {
color: white;
margin: 0;
}

.section2 h3 {
font-size: 18px;
margin-bottom: 5px;
}

.section2 p {
font-size: 14px;
}
.card-icons {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

.card-icons i {
  color: gray;
}

.card-content h3 {
  margin-bottom: 10px;
}

.card-content p {
  color:black;
  font-weight: bold;
  font-size: 14px;
 margin-bottom: 10px;
}
.card-content p1 {
  color:black;
  font-weight: bold;
  font-size: 14px;
 margin-bottom: 40px;
}
/* CSS code */
/* CSS code */
.total-chamas {
  font-size: 18px;
  font-weight: bold;
  color: #555;
  margin-top: 10px;
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

@media (max-width: 768px) {
  .cards-section {
    grid-template-columns: 1fr;
  }
}
/* For screens smaller than 600px */
@media (max-width: 600px) {
/* Adjust the layout for smaller screens */
.container {
grid-template-columns: 1fr;
}
}

/* For screens between 601px and 1024px */
@media (min-width: 601px) and (max-width: 1024px) {
/* Adjust the layout for medium-sized screens */
.container {
grid-template-columns: 1fr 1fr;
}
}

/* For screens larger than 1024px */
@media (min-width: 1025px) {
/* Reset the layout for larger screens */
.container {
grid-template-columns: 1fr 1fr 1fr;
}
}
  </style>
</head>
<body>
   <div class="top-bar">
    <div class="left-section">
      <div class="logo">
        <img src="img/icons8-business-64.png" alt="Organization Logo">
      </div>
      <div class="org-name">
        Kezzy Chama
      </div>
      <div class="toggle-sidebar-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
    <div class="right-section">
      <div class="user-profile">
        <img src="img/people.png" alt="User Profile">
      </div>
     
      <div class="user-name"><?php echo $firstName . " " . $surname; ?></div>
      <div class="notification-bell">
        <i class="fas fa-bell"></i>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="sidebar">
      
      <div class="user-section">
        <div class="user-profile">
          <img src="img/people.png" alt="User Profile">
        </div>
      
        <div class="user-name"><?php echo $firstName . " " . $surname; ?></div>
      </div>
      <ul>
        <li><a href="deposit.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="get_feedback.php"><i class="fas fa-comments"></i> Feedback</a></li>
        <li class="active"><a href="get_help.html"><i class="fas fa-question-circle"></i> Get Help</a></li>
        <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
        <li><a href="#"><i class="fas fa-file-contract"></i> Terms and Conditions</a></li>
      </ul>
    </div>

    <div class="dashboard" id="dashboard">
     
      <h2> Dashboard</h2>
     
    
      <!-- Cards Section -->
      <div class="cards-section">
        <!-- User Profile Card -->
        <div class="card1" style="grid-row: span 2;">
  <a href="user_profile.php">
    <div class="card-content profile-section">
      <div class="user-profile">
        <img src="img/people.png" alt="User Profile">
      </div>
    
      <div class="user-name"><?php echo $firstName . " " . $surname; ?></div>
    </div>
  </a>
  <div class="card-content button-section">
  <a class="card-button" href="chamas.php">
    <h4>Chamas</h4>
    <h4 class="total-chamas"><?php echo $totalChamas; ?></h4>
  </a>
    <a class="card-button" href="#">
      <h4>Requests</h4>
     <h4>0.0</h4>
    </a>
    <a class="card-button" href="#">
      <h4>Shares</h4>
      <h4>0.00</h4>
   
    </a>
  </div>
</div>
    
        <!-- Card 2 -->
        <div class="card2">
          <div class="card-content section1">
            <div class="card-icons">
              <img src="img/icons8-calender-64.png" alt="User Profile">
            </div>
          </div>
          <div class="card-content section2">
          
            <p>Meetings</p>
            <p1>Next:</p1>
          </div>
        </div>
        
        <!-- Card 3 -->
        <div class="card3">
          <div class="card-content section1">
            <div class="card-icons">
              <img src="img/icons8-welfare-50.png" alt="User Profile">
            </div>
          </div>
          <div class="card-content section2">
       
            <p>welfare</p>
            <p1>Next:</p1>
          </div>
        </div>
    
        <!-- Card 4 -->
        <div class="card4">
          <div class="card-content section1">
            <div class="card-icons">
              <img src="img/icons8-goals-64.png" alt="User Profile">
            </div>
          </div>
          <div class="card-content section2">
         
            <p>Goals</p>
            <p1>Next:</p1>
          </div>
        </div>
    
        <!-- Card 5 -->
        <div class="card5">
          <div class="card-content section1">
            <div class="card-icons">
              <img src="img/icons8-cubes-64.png" alt="User Profile">
            </div>
          </div>
          <div class="card-content section2">
           
            <p>Loans</p>
            <p1>Next:</p1>
          </div>
        </div>
    
        <!-- Card 6 -->
        <div class="card6">
          <div class="card-content section1">
            <div class="card-icons">
              <img src="img/icons8-cube-50.png" alt="User Profile">
            </div>
          </div>
          <div class="card-content section2">
          
            <p>soft loans</p>
            <p1>Pending:</p1>
          </div>
        </div>
    
        <!-- Card 7 -->
        <div class="card7">
          <div class="card-content section1">
            <div class="card-icons">
              <img src="img/icons8-merry-pie-50.png" alt="User Profile">
            </div>
          </div>
          <div class="card-content section2">
       
            <p>Merry go round</p>
            <p1>Next:0</p1>
          </div>
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
   
  </div>
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