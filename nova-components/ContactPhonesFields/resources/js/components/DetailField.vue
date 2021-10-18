<template>
  <div class="flex border-b border-40 -mx-6 px-6">
    <panel-item
      v-for="(f, i) in fieldsToShow"
      class="w-100"
      :key="i"
      :field="f" />
  </div>
</template>

<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],

  computed: {
    fieldsToShow () {
      console.log([this.field, ...this.additionalFields])
      return [this.field, ...this.additionalFields]
    },
    additionalFields () {
      return [...Array(3).keys()]
        .map((_, i) => this.getField(i + 1))
        .filter(x => x && x.value && x.value !== 'null')
        .map((x) => this.removeName(x))
    }
  },

  methods: {
    getField(index) {
      const key = `${this.field.attribute}_${index}`
      const component = this.$parent['$children'].find(c => c._props.field.attribute === key)
      return component ? component._props.field : null
    },

    removeName (field) {
      const {value} = field
      return {...this.field, value, name: undefined}
    }
  }
}
</script>
