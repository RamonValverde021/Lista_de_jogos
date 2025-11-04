 <?php
  echo "<p class='p_login'>";
  if (empty($_SESSION['user'])) {
    echo "<a class='a_login' href='./user-login.php'>Login</a>";
  } else {
    echo "Olá, " . $_SESSION['nome'] . "!";
  }
  echo "</p>";
  ?>