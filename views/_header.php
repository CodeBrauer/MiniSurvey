<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
    <nav>
        <?php if (!empty($_SESSION)): ?>
        <ul>
            <li><a href="#" disabled title="<?= $_SESSION['user_id'] ?>">Logged in as: <?= $_SESSION['username'] ?></a></li>
            <li><a href="/index">Home</a></li>
            <li><a href="/create">Create</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
        <?php endif ?>
    </nav>
