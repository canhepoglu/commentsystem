<?php
$iceriAktar = "./ayar.php";
if (file_exists($iceriAktar)) {
  require $iceriAktar;
}


if (isset($_GET['logout'])) {
  session_destroy();
  header("Location:" . $_SERVER['HTTP_REFERER']);
  exit;
}

$meta = array(
  "baslik" => "Login",
  "aciklama" => "Açıklama",
);



if (isset($_POST['login'])) {
  if (isset($_POST["email"]) and isset($_POST["password"])) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    //to prevent from mysqli injection  
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * from members where email = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
      $_SESSION["email"] = $username;

      $_SESSION["login"] = 1;
      //debug($_SERVER);
      echo "Başarıyla giriş yaptınız.";
      header("Location:panel.php");
      exit;
    } else {
      $_SESSION['hatali'] = 'Email adresi veya şifre hatalı. Lütfen tekrar deneyiniz.';
    }
  }
}

$iceriAktar = "./source/header.php";
if (file_exists($iceriAktar)) {
  require $iceriAktar;
}
?>

<section class="vh-100">
  <div class="container py-5 h-100" style="background-color:#343a40!important">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-9">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-12 col-lg-12 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="post">
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">LOGIN</h5>
                  <?php
                  if (!empty($_SESSION['basarili'])) { ?>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong><?php
                              echo htmlentities($_SESSION['basarili']);
                              unset($_SESSION['basarili']); ?>
                      </strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div><?php
                        } ?>
                  <?php
                  if (!empty($_SESSION['hatali'])) { ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong><?php
                              echo htmlentities($_SESSION['hatali']);
                              unset($_SESSION['hatali']); ?>
                      </strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div><?php
                        } ?>
                  <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Adress" />
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" name="login" id="login" type="submit">Login</button>
                  </div>
                  <p>
                    Not yet a member? <a href="signup.php">Sign up</a>
                  </p>
                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register heresdagasdshd</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$iceriAktar = "./source/footer.php";
if (file_exists($iceriAktar)) {
  require $iceriAktar;
}
?>