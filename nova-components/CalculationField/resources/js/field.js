Nova.booting((Vue, router, store) => {
  Vue.component('index-calculation-field', require('./components/IndexField'))
  Vue.component('detail-calculation-field', require('./components/DetailField'))
  Vue.component('form-calculation-field', require('./components/FormField'))
})
