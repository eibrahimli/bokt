<template>
    <card class="flex flex-col items-center justify-center">
        <div class="flex flex-wrap">
            <div class="w-full">
                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center" v-for="branch in branchs">
                        <a @click.prevent="redirectToBranchDashboard" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-bind:class="{'text-gray-600 bg-white': openTab !== branch.id, 'text-white bg-gray-600': openTab === branch.id}">
                            <i class="fas fa-space-shuttle text-base mr-1"></i> {{ branch.name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],
    data() {
        return {
            openTab: 1,
            branchs: [],
        }
    },
    methods: {
        toggleTabs: function(tabNumber){
            this.openTab = tabNumber
        },
        redirectToBranchDashboard() {
            this.$router.push('/dashboards/loan-cards')
        }
    },

    mounted() {
        axios.get('/nova-vendor/branchs-card/test').then(data => {
            this.branchs = data.data
            console.log(this.branchs)
        }).catch(er => {
            console.log(er)
        })
    },
}
</script>
