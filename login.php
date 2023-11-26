<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat Paege</title>
    <link rel="stylesheet" href="./style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />
  </head>
  <body>
    <div class="wrapper">
      <section class="form login">
        <header>Chat Page</header>
        <form action="#">
          <div class="error-txt">this is an error message!</div>
          <div class="field input">
            <label>Email</label>
            <input type="text" placeholder="Email" />
          </div>
          <div class="field input">
            <label>Password</label>
            <input type="password" placeholder="Password" />
            <i class="fas fa-eye"></i>
          </div>
          <div class="field button">
            <input type="submit" value="continue to chat" />
          </div>
        </form>

        <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
      </section>
    </div>
  </body>
  <script src="./javascript/pass-show-hide.js"></script>
</html>
