<template>
  <div class="phone-input-component">
    <div>
      <select class="form-control form-select">
        <option :value="countryCode">{{ countryCode }}</option>
      </select>
    </div>
    <div class="flex phone-input-body">
      <select class="form-control form-select"
              required
              v-model="operatorCode">
        <option :value="null">-</option>
        <option v-for="(o, i) in operators"
                v-bind:key="i"
                :value="o">{{ o }}</option>
      </select>
      <input
          :id="id"
          type="text"
          class="form-control form-input form-input-bordered"
          style="width: 4rem;"
          :class="errorClasses"
          ref="phonePart0"
          placeholder="123"
          required
          pattern="\d{3}"
          v-bind:value="phoneParts[0]"
          @input="inputPart(0, $event.target.value)"
      />
      <input
          :id="id"
          type="text"
          class="form-control form-input form-input-bordered"
          style="width: 3rem;"
          ref="phonePart1"
          :class="errorClasses"
          placeholder="45"
          pattern="\d{2}"
          required
          @input="inputPart(1, $event.target.value)"
          v-bind:value="phoneParts[1]"
      />
      <input
          :id="id"
          type="text"
          class="form-control form-input form-input-bordered"
          style="width: 3rem;"
          :class="errorClasses"
          ref="phonePart2"
          placeholder="67"
          pattern="\d{2}"
          required
          @input="inputPart(2, $event.target.value)"
          v-bind:value="phoneParts[2]"
      />
      <slot />
    </div>
  </div>
</template>

<script>
export default {
name: "PhoneInput",
  props: {
    value: {
      type: String,
      required: true,
    },
    errorClasses: {
      default: null,
    },
    id: {
      required: false,
    }
  },
  data () {
    return {
      operators: [
          // '',
          '12',
          '20',
          '51',
          '50',
          '55',
          '57',
          '70',
          '77',
          '90',
          '99',
      ],
      phoneParts: ['', '', ''],
      operatorCode: null,
      countryCode: '+994'
    }
  },
  computed: {
    fullPhoneNumber () {
      return `${this.countryCode} ${this.operatorCode} ${this.phoneParts[0]} ${this.phoneParts[1]}${this.phoneParts[2]}`
    }
  },
  watch: {
    value (val) {
      if (this.fullPhoneNumber !== val) {
        this.setPhone(val, this.operatorCode)
      }
    },
    phone (val) {
      this.setPhone(val, this.operatorCode)
    },
    fullPhoneNumber (val) {
      this.onInput()
    },
    operatorCode (val) {
      this.onInput()
    },
  },
  mounted() {
    if (this.value && this.value !== 'null') {
      this.setPhone(this.value)
    }
  },
  methods: {
    onInput () {
      this.$emit('input', this.fullPhoneNumber)
    },
    transformNumber (phone) {
      let result = phone.replaceAll(' ', '')
      if(result.startsWith(this.countryCode)) {
        result = result.replace(this.countryCode, '')
      }

      const c = result.substring(0, 2)
      if (this.operatorCode !== c && this.operators.indexOf(c) !== -1) {
        this.operatorCode = c
      }
      if (this.operatorCode && result.startsWith(this.operatorCode)) {
        result = result.replace(this.operatorCode, '')
      }
      if (result.length > 7) {
        result = result.substring(result.length - 7)
      }
      return [
          result.substring(0, 3),
          result.substring(3, 5),
          result.substring(5, 7),
      ]
    },
    setPhone (phone) {
      this.phoneParts = this.transformNumber(phone)
      this.onInput()
    },
    inputPart (index, part) {
      const length = index ? 2 : 3
      const partToSet = part.substring(0, length)
      this.$set(this.phoneParts, index, partToSet)
      if (part.length >= length) {
        const element = this.$refs[`phonePart${index + 1}`]
        if (element) {
          element.focus()
        }
      }
    }
  }
}
</script>

<style scoped lang="sass">
.phone-input-body
  display: flex
  align-items: center
  width: 100%
</style>