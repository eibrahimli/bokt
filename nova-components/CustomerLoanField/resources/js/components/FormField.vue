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
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
      return {
          fields: [
              'calculated_price', 'interested_price','main_price'
          ]
      }
    },

    computed: {
        elements() {
            return this.$parent.$children
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
      console.log(this.field, 'salam')
    },

    watch: {
        value(val) {
            this.elements.forEach(el => {
                if(this.fields.includes(el.field.attribute)) {
                    console.log(el)
                    el.value = val
                }
            })
        }
    }
}
</script>
