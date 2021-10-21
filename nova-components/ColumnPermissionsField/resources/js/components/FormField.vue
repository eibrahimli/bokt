<template>
    <default-field :field="field" :errors="errors">
      <template slot="field">
        <div v-for="(o, i) in availableOptions"
             :key="i"
             class="mb-3">
          <div>
            <label v-if="o.label != 'ID'">{{ o.label  }}</label>
          </div>
          <div>
            <select class="w-full form-control form-select"
                    v-bind:value="optionsToShow[o.column]"
                    @input="(e) => handleChange(e.target.value, o.column)"
            >
              <option :selected="optionsToShow[o.column] == null" :value="null">Hidden</option>
              <option
                v-show="field.validationKey === 'columns' || field.validationKey === 'question_request_columns' || field.validationKey === 'redirect_request_columns'" :value="o.path+'||hideWhenUpdating'">Redaktədə Göstərmə</option>
              <option
                v-show="field.validationKey === 'columns' || field.validationKey === 'question_request_columns' || field.validationKey === 'redirect_request_columns'" :value="o.path+'||hideWhenCreating'">Yaradanda göstərmə</option>
              <option
                :value="field.validationKey === 'columns' || field.validationKey === 'question_request_columns' || field.validationKey === 'redirect_request_columns' ? o.path+'||default': 'default'">{{ o.default }}</option>
              <option v-for="(name, type) in o.names"
                      v-bind:key="type"
                      :value="type+'||'+name">
                {{ name }}
              </option>
              <!--                <option value="default">Hidden</option>-->
            </select>
          </div>
        </div>
      </template>
    </default-field>

</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      selectedOptions: {},
      columns: [
       'columns', 'oral-requests', 'question-requests', 'redirect-requests'
      ]
    }
  },

  computed: {
    availableOptions() {
      return Object.values(this.field.options || {})
    },
    allDefaults () {
      return this.availableOptions.reduce((acc, option) => ({...acc, [option.column]: 'default'}), {})
    },
    optionsToShow () {
      return {
        ...this.allDefaults,
        ...this.selectedOptions,
      }
    }
  },
  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.selectedOptions = this.field.value ? JSON.parse(this.field.value) || {} : {}
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      const value = JSON.stringify(this.selectedOptions)
      formData.append(this.field.attribute, value)
    },

    /**
     * Update the field's internal value.
     */
    handleChange(value, column) {
      const valueToSet = value ? value : null;
      this.$set(this.selectedOptions, column, valueToSet)
    },
  },
}
</script>
