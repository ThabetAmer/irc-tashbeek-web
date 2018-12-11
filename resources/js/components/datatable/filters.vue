<template>
    <!--
    -->
    <div class="flex flex-wrap mb-8">
        <template v-for="filter in filters">
            <customInput input-class="height-align
                                    mb-2 mr-2 p-2 text-grey-darkest font-bold
                                    w-1/5 bg-grey-lighter rounded"
                         :value="textValue"
                         :placeholder="filter.name"
                         v-if="filter.type === 'string'">

            </customInput>

            <customSelect
                    :label="'name'"
                    track-by="name"
                    :options="filter.options"
                    v-model="value"
                    @select="handleSelect"
                    customClass="mb-2 note-select mr-2 w-1/5" v-if="filter.type === 'select'">

            </customSelect>

        </template>
    </div>

</template>


<script>

    import customInput from '../input/input'
    import customSelect from '../select/select'

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        components: {customInput, customSelect},
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
                        name: 'select',
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
                        name: 'select',
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
        },
        mixins: []
    }
</script>

<style lang="scss">

</style>