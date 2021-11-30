<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <input
                :id="field.name"
                type="text"
                class="w-full disabled form-control form-input form-input-bordered"
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
            timeout: null,
            price: 0,
            amount: 0
        }
    },

    computed: {
        children() {
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

        handleProperFieldUpdate(key, parent) {
            if (this.field.attribute === parent._props.field.attribute) {
                this.value = this.price * this.amount
                let edvVal = (parent.$parent.$children.find( el => el._props.field.originalAttribute === 'edv')).value
                let totalPrice = parent.$parent.$children.find( el => el._props.field.originalAttribute === 'total_price')
                Nova.$emit('edv', [edvVal, totalPrice])
                this.price = this.amount = 0
            }
        }
    },

    mounted() {

        Nova.$on('unit_price', value => {
            if (value[3] !== undefined) {
                // Check just unit price updated and quantity send to here
                if (value[3]._props.field.originalAttribute === 'quantity') {
                    this.amount = parseInt(value[3].value)
                }
            }
            this.price = parseFloat(value[1])

            if (this.amount !== 0 && this.price !== 0) {
                this.handleProperFieldUpdate(value[0], value[2])
            }
        })
        Nova.$on('amount', value => {
            console.log('buralard 1', value)
            if (value[3] !== undefined) {
                // Check just quantity updated and unit price send to here
                if (value[3]._props.field.originalAttribute === 'unit_price') {
                    this.price = parseFloat(value[3].value)
                }
            }
            this.amount = parseInt(value[1])
            if (this.amount !== 0 && this.price !== 0) {
                this.handleProperFieldUpdate(value[0], value[2])
            }
        })
    },


}
</script>
