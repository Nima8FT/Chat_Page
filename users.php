<?php
session_start();
include_once("header.php");
if (!isset($_SESSION['unique_id'])) {
  header("Location: login.php");
}
?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <?php
        include_once("php/config.php");
        $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id= {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        }
        ?>
        <div class="content">
          <img src="php/images/<?php echo $row['img'] ?>" alt="" />
          <div class="details">
            <span>
              <?php echo $row['fname'] . " " . $row['$lname'] ?>
            </span>
            <p>
              <?php echo $row['status'] ?>
            </p>
          </div>
        </div>
        <a href="#" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="txt">Select an user to chat</span>
        <input type="text" placeholder="enter name to search" />
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
      </div>
    </section>
  </div>
</body>
<script src="./javascript/user.js"></script>

</html>