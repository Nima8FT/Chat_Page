<?php

require_once("./Assets/php/header.php");

if (!isset($_SESSION['Login'])) {
    ReDirect('login.php');
}

$id = $_SESSION['Login']['id'];
?>

<section class="users">

    <?php HeadUsers($id) ?>

    <div class="search">
        <span class="txt">Select an user to chat</span>
        <input class="" type="text" placeholder="enter name to search" />
        <button class=""><i class="fas fa-search"></i></button>
    </div>

    <?php MainUsers($id) ?>

</section>

<?php require_once("./Assets/php/footer.php"); ?>