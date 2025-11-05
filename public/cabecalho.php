 <?php
  echo "<p class='p_login'>";
  if (empty($_SESSION['user'])) {
    echo "<a class='a_login' href='user-login-form.php'>Login</a>";
  } else {
    echo "Olá, <strong>" . $_SESSION['nome'] . "</strong>!";
  }
  echo "</p>";
  ?>