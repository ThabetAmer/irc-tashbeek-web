<template>
  <!--
        checkbox group which uses the
        original checkbox component
        which returns an array that has the
        selected objects
    -->
  <div
    :class="`${display==='inline' ? 'inline-flex mr-2':''}`"
  >
    <CheckboxField
      v-for="checkbox in checkboxes"
      :key="checkbox.value"
      :label="checkbox.label"
      :check-id="checkbox.value"
      :checked="checkedField(checkbox)"
      @change="checkboxChange(checkbox,$event)"
    />
  </div>
</template>


<script>
  export default {
    /**
     * the only passed prop to the froup
     * is the array of checkbox objects
     * each of these objects will contain
     * value and label. Label is to display lable
     * and value is a unique value for the checkbox
     *
     * The only data is the checkboxValue which
     * has an array of all the checked OBJECTS.
     */
    props: {
      checkboxes: {
        type: [Array, Object],
        default: () => []
      },
      display: {
        type: String,
        default: ''
      }
    },
    data() {
      return {
        checkboxValue: []
      }
    },
    watch: {
      checkboxValue: function (newValue, oldValue) {
        this.$emit('change', this.checkboxValue);
      }
    },
    methods: {
      checkedField(option) {
        return this.checkboxValue.findIndex(item => item.value === option.value) !== -1
      },
      checkboxChange(option, value) {
        const index = this.checkboxValue.findIndex(item => item.value === option.value)
        if (value) {
          this.checkboxValue.push(option)
        }
        else {
          this.checkboxValue.splice(index, 1)
        }
      }
    }

  }
</script>

<style lang="scss">

</style>