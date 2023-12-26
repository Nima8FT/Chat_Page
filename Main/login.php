<?php

require_once("./Assets/php/header.php");

if (isset($_SESSION['Login'])) {
    ReDirect('user.php');
}

if (isset($_POST) && !empty($_POST)) {
    Login($_POST['email'], $_POST['pass']);
}

?>

<section class="form login">
    <header>Login</header>

    <form action="login.php" method="POST">
        <?php MSG(); ?>

        <div class="field txt">
            <label>Email</label>
            <input type="text" placeholder="Email" name="email" required />
        </div>

        <div class="field txt">
            <label>Password</label>
            <input id="pass" type="password" placeholder="Password" name="pass" required />
            <i id="eyes" class="fas fa-eye"></i>
        </div>

        <div class="field btn">
            <button type="submit">login</button>
        </div>
    </form>

    <div class="link">
        Not yet signed up? <a href="signup.php">Signup now</a>
    </div>
</section>

<?php require_once("./Assets/php/footer.php"); ?>