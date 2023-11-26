<?php
session_start();
if (isset($_SESSION["unique_id"])) {
  header("Location: users.php");
}
include_once("header.php");
?>

<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat Page</header>
      <form action="#" enctype="multipart/form-data">
        <div class="error-txt">this is an error message!</div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" placeholder="First Name" name="fname" required />
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" placeholder="Last Name" name="lname" required />
          </div>
        </div>
        <div class="field input">
          <label>Email</label>
          <input type="text" placeholder="Email" name="email" required />
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" placeholder="Password" name="password" required />
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="images" required />
        </div>
        <div class="field button">
          <input type="submit" value="continue to chat" />
        </div>
      </form>

      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>
</body>
<script src="./javascript/pass-show-hide.js"></script>
<script src="./javascript/signup.js"></script>

</html>