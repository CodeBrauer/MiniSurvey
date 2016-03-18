<?php include '_header.php'; ?>
<div class="container create">
    <h1 class="title"><?= $title ?></h1>
    <form method="post">
        <label for="title">Title<br>
            <input type="text" id="title" name="title" placeholder="Something like 'What's the color of your underwear?' ..." required>
        </label>
        <br>
        <br>
        <a href="javascript:addInput()">Add one more answer...</a>
        <br><br>
        <label for="option-1">Answers<br>
            <input type="text" id="option-1" name="option[]" placeholder="Answer 1" required>
            <div id="moreOptions"></div>
        </label>
        <input type="submit" value="Create your magic survey">
    </form>
</div>
<?php include '_footer.php'; ?>