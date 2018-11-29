// app.js
var vm = new Vue({
  template: `<div>{{ msg }}</div>`,
  data: {
    msg: 'hello'
  }
})

// `vue-server-renderer/basic.js` によってエクスポーズ
renderVueComponentToString(vm, (err, res) => {
  print(res)
})
