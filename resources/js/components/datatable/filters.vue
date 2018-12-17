<template>
  <div class="flex flex-wrap mb-8">
    <template v-for="filter in userFilters">
      <CustomInput
        v-if="filter.type === 'text'"
        :key="filter.name+'-'+filter.type"
        input-class="height-align
        mb-2 mr-2 p-2 text-grey-darkest font-bold
        w-1/7 bg-grey-lighter rounded"
        :placeholder="filter.label"
        @input="handleTextInput(filter.name,$event)"
      />
      <CustomSelect
        v-if="filter.type === 'select'"
        :key="filter.name+'-'+filter.type"
        label="label"
        track-by="value"
        :options="filter.options"
        :placeholder="filter.label"
        custom-class="mb-2 note-select mr-2 w-1/7"
        @select="handleSelect(filter.name, $event)"
      />
    </template>
    <CustomSelect
      label="label"
      track-by="name"
      :options="filters"
      placeholder="More"
      :multiple="true"
      custom-class="mb-2 note-select mr-2 w-1/7 filter-selector"
      @select="handleFilterSelect"
    />
  </div>
</template>


<script>

  import CustomInput from '../input/input'
  import CustomSelect from '../select/select'
  import HasFilters from "../../mixins/HasFilters";

  export default {
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    components: {CustomInput, CustomSelect},
    mixins: [HasFilters],
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
      },
      handleFilterSelect(select) {
        this.$emit('filterSelect', {
          name: select.name
        })
      }
    }
  }
</script>

<style lang="scss">

</style>