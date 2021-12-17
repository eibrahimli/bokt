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
      let vm = this
      Nova.$on('nova-belongsto-depend-product', payload => {
          vm.value = payload.value.percentage
          vm.field._props.value = payload.value.percentage
      })
  },
  watch: {
      value(val) {
          Nova.$emit('percentage-change', val)
      }
  }
}
</script>
