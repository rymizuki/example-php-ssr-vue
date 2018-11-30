<?php
require_once "vendor/autoload.php";

use VueSSR\Renderer;

$renderer = new Renderer('node_modules/');
?>
<div>
<?php $renderer->render('./app.js', [
    'message' => 'hello vue!'
]); ?>
</div>