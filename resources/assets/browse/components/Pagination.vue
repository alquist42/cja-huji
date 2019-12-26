<template>
    <div v-if="hasPagination" class="my-1">
        <ul class="pagination pagination-sm justify-content-center flex-wrap">
            <li v-if="meta.prev_page_url" class="page-item"><a class="page-link" href="#" @click.prevent="$emit('paginate', meta.current_page - 1)" rel="prev">&laquo;</a></li>
            <li v-else class="page-item disabled"><span class="page-link">&laquo;</span></li>

            <template v-for="n in meta.last_page">
                <li v-if="meta.current_page === n" class="active page-item"><span class="page-link">{{ n }}</span></li>
                <li v-else-if="show(n)" class="page-item"><a class="page-link" href="#" @click.prevent="$emit('paginate', n)">{{ n }}</a></li>
            </template>

            <li v-if="meta.next_page_url" class="page-item"><a class="page-link" href="#" @click.prevent="$emit('paginate', meta.current_page + 1)" rel="next">&raquo;</a></li>
            <li v-else class="page-item disabled"><span class="page-link">&raquo;</span></li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            meta: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                current_page: 1,
                from: 1,
                last_page: 7,
                next_page_url: "http://localhost:8083/api/items?page=2",
                path: "http://localhost:8083/api/items",
                per_page: 20,
                prev_page_url: null,
                to: 20,
                total: 122
            }
        },

        computed: {
            show() {
                return n => (n < 10 || (n >= 10 && n < 100 && n % 10 === 0) || (n % 100 === 0) || n == this.meta.last_page)
            },
            hasPagination() {
                return this.meta.current_page && !(!this.meta.next_page_url && !this.meta.prev_page_url)
            }
        }

    }
</script>
