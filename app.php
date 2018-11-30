<?php
require_once "vendor/autoload.php";

use VueSSR\Renderer;

$renderer = new Renderer('views/node_modules/');
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Example SSR Vue on PHP</title>
</head>
<body>
<?php $renderer->render('./vews/render.js', [
    'message' => 'hello vue!'
]); ?>
</body>
</html>