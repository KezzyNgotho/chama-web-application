<!DOCTYPE html>
<html>
<head>
  <title>Chama Investment</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* Global Styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    /* Top Bar */
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: darkcyan;
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
      color: white;
      font-size: 18px;
    }

    .toggle-sidebar-btn {
      margin-left: 10px;
      cursor: pointer;
      color: white;
      font-size: 20px;
    }

    .right-section {
      display: flex;
      align-items: center;
      color: white;
    }

    .user-profile img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }

    .user-name {
      margin-right: 10px;
      font-weight: bold;
      font-size: 16px;
    }

    .notification-bell {
      margin-right: 10px;
      cursor: pointer;
      font-size: 20px;
    }

    /* Container */
    .container {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 200px;
      background-color: #f0f0f0;
      color: black;
      padding: 20px;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.hidden {
      transform: translateX(-250px);
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
      font-size: 16px;
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

    /* Dashboard */
    .dashboard {
      flex: 1;
      padding: 20px;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .feedback {
      margin-bottom: 30px;
      margin-left: 100px;
      margin-right: 100px;
    }

    .feedback h2 {
      margin-bottom: 10px;
    }

    .feedback label {
      font-weight: bold;
    }

    .feedback input[type="text"],
    .feedback input[type="email"],
    .feedback textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .feedback textarea {
      resize: vertical;
    }

    .feedback input[type="submit"] {
      padding: 10px 20px;
      background-color: #0078D4;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .feedback input[type="submit"]:hover {
      background-color: #005a9e;
    }

    .rating-stars {
      margin-bottom: 30px;
      color: #005a9e;
    }

    .rating-stars h2 {
      margin-bottom: 10px;
      font-size: 18px;
      font-weight: bold;
    }

    .stars {
      display: flex;
    }

    .stars input[type="radio"] {
      display: none;
    }

    .stars label {
      color: black;
      font-size: 24px;
      padding: 2px;
      cursor: pointer;
    }

    .stars label:hover,
    .stars label:hover ~ label,
    .stars input[type="radio"]:checked ~ label {
      color: #FFD700;
    }

    /* Footer */
    footer {
      background-color: #f0f0f0;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }
    
    /* Responsive Layout */
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

    @media (max-width: 768px) {
      .cards-section {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 600px) {
      .container {
        grid-template-columns: 1fr;
      }
    }

    @media (min-width: 601px) and (max-width: 1024px) {
      .container {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (min-width: 1025px) {
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
      <div class="user-name">
        Code Cove
      </div>
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
        <div class="user-name">Code cove</div>
      </div>
      <ul>
        <li><a href="deposit.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
  <li><a href="get_feedback.html"><i class="fas fa-comments"></i> Feedback</a></li>
  <li class="active"><a href="get_help.html"><i class="fas fa-question-circle"></i> Get Help</a></li>
  <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
  <li><a href="#"><i class="fas fa-file-contract"></i> Terms and Conditions</a></li>
      </ul>
    </div>
    <div class="dashboard">
      <div class="feedback">
        <h2>Tell us about your experience with our application</h2>
        <form>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <label for="message">Message:</label>
          <textarea id="message" name="message" required></textarea>
          <input type="submit" value="Submit">
        </form>
      </div>

      <div class="rating-stars">
        <h2>Rating Stars</h2>
        <div class="stars">
          <input type="radio" id="star5" name="rating" value="5">
          <label for="star5"></label>
          <input type="radio" id="star4" name="rating" value="4">
          <label for="star4"></label>
          <input type="radio" id="star3" name="rating" value="3">
          <label for="star3"></label>
          <input type="radio" id="star2" name="rating" value="2">
          <label for="star2"></label>
          <input type="radio" id="star1" name="rating" value="1">
          <label for="star1"></label>
        </div>
      </div>
      <footer>
        &copy; 2023 Chama Investment. All rights reserved.
      </footer>
    </div>
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
