<?php
//inicializa las variables de session
session_start();
session_destroy();
//redirige a la pagina loging
header("Location: login.php");
exit;
