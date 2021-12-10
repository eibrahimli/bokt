Nova.booting((Vue, router, store) => {
  Vue.component('index-monthly-credit-payment-report', require('./components/IndexField'))
  Vue.component('detail-monthly-credit-payment-report', require('./components/DetailField'))
  Vue.component('form-monthly-credit-payment-report', require('./components/FormField'))
})
