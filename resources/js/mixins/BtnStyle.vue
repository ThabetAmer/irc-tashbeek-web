<script>
    /**
     * Mixin for all btns
     */
    import classNames from "classnames"

    export default {
        props: {
            theme: {
                type: String,
                default: "default"
            },
            btnClass: {
                type: String,
                default: ""
            },
            size: {
                type: String,
                default: ""
            },
            disabled: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            btnStyle() {
                let style = "";
                if (this.theme === 'default') {
                    style = 'bg-white hover:bg-grey-lightest text-grey-darkest';
                }
                else if (this.theme === 'primary') {
                    style = 'bg-blue hover:bg-blue-dark text-white';
                }

                else if (this.theme === 'success') {
                    style = 'bg-green hover:bg-green-dark text-white';
                }

                else if (this.theme === 'failure') {
                    style = 'bg-red hover:bg-red-dark text-white';
                }

                return classNames([style, this.btnClass, 'font-bold', 'shadow', 'rounded', 'py-2', 'px-4']);
            }
        },
    }
</script>