<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss - a coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #maincontainer {
            min-height: 100vh;
        }

    </style>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <?php
    include 'connect.php';
    ?>
    <div class="container my-5 px-5" id="maincontainer">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Why iDiscuss Exists?</h2>
                <p class="lead">iDiscuss’s mission is to share and grow the programming knowledge. Not all knowledge can be written down, but much of that which can be, still isn't. It remains in people’s heads or only accessible if you know the right people. We want to connect the people who have knowledge to the people who need it, to bring together people with different perspectives so they can understand each other better, and to empower everyone to share their knowledge for the benefit of the rest of the world.</p>
            </div>
            <div class="col-md-5 dfdf">
                <img src="img/about1.jpg" alt="" height="300" width="550" class="img-fluid rounded-pill">
            </div>
        </div>

        <div class="container d-flex flex-column align-items-center mt-2 pt-5">
            <h2 class="my-3"> Don't Learn Alone</h2>
        <img src="img/about2.jpg" alt="" height="300" width="550" class="img-fluid rounded-pill">
        <p class="fs-4 my-3">Discuss your ideas, knowledge and quaries with people all around the world.</p>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>