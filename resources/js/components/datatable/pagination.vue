<template>
    <ul v-if="totalPages > 1" class="flex list-reset w-auto font-sans pagination">
        <li class="pagination-item">
            <btn
                    class="no-underline block hover:text-blue hover:bg-blue bg-white text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
                    type="button"
                    @click="onClickFirstPage"
                    :disabled="isInFirstPage"
                    aria-label="Go to first page">
                <template slot="text">
                    First
                </template>
            </btn>
        </li>
        <li class="pagination-item">
            <btn
                    class="no-underline block hover:text-blue hover:bg-blue bg-white text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
                    type="button"
                    @click="onClickPreviousPage"
                    :disabled="isInFirstPage"
                    aria-label="Go to previous page">
                <template slot="text">
                    Previous
                </template>
            </btn>
        </li>
        <li v-for="page in pages" class="pagination-item">
            <btn
                    class="no-underline block  bg-white  border border-grey-light rounded  px-1 py-1 mr-2"
                    type="button"
                    @click="onClickPage(page.name)"
                    :disabled="page.isDisabled"
                    :class="{ 'bg-blue text-green-dark active': isPageActive(page.name), 'hover:text-blue hover:bg-blue text-grey-dark':!isPageActive(page.name) }"
                    :aria-label="`Go to page number ${page.name}`">
                <template slot="text">
                    {{ page.name }}
                </template>

            </btn>
        </li>
        <li class="pagination-item">
            <btn
                    class="no-underline block hover:text-blue hover:bg-blue bg-white text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
                    type="button"
                    @click="onClickNextPage"
                    :disabled="isInLastPage"
                    aria-label="Go to next page"
            >
                <template slot="text">
                   Next
                </template>
            </btn>
        </li>
        <li class="pagination-item">
            <btn
                    class="no-underline block hover:text-blue hover:bg-blue bg-white text-green-dark border border-grey-light rounded  px-1 py-1 mr-2"
                    type="button"
                    @click="onClickLastPage"
                    :disabled="isInLastPage"
                    aria-label="Go to last page">
                <template slot="text">
                    Last
                </template>
            </btn>
        </li>
    </ul>
</template>
<script>
    import btn from '../button/button'
    export default {
        name: 'pagination',
        components:{btn},
        props: {
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
                console.log(' page is ',page, ' curr is ',this.currentPage);
                return this.currentPage == page;
            },
        }
    };
</script>
<style scoped>
</style>