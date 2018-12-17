<template>
  <!--
    -->
  <div class="flex flex-wrap mb-8">
    <template v-for="filter in getSelectedFilters">
      <CustomInput
        v-if="filter.type === 'string'"
        :key="filter.name+'-'+filter.type"
        input-class="height-align
        mb-2 mr-2 p-2 text-grey-darkest font-bold
        w-1/7 bg-grey-lighter rounded"
        :value="textValue"
        :placeholder="filter.name"
      />

      <CustomSelect
        v-if="filter.type === 'select'"
        :key="filter.name+'-'+filter.type"
        v-model="value"
        :label="'name'"
        track-by="name"
        :placeholder="filter.name"
        :options="filter.options"
        custom-class="mb-2 note-select mr-2 w-1/7"
        @select="handleSelect"
      />
    </template>
    <CustomSelect
      v-model="usedFilters"
      :label="'name'"
      track-by="name"
      :options="filters"
      placeholder="more"
      :multiple="`true`"
      custom-class="mb-2 note-select mr-2 w-1/7 filter-selector"
      @select="handleSelect"
    />
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
        type: [Object, Array],
        default: () => [
          {
            name: 'location',
            type: 'string'
          },
          {
            name: 'Nationality',
            type: 'string'
          },
          {
            name: 'job type',
            type: 'string'
          },
          {
            name: 'gender',
            type: 'select',
            options: [
              {name: 'male', language: 'male'},
              {name: 'female', language: 'female'},
            ],
          }
        ]
      }
    },
    data() {
      return {
        textValue: '',
        value: '',
        usedFilters: [
          {
            name: 'gender',
            type: 'select',
            options: [
              {name: 'male', language: 'male'},
              {name: 'female', language: 'female'},
            ],
          }
        ]

      }

    },
    computed: {
      getSelectedFilters() {
        let _self = this;
        if (this.filters) {
          return _self.filters.filter(function (filter) {
            return _self.usedFilters.find(x => x.name === filter.name);
          })
        }
        return [];
      }
    },
    methods: {
      handleSelect(select) {
        this.value = select;
      },
      handleSelectMul(selected) {
        console.log('selected is ', selected);
        // this.value = selected;
      }
    }
  }
</script>

<style lang="scss">

</style>