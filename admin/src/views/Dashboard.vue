<template>
  <v-container
    id="dashboard"
    fluid
    tag="section"
  >
    <dashboard-core-app-bar :loading="isGettingData" />
    <v-row>
      <!--
      <v-col
        cols="12"
        lg="4"
      >
        <base-material-chart-card
          :data="emailsSubscriptionChart.data"
          :options="emailsSubscriptionChart.options"
          :responsive-options="emailsSubscriptionChart.responsiveOptions"
          color="#E91E63"
          hover-reveal
          type="Bar"
        >
          <template v-slot:reveal-actions>
            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  color="info"
                  icon
                  v-on="on"
                >
                  <v-icon
                    color="info"
                  >
                    mdi-refresh
                  </v-icon>
                </v-btn>
              </template>

              <span>Refresh</span>
            </v-tooltip>

            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  light
                  icon
                  v-on="on"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>

              <span>Change Date</span>
            </v-tooltip>
          </template>

          <h4 class="card-title font-weight-light mt-2 ml-2">
            Website Views
          </h4>

          <p class="d-inline-flex font-weight-light ml-2 mt-1">
            Last Campaign Performance
          </p>

          <template v-slot:actions>
            <v-icon
              class="mr-1"
              small
            >
              mdi-clock-outline
            </v-icon>
            <span class="caption grey--text font-weight-light">updated 10 minutes ago</span>
          </template>
        </base-material-chart-card>
      </v-col>

      <v-col
        cols="12"
        lg="4"
      >
        <base-material-chart-card
          :data="dailySalesChart.data"
          :options="dailySalesChart.options"
          color="success"
          hover-reveal
          type="Line"
        >
          <template v-slot:reveal-actions>
            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  color="info"
                  icon
                  v-on="on"
                >
                  <v-icon
                    color="info"
                  >
                    mdi-refresh
                  </v-icon>
                </v-btn>
              </template>

              <span>Refresh</span>
            </v-tooltip>

            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  light
                  icon
                  v-on="on"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>

              <span>Change Date</span>
            </v-tooltip>
          </template>

          <h4 class="card-title font-weight-light mt-2 ml-2">
            Daily Sales
          </h4>

          <p class="d-inline-flex font-weight-light ml-2 mt-1">
            <v-icon
              color="green"
              small
            >
              mdi-arrow-up
            </v-icon>
            <span class="green--text">55%</span>&nbsp;
            increase in today's sales
          </p>

          <template v-slot:actions>
            <v-icon
              class="mr-1"
              small
            >
              mdi-clock-outline
            </v-icon>
            <span class="caption grey--text font-weight-light">updated 4 minutes ago</span>
          </template>
        </base-material-chart-card>
      </v-col>

      <v-col
        cols="12"
        lg="4"
      >
        <base-material-chart-card
          :data="dataCompletedTasksChart.data"
          :options="dataCompletedTasksChart.options"
          hover-reveal
          color="info"
          type="Line"
        >
          <template v-slot:reveal-actions>
            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  color="info"
                  icon
                  v-on="on"
                >
                  <v-icon
                    color="info"
                  >
                    mdi-refresh
                  </v-icon>
                </v-btn>
              </template>

              <span>Refresh</span>
            </v-tooltip>

            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  light
                  icon
                  v-on="on"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>

              <span>Change Date</span>
            </v-tooltip>
          </template>

          <h3 class="card-title font-weight-light mt-2 ml-2">
            Completed Tasks
          </h3>

          <p class="d-inline-flex font-weight-light ml-2 mt-1">
            Last Last Campaign Performance
          </p>

          <template v-slot:actions>
            <v-icon
              class="mr-1"
              small
            >
              mdi-clock-outline
            </v-icon>
            <span class="caption grey--text font-weight-light">campaign sent 26 minutes ago</span>
          </template>
        </base-material-chart-card>
      </v-col>
      -->

      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-archive"
          title="Items"
          :value="data.totals.items.all.toString()"
          sub-icon="mdi-clock"
          :sub-text="`Not published yet: ${data.totals.items.not_published}`"
        />
      </v-col>

      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-image"
          title="Images"
          :value="data.totals.images.all.toString()"
          sub-icon="mdi-tag-off"
          :sub-text="`Not attached yet: ${data.totals.images.not_attached}`"
        />
      </v-col>

      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="accent"
          icon="mdi-apps"
          title="Projects"
          :value="data.totals.projects.toString()"
          sub-icon="mdi-snowflake-alert"
          sub-text="Only active projects are shown"
        />
      </v-col>

      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-shape"
          title="Categories"
          :value="data.totals.categories.toString()"
          sub-icon="mdi-cancel"
          sub-text="Only enabled categories are shown"
        />
      </v-col>

      <v-col
        cols="12"
        md="6"
      >
        <base-material-card
          color="warning"
          class="px-5 py-3"
        >
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              10 last modified items
            </div>
          </template>
          <v-card-text>
            <v-data-table
              class="clickable"
              hide-default-footer
              :headers="itemsHeaders"
              :items="data.items"
              @click:row="editItem"
            >
              <template v-slot:item.creation_date="{ value }">
                {{ value ? value.name : '' }}
              </template>
              <template v-slot:item.publish_state="{ value }">
                {{ publishState(value) }}
              </template>
            </v-data-table>
          </v-card-text>
        </base-material-card>
      </v-col>

      <v-col
        cols="12"
        md="6"
      >
        <base-material-card
          color="primary"
          class="px-5 py-3"
        >
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              15 last activities
            </div>
          </template>
          <v-card-text>
            <v-data-table
              hide-default-footer
              :headers="activitiesHeaders"
              :items="data.activities"
            >
              <template v-slot:item.created_at="{ value }">
                <span class="text-no-wrap">
                  {{ value }}
                </span>
              </template>
              <template v-slot:item.user="{ value }">
                {{ value.name }}
              </template>
              <template v-slot:item.auditable_type="{ item }">
                <router-link
                  class="text-no-wrap"
                  v-if="item.auditable_id"
                  :to="{ name: getEntityClass(item.auditable_type), params: { id: item.auditable_id } }"
                >
                  {{ getEntityClass(item.auditable_type) }} {{ item.auditable_id }}
                </router-link>
                <span
                  v-else
                  class="text-no-wrap"
                >
                  {{ getEntityClass(item.auditable_type) }}
                </span>
              </template>
              <template v-slot:item.new_values="{ value }">
                <v-chip
                  class="mt-1 ml-1"
                  v-for="(propertyValue, propertyName) in value"
                  :key="propertyName"
                  color="primary"
                  small
                >
                  {{ propertyName.toUpperCase() }}
                </v-chip>
              </template>
            </v-data-table>
          </v-card-text>
        </base-material-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  const PUBLISH_STATE_NOT_PUBLISHED = 0
  const PUBLISH_STATE_PREPARED_FOR_PUBLISHING = 1
  const PUBLISH_STATE_PUBLISHED = 2

  export default {
    name: 'DashboardDashboard',

    components: {
      DashboardCoreAppBar: () => import('./dashboard/components/core/AppBar'),
    },

    data () {
      return {
        isGettingData: false,
        data: {
          totals: {
            items: {
              all: '',
              root: '',
              not_published: '',
            },
            images: {
              all: '',
              not_attached: '',
            },
            projects: '',
            categories: '',
          },
          items: [],
          activities: [],
        },
        itemsHeaders: [
          {
            sortable: false,
            text: 'ID',
            value: 'id',
          },
          {
            sortable: false,
            text: 'Name',
            value: 'name',
          },
          {
            sortable: false,
            text: 'Date',
            value: 'creation_date',
          },
          {
            sortable: false,
            text: 'Publish State',
            value: 'publish_state',
          },
        ],
        activitiesHeaders: [
          {
            sortable: false,
            text: 'When',
            value: 'created_at',
          },
          {
            sortable: false,
            text: 'User',
            value: 'user',
          },
          {
            sortable: false,
            text: 'Event',
            value: 'event',
          },
          {
            sortable: false,
            text: 'Object',
            value: 'auditable_type',
          },
          {
            sortable: false,
            text: 'Changes',
            value: 'new_values',
          },
        ],
        dailySalesChart: {
          data: {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            series: [
              [12, 17, 7, 17, 23, 18, 38],
            ],
          },
          options: {
            lineSmooth: this.$chartist.Interpolation.cardinal({
              tension: 0,
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
            },
          },
        },
        dataCompletedTasksChart: {
          data: {
            labels: ['12am', '3pm', '6pm', '9pm', '12pm', '3am', '6am', '9am'],
            series: [
              [230, 750, 450, 300, 280, 240, 200, 190],
            ],
          },
          options: {
            lineSmooth: this.$chartist.Interpolation.cardinal({
              tension: 0,
            }),
            low: 0,
            high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
            },
          },
        },
        emailsSubscriptionChart: {
          data: {
            labels: ['Ja', 'Fe', 'Ma', 'Ap', 'Mai', 'Ju', 'Jul', 'Au', 'Se', 'Oc', 'No', 'De'],
            series: [
              [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],

            ],
          },
          options: {
            axisX: {
              showGrid: false,
            },
            low: 0,
            high: 1000,
            chartPadding: {
              top: 0,
              right: 5,
              bottom: 0,
              left: 0,
            },
          },
          responsiveOptions: [
            ['screen and (max-width: 640px)', {
              seriesBarDistance: 5,
              axisX: {
                labelInterpolationFnc: function (value) {
                  return value[0]
                },
              },
            }],
          ],
        },
        tabs: 0,
        tasks: {
          0: [
            {
              text: 'Sign contract for "What are conference organizers afraid of?"',
              value: true,
            },
            {
              text: 'Lines From Great Russian Literature? Or E-mails From My Boss?',
              value: false,
            },
            {
              text: 'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: false,
            },
            {
              text: 'Create 4 Invisible User Experiences you Never Knew About',
              value: true,
            },
          ],
          1: [
            {
              text: 'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: true,
            },
            {
              text: 'Sign contract for "What are conference organizers afraid of?"',
              value: false,
            },
          ],
          2: [
            {
              text: 'Lines From Great Russian Literature? Or E-mails From My Boss?',
              value: false,
            },
            {
              text: 'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: true,
            },
            {
              text: 'Sign contract for "What are conference organizers afraid of?"',
              value: true,
            },
          ],
        },
        list: {
          0: false,
          1: false,
          2: false,
        },
      }
    },

    async mounted () {
      this.isGettingData = true
      try {
        const { data } = await this.$http.get('dashboard?project=catalogue')
        this.data = data
        console.log(this.data)
      } catch (e) {
        console.log(e)
      } finally {
        this.isGettingData = false
      }
    },

    methods: {
      editItem (item) {
        this.isLoading = true
        this.$router.push({ name: 'Item', params: { id: item.id } })
      },

      complete (index) {
        this.list[index] = !this.list[index]
      },

      publishState (val) {
        switch (val) {
          case PUBLISH_STATE_NOT_PUBLISHED:
            return 'Not published'
          case PUBLISH_STATE_PREPARED_FOR_PUBLISHING:
            return 'Prepared for publishing'
          case PUBLISH_STATE_PUBLISHED:
            return 'Published'
        }

        return 'Unknown'
      },

      getEntityClass (auditableType) {
        switch (auditableType) {
          case 'set':
            return 'Item'
        }

        return 'Unknown'
      },
    },
  }
</script>

<style scoped>
  .v-data-table.clickable >>> tbody > tr {
    cursor: pointer;
  }

  .v-card--material >>> .v-divider {
    margin: 0; /* fix for Bulma interference */
  }

  .v-data-table >>> table td,
  .v-data-table >>> table th {
    vertical-align: inherit; /* fix for Bulma interference */
  }
</style>
