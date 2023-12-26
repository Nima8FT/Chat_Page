<?php

require_once("./Assets/php/header.php");

if (!isset($_SESSION['Login'])) {
    ReDirect('login.php');
}

?>

<section class="users">

    <?php HeadUsers() ?>

    <div class="search">
        <span class="txt">Select an user to chat</span>
        <input class="" type="text" placeholder="enter name to search" />
        <button class=""><i class="fas fa-search"></i></button>
    </div>

    <?php MainUsers() ?>
</section>

<?php require_once("./Assets/php/footer.php"); ?>