<template>
  <default-field :field="field"
                 :errors="errors">
    <template slot="field">
      <div class="flex mb-2" style="align-items: center">
        <phone-input
          v-model="values.main"
          :id="field.name"
          :error-classes="errorClasses">
          <button class="btn btn-default" v-if="showAmount < maxAmount" @click="addPhone($event)">+</button>
        </phone-input>
      </div>
    </template>
    <template slot="field"
              v-for="index in showAmount">
      <div class="flex align-items-center my-2"
           :key="index"
           style="align-items: center">
        <phone-input v-model="values[index]"
                     :id="`${field.name}_${index}`"
                     :error-classes="errorClasses">
          <button @click="removePhone($event)" v-if="index === showAmount" class="btn btn-default">-</button>
        </phone-input>
      </div>
    </template>
  </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'
import PhoneInput from "./PhoneInput";

export default {
  components: {PhoneInput},
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      showAmount: 0,
      maxAmount: 3,
      values: {
        main: '',
      }
    }
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      const validPhones = [...Array(this.maxAmount).keys()]
        .map((_, i) => this.getValue(i + 1))
        .filter(x => x && x !== 'null')

      const additionalValues = validPhones
        .reduce((acc, item, i) => ({
          ...acc,
          [i + 1]: item || '',
        }), {})

      this.showAmount = validPhones.length

      console.log(additionalValues, validPhones, this.showAmount)

      this.values = {
        main: this.field.value || '',
        ...additionalValues
      }
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append('contact_phone', this.values.main || '')
      for (let i = 1; i <= this.maxAmount; i++) {
        const valueToSet = this.showAmount >= i ? this.values[i] || '' : null
        formData.append(`${this.field.attribute}_${i}`, valueToSet)
      }
    },

    /**
     * Update the field's internal value.
     */
    handleChange(value) {
      this.value = value
      this.$set(this.values, 'main', value)
    },

    getValue(index) {
      const key = `${this.field.attribute}_${index}`
      const component = this.$parent.$children.find(c => c._props.field.attribute === key)
      return component ? component._props.field.value : ''
    },

    fillValues(values) {
      this.showAmount = Math.max(values.length - 1, this.showAmount, 0)
      this.values = {
        ...this.values,
        ...values.reduce((acc, phone, i) => ({
          ...acc,
          [i === 0 ? 'main' : i]: phone,
        }), {})
      }
    },

    addPhone(e) {
      e.preventDefault()
      this.showAmount = Math.min(this.showAmount + 1, this.maxAmount)
    },

    removePhone(e) {
      e.preventDefault()
      this.showAmount = Math.max(this.showAmount - 1, 0)
    },
  },
}
</script>
