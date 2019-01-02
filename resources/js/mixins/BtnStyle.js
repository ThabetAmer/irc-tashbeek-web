import classNames from "classnames"
import PropTypes from "../helpers/PropTypes";

export default {
  props: {
    theme: {
      type: String,
      default: "default",
      validator: PropTypes.oneOf(['default', 'primary', 'success', 'danger'])
    },
    btnClass: {
      type: [String, Object],
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
      switch (this.theme) {
        case 'default':
          style = 'bg-white hover:bg-grey-lightest text-grey-darkest'
          break
        case 'primary':
          style = 'bg-blue hover:bg-blue-dark text-white'
          break
        case 'success':
          style = 'bg-green-dark hover:bg-green text-white'
          break
        case 'danger':
          style = 'bg-red hover:bg-red-dark text-white'
          break
      }
      return classNames([style, 'font-bold', 'rounded-full', 'py-2', 'px-4', this.btnClass]);
    }
  },
}