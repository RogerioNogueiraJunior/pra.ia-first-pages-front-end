<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['user'])){
        die("Você não pode acessar essa pagina porque não está logado <p><a href=\"homePage.html\">voltar para a tela inicial</a><p>");
    }
?>