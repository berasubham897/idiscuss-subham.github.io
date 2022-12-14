<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss - a coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #comm {
            min-height: 450px;
        }
    </style>
</head>

<body>
    <?php
    include 'connect.php';
    ?>
    <?php
    require 'header.php';
    ?>



    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $postedby = $row['thread_user_id'];
        $sql5 = "SELECT * FROM `login` WHERE userID =$postedby";
        $result3 = mysqli_query($conn, $sql5);
        $row3 = mysqli_fetch_assoc($result3);
        $user = $row3['name'];
        $threadTitle =  $row['thread_title'];
        $threadDecs = $row['thread_desc'];
    }
    ?>



    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    // $_SESSION['Error'] = false;
    $insertComment = false;
    if ($method == 'POST') {
        $userid = $_POST['sno'];
        $comment_description = $_POST['comment_description'];

        $comment_description = str_replace("<", "&lt;", $comment_description);
        $comment_description = str_replace(">", "&gt;", $comment_description);

        $sqlverify = "SELECT * FROM `comment`";
        $resultverify = mysqli_query($conn, $sqlverify);
        $numverify = mysqli_num_rows($resultverify);
        if ($numverify > 0) {
            while ($rowverify = mysqli_fetch_assoc($resultverify)) {
                $existcomment = $rowverify['comment_desc'];
            }
        }

        if ($comment_description != $existcomment) {
            $sql2 = "INSERT INTO `comment` ( `comment_desc`, `thread_id`, `comment_user_id`) VALUES ('$comment_description', '$id', '$userid')";
            $result2 = mysqli_query($conn, $sql2);
            $insertComment = true;
            if ($insertComment) {
                echo '
                <div class="alert alert-success alert-dismissible fade show my-0"  role="alert">
                <strong>Success ! </strong> Your comment has inserted succesfully. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    }
    ?>

    <div class="container my-5">
        <div class="col-md-12">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2><?php echo $threadTitle; ?> </h2>
                <p><?php echo $threadDecs; ?> </p>
                <h5 class="mt-4 ">Posted by - <?php echo $user; ?> </h5>
            </div>
        </div>

    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
    <div class="container my-4">
        <h2 class="my-3">Add a comment</h2>
        <form action=" ' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="mb-3">
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION["id"] . '">
                <div class="mb-3">
                    <label for="comment_description" class="form-label">Comment description</label>
                    <textarea class="form-control" id="comment_description" rows="3" name="comment_description"></textarea>
                </div>
    
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
    </div>';
    } else {
        echo '
    <div class="container my-4">
        <h2 class="my-3">Add a comment</h2>
        <p >Please login to post a comment.</p>
    </div>    
    ';
    }
    ?>

    <div class="container " id="comm">
        <h2 class="my-3">Comments</h2>
        <?php
        $sql2 = "SELECT * FROM `comment` WHERE thread_id = $id";
        $result2 = mysqli_query($conn, $sql2);
        $num = mysqli_num_rows($result2);


        if ($num == 0) {
            echo '<div class="col-md-12 mb-5">
                    <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>No Comment Found</h2>
                    <p>Be the first one to give a comment on this</p>
                    </div>
                </div>';
        } else {

            while ($row2 = mysqli_fetch_assoc($result2)) {
                $commentby = $row2['comment_user_id'];
                // echo var_dump($commentby);
                $sql5 = "SELECT * FROM `login` WHERE userID =$commentby";
                $result3 = mysqli_query($conn, $sql5);
                $row3 = mysqli_fetch_assoc($result3);

                // var_dump($row3);

                echo '
                    <div class="d-flex text-muted pt-3">
                    <img src="img/user2.png" height="52" width="52" >
                    
                    <div class="d-flex flex-column pb-3 mb-0 mx-3 small lh-sm border-bottom">
                        ' . $row2['comment_desc'] . '
                        <strong class="d-block text-gray-dark fs-5 my-1">Posted by - <b>' . $row3['name'] . '</b></strong>
                        <div>
                            ' . $row2['dt'] . ' at ' . $row2['time'] . '
                        </div>
                    </div>
                    
                    
                    </div>';
            }
        }
        ?>
    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>