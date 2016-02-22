<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
    <div class="container">
    <h1 class="title"><?= $title ?></h1>

        <?php foreach ($votes as $question => $qvotes): ?>
            <meter min="0" max="<?= max($votes) ?>" value="<?= $qvotes ?>"></meter>
            <?php echo $question ?> (Votes: <?=$qvotes?>)

            <hr>
        <?php endforeach ?>
    </div>
</body>
</html>