<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <input
        :id="field.name"
        type="number"
        class="w-full form-control form-input form-input-bordered disabled"
        :class="errorClasses"
        :placeholder="field.name"
        v-model="value"
        @keyup.prevent
        @keydown.prevent
        readonly
      />
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],
  data() {
    return {
        payload: {}
    }
  },
  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
  },

  mounted() {
      console.log(this.$parent, 'parnt')
      let vm = this
      Nova.$on('nova-belongsto-depend-product', payload => {
          console.log(payload)
          vm.$parent.$children.forEach(item => {
              const attribute = item._props.field.attribute
              const el = item.$el
              const div = document.createElement('div')
              div.className = 'px-8 flex items-center'
              switch (attribute) {
                  case 'month':
                      div.innerHTML = `
                          <ul class="flex flex-row gap-8 justify-between list-none">
                            <li class="border-b rounded p-2 font-bold">Min: ${payload.value.min_date}</li>
                            <li class="border-b rounded p-2 font-bold">Max: ${payload.value.max_date}</li>
                          </ul>
                      `
                      el.append(div)
                      break
                  case 'price':
                      div.innerHTML = `
                          <ul class="flex flex-row gap-8 justify-between list-none">
                            <li class="border-b rounded p-2 font-bold">Min: ${payload.value.min_price}</li>
                            <li class="border-b rounded p-2 font-bold">Max: ${payload.value.max_price}</li>
                          </ul>
                      `
                      el.append(div)
                      break
              }

          })
          this.value = payload.value.percentage
          this.payload = payload.value
      })
  },
  watch: {
      value(val) {
          Nova.$emit('percentage-change', [val, this.payload])
      }
  }
}
</script>
