export default {
  data() {
    return {
      sorting: {
        type: null,
        column: null
      }
    }
  },
  methods: {
    handleSort(column,callback) {
      this.sorting = {
        column,
        type: this.sorting.type === 'asc' ? this.sorting.type = 'desc' : this.sorting.type = 'asc'
      }
      if (callback && typeof callback === 'function') {
        callback()
      }

    }
  },
}