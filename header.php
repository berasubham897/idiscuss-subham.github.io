<?php
session_start();


echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-success" href="index.php">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Catagories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/idiscuss/threadlist.php?catid=1">Python</a></li>
              <li><a class="dropdown-item" href="/idiscuss/threadlist.php?catid=2">Java</a></li>
              <li><a class="dropdown-item" href="/idiscuss/threadlist.php?catid=3">C++</a></li>
              <li><a class="dropdown-item" href="/idiscuss/threadlist.php?catid=4">React Js</a></li>
              <li><a class="dropdown-item" href="/idiscuss/threadlist.php?catid=5">Angular Js</a></li>
              <li><a class="dropdown-item" href="/idiscuss/threadlist.php?catid=6">C</a></li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '
            <form class=" d-flex" method="get" action="search.php">
            <input class="form-control me-2" name="search" type="search" actiion="search.php" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success me-2" type="submit">Search</button>

            </form>
            <p class="text-white me-2 my-0"> Welcome - <b>' . $_SESSION['username'] . '</b> </p>
            <a href="_logout.php" class="btn btn-outline-success  me-2" type="submit">Log out</a>';
} else {
  echo '
          <form class=" d-flex" method="get" action="search.php">
            <input class="form-control me-2" name="search" type="search" actiion="search.php" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success me-2" type="submit">Search</button>
            
            </form>
        <button class="btn btn-success  me-2" type="submit"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-success" type="submit"  data-bs-toggle="modal" data-bs-target="#SignupModal">Sign Up</button>';
}
echo '
      </div>
    </div>
  </nav>';

include '_signupModal.php';
include '_loginModal.php';


?>