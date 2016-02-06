
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $title ?></h1>
    <label for="title">Available surveys:</label>
    <select name="title" id="title" onchange="navigateToSurvey(this)">
        <option value="0" selected disabled>- Please choose -</option>
        <?php foreach ($list as $key => $value): ?>
            <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
        <?php endforeach ?>
    </select>
    <script src="/assets/js/main.js"></script>
</body>
</html>