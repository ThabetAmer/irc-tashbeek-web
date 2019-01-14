<template>
  <!--
    checkbox that binds checked to the
    passed prop of value
    the type is checkbox. change and input
    are both handled.
    -->
  <div class="mr-2">
    <label :class="`form-check-label ${labelClass}`">
      <input
        :id="checkId"
        :value="value"
        type="checkbox"
        :checked="checked"
        :class="checkboxClass"
        :disabled="disabled"
        @input="$emit('input', $event.target.checked)"
        @change="$emit('change', $event.target.checked)"
      >
      <span
        v-if="labelClass"
        class="checkmark"
      />

      {{ label }}
    </label>
  </div>
</template>
<script>
  import classNames from "classnames"

  export default {
    /**
     * all props have their needed types
     */
    props: {
      label: {
        type: String,
        default: "Default Checkbox"
      },
      checked: {
        type: Boolean,
        default: false
      },
      checkId: {
        type: [String, Number],
        default: ''
      },
      inputClass: {
        type: [String, Array, Object],
        default: ''
      },
      labelClass: {
        type: [String, Array, Object],
        default: ''
      },
      value: {
        type: [String, Boolean],
        default: ''
      },
      disabled:{
        type:Boolean,
        default:false
      }
    },
    computed: {
      checkboxClass() {
        return classNames(['form-check-input', this.inputClass]);
      }
    },

  }
</script>

<style lang="scss">

</style>