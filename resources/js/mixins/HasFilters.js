export default {
  props:{
    filters: {
      type: Array,
      default: () => ([])
    },
    userFilters:{
      type: Array,
      default: () => ([])
    },
  }
}