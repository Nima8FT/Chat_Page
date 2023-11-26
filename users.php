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
        <div class="content">
          <img src="img.jpg" alt="" />
          <div class="details">
            <span>Nima</span>
            <p>Active</p>
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
        <a href="#">
          <div class="content">
            <img src="img.jpg" alt="" />
            <div class="details">
              <span>Fateme</span>
              <p>This it test message</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
          <div class="content">
            <img src="img.jpg" alt="" />
            <div class="details">
              <span>Fateme</span>
              <p>This it test message</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
          <div class="content">
            <img src="img.jpg" alt="" />
            <div class="details">
              <span>Fateme</span>
              <p>This it test message</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
          <div class="content">
            <img src="img.jpg" alt="" />
            <div class="details">
              <span>Fateme</span>
              <p>This it test message</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
          <div class="content">
            <img src="img.jpg" alt="" />
            <div class="details">
              <span>Fateme</span>
              <p>This it test message</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
          <div class="content">
            <img src="img.jpg" alt="" />
            <div class="details">
              <span>Fateme</span>
              <p>This it test message</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
          <div class="content">
            <img src="img.jpg" alt="" />
            <div class="details">
              <span>Fateme</span>
              <p>This it test message</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>
      </div>
    </section>
  </div>
</body>
<script src="./javascript/users.js"></script>

</html>