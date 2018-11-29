# example-php-ssr-vue

> PHPからVueJSをSSRする実験

## requirements

* docker
* ndenv

## setup

```console
$ ndenv install $(cat .node-version)
$ ndenv rehash
$ exec $SHELL -l

$ npm install

$ bin/build
$ bin/dev
```