<template>
  <!--
        checkbox group which uses the
        original checkbox component
        which returns an array that has the
        selected objects
    -->
  <div
    :class="`${display==='inline' ? 'inline-flex mr-2':''}`"
  >
    <CheckboxField
      v-for="checkbox in checkboxes"
      :key="checkbox.value"
      :label="checkbox.label"
      label-class="pt-1"
      :check-id="checkbox.value"
      :checked="checkbox.checked"
      :disabled="disabled"
      @change="checkboxChange(checkbox,$event)"
    />
  </div>
</template>


<script>
  export default {
    /**
     * the only passed prop to the group
     * is the array of checkbox objects
     * each of these objects will contain
     * value and label. Label is to display label
     * and value is a unique value for the checkbox
     *
     * The only data is the checkboxValue which
     * has an array of all the checked OBJECTS.
     */
    props: {
      checkboxes: {
        type: Array,
        default: () => []
      },
      display: {
        type: String,
        default: ''
      },
      disabled:{
        type:Boolean,
        default:false
      }
    },
    data() {
      return {
        selections: []
      }
    },
    watch:{
      checkboxes: function(newValue){
        this.selections =  newValue.filter(checkbox => checkbox.checked === true);
      }
    },
    mounted(){
      this.selections = [...this.checkboxes.filter(checkbox => checkbox.checked === true)]
    },
    methods: {
      checkboxChange(option, value) {
        const index = this.selections.findIndex(item => item.value === option.value)

        if (value) {
          this.selections.push(option)
        }
        else {
          this.selections.splice(index, 1)
        }

        this.$emit('change', this.selections)
      }
    }

  }
</script>

<style lang="scss">

</style>