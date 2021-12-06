<template>
    <div class="relative">
        <ul>
            <li>Cəmi : {{ priceTotal.toFixed(2) }}</li>
            <li>Ədv : {{ edv }} %</li>
            <li>Yekun : {{ total.toFixed(2) }}</li>
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
            total: 0,
            edv: 0,
            priceTotal: 0
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = JSON.parse(this.field.value)
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, JSON.stringify({ total : this.total, edv : this.edv, priceTotal: this.priceTotal }))
        },
    },

    mounted() {
        Nova.$on('total', (vale) => {
            let [current, prev] = vale
            this.total = this.total + current - prev
        })
        Nova.$on('edvTotal', vale => {
            let [current, prev] = vale
            this.edv = Number(this.edv) + Number(current) - Number(prev)
        })
        Nova.$on('priceTotal', vale => {
            let [current, prev] = vale
            this.priceTotal = Number(this.priceTotal) + Number(current) - Number(prev)
        })
    },
}
</script>

<style scoped>
    ul {
        list-style: none;
        padding: 2rem;
    }
    li{
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 0.4rem;
        margin-bottom: 0.5rem;
    }
    li:last-child {
        margin-bottom: 0
    }
</style>
