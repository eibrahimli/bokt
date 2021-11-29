Nova.booting((Vue, router, store) => {
  Vue.component('index-CalculationForUnitPriceField', require('./components/IndexField'))
  Vue.component('detail-CalculationForUnitPriceField', require('./components/DetailField'))
  Vue.component('form-CalculationForUnitPriceField', require('./components/FormField'))
})
