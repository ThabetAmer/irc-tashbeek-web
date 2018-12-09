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
                    'bg-white rounded-lg border px-4 py-8 border-black border-solid',this.customClass]);
            }
        },
    }
</script>