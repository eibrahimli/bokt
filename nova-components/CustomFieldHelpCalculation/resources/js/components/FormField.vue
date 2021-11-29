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
            timeout: null,
            price: 0,
            amount: 0,
            currentAttr: ''
        }
    },

    computed: {
        children() {
            return this.$parent.$children
        },
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

        handleProperFieldUpdate(key,parent) {
            console.log('price', this.price, '  amount', this.amount)
            if(this.field.attribute === parent.attribute) {
                this.value = this.price * this.amount
                this.price=this.amount=0
            }
        }
    },

    mounted() {

        Nova.$on('unit_price', value => {
            if(value[3] !== undefined) {
                if(value[3]._props.field.originalAttribute === 'quantity') {
                    this.amount = value[3].value
                } else {
                    this.price = value[3].value
                }
            }
            this.price = value[1]
            if (this.amount !== 0 && this.price !== 0) {
                this.handleProperFieldUpdate(value[0],value[2])
            }
        } )
        Nova.$on('amount', value => {
            if(value[3] !== undefined) {
                if(value[3]._props.field.originalAttribute === 'unit_price') {
                    this.price = value[3].value
                }
            }
            this.amount = value[1]
            if (this.amount !== 0 && this.price !== 0) {
                this.handleProperFieldUpdate(value[0],value[2])
            }

        })

    }
}
</script>
