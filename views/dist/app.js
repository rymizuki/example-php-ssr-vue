// app.js
var state = this.global.__PRELOAD_STATE__
var vm = new Vue({
  template: `<div>{{ msg }}</div>`,
  data: {
    msg: state.message
  }
})
renderVueComponentToString(vm, (err, res) => {
    if (err) throw new Error(err);
    print(res)
})