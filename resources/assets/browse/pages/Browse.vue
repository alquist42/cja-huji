<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <b-tree-view
                    :data="treeData"
                    ref="tree"
                    :contextMenu="false"
                    :showIcons="false"
                    :renameNodeOnDblClick="false"
                    @nodeSelect="nodeSelect"></b-tree-view>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body" v-if="items.length">
            <div class="row">
              <template v-for="(item, i) in items">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4" :key="i">

                  <div class="card">
                    <img class="card-img-top" src="http://placeimg.com/640/480/arch" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ item.name }}</h5>
                      <p class="card-text">{{ item.description }}</p>
                    </div>
                  </div>

                 </div>
              </template>
            </div>
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
        items: []
      }
    },
    methods: {
      async nodeSelect(node, isSelected) {

        const { data } = await axios.get("/api/items?origin=" + node.data.id)

        this.items = data.data
      },
    },

    created () {
      console.log('created')
      console.log(this.$router.project)
    },

    async mounted () {
      const { data } = await axios.get("/api/origins?as_tree=1")
      this.treeData = data
    }

  }
</script>
