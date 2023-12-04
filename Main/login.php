<?php require_once("./Assets/php/header.php"); ?>

<section class="form login">
    <header>Login</header>

    <form action="#">
        <div class="err-txt">This is an error message</div>

        <div class="field txt">
            <label>Email</label>
            <input type="text" placeholder="Email" name="email" />
        </div>

        <div class="field txt">
            <label>Password</label>
            <input id="pass" type="password" placeholder="Password" name="pass" />
            <i id="eyes" class="fas fa-eye"></i>
        </div>

        <div class="field btn">
            <button type="submit">login</button>
        </div>
    </form>

    <div class="link">
        Not yet signed up? <a href="signup.html">Signup now</a>
    </div>
</section>

<?php require_once("./Assets/php/footer.php"); ?>