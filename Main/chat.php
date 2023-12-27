<?php

require_once("./Assets/php/header.php");

if (!isset($_SESSION['Login'])) {
    ReDirect('login.php');
}

$my_id = $_SESSION['Login']['id'];
$user_id = $_GET['id'];

?>

<section class="chat-area">

    <header>
        <?php HeadChat($user_id); ?>
    </header>

    <div class="chat-zone">
        <?php MainChat($my_id, $user_id); ?>
    </div>

    <form action="#" class="typing-area">
        <input type="text" name="outgoing_id" value="<?php echo $my_id ?>" hidden>
        <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="msg" class="txt-msg" placeholder="type a message here ...">
        <button class="send-btn"><i class="fab fa-telegram-plane"></i></button>
    </form>
</section>

<?php require_once("./Assets/php/footer.php"); ?>