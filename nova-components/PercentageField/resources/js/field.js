Nova.booting((Vue, router, store) => {
  Vue.component('index-PercentageField', require('./components/IndexField'))
  Vue.component('detail-PercentageField', require('./components/DetailField'))
  Vue.component('form-PercentageField', require('./components/FormField'))
})
