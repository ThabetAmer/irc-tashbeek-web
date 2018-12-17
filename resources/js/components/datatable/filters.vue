<template>
  <!--
    -->
  <div class="flex flex-wrap mb-8">
    <template v-for="filter in filters">
      <CustomInput
        v-if="filter.type === 'string'"
        :key="filter.name+'-'+filter.type"
        input-class="height-align
        mb-2 mr-2 p-2 text-grey-darkest font-bold
        w-1/5 bg-grey-lighter rounded"
        :value="textValue"
        :placeholder="filter.name"
      />

      <CustomSelect
        v-if="filter.type === 'select'"
        :key="filter.name+'-'+filter.type"
        v-model="value"
        :label="'name'"
        track-by="name"
        :options="filter.options"
        custom-class="mb-2 note-select mr-2 w-1/5"
        @select="handleSelect"
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
                type: [Object, Array],
                default: () => [
                    {
                        name: 'location',
                        type: 'string'
                    },
                    {
                        name: 'Name',
                        type: 'string'
                    },
                    {
                        name: 'Language2',
                        type: 'select',
                        options: [
                            {name: 'Vue.js', language: 'JavaScript'},
                            {name: 'Rails', language: 'Ruby'},
                            {name: 'Sinatra', language: 'Ruby'},
                            {name: 'Laravel', language: 'PHP'},
                            {name: 'Phoenix', language: 'Elixir'}
                        ],
                    },
                    {
                        name: 'job type',
                        type: 'string'
                    },
                    {
                        name: 'Language',
                        type: 'select',
                        options: [
                            {name: 'Vue.js', language: 'JavaScript'},
                            {name: 'Rails', language: 'Ruby'},
                            {name: 'Sinatra', language: 'Ruby'},
                            {name: 'Laravel', language: 'PHP'},
                            {name: 'Phoenix', language: 'Elixir'}
                        ],
                    }
                ]
            }
        },
        data() {
            return{
                textValue: '',
                value: ''
            }

        },
        methods: {
            handleSelect(select) {
                this.value = select;
            }
        }
    }
</script>

<style lang="scss">

</style>