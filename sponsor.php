<?php
session_start();
$_SESSION["view"] = "Home";

include('dbconnect.php');
include('navbar.php');
?>

<!doctype html>
<html lang="en">

<head>
  <title>Sponsorship</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    body {
      background-image: url('misc/campus.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    img {
      width: 150px;
      height: auto;
    }

    html {
      overflow: scroll;
      overflow-x: hidden;
    }

    ::-webkit-scrollbar {
      width: 0;
      background: transparent;
    }

    ::-webkit-scrollbar-thumb {
      background: #FF0000;
    }
  </style>
</head>

<body>
  <div class="row mt-4 d-flex justify-content-center">
    <div class="col-md-4">
      <div class="card" style="border-radius: .5rem;">
        <div class="card-body pt-2 pb-2">
          <form action="verify.php" method="POST">
            <center><img src="misc/logo.png"></center>
            <?php
            if (isset($_GET['error'])) {
              echo
              '<div class="alert mt-3 alert-danger text-center ml-5 mr-5 alert-dismissible" role="alert">'
                . $_GET["error"] .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
              session_unset();
              session_destroy();
            }
            ?>
            <div class="form-group row mt-3 pt-3">
              <label for="inputName" class="col-sm-3 col-form-label">Sponsor</label>
              <div class="col-sm-9">
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Sponsor Brand/Bank" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputAgent" class="col-sm-3 col-form-label">Agent</label>
              <div class="col-sm-9">
                <input type="text" name="agent" class="form-control" id="inputAgent" placeholder="Sponsor Agent" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputContact" class="col-sm-3 col-form-label">Contacts</label>
              <div class="col-sm-9">
                <input type="text" name="contacts" class="form-control" id="inputContact" placeholder="Separate by Comma" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter Your Email" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter Password" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputConfirm" class="col-sm-3 col-form-label">Confirm</label>
              <div class="col-sm-9">
                <input type="password" name="confirm" class="form-control" id="inputConfirm" placeholder="Confirm Password" required>
              </div>
            </div>
            <div class="form-group text-center">
              <span>Already Verified? LogIn Instead |</span>
              <a href="login.php">Log In</a>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Apply</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>