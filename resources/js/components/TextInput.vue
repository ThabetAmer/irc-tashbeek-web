<template>
  <!--
    input field that takes props from the user
    sets these props as shown below
    the type of input 'email, text, number'
    is passed in the 'type' prop.
    '@focus,@blur,@input,@change' are all
    events that are caught by the user
    in the original component.
    'inputClass' can be String, Array or Object
    and it is parsed and added to 'form-control '
    -->
  <div
    :class="`relative ${wrapperClass}`"
  >
    <input
      :type="type"
      :name="name"
      :value="value"
      :readonly="readOnly"
      :disabled="disabled"
      :maxlength="maxLength"
      :placeholder="placeholder"
      :class="computedInputClass"
      @blur="$emit('blur',$event)"
      @focus="$emit('focus',$event)"
      @change="$emit('change',$event)"
      @input="$emit('input',$event.target.value)"
    >
    <button
      v-if="hasRemove && value"
      class="clear-filter-button  flex items-center absolute pin-r pin-t mt-3 mr-3 cursor-pointer text-white text-xxs rounded-full"
      @click="$emit('clear')"
    >
      <i
        class="icon-X_x40_2xpng_2"
      />
    </button>
  </div>
</template>


<script>
  import InputStyleMixin from "../mixins/InputStyle"

  export default {
    mixins: [InputStyleMixin],
    /**
     * all props have their needed types
     * and they also have their default
     * non-effecting values
     */
    props: {
      value: {
        type: [String, Number, Boolean],
        default: ''
      },
      size: {
        type: String,
        default: ''
      },
      type: {
        type: String,
        default: 'text'
      },
      placeholder: {
        type: String,
        default: 'Insert Text'
      },
      name: {
        type: String,
        default: ''
      },
      readOnly: {
        type: Boolean,
        default: false
      },
      maxLength: {
        type: Number,
        default: 100
      },
      disabled: {
        type: Boolean,
        default: false
      },
      hasRemove:{
        type: Boolean,
        default: false
      },
      wrapperClass:{
        type:String,
        default:''
      }
    }
  }
</script>

<style lang="scss">

</style>