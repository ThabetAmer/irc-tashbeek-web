<template>
    <!--
   Select with search that takes props
   options can be array of values or array
   of objects. multiple is either true or false
   to allow for selecting multiple objects at once
   track-by is the key the objects get tracked
   by. by default it is set to the name.
   label is the key which gets shown in the
   select dropdown
   @input and @select are events that emit the
   select object/s
   -->
    <multiselect class="multiselect-field"
                 :options="options"
                 :value="value"
                 :multiple="multiple"
                 :track-by="trackBy"
                 :label="label"
                 :placeholder="placeholder"
                 @input="handleInput"
                 @select="handleSelect">
    </multiselect>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import classNames from 'classnames'

    export default {
        /**
         * all props have their needed types
         * and they also have their default
         * non-effecting values/default values
         */
        props: {
            label: {
                type: String
            },
            value: {
                type: [String, Number, Object, Array]
            },
            options: {
                type: Array,
                default: []
            },
            multiple: {
                type: Boolean,
                default: false
            },
            placeholder: {
                type: String,
                default: 'click to select'
            },
            trackBy: {
                type: String,
                default: "name"
            }
        },
        methods: {
            handleInput(value, id) {
                this.$emit('input', value);
            },
            handleSelect(selectedOption) {
                this.$emit('select', selectedOption);
            }
        },
        components: {Multiselect}
    }
</script>

<style lang="scss">

</style>