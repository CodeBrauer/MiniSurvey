<?php

/**
* Error Handler
*/
class Error
{
    public static function handle(Exception $e)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>WHOT? An error appeared!</title>
            <style>
                .box { width: 90%; margin: 10px auto 0; font-family: sans-serif; }
                strong { display: inline-block; width: 130px; }
            </style>
        </head>
        <body>
            <div class="box">
                <h1>WHOT? An error appeared! :o</h1>
                <p>I catched that Exception for you &hearts; </p>
                <strong>Error: </strong><code><?php echo $e->getMessage() ?></code><br>
                <strong>Code: </strong><code><?php echo $e->getCode() ?></code><br>
                <strong>Filename: </strong><code><?php echo $e->getFile() ?></code><br>
                <strong>Line number: </strong><code><?php echo $e->getLine() ?></code><br>
                <br>
                <strong>Trace: </strong>
                <pre><?php echo $e->getTraceAsString() ?></pre>
            </div>
        </body>
        </html>
        <?php
    }
}