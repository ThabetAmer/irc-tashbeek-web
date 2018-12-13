<template>
    <!--
    -->
    <div class="">
        <filters
                v-if="hasFilters"
        ></filters>
        <table class="w-full text-left table-striped mb-8">
            <thead>
            <tr class="font-bold text-green-dark">
                <th class="pb-2" v-for="head in header">{{head}}</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="row in rows" class="font-bold text-black  border-grey-light border-b-2">

                <td class="py-4" v-for="data in filterRow(row)">{{data}}</td>
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
                _.map(Object.keys(row),function (rData) {
                    _.each(_self.header, function (head) {
                        if(head == rData ){
                            newRow[head] = row[head]
                        }
                    })
                });
                return newRow;
            }
        },
        filters: {},
        props: {
            hasPagination: {
                type: [Boolean, String],
                default: true
            },
            hasFilters: {
                type: [Boolean, String],
                default: true
            },
            header: {
                type: [String, Array],
                default: () => ['name', 'old']
            },
            rows: {
                type: [String, Array],
                default: () => [
                    {
                        id: 1,
                        name: 'Ahmad',
                        test: 'ali',
                        old: 'Old'
                    },
                    {
                        id: 1,
                        name: 'Ahmad',
                        test: 'ali',
                        old: 'Old'
                    },
                    {
                        id: 1,
                        name: 'Ahmad',
                        test: 'ali',
                        old: 'Old'
                    },
                    {
                        id: 1,
                        name: 'Ahmad',
                        test: 'ali',
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