<template>
  <v-app>
    <dashboard-core-app-bar />

    <dashboard-core-drawer />

    <v-main>
      <v-container
        id="user-profile"
        fluid
        tag="section"
      >
        <v-row justify="center">
          <v-col cols="12">
            <v-select
              v-model="projects"
              :items="projects"
              item-text="title"
              item-value="url"
              attach
              chips
              label="Projects 2"
              multiple
            />
            <v-select
              v-model="categories"
              :items="categories"
              item-text="name"
              item-value="id"
              attach
              chips
              label="Categories"
              multiple
            />
          </v-col>
          <v-col cols="12">
            <v-data-table
              dense
              :headers="headers"
              :items="items"
              :items-per-page="5"
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
                  <v-dialog
                    v-model="dialog"
                    max-width="500px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        v-on="on"
                      >
                        New Item
                      </v-btn>
                    </template>
                    <v-card>
                      <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                      </v-card-title>

                      <v-card-text>
                        <v-container>
                          <v-row>
                            <v-col
                              cols="12"
                              sm="6"
                              md="4"
                            >
                              <v-text-field
                                v-model="editedItem.name"
                                label="Dessert name"
                              />
                            </v-col>
                            <v-col
                              cols="12"
                              sm="6"
                              md="4"
                            >
                              <v-text-field
                                v-model="editedItem.calories"
                                label="Calories"
                              />
                            </v-col>
                            <v-col
                              cols="12"
                              sm="6"
                              md="4"
                            >
                              <v-text-field
                                v-model="editedItem.fat"
                                label="Fat (g)"
                              />
                            </v-col>
                            <v-col
                              cols="12"
                              sm="6"
                              md="4"
                            >
                              <v-text-field
                                v-model="editedItem.carbs"
                                label="Carbs (g)"
                              />
                            </v-col>
                            <v-col
                              cols="12"
                              sm="6"
                              md="4"
                            >
                              <v-text-field
                                v-model="editedItem.protein"
                                label="Protein (g)"
                              />
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>

                      <v-card-actions>
                        <v-spacer />
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="close"
                        >
                          Cancel
                        </v-btn>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="save"
                        >
                          Save
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-toolbar>
              </template>
              <template v-slot:item.actions="{ item }">
                <v-icon
                  small
                  class="mr-2"
                  @click="editItem(item)"
                >
                  mdi-pencil
                </v-icon>
                <v-icon
                  small
                  @click="deleteItem(item)"
                >
                  mdi-delete
                </v-icon>
              </template>
              <template v-slot:item.locations="{ item }">
                <v-combobox
                  v-model="item.locations"
                  :items="item.locations"
                  item-text="name"
                  item-value="id"
                  outlined
                  multiple
                  chips
                  dense
                  deletable-chips
                ></v-combobox>
              </template>
              <template v-slot:item.communities="{ item }">
                <v-combobox
                  v-model="item.communities"
                  :items="item.communities"
                  item-text="name"
                  item-value="id"
                  outlined
                  multiple
                  chips
                  dense
                  deletable-chips
                ></v-combobox>
              </template>
            </v-data-table>
          </v-col>
        </v-row>

<!--        <v-row>-->
<!--          <v-col cols="12">-->
<!--            <v-treeview-->
<!--              :items="options"-->
<!--            />-->
<!--          </v-col>-->
<!--        </v-row>-->

        <v-row>
          <v-col cols="12">
            <vue-excel-editor
              v-model="opts"
              filter-row
              remember
            />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <button @click="addNode">
              Add Node
            </button>
            <vue-tree-list
              :model="data"
              default-tree-node-name="new node"
              default-leaf-node-name="new leaf"
              :default-expanded="false"
              @click="onClick"
              @change-name="onChangeName"
              @delete-node="onDel"
              @add-node="onAddNode"
            >
              <span
                slot="addTreeNodeIcon"
                class="icon"
              >📂</span>
              <span
                slot="addLeafNodeIcon"
                class="icon"
              >＋</span>
              <span
                slot="editNodeIcon"
                class="icon"
              >📃</span>
              <span
                slot="delNodeIcon"
                class="icon"
              >✂️</span>
              <span
                slot="leafNodeIcon"
                class="icon"
              >🍃</span>
              <span
                slot="treeNodeIcon"
                class="icon"
              >🌲</span>
            </vue-tree-list>
            <button @click="getNewTree">
              Get new tree
            </button>
            <pre>
              {{ newTree }}
            </pre>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <file-manager />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <ais-instant-search
              :search-client="searchClient"
              index-name="sets_index"
            >
              <div class="search-panel">
                <div class="search-panel__filters">
                  <ais-refinement-list
                    attribute="subjects"
                    searchable
                  />
                </div>

                <div class="search-panel__results">
                  <ais-search-box
                    placeholder="Search here…"
                    class="searchbox"
                  />
                  <ais-hits>
                    <template
                      slot="item"
                      slot-scope="{ item }"
                    >
                      <v-img
                        :src="item.images[0]"
                        contain
                        max-height="150px"
                        max-width="150px"
                      />
                      <h1>
                        <ais-highlight
                          :hit="item"
                          attribute="name"
                        />
                      </h1>
                      <p>
                        <ais-highlight
                          :hit="item"
                          attribute="description"
                        />
                      </p>
                      <p>
                        <ais-highlight
                          :hit="item"
                          attribute="subjects"
                        />
                      </p>
                      <p>
                        <ais-highlight
                          :hit="item"
                          attribute="properties"
                        />
                      </p>
                    </template>
                  </ais-hits>

                  <div class="pagination">
                    <ais-pagination />
                  </div>
                </div>
              </div>
            </ais-instant-search>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-form
              ref="form"
              lazy-validation
            >
              <v-text-field
                v-model="item.name"
                :counter="10"
                label="Name"
                required
                outlined
              />

              <v-text-field
                v-model="item.ntl"
                label="NTL"
                required
                outlined
              />

              <tiptap-vuetify
                v-model="item.description"
                :extensions="extensions"
              />
            </v-form>
            <template
              v-for="image in item.images"
            >
              <v-img
                :key="image.id"
                aspect-ratio="1.7"
                min-height="150px"
                :src="`http://cja.huji.ac.il/${image.small || image.medium || image.def || image.batch_url}`"
              />
            </template>
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="locations"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="origins"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="schools"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="subjects"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="historical_origins"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="periods"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="collections"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="communities"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="professions"-->
<!--            />-->
<!--            <treeselect-->
<!--              :multiple="true"-->
<!--              :normalizer="normalizer"-->
<!--              :show-count="true"-->
<!--              :options="artists"-->
<!--            />-->
            <template
              v-for="prop in properties"
            >
              <v-text-field
                v-if="prop.type === 'text'"
                :key="prop.id"
                v-model="item[prop.prop_name]"
                :label="prop.verbose_name"
                outlined
              />
              <v-textarea
                v-if="prop.type === 'textarea' && prop.content_type === 'plain'"
                :key="prop.id"
                v-model="item[prop.prop_name]"
                :label="prop.verbose_name"
                outlined
              />
              <tiptap-vuetify
                v-if="prop.type === 'textarea' && prop.content_type === 'htmle'"
                :key="prop.id"
                v-model="item[prop.prop_name]"
                :placeholder="prop.verbose_name"
                :extensions="extensions"
              />
              <v-select
                v-if="prop.type === 'select'"
                :key="prop.id"
                v-model="item[prop.prop_name]"
                :items="prop.allowed_vals.split(' | ')"
                chips
                :label="prop.verbose_name"
                outlined
              />
            </template>
          </v-col>
        </v-row>
      </v-container>

      <dashboard-core-footer />
    </v-main>

    <!--    <dashboard-core-settings />-->
  </v-app>
</template>

<script>

  // import the component
  // import Treeselect from '@riophae/vue-treeselect'
  // import the styles
  import '@riophae/vue-treeselect/dist/vue-treeselect.css'
  import algoliasearch from 'algoliasearch/lite'
  import 'instantsearch.css/themes/algolia-min.css'

  import { VueTreeList, Tree, TreeNode } from 'vue-tree-list'

  import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'

  export default {
    name: 'DashboardIndex',

    components: {
      // Treeselect,
      VueTreeList,
      TiptapVuetify,
      DashboardCoreAppBar: () => import('../views/dashboard/components/core/AppBar'),
      DashboardCoreDrawer: () => import('../views/dashboard/components/core/Drawer'),
      // DashboardCoreSettings: () => import('./components/core/Settings'),
      // DashboardCoreView: () => import('../components/core/View'),
    },

    props: [
      'collection',
      'options',
      'locations',
      'origins',
      'schools',
      'properties',
      'subjects',
      'historical_origins',
      'periods',
      'collections',
      'communities',
      'makers',
      'professions',
      'artists',
      'item',
      'projects',
      'categories',
    ],

    data: () => ({
      expandOnHover: false,

      searchClient: algoliasearch(
        'G6B5F5SPPO',
        '5a24886cfcc75d98f6e97c7fe27bc0c7',
      ),

      newTree: {},

      jsondata: [
        { user: 'hc', name: 'Harry Cole', phone: '1-415-2345678', gender: 'M', age: 25, birth: '1997-07-01' },
        { user: 'sm', name: 'Simon Minolta', phone: '1-123-7675682', gender: 'M', age: 20, birth: '1999-11-12' },
        { user: 'ra', name: 'Raymond Atom', phone: '1-456-9981212', gender: 'M', age: 19, birth: '2000-06-11' },
        { user: 'ag', name: 'Mary George', phone: '1-556-1245684', gender: 'F', age: 22, birth: '2002-08-01' },
        { user: 'kl', name: 'Kenny Linus', phone: '1-891-2345685', gender: 'M', age: 29, birth: '1990-09-01' },
      ],

      dialog: false,

      editedIndex: -1,
      editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },

      extensions: [
        History,
        Blockquote,
        Link,
        Underline,
        Strike,
        Italic,
        ListItem,
        BulletList,
        OrderedList,
        [Heading, {
          options: {
            levels: [1, 2, 3],
          },
        }],
        Bold,
        Code,
        HorizontalRule,
        Paragraph,
        HardBreak,
      ],

      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Category', value: 'category' },
        { text: 'Locations', value: 'locations' },
        { text: 'Communities', value: 'communities' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],

      normalizer (node) {
        const n = {
          id: node.id,
          label: node.name,
        }
        if (node.children && node.children.length) {
          n.children = node.children
        }
        return n
      },
    }),

    computed: {
      opts () {
        return this.collection.data.map(d => {
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
      data () {
        return new Tree(this.options)
      },
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    mounted () { console.log('in', this.item, this.properties) },

    methods: {

      editItem (item) {
        this.editedIndex = this.items.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.items.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.items.splice(index, 1)
      },

      onDel (node) {
        console.log(node)
        node.remove()
      },

      onChangeName (params) {
        console.log(params)
      },

      onAddNode (params) {
        console.log(params)
      },

      onClick (params) {
        console.log(params)
      },

      addNode () {
        var node = new TreeNode({ name: 'new node', isLeaf: false })
        if (!this.data.children) this.data.children = []
        this.data.addChildren(node)
      },

      getNewTree () {
        var vm = this
        function _dfs (oldNode) {
          var newNode = {}

          for (var k in oldNode) {
            if (k !== 'children' && k !== 'parent') {
              newNode[k] = oldNode[k]
            }
          }

          if (oldNode.children && oldNode.children.length > 0) {
            newNode.children = []
            for (var i = 0, len = oldNode.children.length; i < len; i++) {
              newNode.children.push(_dfs(oldNode.children[i]))
            }
          }
          return newNode
        }

        vm.newTree = _dfs(vm.data)
      },

    },
  }
</script>

<style>
  body,
  h1 {
    margin: 0;
    padding: 0;
  }

  body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica,
    Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
  }

  .header {
    display: flex;
    align-items: center;
    min-height: 50px;
    padding: 0.5rem 1rem;
    background-image: linear-gradient(to right, #4dba87, #2f9088);
    color: #fff;
    margin-bottom: 1rem;
  }

  .header a {
    color: #fff;
    text-decoration: none;
  }

  .header-title {
    font-size: 1.2rem;
    font-weight: normal;
  }

  .header-title::after {
    content: ' ▸ ';
    padding: 0 0.5rem;
  }

  .header-subtitle {
    font-size: 1.2rem;
  }

  .search-panel {
    display: flex;
  }

  .search-panel__filters {
    flex: 1;
    margin-right: 1em;
  }

  .search-panel__results {
    flex: 3;
  }

  .searchbox {
    margin-bottom: 2rem;
  }

  .pagination {
    margin: 2rem auto;
    text-align: center;
  }
</style>
