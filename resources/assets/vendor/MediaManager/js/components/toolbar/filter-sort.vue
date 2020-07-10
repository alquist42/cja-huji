<template>
    <my-dropdown :disabled="disabled">
        <template v-slot:title>
            {{ trans('filtration') }}
        </template>

        <template v-slot:content>
            <!-- filters -->
            <div v-for="item in filters"
                 :key="`filter-${item}`"
                 class="dropdown-item"
                 :class="[
                     filterNameIs(item) ? 'has-text-weight-bold has-text-link' : 'has-text-grey-dark',
                     haveFileType(item) ? 'link' : 'has-text-grey-light disabled'
                 ]"
                 @click.stop="setFilterName(item)">
                {{ trans(item) }}
            </div>

            <!-- custom filters -->
            <hr class="dropdown-divider">
            <div v-for="item in customFilters"
                 :key="`filter-${item.key}`"
                 class="dropdown-item link"
                 :class="[
                     customFilterNameIs(item.key) ? 'has-text-weight-bold has-text-link' : 'has-text-grey-dark'
                 ]"
                 @click.stop="setCustomFilterName(item.key)">
                {{ item.text }}
            </div>

            <!-- sorts -->
            <hr class="dropdown-divider">
            <div v-for="item in sorts"
                 :key="`sort-${item}`"
                 class="dropdown-item link"
                 :class="sortNameIs(item) ? 'has-text-weight-bold has-text-link' : 'has-text-grey-dark'"
                 @click.stop="setSortName(item)">
                {{ trans(item) }}
            </div>
        </template>
    </my-dropdown>
</template>

<script>
export default {
    props: [
        'setFilterName',
        'setCustomFilterName',
        'filterNameIs',
        'customFilterNameIs',
        'setSortName',
        'sortNameIs',
        'disabled',
        'haveAFileOfType',
        'trans',
        'inModal'
    ],

    data() {
        return {
            filters: [
                'image',
                'video',
                'audio',
                'folder',
                'text',
                'application',
                'locked',
                'selected',
                'non'
            ],
            sorts: [
                'name',
                'size',
                'last_modified',
                'non'
            ]
        }
    },

    computed: {
        customFilters() {
            const commonItems = [
                {
                    key: 'orphans',
                    text: 'Orphans',
                },
            ]
            const modalItems = [
                {
                    key: 'item-s',
                    text: 'Item\'s',
                },
                {
                    key: 'whole-tree',
                    text: 'Whole Tree',
                },
            ]

            return commonItems.concat(this.inModal ? modalItems : [])
        }
    },

    methods: {
        haveFileType(val) {
            if (val == 'non') {
                return true
            }

            return this.haveAFileOfType(val)
        }
    }
}
</script>
