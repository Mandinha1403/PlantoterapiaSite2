<?php

// Encerra a sessão

// Inicia
session_start();

// Limpa
session_unset();

// Destroi
session_destroy();

// Envia o usuário para a página de login
header('Location: index.php');
?>