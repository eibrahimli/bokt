<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <input
        :id="field.name"
        type="text"
        class="w-full form-control form-input form-input-bordered"
        :class="errorClasses"
        :placeholder="field.name"
        v-model="value"
      />
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

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

  updated() {
      clearTimeout(this.timeout);
      let vm = this

      // Make a new timeout set to go off in 1000ms (1 second)
      this.timeout = setTimeout(function () {
          if(vm.field.originalAttribute == 'unit_price') {
              Nova.$emit('unit_price', [vm._props.field.attribute, vm.value])
          } else {
              Nova.$emit('amount', [vm._props.field.attribute, vm.value])
          }
      }, 1000);
  }
}
</script>
