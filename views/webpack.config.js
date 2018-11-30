const path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
  entry: './src',
  output: {
    path: path.resolve('./dist'),
    filename: '[name].bundle.js',
  },
  module: {
    rules: [
      { test: /\.vue$/, use: 'vue-loader' },
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
  ]
}