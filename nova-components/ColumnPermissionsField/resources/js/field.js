Nova.booting((Vue, router, store) => {
  Vue.component('index-column-permissions-field', require('./components/IndexField'))
  Vue.component('detail-column-permissions-field', require('./components/DetailField'))
  Vue.component('form-column-permissions-field', require('./components/FormField'))
})
