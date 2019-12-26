<template>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="taxonomy-container col-md-4 sticky" ref="taxonomy">
        <div class="card">

          <div class="card-body" v-if="!rendered">
            <div class="d-flex align-items-center">
              <h5 class="card-title">Loading...</h5>
              <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
            </div>
          </div>

          <div class="card-body" v-else>
            <b-tree-view
                    :data="treeData"
                    :key="`tree-${treeData.length}`"
                    ref="tree"
                    :contextMenu="false"
                    :showIcons="false"
                    :contextMenuItems="[]"
                    :renameNodeOnDblClick="false"
                    @nodeSelect="nodeSelect"></b-tree-view>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body" v-if="loading">
            <div class="d-flex align-items-center">
              <h5 class="card-title">Loading...</h5>
              <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
            </div>
          </div>

          <Pagination class="mt-3" :meta="meta" @paginate="loadItems"/>

          <div class="card-body" v-if="items.length">
            <div class="row">
              <template v-for="(item, i) in items">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4" :key="i" @click="openItem(item.id)">

                  <div class="card">
                    <img class="card-img-top" :src="`http://cja.huji.ac.il/${item.images[0].small || item.images[0].medium || item.images[0].def || item.images[0].batch_url}`" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ item.ntl || item.name  }}</h5>
                    </div>
                  </div>

                 </div>
              </template>
            </div>
          </div>

          <Pagination :meta="meta" @paginate="loadItems"/>

          <div class="card-body" v-if="!items.length && !loading">
            <h5 class="card-title">No item found</h5>
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

  export default {
    components: {
      bTreeView,
      Pagination
    },

    data() {
      return {
        treeData: [],
        items: [],
        loading: false,
        rendered: false,
        meta: {},
        page: 1
      }
    },
    watch: {
      '$route.params.type': {
        handler: function () {
          this.initialize()
        },
        immediate: true
      },
      '$route.params.id': async function (val) {
        this.selected = val
        await this.loadItems()
      }
    },
    methods: {
      async initialize() {
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

        this.$refs.taxonomy.scrollTop = node.$el.offsetTop

        while (!roots.includes(node._uid)) {
          node = node.$parent
          node.expand()
        }
      },

      async nodeSelect(node, isSelected) {

        if (!isSelected && this.selected === node.data.id) {
          node.select()
        }

        if (isSelected && this.selected !== node.data.id) {
          await this.$router.push({ name: 'browse-id', params: { id: node.data.id }})
        }

      },

      async loadItems(page = 1) {
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

      scrollTo() {
        const el = document.querySelector('.tree-branch.selected')[0];

        if (el) {
          el.scrollIntoView();
        }
      },

      openItem (id) {
        window.open(`/${this.project}/items/${id}`, '_blank')
      }
    },

    created () {
      this.project = window.project
    }

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
