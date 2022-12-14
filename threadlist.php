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
    include 'header.php';
    ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category` WHERE cat_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catTitle = $row['cat_title'];
        $catDes = $row['cat_description'];
    }
    ?>


    <?php
    $method = $_SERVER['REQUEST_METHOD'];

    $insert = false;
    if ($method == 'POST') {
        $userid = $_POST['sno'];
        $thread_title = $_POST['thread_title'];
        $thread_description = $_POST['thread_description'];

        $thread_description = str_replace("<", "&lt;", $thread_description);
        $thread_description = str_replace(">", "&gt;", $thread_description);

        $thread_title = str_replace("<", "&lt;", $thread_title);
        $thread_title = str_replace(">", "&gt;", $thread_title);

        $sqlverify = "SELECT * FROM `thread`";
        $resultverify = mysqli_query($conn, $sqlverify);
        $numverify = mysqli_num_rows($resultverify);
        if ($numverify > 0) {
            while ($rowverify = mysqli_fetch_assoc($resultverify)) {
                $existthread = $rowverify['thread_desc'];
                $existthreadtitle = $rowverify['thread_title'];
            }
        }
        $check = 1;

        $status = 0;

        if ($check == 1) {
            if (($thread_description == $existthread) and ($thread_title != $existthreadtitle)) {
                $status = 1;
            } elseif (($thread_description != $existthread) and ($thread_title == $existthreadtitle)) {
                $status = 1;
            } elseif (($thread_description != $existthread) and ($thread_title != $existthreadtitle)) {
                $status = 1;
            } else {
                $status = 0;
            }
        }

        if ($status == 1) {
            $sql2 = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `cat_id`,`thread_user_id`) VALUES ('$thread_title', '$thread_description', '$id','$userid')";
            $result2 = mysqli_query($conn, $sql2);
            $insert = true;
            if ($insert) {
                echo '
                <div class="alert alert-success alert-dismissible fade show my-0"  role="alert">
                <strong>Success ! </strong> Your data has inserted succesfully. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    }

    ?>


    <div class="container my-5">
        <div class="col-md-12">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>Welcome to the platform of <?php echo $catTitle ?></h2>
                <p><?php echo $catDes ?></p>

            </div>
        </div>
    </div>







    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
            <div class="container my-4">
            <h2 class="my-3">Have More Questions?</h2>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="mb-3">
                    <label for="thread_title" class="form-label">Discussion title</label>
                    <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Please Keep Your Title as Short as Possible</div>
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION["id"] . '">
                <div class="mb-3">
                    <label for="thread_description" class="form-label">Discussion description</label>
                    <textarea class="form-control" id="thread_description" rows="3" name="thread_description"></textarea>
                </div>
    
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
            ';
    } else {
        echo '
            <div class="container my-4">
            <h2 class="my-3">Have More Questions?</h2>
            <p >Please login to start a discussion.</p>
            </div>';
    }


    ?>




    <div class="container" id="comm">
        <h2 class="my-3">Browse Questions</h2>
        <?php
        $sql1 = "SELECT * FROM `thread` WHERE cat_id = $id ";
        $result1 = mysqli_query($conn, $sql1);

        $num = mysqli_num_rows($result1);
        if ($num == 0) {
            echo '<div class="col-md-12 mb-5">
                <div class="h-100 p-5 bg-light border rounded-3">
                  <h2>No Discussion Found</h2>
                  <p>Be the first one to start a discussion</p>
                </div>
              </div>';
        } 
        
        else {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $postedby = $row1['thread_user_id'];
                $sql5 = "SELECT * FROM `login` WHERE userID =$postedby";
                $result3 = mysqli_query($conn, $sql5);
                $row3 = mysqli_fetch_assoc($result3);
                
                echo '
                <div class="d-flex text-muted pt-3">
                <img src="img/user2.png" height="52" width="52" >
                    <div class="d-flex flex-column pb-3 mb-0 mx-3 small lh-sm border-bottom">
                        <a href="thread.php?threadid=' . $row1['thread_id'] . '" class="text-decoration-none"><strong class="d-block text-gray-dark">' . $row1['thread_title'] . '</strong></a>
                        ' . $row1['thread_desc'] . '
                        
                        <div class="my-2">
                        posted by -<b>' . $row3['name'] . '</b>
                        </div>
                        <div>
                            ' . $row1['dt'] . ' at ' . $row1['time'] . '
                        </div>
                    </div>
                    </div>
                
                ';
            };
        }
        ?>
        

    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>

</html>