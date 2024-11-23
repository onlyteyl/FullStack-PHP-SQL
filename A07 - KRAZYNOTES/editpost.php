<?php

include("connect.php");

$id = $_GET['id'];


if (isset($_POST['btnEdit'])) {
    $content = $_POST['content'];
    $privacy = $_POST['privacy'];
    $editQuery = "UPDATE posts SET content='$content', privacy='$privacy' WHERE postID='$id'";
    executeQuery($editQuery);

    header('Location: index.php');
}



$query = "SELECT * FROM posts WHERE postID = '$id'";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KRAZYNOTES.Beta 2.0 | POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link href="css/post.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Krona+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link href="img/tabicon.png" rel="icon">
</head>

<body>

    <!-- NAV-BAR -->
    <nav class="navbar bg-body-tertiary ">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><img src="img/logoicon1.png"></span>
        </div>
    </nav>


    <div class="row g-0">
        <div class="col-2">
            <div class="side-bar-maincontent">
                <a href="index.php">
                    <div class="side-content">
                        <i class="fas fa-home"></i><span class="text"> Home</span>
                    </div>
                </a>
                <div class="side-content">
                    <i class="fas fa-search"></i><span class="text"> Explore</span>
                </div>
                <div class="side-content">
                    <i class="fas fa-bell"></i><span class="text"> Notification</span>
                </div>
                <div class="side-content">
                    <i class="fas fa-envelope"></i><span class="text"> Messages</span>
                </div>

                <a href="index.php">
                    <div class="side-content-btn">
                        <button class="side-btn btn btn-secondary mx-auto">
                            <span class="button-text">CANCEL POST</span>
                        </button>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-9">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="form-container">
                        <h2 class="text-center">Edit Post</h2>
                        <?php if ($post = mysqli_fetch_assoc($result)) { ?>
                            <form method="POST">
                                <div class="form-group">
                                    <textarea name="content" id="content" rows="4"
                                        required><?php echo $post['content']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="privacy">Privacy</label>
                                    <select class="form-select" style="width: fit-content; margin-bottom: 20px"
                                        name="privacy" id="privacy" required>
                                        <option value="Public" <?php echo ($post['privacy'] == 'Public') ? 'selected' : ''; ?>>Public</option>
                                        <option value="Private" <?php echo ($post['privacy'] == 'Private') ? 'selected' : ''; ?>>Private</option>
                                    </select>
                                </div>
                                <button type="submit" name="btnEdit" class="btn-submit btn">NOTES IT</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-1">

    </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>