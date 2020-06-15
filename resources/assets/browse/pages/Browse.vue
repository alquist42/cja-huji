<template>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-4">
        <div
          ref="taxonomy"
          class="taxonomy-container sticky"
        >
          <vue-bootstrap-typeahead
            v-if="rendered"
            v-model="query"
            :data="queryItems"
            size="lg"
            :serializer="s => s.name"
            placeholder="Quick search..."
            class="mb-3"
            @hit="loadSearch"
          />
          <div class="card">
            <div
              v-if="!rendered"
              class="card-body"
            >
              <div class="d-flex align-items-center">
                <h5 class="card-title">
                  Loading...
                </h5>
                <div
                  class="spinner-border ml-auto"
                  role="status"
                  aria-hidden="true"
                />
              </div>
            </div>

            <div
              v-else
              class="card-body"
            >
              <b-tree-view
                :key="`tree-${treeData.length}`"
                ref="tree"
                :data="treeData"
                :context-menu="false"
                :show-icons="false"
                :context-menu-items="[]"
                :rename-node-on-dbl-click="false"
                @nodeSelect="nodeSelect"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div
            v-if="loading"
            class="card-body"
          >
            <div class="d-flex align-items-center">
              <h5 class="card-title">
                Loading...
              </h5>
              <div
                class="spinner-border ml-auto"
                role="status"
                aria-hidden="true"
              />
            </div>
          </div>

          <pagination
            class="mt-3"
            :meta="meta"
            @paginate="loadItems"
          />

          <div
            v-if="items.length"
            class="card-body"
          >
            <div class="row">
              <template v-for="(item, i) in items">
                <div
                  :key="i"
                  class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4"
                  @click="openItem(item.id)"
                >
                  <div class="card">
                    <img
                      class="card-img-top"
                      :src="`/images/s-${item.id}-small.png`"
                      alt="Card image cap"
                    >
                    <div class="card-body">
                      <h5 class="card-title">
                        {{ item.ntl || item.name }}
                      </h5>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>

          <pagination
            :meta="meta"
            @paginate="loadItems"
          />

          <div
            v-if="!items.length && !loading"
            class="card-body"
          >
            <h5 class="card-title">
              No item found
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { bTreeView } from 'bootstrap-vue-treeview'
  import axios from 'axios'
  import Pagination from '../components/Pagination'
  import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'

  function debounce (func, wait, immediate) {
    let timeout

    return function executedFunction () {
      const context = this
      const args = arguments

      const later = function () {
        timeout = null
        if (!immediate) func.apply(context, args)
      }

      const callNow = immediate && !timeout

      clearTimeout(timeout)

      timeout = setTimeout(later, wait)

      if (callNow) func.apply(context, args)
    }
  }

  export default {
    components: {
      bTreeView,
      Pagination,
      VueBootstrapTypeahead,
    },

    data () {
      return {
        treeData: [],
        items: [],
        loading: false,
        rendered: false,
        meta: {},
        query: '',
        queryItems: [],
      }
    },
    watch: {
      '$route.params.type': {
        handler: function () {
          this.initialize()
        },
        immediate: true,
      },
      '$route.params.id': async function (val) {
        this.selected = val
        await this.loadItems()
      },
      query: debounce(function (query) { this.autocomplete(query) }, 300),
    },

    created () {
      this.project = window.project
    },
    methods: {
      async loadSearch (selected) {
        await this.$router.push({ name: 'browse-id', params: { id: selected.id } })
        this.query = ''
        this.select()
      },

      async initialize () {
        console.log('init')
        this.type = this.$route.params.type
        this.selected = parseInt(this.$route.params.id)
        this.rendered = false

        const { data } = await axios.get(`/api/taxonomy/${this.type}?as_tree=1&project=${window.project}`)

        this.treeData = data

        this.$nextTick(() => {
          this.rendered = true

          this.$nextTick(() => {
            if (this.selected) {
              this.$nextTick(() => {
                this.select()
              })
            }
          })
        })

        await this.loadItems()
      },
      select () {
        const roots = this.$refs.tree.$refs.rootNodes.map(r => r._uid)
        let node = this.$refs.tree.getNodeByKey(this.selected)
        node.select()

        let offset = node.$el.offsetTop

        while (!roots.includes(node._uid)) {
          node = node.$parent
          node.expand()
          // FIXME: here offset is still 0 (nextTick)
          offset += node.$el.offsetTop
        }

        this.$refs.taxonomy.scrollTop = offset
      },

      async nodeSelect (node, isSelected) {
        if (!isSelected && this.selected === node.data.id) {
          node.select()
        }

        if (isSelected && this.selected !== node.data.id) {
          await this.$router.push({ name: 'browse-id', params: { id: node.data.id } })
        }
      },

      async loadItems (page = 1) {
        if (!this.selected) {
          return
        }

        window.scrollTo(0, 0)

        this.items = []
        this.meta = {}
        this.loading = true

        const { data } = await axios.get(`/api/items?${this.type}[]=${this.selected}&project=${window.project}&page=${page}`)

        this.items = data.data
        this.meta = data.meta
        this.loading = false
      },

      async autocomplete (query) {
        const { data } = await axios.get(`/api/autocomplete/?type=${this.type}&project=${window.project}&term=${query}`)
        this.queryItems = data || []
      },

      scrollTo () {
        const el = document.querySelector('.tree-branch.selected')[0]

        if (el) {
          el.scrollIntoView()
        }
      },

      openItem (id) {
        window.open(`/${this.project}/items/${id}`, '_blank')
      },
    },

  }
</script>

<style>
  .taxonomy-container {
    max-height: 700px;
    overflow-y: scroll;
  }

  .sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
  }
  .sticky:before,
  .sticky:after {
    content: '';
    display: table;
  }
</style>
