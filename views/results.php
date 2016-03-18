<?php include '_header.php'; ?>    <div class="container">
    <h1 class="title"><?= $title ?></h1>

        <?php foreach ($votes as $question => $qvotes): ?>
            <meter min="0" max="<?= max($votes) ?>" value="<?= $qvotes ?>"></meter>
            [<?=$qvotes?> Vote<?= ($qvotes != 1) ? 's' : '' ?>] <?php echo $question ?>
            <hr>
        <?php endforeach ?>
    </div>
<?php include '_footer.php'; ?>