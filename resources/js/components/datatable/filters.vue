<template>
  <!--
    -->
  <div class="flex flex-wrap mb-8">
    <template v-for="filter in filters">
      <CustomInput
        v-if="filter.type === 'text'"
        :key="filter.name+'-'+filter.type"
        input-class="height-align
        mb-2 mr-2 p-2 text-grey-darkest font-bold
        w-1/7 bg-grey-lighter rounded"
        :value="textValue"
        :placeholder="filter.label"
        @input="handleTextInput(filter.name,$event)"
      />

      <CustomSelect
        v-if="filter.type === 'select'"
        :key="filter.name+'-'+filter.type"
        v-model="value"
        :label="'label'"
        track-by="value"
        :options="filter.options"
        :placeholder="filter.label"
        custom-class="mb-2 note-select mr-2 w-1/7"
        @select="handleSelect(filter.name,$event)"
      />
    </template>
  </div>
</template>


<script>

  import CustomInput from '../input/input'
  import CustomSelect from '../select/select'

  export default {
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    components: {CustomInput, CustomSelect},
    mixins: [],
    props: {
      filters: {
        type: Array,
        default: () => []
      }
    },
    data() {
      return {
        textValue: '',
        value: ''
      }

    },
    methods: {
      handleSelect(name, selected) {
        this.$emit('change', {
          name,
          value: selected.value
        })
      },
      handleTextInput(name, value) {
        this.$emit('change', {
          name,
          value
        })
      }
    }
  }
</script>

<style lang="scss">

</style>