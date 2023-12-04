<?php

require_once("./Assets/php/header.php");

if (!isset($_SESSION['Login'])) {
    ReDirect('login.php');
}

?>

<section class="users">
    <header>
        <div class="content">
            <img src="./Assets/images/img.jpg" alt="Profile" />
            <div class="details">
                <span>Nima Malakootikhah</span>
                <p>Active now</p>
            </div>
        </div>
        <a href="#" class="logout">Logout</a>
    </header>

    <div class="search">
        <span class="txt">Select an user to chat</span>
        <input class="" type="text" placeholder="enter name to search" />
        <button class=""><i class="fas fa-search"></i></button>
    </div>

    <div class="users-list">
        <a href="#">
            <div class="content">
                <img src="./Assets/images/img.jpg" alt="Profile" />
                <div class="details">
                    <span>Fateme Malakootikhah</span>
                    <p>messages</p>
                </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
            <div class="content">
                <img src="./Assets/images/img.jpg" alt="Profile" />
                <div class="details">
                    <span>Fateme Malakootikhah</span>
                    <p>messages</p>
                </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
            <div class="content">
                <img src="./Assets/images/img.jpg" alt="Profile" />
                <div class="details">
                    <span>Fateme Malakootikhah</span>
                    <p>messages</p>
                </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
            <div class="content">
                <img src="./Assets/images/img.jpg" alt="Profile" />
                <div class="details">
                    <span>Fateme Malakootikhah</span>
                    <p>messages</p>
                </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>

        <a href="#">
            <div class="content">
                <img src="./Assets/images/img.jpg" alt="Profile" />
                <div class="details">
                    <span>Fateme Malakootikhah</span>
                    <p>messages</p>
                </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a>
    </div>
</section>

<?php require_once("./Assets/php/footer.php"); ?>