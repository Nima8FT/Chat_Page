<?php require_once("./Assets/php/header.php"); ?>

<section class="form signup">
    <header>Create Account</header>

    <form action="login.php" method="POST" enctype="multipart/form-data">
        <?php MSG() ?>

        <input type="text" name="unique_id" value="1" style="display: none;">

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
            <input type="email" placeholder="Email" name="email" required />
        </div>

        <div class="field txt">
            <label>Password</label>
            <input id="pass" type="password" placeholder="Password" name="password" required />
            <i id="eyes" class="fas fa-eye"></i>
        </div>

        <div class="field img">
            <label>Select Image</label>
            <input type="file" name="images" required />
        </div>

        <div class="field txt">
            <input type="text" name="Table" value="users" style="display: none;">
            <input type="text" name="img" value="aaa" style="display: none;">
            <input type="text" name="status" value="Active" style="display: none;">
        </div>

        <div class="field btn">
            <button type="submit" name="action" value="insert">create account</button>
        </div>
    </form>

    <div class="link">
        Already signed up? <a href="login.php">Login now</a>
    </div>
</section>

<?php require_once("./Assets/php/footer.php"); ?>