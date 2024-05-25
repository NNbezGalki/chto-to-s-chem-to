<?php
require_once 'config.php';

session_start();

// Получаем код авторизации
$code = $_GET['code'];

// Обмениваем код на токен
$url = "https://oauth.vk.com/access_token?client_id=".VK_APP_ID."&client_secret=".VK_APP_SECRET."&redirect_uri=".VK_REDIRECT_URI."&code=".$code;
$response = json_decode(file_get_contents($url));

// Сохраняем данные сессии
$_SESSION['vk_access_token'] = $response->access_token;
$_SESSION['vk_user_id'] = $response->user_id;

// Редиректим на главную страницу
header('Location: /');