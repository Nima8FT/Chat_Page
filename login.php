<?php
include_once("header.php");
?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Chat Page</header>
      <form action="#">
        <div class="error-txt">this is an error message!</div>
        <div class="field input">
          <label>Email</label>
          <input type="text" placeholder="Email" name="email" />
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" placeholder="Password" name="password" />
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="continue to chat" />
        </div>
      </form>

      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>
</body>
<script src="./javascript/pass-show-hide.js"></script>
<script src="./javascript/login.js"></script>

</html>