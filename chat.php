<?php
session_start();
if (!isset($_SESSION["unique_id"])) {
  header("Location: login.php");
}
include_once("header.php");
?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $user_id = $_GET['user_id'];
        include_once("php/config.php");
        $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id= {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <div class="content">
          <img src="php/images/<?php echo $row['img'] ?>" alt="" />
          <div class="details">
            <span>
              <?php echo $row['fname'] . " " . $row['lname'] ?>
            </span>
            <p>
              <?php echo $row['status'] ?>
            </p>
          </div>
        </div>
      </header>
      <div class="chat-box">
      </div>
      <form action="#" class="typing-area">
        <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
        <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" id="nima" placeholder="type a message here ...">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
</body>
<script src="./javascript/chats.js"></script>

</html>