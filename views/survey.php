<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <div class="survey">
        <h1><?= $title ?></h1>
        
        <?php if (isset($msg)): ?>
            <fieldset>
                <legend>Info</legend>
                <?= $msg ?>
            </fieldset>
            <br>
        <?php endif ?>

        <form action="" method="post" accept-charset="utf-8">
            <?php foreach ($questions as $key => $value): ?>
                <label for="a_<?= $key ?>">
                    <input required type="radio" name="answer" value="<?= $value['id'] ?>" id="a_<?= $key ?>">
                    &nbsp;<?= $value['question'] ?>
                </label>
                <br>
            <?php endforeach ?>
            <br>
            <input type="submit" name="go" value="Vote">
            <br><br>
            <a href="<?= $results_link ?>">Show results</a>
        </form>
    </div>
</body>
</html>