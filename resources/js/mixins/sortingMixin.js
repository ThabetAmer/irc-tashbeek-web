export default {
  props: {},
  methods: {
    handleSort(head) {
      if (this.sorting['type'] === 'asc') {
        this.sorting['type'] = 'desc'
      }
      else {
        this.sorting['type'] = 'asc'
      }
      this.sorting['columnField'] = head.name
      this.$emit('sortChange')
    }
  },
  computed: {}
}