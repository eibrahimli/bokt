Nova.booting((Vue, router, store) => {
  Vue.component('index-edv-calculation', require('./components/IndexField'))
  Vue.component('detail-edv-calculation', require('./components/DetailField'))
  Vue.component('form-edv-calculation', require('./components/FormField'))
})
