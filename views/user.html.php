<?php
/** @var array $data */
/** @var array $config */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->config['site_name'] ?></title>
    <link rel="stylesheet" type="text/css" href="views/css/user.css">
    <link rel="stylesheet" type="text/css" href="views/css/style.css">
</head>
<body>
<div class="container">
    <nav>
        <ul>
            <li class="active"><a href="index.php?action=list" >User Account</a></li>
            <li><a href="index.php?action=add-form">Add User</a></li>
        </ul>
    </nav>
    <h2>User Account</h2>
    <div class="row header-row">
        <div class="item">Username</div>
        <div class="item">Email</div>
        <div class="item"></div>
    </div>
    <?php
    foreach ($data as $key => $user) : ?>
        <div class="row <?= $key % 2 == 0 ? "row-color1" : "row-color2" ?>" >
            <div class="item"><a href="#" onclick="showUserInfo(<?= $user->getId() ?>)"> <?= $user->getUserName() ?></a></div>
            <div class="item"><?= $user->getEmail() ?></div>
            <div class="item"><a href="/index.php?entity=user&action=del&id=<?= $user->getId() ?>" onclick="return confirm('Are you sure, you want to delete this user?')">Delete</a></div>
        </div>
    <?php endforeach; ?>
</div>
<dialog id="dialog">
    <div id="dialog-content"></div>
    <button class="close">Close</button>
</dialog>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="views/js/user.js"></script>
</body>
</html>