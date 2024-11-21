<?php
include("php/connection.php");

session_start();

$_SESSION['error-message'] = "";

if (isset($_POST['email']) || isset($_POST['senha'])) {

    if (strlen($_POST['email']) == 0) {
        $_SESSION['error-message'] = "Preencha o seu email";
    } else if (strlen($_POST['senha']) == 0) {
        $_SESSION['error-message'] ="Preencha a sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['user'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: CreationPage.html");
            exit;

        } else {
            $_SESSION['error-message'] = "Falha ao logar! Email ou senha incorretos";
        }
    }
}
?>