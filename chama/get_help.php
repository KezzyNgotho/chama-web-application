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
  width: 300px;
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
  padding: 10px;
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
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: box-shadow 0.3s;
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
  width: 200px;
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
  width: 200px;
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
  width: 200px;
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
width: 200px;
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
width: 200px;
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
width: 200px;
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


.help-section {
    margin-top: 0px;
    background-color:whitesmoke;
  }

  .help-section h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
  }

  .help-section p {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
  }

  .help-section ul {
    list-style: none;
    margin: 10px 0;
    padding: 0;
  }

  .help-section ul li {
    margin-bottom: 5px;
  }

  .help-section a {
    color: #007bff;
    text-decoration: none;
    display: inline-block;
    margin-right: 10px;
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
        <div class="user-name">John Doe</div>
      </div>
      <ul>
        <li><a href="deposit.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
  <li><a href="get_feedback.html"><i class="fas fa-comments"></i> Feedback</a></li>
  <li class="active"><a href="get_help.html"><i class="fas fa-question-circle"></i> Get Help</a></li>
  <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
  <li><a href="#"><i class="fas fa-file-contract"></i> Terms and Conditions</a></li>
      </ul>
    </div>

    <div class="help-section">
        <h2>Get Help</h2>
        <p>
          Welcome to the "Get Help" page. If you have any questions or need assistance,
          please feel free to contact our support team or refer to the resources below:
        </p>
        <h3>Contact Support</h3>
        <p>
          For immediate assistance, you can contact our support team via email or phone:
        </p>
        <ul>
          <li>Email: support@example.com</li>
          <li>Phone: +1 (123) 456-7890</li>
        </ul>
        <h3>Frequently Asked Questions</h3>
        <p>
          Check our frequently asked questions (FAQ) section to find answers to common queries.
        </p>
        <a href="#">View FAQs</a>
        <h3>Documentation</h3>
        <p>
          Visit our documentation section to explore in-depth guides and tutorials on how to use our services.
        </p>
        <a href="#">View Documentation</a>
        <h3>Community Forum</h3>
        <p>
          Join our community forum to discuss topics, ask questions, and connect with other users.
        </p>
        <a href="#">Go to Forum</a>
      </div>
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



