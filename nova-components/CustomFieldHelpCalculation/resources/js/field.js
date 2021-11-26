Nova.booting((Vue, router, store) => {
  Vue.component('index-custom-field-help-calculation', require('./components/IndexField'))
  Vue.component('detail-custom-field-help-calculation', require('./components/DetailField'))
  Vue.component('form-custom-field-help-calculation', require('./components/FormField'))
})
