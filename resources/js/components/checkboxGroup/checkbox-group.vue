<template>
    <!--
        checkbox group which uses the
        original checkbox component
        which returns an array that has the
        selected objects
    -->
    <div>
        <checkbox-field
                :key="checkbox.value"
                :label="checkbox.label"
                :check-id="checkbox.value"
                v-for="checkbox in checkboxes"
                :checked="checkedField(checkbox)"
                @change="checkboxChange(checkbox,$event)">
        </checkbox-field>
    </div>
</template>


<script>
    import checkboxField from "../checkbox/checkbox";

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
            checkboxes: [Array, Object]
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
        },
        data() {
            return {
                checkboxValue: [],
            }
        },
        components: {
            checkboxField
        },
        watch: {
            checkboxValue: function (newValue, oldValue) {
                this.$emit('change', this.checkboxValue);
            }
        }

    }
</script>

<style lang="scss">

</style>