<?php
$_votes  = [];
$noVotes = [];
foreach ($votes as $value) {
    if ($value['vote'] !== NULL) {
        $_votes[] = $value['question'];
    } else {
        $noVotes[$value['question']] = 0;
    }
}

$votes = array_count_values($_votes);
arsort($votes);
$votes = $votes + $noVotes;
?>
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