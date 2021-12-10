<template>
    <div class="flex justify-center">
        <table>
            <thead>
            <tr>
                <th>Esas</th>
                <th>Faiz</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>34</td>
                <td>35</td>
            </tr>

            <tr>
                <td>344</td>
                <td>355</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            data: {
                month: '',
                price: '',
                percentage: '',
            },
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

        handleRequest(type, data) {
            this.data[type] = data
        },
        checkProperties(obj) {
            for (let key in obj) {
                if (obj[key] === null || obj[key].trim() === '') {
                    return false;
                }
            }
            return true;
        }
    },

    mounted() {

        Nova.$on('percentage-change', data => {
            this.handleRequest('percentage', data)
        })
        Nova.$on('month-change', data => {
            this.handleRequest('month', data)
        })
        Nova.$on('price-change', data => {
            this.handleRequest('price', data)
        })
    },

    watch: {
        data : {
            handler(val , oldVal) {
                clearTimeout(this.timeout);
                let vm = this

                // Make a new timeout set to go off in 1000ms (1 second)
                this.timeout = setTimeout(function () {

                    if(vm.checkProperties(val)) {
                        Nova.request().post('/eibrahimli/test',val).then(function (data) {
                            console.log(data)
                        })
                    }
                }, 1000);
            },
            deep: true
        }
    }
}
</script>
