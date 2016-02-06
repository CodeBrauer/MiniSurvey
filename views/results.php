<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $title ?></h1>
    
    <?php foreach ($votes as $question => $qvotes): ?>
        <meter min="0" max="<?= max($votes) ?>" value="<?= $qvotes ?>"></meter>
        <?php echo $question ?> (Votes: <?=$qvotes?>)

        <hr>
    <?php endforeach ?>
</body>
</html>