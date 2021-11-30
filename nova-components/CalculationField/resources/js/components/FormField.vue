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
                @keyup.prevent="handleKeyUp"
            />
        </template>
    </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    computed: {
        amount() {
            return this.$parent.$children.find(child => {
                if (child._props.field.originalAttribute === 'quantity') {
                    return child.value
                }
            })
        },
        unit_price() {
            return this.$parent.$children.find(child => {
                if (child._props.field.originalAttribute === 'unit_price') {
                    return child.value
                }
            })
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

        handleKeyUp() {
            if (!this.field.depends) {
                clearTimeout(this.timeout);
                let vm = this

                // Current price field | this will be dynamic  in future
                let current = vm.$parent.$children.find(child => child._props.field.originalAttribute === 'price')

                // Make a new timeout set to go off in 1000ms (1 second)
                this.timeout = setTimeout(function () {
                    if (vm.field.originalAttribute == 'unit_price') {
                        Nova.$emit('unit_price', [vm._props.field.attribute, vm.value, current, vm.amount])
                    } else if(vm.field.originalAttribute == 'quantity') {
                        Nova.$emit('amount', [vm._props.field.attribute, vm.value, current, vm.unit_price])
                    }
                }, 1000);
            } else {
                clearTimeout(this.timeout);
                let vm = this
                let current = vm.$parent.$children.find(child => child._props.field.originalAttribute == 'total_price')
                console.log(current)
                // Make a new timeout set to go off in 1000ms (1 second)
                this.timeout = setTimeout(function () {
                    Nova.$emit('edv', [vm.value, current])
                }, 1000);
            }
        }

    },



}
</script>
