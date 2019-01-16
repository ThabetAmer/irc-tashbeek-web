<template>
  <div>
    <ul
      v-if="totalPages > 1"
      class="flex list-reset w-auto font-sans pagination"
    >
      <li class="pagination-item">
        <Btn
          class="no-underline block hover:text-blue hover:bg-grey-lighter bg-white text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
          type="button"
          :disabled="isInFirstPage"
          aria-label="Go to first page"
          @click="onClickFirstPage"
        >
          <template slot="text">
            {{ 'irc.first_page' | trans }}
          </template>
        </Btn>
      </li>
      <li class="pagination-item">
        <Btn
          class="no-underline block hover:text-blue hover:bg-grey-lighter  text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
          type="button"
          :disabled="isInFirstPage"
          aria-label="Go to previous page"
          @click="onClickPreviousPage"
        >
          <template slot="text">
            {{ 'irc.prev_page' | trans }}
          </template>
        </Btn>
      </li>
      <li
        v-for="page in pages"
        :key="page.name"
        class="pagination-item"
      >
        <Btn
          class="no-underline block  border border-grey-light rounded  px-1 py-1 mr-2"
          type="button"
          :disabled="page.isDisabled"
          :btn-class="{ 'bg-grey-light hover:bg-grey-light text-green-dark active': isPageActive(page.name), 'hover:text-blue hover:bg-grey-lighter text-grey-dark':!isPageActive(page.name) }"
          :aria-label="`Go to page number ${page.name}`"
          @click="onClickPage(page.name)"
        >
          <template slot="text">
            {{ page.name }}
          </template>
        </Btn>
      </li>
      <li class="pagination-item">
        <Btn
          class="no-underline block hover:text-blue hover:bg-grey-lighter bg-white text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
          type="button"
          :disabled="isInLastPage"
          aria-label="Go to next page"
          @click="onClickNextPage"
        >
          <template slot="text">
            {{ 'irc.next_page' | trans }}
          </template>
        </Btn>
      </li>
      <li class="pagination-item">
        <Btn
          class="no-underline block hover:text-blue hover:bg-grey-lighter bg-white text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
          type="button"
          :disabled="isInLastPage"
          aria-label="Go to last page"
          @click="onClickLastPage"
        >
          <template slot="text">
            {{ 'irc.last_page' | trans }}
          </template>
        </Btn>
      </li>

      <li
        v-if="perPageEnabled"
        class="ml-auto flex items-center pagination-select"
      >
        <div class="mr-2">
          {{ 'irc.rows_per_page' | trans }}
        </div>
        <div>
          <CustomSelect
            :options="perPageOptions"
            track-by="value"
            placeholder="rows per page"
            :value="perPage"
            @select="handlePerPage($event.value)"
          />
        </div>
      </li>
    </ul>
  </div>
</template>
<script>

  export default {
    name: 'Pagination',
    props: {
      perPageEnabled:{
        type:Boolean,
        default: true
      },
      maxVisibleButtons: {
        type: Number,
        required: false,
        default: 5
      },
      totalPages: {
        type: Number,
        required: true
      },
      total: {
        type: Number,
        required: true
      },
      perPage: {
        type: Number,
        required: true
      },
      currentPage: {
        type: Number,
        required: true
      },
    },
    data() {
      return {
        perPageOptions: [
          {
            label: "15",
            value: 15
          },
          {
            label: "30",
            value: 30
          },
          {
            label: "50",
            value: 50
          }
        ]

      }
    },
    computed: {
      startPage() {
        if (this.currentPage === 1) {
          return 1;
        }
        if (this.currentPage === this.totalPages) {
          let total = this.totalPages - this.maxVisibleButtons + 1;
          return total < 1 ? 1 : total;
        }
        return this.currentPage - 1;
      },
      endPage() {
        return Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
      },
      pages() {
        const range = [];
        for (let i = this.startPage; i <= this.endPage; i += 1) {
          range.push({
            name: i,
            isDisabled: i === this.currentPage
          });
        }
        return range;
      },
      isInFirstPage() {
        return this.currentPage === 1;
      },
      isInLastPage() {
        return this.currentPage === this.totalPages;
      },
    },
    methods: {
      handlePerPage($event) {
        this.$emit('perPage', $event);

      },
      onClickFirstPage() {
        this.$emit('pagechanged', 1);
      },
      onClickPreviousPage() {
        this.$emit('pagechanged', this.currentPage - 1);
      },
      onClickPage(page) {
        this.$emit('pagechanged', page);
      },
      onClickNextPage() {
        this.$emit('pagechanged', this.currentPage + 1);
      },
      onClickLastPage() {
        this.$emit('pagechanged', this.totalPages);
      },
      isPageActive(page) {
        return this.currentPage === page;
      },
    }
  };
</script>
<style scoped>
</style>