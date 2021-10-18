Nova.booting((Vue, router, store) => {
  Vue.component('index-contact-phones-fields', require('./components/IndexField'))
  Vue.component('detail-contact-phones-fields', require('./components/DetailField'))
  Vue.component('form-contact-phones-fields', require('./components/FormField'))
})
