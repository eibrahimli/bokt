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
                @keyup.prevent
                @keydown.prevent
                readonly
            />
        </template>
    </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

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
        Nova.$on('edv', val => {
            if(this.field.attribute === val[1].field.attribute) {
                let priceVal = (this.$parent.$children.find(el => el._props.field.originalAttribute === 'price' || el._props.field.attribute === 'price')).value
                this.value = priceVal + ((val[0] * priceVal) / 100)
            }
        })
    },

    watch: {
        value(current, prev) {
            Nova.$emit('total', [current,prev])
        }
    }
}
</script>
