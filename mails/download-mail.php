<?php
session_start();

$name = $_POST['name'];
$tel = $_POST['tel'];
$email = isset($_POST['email']) ? $_POST['email'] : 'Не указан';

// Отправляем письма
mail("honey.ryazan@yandex.ru, vasilyev-r@mail.ru", "Скачивание файла с сайта медовые-подарки.рф.", "Клиент ".$name." скачал файл. Телефон: " . $tel . ", Email: " . $email);

$_SESSION['win'] = 1;
$_SESSION['recaptcha'] = '<p class="text-light">Скачивание начнется через несколько секунд.</p><p class="text-light">Спасибо, уже пошли точить для вас бочонки</p>';

header("Location: ".$_SERVER['HTTP_REFERER']);
exit;
?>