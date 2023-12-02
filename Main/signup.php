<?php require_once("./Assets/php/header.php"); ?>

<section class="form signup">
    <header>Create Account</header>

    <form action="#" enctype="multipart/form-data">
        <div class="err-txt">This is an error message</div>

        <div class="field txt">
            <label>First Name</label>
            <input type="text" placeholder="First Name" name="fname" required />
        </div>

        <div class="field txt">
            <label>Last Name</label>
            <input type="text" placeholder="Last Name" name="lname" required />
        </div>

        <div class="field txt">
            <label>Email</label>
            <input type="text" placeholder="Email" name="email" required />
        </div>

        <div class="field txt">
            <label>Password</label>
            <input id="pass" type="password" placeholder="Password" name="pass" required />
            <i id="eyes" class="fas fa-eye"></i>
        </div>

        <div class="field img">
            <label>Select Image</label>
            <input type="file" name="images" required />
        </div>

        <div class="field btn">
            <button type="submit">create account</button>
        </div>
    </form>

    <div class="link">
        Already signed up? <a href="login.html">Login now</a>
    </div>
</section>

<?php require_once("./Assets/php/footer.php"); ?>