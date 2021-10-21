Nova.booting((Vue, router, store) => {
  Vue.component('index-customer-loan-field', require('./components/IndexField'))
  Vue.component('detail-customer-loan-field', require('./components/DetailField'))
  Vue.component('form-customer-loan-field', require('./components/FormField'))
})
