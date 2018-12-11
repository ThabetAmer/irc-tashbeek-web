<template>
    <!--
    -->
    <div class="">
        <filters></filters>
        <table class="w-full text-left table-striped mb-8">
            <thead>
            <tr class="font-bold text-green-dark">
                <th class="pb-2" v-for="head in header">{{head}}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in rows" class="font-bold text-black  border-grey-light border-b-2">
                <td class="py-4" v-for="data in row">{{data}}</td>
            </tr>
            </tbody>

        </table>
        <pagination
                totalPages="4"
                total="4"
                perPage="10"
                currentPage="1"
        ></pagination>

    </div>

</template>


<script>
    import filters from './filters';
    import pagination from './pagination';

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        components:{filters,pagination},
        props: {
            header: {
                type: [String, Array],
                default:()=> ['Head1', 'Head2', 'Head3', 'Head4']
            },
            rows: {
                type: [String, Array],
                default:()=> [
                    [
                        'Row Data',
                        'Row Data',
                        'Row Data',
                        'Row Data'
                    ],
                    [
                        'Row Data',
                        'Row Data',
                        'Row Data',
                        'Row Data'
                    ],
                    [
                        'Row Data',
                        'Row Data',
                        'Row Data',
                        'Row Data'
                    ],
                    [
                        'Row Data',
                        'Row Data',
                        'Row Data',
                        'Row Data'
                    ]
                ]
            }
        },
        mixins: []
    }
</script>

<style lang="scss">

</style>