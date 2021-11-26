<template>
    <div class="relative">
        <ul>
            <li>Cəmi</li>
            <li>Ədv 18%</li>
            <li>Yekun</li>
        </ul>
    </div>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            amounts: []
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
      // Nova.$on('price', (vale) => {
      //   // this.amounts.push(vale)
      //     console.log(vale)
      // })
    }
}
</script>
