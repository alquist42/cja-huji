<template>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-4">
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

          <div class="card-body" v-if="items.length">
            <div class="row">
              <template v-for="(item, i) in items">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4" :key="i" @click="openItem(item.id)">

                  <div class="card">
                    <img class="card-img-top" src="http://placeimg.com/640/480/arch" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ item.name }}</h5>
                    </div>
                  </div>

                 </div>
              </template>
            </div>
          </div>

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

  export default {
    components: {
      bTreeView
    },

    data() {
      return {
        treeData: [],
        items: [],
        loading: false,
        rendered: false
      }
    },
    watch: {
      '$route.params.type': {
        handler: function () {
          this.initialize()
        },
        immediate: true
      }
    },
    methods: {
      async initialize() {
        this.type = this.$route.params.type
        this.selected = parseInt(this.$route.params.id)
        this.rendered = false

        const { data } = await axios.get(`/api/taxonomy/${this.type}?as_tree=1`)

        this.treeData = data

        this.$nextTick(() => {
          this.rendered = true

          this.$nextTick(() => {
            if (this.selected) {
              this.$nextTick(() => {
                this.select()
              })
            }

            else {
              this.$refs.tree.$refs.rootNodes.forEach(node => {
                node.expand()
              })
            }
          })
        })
      },
      select (id) {
        if (id) {
          this.hideSelected(id)
          this.selected = id
        }

        this.showSelected()
      },
      showSelected() {
        const roots = this.$refs.tree.$refs.rootNodes.map(r => r._uid)
        let node = this.$refs.tree.getNodeByKey(this.selected)
        node.select()

        while (!roots.includes(node._uid)) {
          node = node.$parent
          node.expand()
        }
      },
      hideSelected() {
        const roots = this.$refs.tree.$refs.rootNodes.map(r => r._uid)
        let node = this.$refs.tree.getNodeByKey(this.selected)
        node.deselect()

        while (!roots.includes(node._uid)) {
          node = node.$parent
          node.collapse()
        }
      },
      async nodeSelect(node, isSelected) {

        console.log(this.selected, node.data.id)

        // TODO: fix selected
        if (this.selected !== node.data.id) {
          this.$router.push({ name: 'browse-id', params: { id: node.data.id }})
          this.selected = node.data.id

          this.items = []
          this.loading = true

          const { data } = await axios.get(`/api/items?${this.type}[]=${node.data.id}`)

          this.items = data.data
          this.loading = false
        }
        else {
          node.select()
        }
      },

      openItem (id) {
        window.open(`/${this.project}/items/${id}`, '_blank')
      }
    },

    created () {
      this.project = window.project
    },

    mounted () {
      this.initialize()
    }

  }
</script>
