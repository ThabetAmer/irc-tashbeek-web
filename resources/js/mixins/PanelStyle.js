/**
 * Mixin for all btns
 */
import classNames from "classnames"

export default {
  props: {
    customClass:{
      type:String,
      default:''
    },
    bg:{
      type:String,
      default: "lightest"
    }
  },
  computed: {
    panelStyle() {
      let bg

      switch (this.bg){
        case 'lightest':
        default:
          bg = 'white'
          break;
        case 'lighter':
          bg = 'grey-lightest'
          break;
        case 'light':
          bg = 'grey-lighter'
          break;
      }

      bg = `bg-${bg}`
      return classNames([
        'rounded-lg  px-6 py-6 border border-solid mb-3 relative', this.customClass, bg]);
    }
  },
}