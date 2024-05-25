<?php
require_once 'config.php';

session_start();

// Если пользователь уже авторизован, отображаем его данные
if(isset($_SESSION['vk_access_token'])) {
  $user_info = json_decode(file_get_contents('https://api.vk.com/method/users.get?user_ids='.$_SESSION['vk_user_id'].'&fields=photo_max_orig&v=5.131&access_token='.$_SESSION['vk_access_token']));
  $user_info = $user_info->response[0]; 
  echo '<img src="'.$user_info->photo_max_orig.'"><br>';
  echo 'Привет, '.$user_info->first_name.' '.$user_info->last_name.'!';
  echo '<br><a href="logout.php">Выйти</a>';
} else {
  // Формируем ссылку для авторизации 
  $auth_url = "https://oauth.vk.com/authorize?client_id=".VK_APP_ID."&display=page&redirect_uri=".VK_REDIRECT_URI."&scope=friends&response_type=code&v=5.131";
  echo '<a href="'.$auth_url.'">Авторизоваться через ВКонтакте</a>';
}