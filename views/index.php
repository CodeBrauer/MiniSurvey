<?php include '_header.php'; ?>
<div class="container">
    <h1 class="title"><?= $title ?></h1>
    <label for="title">Available surveys:</label>
    <?php if (empty($list)): ?>
        <strong>There no surveys, yet.</strong>
    <?php else: ?>
        <select name="title" id="title" onchange="navigateToSurvey(this)">
            <option value="0" selected disabled>- Please choose -</option>
            <?php foreach ($list as $key => $value): ?>
                <option value="<?= $value['id'] ?>">
                    <?= $value['title'] . ' [created by ' . $value['username'] . ']' .
                    ($value['answered'] ? ' » (answered @' . date('d.m.Y H:i:s', strtotime($value['answered'])) . ')' : ''); ?>
                </option>
            <?php endforeach ?>
        </select>
    <?php endif ?>
</div>
<?php include '_footer.php'; ?>