<template>
    <!--
    -->
    <div class="">
        <filters
                v-if="hasFilters"
        ></filters>
        <table :class="[`w-full text-left`,{'table-striped' : striped,'scrollable-fixed-header' : fixedHeader} ,'mb-8']">
            <thead>
            <tr class="font-bold text-green-dark">
                <th class="pb-2 pl-1" v-for="head in header">{{head['translations']['en']}}</th>
                <th class="pb-2 px-4 pl-1"></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="row in rows" class="font-bold text-black  border-grey-light border-b-2">

                <td class="py-4 pl-2" v-for="data in filterRow(row)">{{data}}</td>
                <td class="py-4 px-4 pl-2">
                    <button class="flex-1 text-xl  text-green-dark">
                        <i class="far fa-file-alt"></i>
                    </button>
                </td>
            </tr>
            </tbody>

        </table>
        <pagination
                v-if="hasPagination"
                totalPages="4"
                total="4"
                perPage="10"
                currentPage="1"
        ></pagination>

    </div>

</template>


<script>
    import Vue from 'vue'
    import filters from './filters';
    import pagination from './pagination';
    import _ from 'underscore';

    Vue.use(_);
    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        components: {filters, pagination},
        methods: {
            filterRow(row) {
                let _self = this;
                let newRow = {};
                _.map(Object.keys(row), function (rData) {
                    _.each(_self.header, function (head) {
                        if (head.name == rData) {
                            newRow[head.name] = row[head.name]
                        }
                    })
                });
                return newRow;
            }
        },
        filters: {},
        props: {
            fixedHeader:{
                type: [Boolean, String],
                default: false
            },
            hasPagination: {
                type: [Boolean, String],
                default: true
            },
            hasFilters: {
                type: [Boolean, String],
                default: true
            },
            striped: {
                type: [Boolean, String],
                default: true
            },
            header: {
                type: [String, Array],
                default: () => [
                    {
                        name: 'test',
                        translations: {
                            en: 'test'
                        }
                    },
                    {
                        name: 'old',
                        translations: {
                            en: 'Old'
                        }
                    },
                    {
                        name: 'id',
                        translations: {
                            en: 'ID'
                        }
                    },
                    {
                        name: 'name',
                        translations: {
                            en: 'Name'
                        }
                    }
                ]
            },
            rows: {
                type: [String, Array],
                default: () => [
                    {
                        id: 1,
                        name: 'Boutros Baqaeen',
                        test: 'Monthy follow-up',
                        old: 'Old'
                    },
                    {
                        id: 1,
                        name: 'Boutros Baqaeen',
                        test: 'Monthy follow-up',
                        old: 'Old'
                    },
                    {
                        id: 1,
                        name: 'Boutros Baqaeen',
                        test: 'Monthy follow-up',
                        old: 'Old'
                    },
                    {
                        id: 1,
                        name: 'Boutros Baqaeen',
                        test: 'Monthy follow-up',
                        old: 'Old'
                    }
                ]
            }
        },
        mixins: []
    }
</script>

<style lang="scss">

</style>