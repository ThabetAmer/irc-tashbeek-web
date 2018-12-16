<script>
    /**
     * Mixin for all btns
     */
    import classNames from "classnames"

    export default {
        props: {
            customClass:{
                type:String,
                default:''
            }
        },
        computed: {
            panelStyle() {
                return classNames([
                    'bg-white rounded-lg  px-6 py-6 border border-solid mb-3 relative',this.customClass]);
            }
        },
    }
</script>