import App from './App.vue'

App.propsData = __PRELOAD_STATE__
var vm = new Vue(App);

renderVueComponentToString(vm, (err, res) => {
    if (err) throw new Error(err);
    print(res)
})
