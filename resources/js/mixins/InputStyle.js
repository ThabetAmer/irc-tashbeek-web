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
      type: [String, Array, Object],
      default:''
    }
  },
  computed: {
    computedInputClass() {
      return classNames(['focus:outline-none focus:shadow-outline ', this.inputClass]);
    }
  },
}