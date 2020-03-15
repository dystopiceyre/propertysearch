<?php

/*if ($_SERVER['REQUEST_URI'] == "/328/propertysearch/") {
    $textColor = "text-white";
}*/

$text = "white";
if ($_SESSION['navDark']) {
    $text = "dark";
}

$loggedin = '<a class="nav-link h5 font-weight-normal text-' . $text . '" href="login">Login</a>';
if ($_SESSION['fname']) {
    $loggedin = '
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link h5 font-weight-normal text-' . $text . ' dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Hello, ' . $_SESSION['fname'] . '</a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="nav-link h5 font-weight-normal text-dark dropdown-item" href="profile">Profile</a>
          <a class="nav-link h5 font-weight-normal text-dark dropdown-item" href="#">My saved</a>
          <a class="nav-link h5 font-weight-normal text-dark dropdown-item" href="logout">Log out</a>
        </div>
      </li>';
}

echo '

<!--Main Navigation-->
<header>
      <nav class="navbar navbar-light shadow-none sticky-top navbar-expand-lg scrolling-navbar">
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto order-1">
        <li class="nav-item">
          <a class="navbar-brand" href="/328/propertysearch">
            <img src="./images/Logo4.png" width="60" height="60" class="d-inline-block align-top" alt="logo">
          </a>
        </li>
      </ul>
      <ul class="navbar-nav mr-auto order-0">
        <li class="nav-item">
          <a class="nav-link h5 font-weight-normal text-' . $text . '" href="#">About us</a>
        </li>
      </ul>
      <ul class="navbar-nav nav-flex-icons order-2">
        <li class="nav-item">' . $loggedin . '</li>
      </ul>
    </div>
  </nav>

</header>';