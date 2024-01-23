<?php
function clean($str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysqli_real_escape_string($str);
}
function hashAndSaltPassword($password)
{
    // Gere um salt aleatório
    $salt = random_bytes(16);

    // Combine a senha com o salt e faça o hash
    $hashed_password = password_hash($password . $salt, PASSWORD_BCRYPT);

    return array(
        'hash' => $hashed_password,
        'salt' => $salt
    );
}

function verifyPassword($user_input_password, $stored_hashed_password, $salt)
{
    // Verifique se a senha inserida pelo usuário está correta
    return password_verify($user_input_password . $salt, $stored_hashed_password);
}

// Exemplo de uso:
$plain_password = 'senha123';
$hashed_data = hashAndSaltPassword($plain_password);

// Armazene $hashed_data['hash'] e $hashed_data['salt'] no banco de dados

// Para verificar a senha posteriormente:
$is_password_correct = verifyPassword($plain_password, $stored_hashed_password, $stored_salt);
if ($is_password_correct) {
    // Senha correta
} else {
    // Senha incorreta
}
function validateEmail($email)
{
    // Valide o formato do endereço de e-mail
    $validated_email = filter_var($email, FILTER_VALIDATE_EMAIL);

    return $validated_email;
}

// Exemplo de uso:
$email = 'usuario@example.com';
$validated_email = validateEmail($email);

if ($validated_email !== false) {
    // Endereço de e-mail válido
} else {
    // Endereço de e-mail inválido
}


?>