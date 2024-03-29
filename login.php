<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="author" content="Kannagara Hostel Boys" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Uok Web_programming Assignment" />
  <title>Smart Mobile Login</title>
  <link rel="icon" href="i.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
  <link rel="stylesheet" href="./jay jay.css" />
  <style>
    body {
      background-image: url("./s.jpg");
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body>
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-sm-center h-100">
        <p style="color:black;font-size:x-large;text-align:center;font-weight:bolder;" id="msg"></p>
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
          <div class="card shadow-lg">
            <div class="card-body p-5">
              <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
              <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                <div class="mb-3">
                  <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                  <input id="email" type="email" class="form-control" name="email" value="" required autofocus />
                  <div class="invalid-feedback">Email is invalid</div>
                </div>

                <div class="mb-3">
                  <div class="mb-2 w-100">
                    <label class="text-muted" for="password">Password</label>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" required />
                  <div class="invalid-feedback">Password is required</div>
                </div>

                <div class="d-flex align-items-center">
                  <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" />
                    <label for="remember" class="form-check-label">Remember Me</label>
                  </div>
                  <button type="submit" name="k" class="btn btn-primary ms-auto">
                    Login
                  </button>
                </div>
              </form>
            </div>
            <div class="card-footer py-3 border-0">
            <div class="text-center">
              Don't have an account?
              <b onclick="goreg()">Create One</b>
            </div>
          </div>
          </div>
          
        </div>
      </div>
    </div>
    </div>
  </section>

  <div id="php">
    <?php
    if (isset($_POST['k'])) {
      include 'db.php';
      //for admin
      $passcode = array();
      $u = true;
      $a = array();
      $un = array();
      $Q = "SELECT * FROM admin";
      $list = mysqli_query($db, $Q);

      if (mysqli_num_rows($list) > 0) {
        while ($data = mysqli_fetch_assoc($list)) {
          array_push($a, "$data[email]");
          array_push($passcode, "$data[pass]");
          array_push($un, "$data[name]");
        }
      } else {
        echo "zero resault found";
      }
      if (in_array($_POST['email'], $a)) {
        $u = false;
        $key = array_search($_POST['email'], $a);
        $pass = $_POST['password'];
        $enc_pass = '%^&*#@';
        $symbols = array(')', '!', '@', '#', '$', '%', '^', '&', '*', '(');
        echo $enc_pass;
        for ($i = 0; $i != strlen($pass); $i++) {
          $enc_pass .= $symbols[$pass[$i]];
        }

        if ($enc_pass == $passcode[$key])
          echo "<script>
          document.getElementById('msg').innerHTML = 'Log in Successfull  Admin Name : $un[$key] <br> pleace wait...'
          localStorage.setItem('data','$un[$key]')
          localStorage.setItem('table','admin')
          setTimeout(() =>window.location.href = 'app.php?user=$un[$key]',500);
          </script>";
        else
          echo "<script>
        document.getElementById('msg').innerHTML = 'Password is wrong...'
        </script>";
      } else {
        echo "<script>console.log('Contact the Developer..')</script>";
      }

      //for user
      if ($u) {
        $passcode = array();
        $un = array();
        $a = array();
        $Q = "SELECT * FROM user";
        $list = mysqli_query($db, $Q);

        if (mysqli_num_rows($list) > 0) {
          while ($data = mysqli_fetch_assoc($list)) {
            array_push($a, "$data[email]");
            array_push($passcode, "$data[pass]");
            array_push($un, "$data[name]");
          }
        } else {
          echo "zero resault found";
        }
        print_r($a);
        if (in_array($_POST['email'], $a)) {
          $key = array_search($_POST['email'], $a);
          $pass = $_POST['password'];
          $enc_pass = '%^&*#@';
          $symbols = array(')', '!', '@', '#', '$', '%', '^', '&', '*', '(');
          echo $enc_pass;
          for ($i = 0; $i != strlen($pass); $i++) {
            $enc_pass .= $symbols[$pass[$i]];
          }

          if ($enc_pass == $passcode[$key])
            echo "<script>
                  document.getElementById('msg').innerHTML = 'Log in Successfull  User Name : $un[$key] <br> Pleace Wait...'
                  localStorage.setItem('data','$un[$key]')
                  localStorage.setItem('table','user')
                  setTimeout(() =>window.location.href = 'app.php?user=$un[$key]',500);
                  </script>";
          else
            echo "<script>
                  document.getElementById('msg').innerHTML = 'User Password is wrong...'
                  </script>";
        } else {
          echo "<script>
          document.getElementById('msg').innerHTML = 'you are not a user create a accout first'
          </script>";
        }
        mysqli_close($db);
        echo "<script>
        setTimeout(() =>document.getElementById('msg').innerHTML = '',2000);
        </script>";
      }
    }

    ?>

    <script src="js/login.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="./Logic.js"></script>

</body>

</html>