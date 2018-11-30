# example-php-ssr-vue

> PHPからVueJSをSSRする実験

## requirements

* docker
* ndenv

## setup

```console
# buildに必要なのでnodeを入れる
$ ndenv install $(cat .node-version)
$ ndenv rehash
$ exec $SHELL -l

# Vueをbundle
$ cd views/
$ npm install
$ npm run build

# PHPを実行
$ bin/build
$ bin/dev
```

## open in brower

```
$ open http://localhost:3000
```