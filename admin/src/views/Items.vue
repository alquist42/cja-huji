<template>
  <v-container
    fluid
    tag="section"
  >
    <dashboard-core-app-bar :loading="isLoading">
      <template #controls>
        <v-btn
          outlined
          color="success"
          @click="$router.push({ name: 'ItemCreate' })"
        >
          New Item
        </v-btn>
      </template>
    </dashboard-core-app-bar>
    <v-row justify="center">
      <v-col cols="12">
        <v-data-table
          dense
          :headers="headers"
          :items="items"
          class="elevation-1"
          v-model="selected"
          :options.sync="options"
          :server-items-length="totalItems"
          :footer-props="{ itemsPerPageOptions: [5, 10, 15, 25, 50, 100] }"
        >
          <template v-slot:item.images="{ item }">
            <template
              v-for="image in item.images"
            >
              <v-avatar
                :key="image.id"
                class="profile clickable"
                color="grey"
                size="48"
                tile
                @click="editItem(item.id)"
              >
                <v-img :src="`/images/${item.id}-${image.id}-thumb.png`" />
              </v-avatar>
            </template>
          </template>
          <template v-slot:item.name="{ item }">
            <div
              class="text-no-wrap fill-height clickable"
              @click="editItem(item.id)"
            >
              {{ item.name }}
            </div>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: 'Items',

    components: {
      DashboardCoreAppBar: () => import('./dashboard/components/core/AppBar'),
    },

    data: () => ({
      items: [],
      selected: [],
      headers: [
        {
          value: 'images',
          sortable: false,
        },
        { text: 'Name', value: 'name' },
        // {
        //   text: 'Parent', value: 'parent_id',
        // },
        {
          text: 'Date', value: 'date',
        },
        {
          text: 'Publish State',
          value: 'publish_state',
          class: 'text-no-wrap',
        },
        // {
        //   text: 'Publish Reason',
        //   value: 'publish_state_reason',
        //   class: 'text-no-wrap',
        // },
        { text: 'Category', value: 'category' },
      ],
      isLoading: false,
      options: {},
      totalItems: 0,
    }),

    computed: {
      opts () {
        return this.items.map(d => {
          Object.keys(d).forEach(function (key) {
            if (d[key] === null) {
              d[key] = ''
            }
          })
          return d
        })
      },

      page () {
        return this.$route.query.page ? parseInt(this.$route.query.page) : 1
      },

      itemsPerPage () {
        return this.$route.query.per_page ? parseInt(this.$route.query.per_page) : 25
      },

      sortBy () {
        return this.$route.query.sort_by || ''
      },

      sortDesc () {
        return this.$route.query.desc === '1' ? '1' : '0'
      },
    },

    watch: {
      options: {
        deep: true,
        handler (val) {
          let update = false
          const query = { ...this.$route.query }

          if (this.page !== val.page) {
            update = true
            query.page = val.page
          }

          if (this.itemsPerPage !== val.itemsPerPage) {
            update = true
            query.per_page = val.itemsPerPage
          }

          const sortBy = val.sortBy.length ? val.sortBy[0] : ''
          if (this.sortBy !== sortBy) {
            update = true
            query.sort_by = sortBy
          }

          let sortDesc = '0'
          if (val.sortDesc.length) {
            sortDesc = val.sortDesc[0] ? '1' : '0'
          }
          if (this.sortDesc !== sortDesc) {
            update = true
            query.desc = sortDesc
          }

          if (update) {
            this.$router.replace({
              name: this.$route.name,
              query,
            })
            this.getItems()
          }
        },
      },
    },

    created () {
      this.options.page = this.page
      this.options.itemsPerPage = this.itemsPerPage
      this.options.sortBy = this.sortBy ? [this.sortBy] : []
      this.options.sortDesc = this.sortDesc === '1' ? [true] : [false]
      this.getItems()
    },

    methods: {
      async getItems () {
        this.isLoading = true
        const { data } = await this.$http.get(`items?&project=catalogue&page=${this.page}&per_page=${this.itemsPerPage}&sort_by=${this.sortBy}&desc=${this.sortDesc}`)
        this.items = data.data
        this.totalItems = data.total
        this.isLoading = false
      },

      editItem (id) {
        this.isLoading = true
        this.$router.push({ name: 'Item', params: { id } })
      },
    },
  }
</script>

<style scoped>
  .clickable {
    cursor: pointer;
  }
</style>
