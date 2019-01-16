<template>
  <div class="flex flex-wrap mb-8">
    <template v-for="filter in userFilters">
      <CustomSelect
        v-if="filter.type === 'select'"
        :key="filter.name+'-'+filter.type"
        label="label"
        track-by="value"
        :has-remove="true"
        :value="getOptionValue(filter)"
        :options="filter.options"
        :placeholder="filter.label"
        wrapper-class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/7  pr-2 h-50"
        custom-class="mb-2 note-select filter-input multiselect-with-remove"
        @clear="handleClear(filter.name)"
        @select="handleSelect(filter.name, $event)"
      />
      <DatePicker
        v-else-if="filter.type === 'date'"
        :key="filter.name+'-'+filter.type"
        lang="en"
        :value="filter.filterValue"
        wrapper-class="sm:w-full md:w-1/2 lg:w-1/3  xl:w-1/7  pr-2 h-50"
        input-class="height-align text-sm
        mb-2 mr-2 p-2 text-grey-darkest font-bold
        w-full bg-grey-lighter rounded"
        :clear-button="true"
        format="yyyy-MM-dd"
        :placeholder="filter.label"
        clear-button-icon="icon-X_x40_2xpng_2"
        custom-class="mb-2 note-select filter-input multiselect-with-remove"
        @cleared="handleClear(filter.name)"
        @input="handleTextInput(filter.name,$event)"
      />
      <TextInput
        v-else
        :key="filter.name+'-'+filter.type"
        input-class="height-align
        mb-2 mr-2 p-2 text-grey-darkest font-bold
        w-full bg-grey-lighter rounded"
        wrapper-class="sm:w-full md:w-1/2 lg:w-1/3  xl:w-1/7   pr-2 h-50"
        :has-remove="true"
        :placeholder="filter.label"
        :value="filter.filterValue"
        @clear="handleClear(filter.name)"
        @input="handleTextInput(filter.name,$event)"
      />
    </template>
    <FilterSelect
      label="label"
      track-by="name"
      :filters="filters"
      :user-filters="userFilters"
      placeholder="More"
      :multiple="true"
      custom-class="mb-2 note-select pr-2 sm:w-full md:w-1/2 lg:w-1/3  xl:w-1/7 filter-selector"
      @select="handleFilterSelect"
    />
  </div>
</template>

<script>
  import FilterSelect from './FilterSelect'
  import HasFilters from "../mixins/HasFilters";
  import DatePicker from 'vuejs-datepicker'

  export default {
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    components: {FilterSelect,DatePicker },
    mixins: [HasFilters],
    data(){
      return{
        vall:''
      }
    },
    methods: {
      inputDate(eve){
        console.log(' dd ',eve);
        this.val = eve;
      },
      handleSelect(name, selected) {
        this.$emit('change', {
          name,
          value: selected.value
        })
      },
      handleClear(name){
        this.$emit('change', {
          name,
          value:null
        })
      },
      handleTextInput(name, value) {
        console.log(' val is ', value);
        this.$emit('change', {
          name,
          value
        })
      },
      handleFilterSelect(select) {
        this.$emit('filterSelect', {
          name: select.name
        })
      },
      getOptionValue(filter){
        if(!filter.filterValue){
          return undefined
        }

        const optionIndex = filter.options.findIndex(option => option.value == filter.filterValue )

        if(optionIndex === -1){
          return undefined
        }

        return {
          ...filter.options[optionIndex]
        }
      }
    }
  }
</script>

<style lang="scss">

</style>