 <?php
   date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo
   echo "<footer>";
   echo "<p>Acesado por " . $_SERVER['REMOTE_ADDR'] . " em " . date("d/m/Y H:i:s") . "</p>";
   echo "<p>Desenvolvido por Ramon Valverde &copy; 2023</p>";
   echo "</footer>";
   $banco->close(); // Inicia um bloco PHP para fechar a conexão com o banco de dados, liberando recursos.
   ?>