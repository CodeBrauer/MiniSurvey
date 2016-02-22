
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
        <label for="title">Available surveys:</label>
        <select name="title" id="title" onchange="navigateToSurvey(this)">
            <option value="0" selected disabled>- Please choose -</option>
            <?php foreach ($list as $key => $value): ?>
                <option value="<?= $value['id'] ?>"><?= $value['title'] . ($value['answered'] ? ' » (answered @' . date('d.m.Y H:i:s', $value['answered']) . ')' : '');?></option>
            <?php endforeach ?>
        </select>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>