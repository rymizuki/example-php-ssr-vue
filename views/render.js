// app.js
var vm = require('./dist/app.js')
renderVueComponentToString(vm, (err, res) => {
    if (err) throw new Error(err);
    print(res)
})
