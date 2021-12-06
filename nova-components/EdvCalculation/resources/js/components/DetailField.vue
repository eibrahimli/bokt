<template>
    <div class="relative">
        <ul>
            <li>Cəmi : {{ parseFloat(result.priceTotal).toFixed(2) }}</li>
            <li>Ədv : {{ result.edv }} %</li>
            <li>Yekun : {{ parseFloat(result.total).toFixed(2) }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    data() {
        return {
            result: {}
        }
    },

    mounted() {
        this.result = JSON.parse(this.field.value)
    }
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
