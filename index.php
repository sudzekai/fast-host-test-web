<?php
declare(strict_types=1);

session_start();

$visits = (int) ($_SESSION['visits'] ?? 0) + 1;
$_SESSION['visits'] = $visits;

$name = trim((string) ($_POST['name'] ?? ''));
$greeting = $name !== ''
    ? 'Привет, ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '!'
    : 'Привет, гость!';

$now = (new DateTimeImmutable('now', new DateTimeZone('Europe/Moscow')))->format('d.m.Y H:i:s');
$phpVersion = PHP_VERSION;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PHP Test — FastHost</title>
<style>
  body { font-family: system-ui, sans-serif; background: #0F1420; color: #E6EAF2;
         display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 16px; box-sizing: border-box; }
  .card { background: #1A2231; border: 1px solid #293244; border-radius: 10px; padding: 32px 40px; width: 100%; max-width: 420px; }
  h1 { margin: 0 0 8px; font-size: 22px; }
  p { margin: 0 0 16px; color: #8A94A6; }
  .stats { margin: 0 0 20px; font-size: 14px; line-height: 1.8; }
  .stats span { color: #6B9BFF; }
  form { display: flex; gap: 8px; }
  input { flex: 1; min-width: 0; padding: 10px 12px; border-radius: 8px; border: 1px solid #293244;
          background: #0F1420; color: #E6EAF2; font-size: 14px; }
  input:focus { outline: none; border-color: #6B9BFF; }
  button { padding: 10px 16px; border: 0; border-radius: 8px; background: #6B9BFF; color: #0F1420;
           font-size: 14px; font-weight: 600; cursor: pointer; }
  button:hover { background: #8BB1FF; }
  code { color: #6B9BFF; }
</style>
</head>
<body>
<div class="card">
  <h1><?= $greeting ?></h1>
  <p>Страница на PHP, задеплоенная через GitHub Actions.</p>
  <div class="stats">
    Время сервера: <span><?= htmlspecialchars($now, ENT_QUOTES, 'UTF-8') ?></span><br>
    Версия PHP: <span><?= htmlspecialchars($phpVersion, ENT_QUOTES, 'UTF-8') ?></span><br>
    Просмотров в сессии: <span><?= $visits ?></span>
  </div>
  <form method="post" action="">
    <input type="text" name="name" maxlength="50" placeholder="Как вас зовут?" value="">
    <button type="submit">OK</button>
  </form>
  <p style="margin-top:16px;margin-bottom:0"><code>test.sudzekai.ru</code></p>
</div>
</body>
</html>
