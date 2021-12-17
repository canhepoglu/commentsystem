<?php
include_once "ayar.php";
?>
<?php
/*
$iceriAktar = "./ayar.php";
if (file_exists($iceriAktar)) {
  require $iceriAktar;
}*/

$meta = array(
  "baslik" => "Sign Up",
  "aciklama" => "Açıklama",
);


if (isset($_POST['signup'])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];

  if ($password1 != $password2) {
    exit("Passwords are not the same!");
  }

  $sql_beam = mysqli_query($conn, "SELECT * FROM members WHERE email = '$email'");
  $row = mysqli_fetch_array($sql_beam);
  if ($row[0]) {
    $_SESSION['message'] = 'Bu email adresi mevcuttur. Lütfen geçerli email adresi giriniz.';
  } else {
    $sql = "INSERT INTO `members` (`namesurname`, `email`, `password`) VALUES ('$username', '$email', '$password1')";
    $result = mysqli_query($conn, $sql);
    $_SESSION['basarili'] = 'Kaydınız başarıyla tamamlandı aşağıdaki formdan giriş yapabilirsiniz.';
    header("Location:login.php");
    exit;
  }

  /*
  if ($count == 1) {
    exit("It contains username or email.");
  }
*/
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
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">SIGN UP</h5>
                  <?php
                  if (!empty($_SESSION['message'])) { ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong><?php
                              echo htmlentities($_SESSION['message']);
                              unset($_SESSION['message']); ?>
                      </strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div><?php
                        } ?>

                  <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Name Surname" />
                  </div>
                  <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Adress" />
                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" id="password1" name="password1" class="form-control form-control-lg" placeholder="Password" />
                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" id="password2" name="password2" class="form-control form-control-lg" placeholder="Password Repeat" />
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit" id="signup" name="signup" onclick="myFunction()">Sign Up</button>
                  </div>
                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register heres</a></p>
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