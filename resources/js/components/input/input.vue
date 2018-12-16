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

    <input :type="type"
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
           @input="$emit('input',$event.target.value)">
</template>


<script>
    import  InputStyleMixin from  "../../mixins/InputStyle"
    export default {
        /**
         * all props have their needed types
         * and they also have their default
         * non-effecting values
         */
        props: {
            value: {
                type: [String, Number,Boolean]
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
            }
        },
        mixins:[InputStyleMixin]
    }
</script>

<style lang="scss">

</style>