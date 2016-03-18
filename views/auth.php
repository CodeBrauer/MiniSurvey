<?php include '_header.php'; ?>
    <div class="container login">
        <h1 class="title"><?= $title ?></h1>
        <?php if (isset($msg)): ?>
            <fieldset class="auth-<?= (int)$msg[0] ?>">
                <legend><?= ($msg[0]) ? "Success" : "Fail" ?></legend>
                <?= $msg[1] ?>
            </fieldset>
        <?php endif ?>
        <div class="s50">
            <h2>Login</h2>
            <form action="" method="post">
                <input type="hidden" name="form" value="login">
                <input type="text" name="username" id="username" placeholder="username" tabindex="1">
                <br>
                <input type="password" name="password" id="password" placeholder="password" tabindex="2">
                <br><br>
                <input type="submit" value="Login" tabindex="3">
            </form>
        </div>
        <div class="s50">
            <h2>Register</h2>
            <form action="" method="post">
                <input type="hidden" name="form" value="register">
                <input type="text" name="username" id="username" placeholder="username" tabindex="4">
                <br>
                <input type="password" name="password" id="password" placeholder="password" tabindex="5">
                <br><br>
                <input type="submit" value="Register" tabindex="6">
            </form>
        </div>
    </div>
</body>
</html>