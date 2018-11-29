<?php

$vue_source = file_get_contents('node_modules/vue/dist/vue.js');
$renderer_source = file_get_contents('node_modules/vue-server-renderer/basic.js');
$app_source = file_get_contents('app.js');

$v8 = new V8Js();

$v8->executeString('var process = { env: { VUE_ENV: "server", NODE_ENV: "production" }}; this.global = { process: process };');
$v8->executeString($vue_source);
$v8->executeString($renderer_source);
$v8->executeString($app_source);