<template>

</template>

<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],
  computed: {
    availableOptions() {
      return Object.values(this.field.options || {})
    },
    allDefaults() {
      return this.availableOptions.reduce((acc, option) => ({...acc, [option.column]: 'default'}), {})
    },
    value() {
      try {
        return JSON.parse(this.field.value) || {}
      } catch (e) {
        return {}
      }
    },
    optionsToShow() {
      return {
        ...this.allDefaults,
        ...this.value,
      }
    },
    valuesToDisplay() {
      return this.availableOptions
          .map(option => ({...option, value: this.optionsToShow[option.column]}))
          // .map(option => `${option.default}: ${option.value ? this.getName(option, option.value) : '-'}`)
    }
  },
  methods: {
    getName(option, type) {
      if (type === 'default') {
        return option.default
      }
      return option.names[type] || '-'
    }
  }

}
</script>
