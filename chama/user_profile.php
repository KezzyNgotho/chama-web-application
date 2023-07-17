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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $firstName = $_POST["firstName"];
    $surname = $_POST["surname"];
    $otherNames = $_POST["otherNames"];
    $gender = $_POST["gender"];
    $email = $_SESSION["user_email"];
    $phoneNumber = $_POST["phoneNumber"];
    $idNumber = $_POST["idNumber"];
    $bio = $_POST["bio"];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO accounts (first_name, surname, other_names, gender, email, phone_number, id_number, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $firstName, $surname, $otherNames, $gender, $email, $phoneNumber, $idNumber, $bio);

    // Execute the statement
    if ($stmt->execute()) {
        $notification = "Account details saved successfully!";
    } else {
        $notification = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Fetch account details from the database
$accountDetails = [];
$sql = "SELECT * FROM accounts WHERE email = '{$_SESSION['user_email']}'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $accountDetails = $result->fetch_assoc();
}

// Close the connection
$conn->close();

// Initialize the form data with fetched account details
$firstName = isset($accountDetails["first_name"]) ? $accountDetails["first_name"] : "";
$surname = isset($accountDetails["surname"]) ? $accountDetails["surname"] : "";
$otherNames = isset($accountDetails["other_names"]) ? $accountDetails["other_names"] : "";
$gender = isset($accountDetails["gender"]) ? $accountDetails["gender"] : "";
$email = isset($accountDetails["email"]) ? $accountDetails["email"] : "";
$phoneNumber = isset($accountDetails["phone_number"]) ? $accountDetails["phone_number"] : "";
$idNumber = isset($accountDetails["id_number"]) ? $accountDetails["id_number"] : "";
$bio = isset($accountDetails["bio"]) ? $accountDetails["bio"] : "";
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Chama Investment</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <style>
      .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color:  #1B6B93;
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
        margin-top:30px;
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
        grid-template-columns: 2fr repeat(3, 1fr);
        grid-gap: 1px;
      }
      .card1 {
        background-color: white;
  
        border-radius: 1px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: grid;
        grid-template-rows: auto 1fr;
        height: 200px;
        width: 290px;
      }

      .card1 .section1 {
        display: flex;
        align-items: center;
        background-color:#1B6B93;
      }

      .card1 .section2 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        margin-top: 10px;
      }
      .card1 .section2-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-top: 10px;
        transition: background-color 0.3s ease;
      }
      
      
      .card1 .section2-content .icon {
        margin-right: 5px;
      }

      .card1 .section2-content .value {
        font-weight: bold;
      }

      .card2 {
        background-color:white;
    width :720px;
    height: 510px;
        border-radius: 3px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
        border-color: #1B6B93;
      }


      .card2 .top-bar {
        background-color: #f2f2f2;
        padding: 10px;
        display: flex;
        justify-content: space-around;
       
      }
      
      .card2 .navigation-link {
        color: #1B6B93;
        text-decoration: none;
        font-weight: bold;
        padding: 5px;
      }
      
      .card2 .navigation-link:hover {
        color: #000000;
      }
      .card2 .section2-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-top: 0;
        padding: 20px;
        background-color: white;
        border-radius: 1px;
      }
      
      .card2 .section2-content {
        display: flex;
        flex-direction: column;
        align-items: center; /* Center align the forms */
        margin-top: 0;
      
        background-color: white;
        border-radius: 1px;
      }
      
      .card2 .form-fields-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center; /* Center align the form fields */
       
        margin-right: 50px;
        width: 700px; /* Increase the width of the form fields container */
      }
      
      .card2 .form-row {
        display: flex;
        flex-basis: 100%;
        padding: 10px;
      }
      
      .card2 .form-field {
        flex-grow: 1;
      
        margin-left: 5px;
      }
      
      .card2 .form-field label {
        display: block;
        margin-bottom: 5px;
      }
      
      .card2 .form-field input,
      .card2 .form-field select,
      .card2 .form-field textarea {
        width: 330px; /* Increase the width of the form fields */
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 1px;
      
      }
      
      .card2 .form-actions {
       
        display: flex;
        justify-content:centre;
        margin-top: 10px;
        
        
      
      }
      
      .card2 .form-actions button {
        margin-left: 30px;
        width:320px;
        padding:10px;
      }
      
      

      .card1 .user-profile img {
        width: 80px;
        height: 80px;
        border-radius: 1px;
      }

      .card1 .user-name {
        font-size: 18px;
        font-weight: bold;
      }

      .card1 .member-number {
        margin-top: 10px;
        margin-left: 19px;
        font-size: 14px;
        color: black;

        font-weight: 900;
      }

      .section2 {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
      }

      .section2-content {
        display: flex;
        align-items: center;
        margin-left: 10px;
        transition: background-color 0.3s ease;
      }

      
      .section2-content .value {
        font-weight: 900;
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

     

      .section2-content {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
      }
      footer {
        background-color: white;
        padding: 10px;
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
          <img src="img/icons8-business-64.png" alt="Organization Logo" />
        </div>
        <div class="org-name">Kezzy Chama</div>
        <div class="toggle-sidebar-btn">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="right-section">
        <div class="user-profile">
          <img src="img/people.png" alt="User Profile" />
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
        <h2>User Profile</h2>

        <!-- Cards Section -->
        <div class="cards-section">
          <!-- Card 1: User Profile -->
          <div class="card1">
            <div class="section1">
              <!-- Profile name and member number -->
              <div class="user-profile">
                <img src="img/people.png" alt="User Profile" />
                <div class="user-name"><?php echo $firstName . " " . $surname; ?></div>
              </div>
              <div class="member-number">Member Number: 123456</div>
            </div>
            <div class="section2">
              <div class="section2-content">
                <div class="value">Chamas: 5</div>
              </div>
              <div class="section2-content">
                <div class="value">Messages: 10</div>
              </div>
            </div>
          </div>

        <!-- Card 2: Account Credentials -->
<div class="card2">
  <div class="top-bar">
    <a class="user_profile.php" href="user_profile.php">Account</a>
    <a class="credentials.php" href="credentials.php">Credentials</a>
    <a class="navigation-link" href="timeline.php">Timeline</a>
  </div>
  <div class="section1">
    <div class="section1-content">
     
    </div>
  </div>
  <div class="section2">
        <div class="section2-content">
          <h3 id="account">Account Details</h3>
          <div class="form-fields-container">
            <!-- Add the form submission action and method -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="form-row">
                <div class="form-field">
                  <label for="firstName">First Name</label>
                  <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
                </div>
                <div class="form-field">
                  <label for="surname">Surname</label>
                  <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-field">
                  <label for="otherNames">Other Names</label>
                  <input type="text" id="otherNames" name="otherNames" value="<?php echo $otherNames; ?>">
                </div>
                <div class="form-field">
                  <label for="gender">Gender</label>
                  <select id="gender" name="gender">
                    <option value="male" <?php echo ($gender === "male") ? "selected" : ""; ?>>Male</option>
                    <option value="female" <?php echo ($gender === "female") ? "selected" : ""; ?>>Female</option>
                    <option value="other" <?php echo ($gender === "other") ? "selected" : ""; ?>>Other</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-field">
                  <label for="email">Email Address</label>
                  <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-field">
                  <label for="phoneNumber">Phone Number</label>
                  <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-field">
                  <label for="idNumber">ID Number</label>
                  <input type="text" id="idNumber" name="idNumber" value="<?php echo $idNumber; ?>">
                </div>
                <div class="form-field">
                  <label for="bio">Bio</label>
                  <textarea id="bio" name="bio"><?php echo $bio; ?></textarea>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit">Save</button>
                <button type="button">Discard</button>
              </div>
            </form>
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

    <!-- Display the success notification if applicable -->
   
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
      const toggleSidebarBtn = document.querySelector(".toggle-sidebar-btn");
      const sidebar = document.querySelector(".sidebar");

      toggleSidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("hidden");
      });
      <?php if (isset($notification)): ?>
        alert("<?php echo $notification; ?>");
      <?php endif; ?>
      
    </script>
  </body>
</html>
