<script>
    /**
     * Mixin for all inputs
     * currently to add the classes passed
     * from the user to form-control
     * and form a single array ofs
     */
    import classNames from "classnames"

    export default{
        props: {
            inputClass: {
                type: [String, Array, Object]
            }
        },
        computed: {
            computedInputClass() {
                return classNames(['', this.inputClass]);
            }
        },
    }
</script>