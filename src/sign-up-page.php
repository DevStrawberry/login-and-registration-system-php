<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST["username"];
    $new_email = $_POST["email"];

    $new_password_main = $_POST["create_password"];
    $new_password_confirm = $_POST["confirm_password"];

    if ($new_password_main !== $new_password_confirm) {
        echo "Erro: As senhas enviadas não coincidem. O registro não foi processado.";
        exit();
    }

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "basic-crm-system-db";

    $con = mysqli_connect($hostname, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
        exit();
    }

    $hashed_password = password_hash($new_password_main, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $new_username, $new_email, $hashed_password);

        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            echo "Novo registro criado com sucesso!";
        } else {
            echo "Erro ao inserir registro: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);

    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>