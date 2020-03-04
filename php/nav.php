<?php

/*if ($_SERVER['REQUEST_URI'] == "/328/propertysearch/") {
    $textColor = "text-white";
}*/

$text = "white";
if ($_SESSION['navDark']) {
    $text = "dark";
}

echo '

<!--Main Navigation-->
<header>
      <nav class="navbar shadow-none sticky-top navbar-expand-lg scrolling-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link h5 font-weight-normal text-' . $text . '" href="#">About us</a>
        </li>
      </ul>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="navbar-brand" href="/328/propertysearch">
          <img src="./images/Logo4.png" width="60" height="60" class="d-inline-block align-top" alt="logo">
  </a>
        </li>
      </ul>
      <ul class="navbar-nav nav-flex-icons">
        <li class="nav-item">
          <a class="nav-link h5 font-weight-normal text-' . $text . '" href="login">Log in</a>
        </li>
      </ul>
    </div>
  </nav>

</header>';