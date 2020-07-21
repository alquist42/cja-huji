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
          show-select
          :options.sync="options"
          :server-items-length="totalItems"
          :footer-props="{ itemsPerPageOptions: [5, 10, 15, 25, 50, 100] }"
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Sets</v-toolbar-title>
            </v-toolbar>
          </template>
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
                <v-img :src="`http://cja.huji.ac.il/${image.small || image.medium || image.def || image.batch_url}`" />
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
          <template v-slot:item.locations="{ item }">
            <template
              v-for="location in item.locations"
            >
              <v-chip
                :key="location.id"
                color="primary"
                label
                small
              >
                {{ location.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.communities="{ item }">
            <template
              v-for="community in item.communities"
            >
              <v-chip
                :key="community.id"
                color="primary"
                label
                small
              >
                {{ community.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.origins="{ item }">
            <template
              v-for="origin in item.origins"
            >
              <v-chip
                :key="origin.id"
                color="primary"
                label
                small
              >
                {{ origin.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.origin_details="{ item }">
            <template
              v-for="detail in item.origin_details"
            >
              <v-chip
                :key="detail.id"
                color="primary"
                label
                small
              >
                {{ detail.details }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.schools="{ item }">
            <template
              v-for="school in item.schools"
            >
              <v-chip
                :key="school.id"
                color="primary"
                label
                small
              >
                {{ school.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.objects="{ item }">
            <template
              v-for="object in item.objects"
            >
              <v-chip
                :key="object.id"
                color="primary"
                label
                small
              >
                {{ object.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.subjects="{ item }">
            <template
              v-for="subject in item.subjects"
            >
              <v-chip
                :key="subject.id"
                color="primary"
                label
                small
              >
                {{ subject.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.historical_origins="{ item }">
            <template
              v-for="historical_origin in item.historical_origins"
            >
              <v-chip
                :key="historical_origin.id"
                color="primary"
                label
                small
              >
                {{ historical_origin.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.periods="{ item }">
            <template
              v-for="period in item.periods"
            >
              <v-chip
                :key="period.id"
                color="primary"
                label
                small
              >
                {{ period.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.collections="{ item }">
            <template
              v-for="collection in item.collections"
            >
              <v-chip
                :key="collection.id"
                color="primary"
                label
                small
              >
                {{ collection.name }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.collection_details="{ item }">
            <template
              v-for="detail in item.collection_details"
            >
              <v-chip
                :key="detail.id"
                color="primary"
                label
                small
              >
                {{ detail.details }}
              </v-chip>
            </template>
          </template>
          <template v-slot:item.makers="{ item }">
            <template
              v-for="maker in item.makers"
            >
              <v-chip
                :key="maker.id"
                color="primary"
                label
                small
              >
                {{ maker.artist.name }} [{{ maker.profession.name }}]
              </v-chip>
            </template>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon
              small
              class="mr-2"
              @click="editItem(item.id)"
            >
              mdi-pencil
            </v-icon>
            <v-icon
              small
            >
              mdi-delete
            </v-icon>
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
        { text: 'Locations', value: 'locations' },
        { text: 'Communities', value: 'communities' },

        {
          text: 'Origins', value: 'origins',
        },
        {
          text: 'Origin Details',
          value: 'origin_details',
          class: 'text-no-wrap',
        },
        {
          text: 'Schools', value: 'schools',
        },
        {
          text: 'Objects', value: 'objects',
        },
        {
          text: 'Subjects', value: 'subjects',
        },
        {
          text: 'Historical Origins',
          value: 'historical_origins',
          class: 'text-no-wrap',
        },
        {
          text: 'Periods', value: 'periods',
        },
        {
          text: 'Collections', value: 'collections',
        },
        {
          text: 'Collection Details',
          value: 'collection_details',
          class: 'text-no-wrap',
        },
        {
          text: 'Makers', value: 'makers',
        },
        // {
        //   text: 'Remarks', value: 'remarks',
        // },
        // {
        //   text: 'Properties', value: 'properties',
        // },
        // { text: 'Actions', value: 'actions', sortable: false },
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
