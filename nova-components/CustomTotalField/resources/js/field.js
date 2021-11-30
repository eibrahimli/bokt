Nova.booting((Vue, router, store) => {
  Vue.component('index-custom-total-field', require('./components/IndexField'))
  Vue.component('detail-custom-total-field', require('./components/DetailField'))
  Vue.component('form-custom-total-field', require('./components/FormField'))
})
