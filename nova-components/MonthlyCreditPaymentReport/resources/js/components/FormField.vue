<template>
    <div class="flex justify-center mx-auto">
        <div class="flex flex-col w-full">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Ay
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Əsas Hissə
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Faiz Hissə
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Xidmət Haqqı
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Cəm
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            <tr v-for="(rep,index) in reports[0]" :key="index" class="whitespace-nowrap">
                            <td class="px-6 text-center py-4">
                                <div class="text-sm text-gray-900">
                                    {{ rep.termInMonth }}
                                </div>
                            </td>
                            <td class="px-6 text-center py-4">
                                <div class="text-sm text-gray-900">
                                    {{ rep.mainDept }}
                                </div>
                            </td>
                            <td class="px-6 text-center py-4">
                                <div class="text-sm text-gray-900">
                                    {{ rep.percentDept }}
                                </div>
                            </td>
                            <td class="px-6 text-center py-4">
                                <div class="text-sm text-gray-900">
                                    {{ 'Yoxdur' }}
                                </div>
                            </td>
                            <td class="px-6 text-center py-4">
                                <div class="text-sm text-gray-900">
                                    {{ rep.totalDept }}
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
            reports: []
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
                if (obj[key] === null || obj[key].trim() === '' || obj[key] === '0') {
                    return false;
                }
            }
            return true;
        }
    },

    mounted() {

        Nova.$on('percentage-change', data => {
            this.handleRequest('percentage', String(data))
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
                        Nova.request().post('/eibrahimli/report',val).then(res => {
                            vm.reports = res.data
                            vm.value = JSON.stringify(vm.reports[0])
                        })
                    }
                }, 1000);
            },
            deep: true
        }
    }
}
</script>
