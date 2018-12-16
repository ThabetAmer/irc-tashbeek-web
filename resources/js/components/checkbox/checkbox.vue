<template>
  <!--
    checkbox that binds checked to the
    passed prop of value
    the type is checkbox. change and input
    are both handled.
    -->
  <div>
    <label class="form-check-label">
      <input
        :id="checkId"
        :value="value"
        type="checkbox"
        :checked="checked"
        :class="checkboxClass"
        @input="$emit('input', $event.target.checked)"
        @change="$emit('change', $event.target.checked)"
      >

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
                type: [String, Number]
            },
            inputClass: {
                type: [String, Array, Object]
            },
            value: {
                type: [String, Boolean],
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