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
                        <tr v-for="(rep,index) in JSON.parse(field.value)" :key="index" class="whitespace-nowrap">
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
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    mounted() {
        console.log(this.field.value)
    }
}
</script>
