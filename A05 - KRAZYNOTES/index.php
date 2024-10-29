<?php
include("connect.php");

$query = "SELECT * FROM posts LEFT JOIN userinfo ON posts.userID = userinfo.userID WHERE posts.userID;";
$result = executeQuery($query);


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KRAZYNOTES</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">

  
</head>

<body>

  <!-- As a heading -->
  <nav class="navbar bg-body-tertiary ">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1"><img src="img/logoicon.png"></span>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <div class="post-main-container flex-wrap d-flex justify-content-around">



          <?php while ($post = mysqli_fetch_assoc($result)) { ?>

            <div class="card-container-main">
              <div class="top-content">
                <div class="row">
                  <div class="col">
                    <div class="name-content">
                      <?php echo $post["nickname"] ?> <br> <span
                        class="fullname"><?php echo $post["firstName"] . " " . $post["lastName"] ?></span>
                    </div>
                  </div>
                  <div class="col">
                    <div class="status-container">
                      <div class="status text-end">
                        <?php echo $post["privacy"] ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="content-img-container">
                <img src="imgcontent/<?php echo $post["attachment"] ?>">
              </div>
              <div class="content-desc">
                <div class="desc">
                <?php echo $post["content"] ?>

                </div>
              </div>
            </div>
          <?php } ?>


        </div>
      </div>
      <div class="col-4">
        <div class="img-container">
          <img src="img/logoside.png">
        </div>
      </div>
    </div>
  </div>

    <!-- SECTION DIVIDER -->
    <div class="container">
    <div class="line-divider">
    </div>
  </div>

  <div class="container">
    <div class="container-fluid">
      <footer class="text-center text-black">
        <div class="container">
          <section>
            <div class="row text-center d-flex justify-content-center pt-5">
              <div class="col-md-2">
                <h6 class="text-uppercase font-weight-bold">
                  <a href="#!" class="text-black">About us</a>
                </h6>
              </div>
              <div class="col-md-2">
                <h6 class="text-uppercase font-weight-bold">
                  <a href="#!" class="text-black">Products</a>
                </h6>
              </div>
              <div class="col-md-2">
                <h6 class="text-uppercase font-weight-bold">
                  <a href="#!" class="text-black">Help</a>
                </h6>
              </div>
              <div class="col-md-2">
                <h6 class="text-uppercase font-weight-bold">
                  <a href="#!" class="text-black">Contact</a>
                </h6>
              </div>
            </div>
          </section>
          <hr class="my-5" />
          <section class="mb-5">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-8">
                <p class="disclaimer">KrazyNotes provides content for informational and entertainment purposes only. While we strive for accuracy, we cannot guarantee that all information is up-to-date or completely reliable. Use the information at your discretion, and consult professionals for specific advice.
                </p>
              </div>
            </div>
          </section>
        </div>
        <div class="text-center p-3">
          © 2024 Copyright: onlyteyl

        </div>
      </footer>
    </div>

  </div>




  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>