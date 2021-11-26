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
        children () {
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

        emptyValue() {
            this.value = 0
        },

        handleProperFieldUpdate(key) {
            let vm = this
            this.$parent.$children.forEach(child => {
                if(child._props.field.attribute == vm.field.attribute) {
                    console.log(child)
                    console.log(vm.field.attribute)
                    child.value = vm.price * vm.amount
                }
            })
        }
    },

    mounted() {

        Nova.$on('unit_price', (value) => {
            this.emptyValue()
            this.price = value[1]
            console.log(value[0])
            this.handleProperFieldUpdate(value[0])
        })
        Nova.$on('amount', (value) => {
            this.emptyValue()
            this.amount = value[1]
            this.handleProperFieldUpdate(value[0])
        })

    }
}
</script>
