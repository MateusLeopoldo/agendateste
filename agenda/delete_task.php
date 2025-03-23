<?php
if (isset($_GET['id'])) {
    $tasks = json_decode(file_get_contents('tasks.json'), true);
    unset($tasks[$_GET['id']]);
    file_put_contents('tasks.json', json_encode($tasks));
}

header('Location: index.php');
exit;
?>