<template>
  <form>
    <div class="row">
      <div v-for="field in fields"
           :key="field.key"
           class="col-xl-4 col-md-6 mb-4">
        <v-select
          multiple
          :placeholder="field.title"
          v-model="selected[field.key]"
          label="name"
          :reduce="option => option.id"
          :options="options[field.key]"
        />
      </div>
    </div>
  </form>
</template>
<script>
  import axios from 'axios'

  export default {
    props: {
      fields: {
        type: Array,
        default() {
          return [
            {
              title: 'Location',
              key: 'locations',
            },
            {
              title: 'Community',
              key: 'communities',
            },
            {
              title: 'Present Usage',
              key: 'subjects',
            },
            {
              title: 'Construction Material',
              key: 'materials',
            },
            {
              title: 'Significance rating',
              key: 'ratings',
            },
            {
              title: 'Condition of building fabric',
              key: 'conditions',
            },
          ]
        }
      }
    },
    data() {
      return {
        selected: {
          locations: [],
          communities: [],
          subjects: [],
          materials: [],
          ratings: [],
          conditions: []
        },
        options: {
          location: [],
          community: [],
          subject: [],
          material: [],
          rating: [],
          condition: []
        }
      }
    },
    created() {
      axios.get('/api/mhs/map/options')
        .then(({data}) => {
          this.options = data;
        })
    },
    watch: {
      selected: {
        handler() {
          this.$emit('change', this.selected)
        },
        deep: true
      }
    }
  }
</script>