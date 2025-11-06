 <?php
  echo "<p class='p_login'>";
  if (empty($_SESSION['user'])) {
    echo "<a class='a_login' href='user-login-form.php'>Login</a>";
  } else {
    echo "Olá, <strong>" . $_SESSION['nome'] . "</strong>! | ";
    echo "<a class='a_cabecalho' href='editar-usuario.php'>Meus Dados</a> | ";
    if(isAdmin()) {
      echo "<a class='a_cabecalho' href='novo-usuario.php'>Novo usuário</a> | ";
      echo "<a class='a_cabecalho' href='novo-jogo.php'>Novo jogo</a> | ";
    } 
    echo "<a class='a_cabecalho' href='user-logout.php'>Sair</a>";
    //echo "<br>( usuário do tipo ".$_SESSION['tipo']. ")";
  }
  echo "</p>";
  ?>