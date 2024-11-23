<?php
include("connect.php");

$currentUser = 1;
$lastName = "";
$firstName ="";
$nickname = "";

$userquery ="SELECT * FROM userinfo WHERE userID = '$currentUser'";
$userresult = executeQuery($userquery);

if(mysqli_num_rows($userresult )> 0){
    while ($currentUserinfo = mysqli_fetch_assoc($userresult)) {
$lastName = $currentUserinfo["lastName"];
$firstName = $currentUserinfo["firstName"];
$nickname = $currentUserinfo["nickname"];

    }
}

if (isset($_POST['btnDelete'])) {
    $userID = $_POST['userID'];

 
    if ($userID == $currentUser) {
        $postID = $_POST['postID'];
        $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
        executeQuery($deleteQuery);
    } else {
        echo "You do not have permission to delete this post.";
    }
}




$query = "SELECT * FROM posts LEFT JOIN userinfo ON posts.userID = userinfo.userID ORDER BY posts.postID DESC;";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KRAZYNOTES.Beta 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="css/style.css" rel="stylesheet">
    <link href="img/tabicon.png" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Krona+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- As a heading -->
    <nav class="navbar bg-body-tertiary ">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><img src="img/logoicon1.png"></span>
        </div>
    </nav>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-2">

            <div class="user-info text-center p-3">
                    <div class="username">

                        <span><?php echo $nickname ?></span>
                    </div>
                    <div class="fullname">
                        <span><?php echo $firstName . " " . $lastName; ?></span>
                    </div>
                    <hr>
                </div>

                <div class="side-bar-maincontent">
                    <div class="side-content">
                        <i class="fas fa-home"></i><span class="text"> Home</span>
                    </div>
                    <div class="side-content">
                        <i class="fas fa-search"></i><span class="text"> Explore</span>
                    </div>
                    <div class="side-content">
                        <i class="fas fa-bell"></i><span class="text"> Notification</span>
                    </div>
                    <div class="side-content">
                        <i class="fas fa-envelope"></i><span class="text"> Messages</span>
                    </div>

                    <a href="post.php">
                        <div class="side-content-btn">
                            <button class="side-btn btn btn-secondary mx-auto">
                                <span class="button-text">POST</span>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="NotesTitle text-center my-4">
                    <div class="row">
                        <div class="col hover-effect">
                            FOR YOU
                        </div>
                        <div class="col divider hover-effect">
                            FOLLOWING
                        </div>
                    </div>
                </div>
                <div class="container post-container custom-scroll" style="background-color: #D9D9D9">
                    <?php while ($post = mysqli_fetch_assoc($result)) { ?>
                        <div class="card m-4 shadow">
                            <div class="top-c-contianer">
                                <div class="row">
                                    <div class="col">
                                        <div class="name-content">
                                            <?php echo $post["nickname"] ?> <br><span
                                                class="fullname"><?php echo $post["firstName"] . " " . $post["lastName"] ?></span>
                                        </div>
                                    </div>
                                    <div class="col text-end">
                                        <div class="status">
                                            <?php echo $post["privacy"] ?>
                                        </div>
                                        <!-- delete -->
                                        <form method="post">
                                            <input type="hidden" value="<?php echo $post['userID']; ?>" name="userID">
                                            <input type="hidden" value="<?php echo $post['postID'] ?>" name="postID">
                                            <button class="btn btn-danger deletebtn" name="btnDelete">Delete</button>
                                        </form>
                                        <!-- edit -->
                                        <?php if ($post['userID'] == $currentUser) { ?>
                                            <a href="editpost.php?id=<?php echo $post['postID']; ?>" name="btnEdit">
                                                <button class="btn btn-primary deletebtn">Edit</button>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="bot-c-contianer">
                                <div class="content-desc p-4">
                                    <?php echo $post["content"] ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="container-fluid my-5">
                    <footer class="text-center text-white" style="font-size:12px">
                        <div class="container">
                            <section>
                                <div class="row text-center d-flex justify-content-center pt-5">
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="#!" class="text-white">About us</a>
                                        </h6>
                                    </div>
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="#!" class="text-white">Products</a>
                                        </h6>
                                    </div>
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="#!" class="text-white">Help</a>
                                        </h6>
                                    </div>
                                    <div class="col-md-2">
                                        <h6 class="text-uppercase font-weight-bold">
                                            <a href="#!" class="text-white">Contact</a>
                                        </h6>
                                    </div>
                                </div>
                            </section>
                            <hr class="my-5" />
                            <section class="mb-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-8">
                                        <p class="disclaimer">KrazyNotes provides content for informational and
                                            entertainment purposes only. While we strive for accuracy, we cannot
                                            guarantee that all information is up-to-date or completely reliable. Use the
                                            information at your discretion, and consult professionals for specific
                                            advice.
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
        </div>
        <div class="col-1"></div>
    </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>