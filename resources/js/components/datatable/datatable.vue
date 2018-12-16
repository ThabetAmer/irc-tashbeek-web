<template>
  <!--
    -->
  <div class="">
    <Filters
      v-if="hasFilters"
    />
    <table :class="[`w-full text-left`,{'table-striped' : striped,'scrollable-fixed-header' : fixedHeader} ,'mb-8']">
      <thead>
        <tr class="font-bold text-green-dark">
          <th
            v-for="head in header"
            :key="head.name"
            class="pb-2 pl-1"
          >
            {{ head['translations']['en'] }}
          </th>
          <th class="pb-2 px-4 pl-1" />
        </tr>
      </thead>

      <tbody>
        <tr
          v-for="row in rows"
          :key="row.id"
          class="font-bold text-black  border-grey-light border-b-2"
        >
          <td
            v-for="data in filterRow(row)"
            :key="data"
            class="py-4 pl-2"
          >
            {{ data }}
          </td>
          <td class="py-4 px-4 pl-2">
            <button class="flex-1 text-xl  text-green-dark">
              <i class="far fa-file-alt" />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <Pagination
      v-if="hasPagination"
      total-pages="4"
      total="4"
      per-page="10"
      current-page="1"
    />
  </div>
</template>


<script>
  import Vue from 'vue'
  import Filters from './filters';
  import Pagination from './pagination';
  import _ from 'underscore';

  Vue.use(_);
  export default {
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    components: {Filters, Pagination},
    filters: {},
    mixins: [],
    props: {
      fixedHeader: {
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
    }
  }
</script>

<style lang="scss">

</style>