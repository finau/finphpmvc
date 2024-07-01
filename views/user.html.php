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
</head>
<body>
<div class="container">
    <?php
    foreach ($data as $user) : ?>
        <div class="row">
            <div><label>Username: </label> <?= $user->getUserName() ?></div>
            <div><label>Email: </label> <?= $user->getEmail() ?></div>
            <div><label>Password: </label><?= $user->getPassword() ?></div>
            <div><label>Birth Date: </label><?= $user->getBirthDate() ?></div>
            <div><label>Phone Number: </label><?= $user->getPhoneNumber() ?></div>
            <div><label>URL: </label><?= $user->getUrl() ?></div>
            <div><a href="/index.php?entity=user&action=del&uid=<?= $user->getId() ?>">Delete</a></div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>