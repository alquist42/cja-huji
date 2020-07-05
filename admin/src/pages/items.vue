<template>
  <v-app>
    <dashboard-core-app-bar />

    <dashboard-core-drawer />

    <v-content>
      <v-container
        id="user-profile"
        fluid
        tag="section"
      >
        <v-row justify="center">
          <v-col cols="12">
            <v-data-table
              dense
              :headers="headers"
              :items="items"
              :items-per-page="25"
              class="elevation-1"
              show-select
            >
              <template v-slot:top>
                <v-toolbar
                  flat
                  color="white"
                >
                  <v-toolbar-title>Sets</v-toolbar-title>
                  <v-divider
                    class="mx-4"
                    inset
                    vertical
                  />
                  <v-spacer />
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                  >
                    New Item
                  </v-btn>
                </v-toolbar>
              </template>
              <template v-slot:item.images="{ item }">
                <template
                  v-for="image in item.images"
                >
                  <v-avatar
                    :key="image.id"
                    class="profile"
                    color="grey"
                    size="48"
                    tile
                  >
                    <v-img :src="`http://cja.huji.ac.il/${image.small || image.medium || image.def || image.batch_url}`" />
                  </v-avatar>
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
              <template v-slot:item.name="{ item }">
                <span class="text-no-wrap">{{ item.name }}</span>
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
              <template v-slot:item.origins_details="{ item }">
                <template
                  v-for="origin in item.origins_details"
                >
                  <v-chip
                    :key="origin.id"
                    color="primary"
                    label
                    small
                  >
                    {{ origin.details }}
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
                  v-for="origin in item.collection_details"
                >
                  <v-chip
                    :key="origin.id"
                    color="primary"
                    label
                    small
                  >
                    {{ origin.details }}
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
            </v-data-table>
          </v-col>
        </v-row>
      </v-container>

      <!--      <dashboard-core-footer />-->
    </v-content>

    <!--    <dashboard-core-settings />-->
  </v-app>
</template>

<script>

  export default {
    name: 'Items',

    components: {
      DashboardCoreAppBar: () => import('../views/dashboard/components/core/AppBar'),
      DashboardCoreDrawer: () => import('../views/dashboard/components/core/Drawer'),
      // DashboardCoreSettings: () => import('./components/core/Settings'),
      // DashboardCoreView: () => import('../components/core/View'),
    },

    props: [
      'collection',
    ],

    data: () => ({

      headers: [
        { value: 'images' },
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
        { text: 'Actions', value: 'actions', sortable: false },
      ],
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
      items () {
        return this.collection.data
      },
    },

    methods: {
      editItem (id) {
        window.location.href = '/staff/items/' + id
      },
    },
  }
</script>
