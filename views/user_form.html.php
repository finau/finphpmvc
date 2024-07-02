<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->config['site_name'] ?></title>
    <link rel="stylesheet" type="text/css" href="views/css/user-form.css">
    <link rel="stylesheet" type="text/css" href="views/css/style.css">
</head>
<body>
<div class="container">
    <nav>
        <ul>
            <li><a href="index.php?action=list">User Account</a></li>
            <li class="active"><a href="index.php?action=add-form">Add User</a></li>
        </ul>
    </nav>
    <h2>Add new user</h2>
    <?php if (isset($data['status'])) : ?>
        <div class="<?= $data['status'] ?>"><?= $data['message'] ?></div>
    <?php endif ?>
    <form name="adduser" id="adduser" action="index.php">
        <div class="row">
            <label for="username">Username:</label> <input type="text" id="user_name"  name="user_name" size="30" maxlength="100" required value="<?= $data['user_name'] ?>">
        </div>

        <div class="row">
            <label for="password">Password:</label> <input type="password" id="password" name="password" size="30" maxlength="100" required value="<?= $data['password'] ?>">
        </div>

        <div class="row">
            <label for="email">Email:</label> <input type="email" id="email" name="email" size="30" maxlength="100" required value="<?= $data['email'] ?>">
        </div>

        <div class="row">
            <label for="birthdate">Birth date:</label> <input type="date" name="birth_date" id="birth_date" size="20" required value="<?= $data['birth_date'] ?>">
        </div>

        <div class="row">
            <label for="phone">Phone number:</label> <input type="tel" name="phone_number" id="phone_number" maxlength="10" size="20" required value="<?= $data['phone_number'] ?>">
        </div>
        <div class="row">
            <label for="url">URL:</label> <input type="url" id="url" name="url" size="40" maxlength="200" required value="<?= $data['url'] ?>">
        </div>
        <input type="submit" name="submit" value="Add User">

        <input type="hidden" name="action" value="add">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="views/js/user-form.js"></script>
</body>
</html>