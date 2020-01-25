<template>
  <div class="row my-5">
    <div class="col-12">
      <navigation @change="this.fetchMarkers"/>
    </div>
    <div class="col-12">
      <GmapMap
        :center="center"
        :zoom="zoom"
        map-type-id="terrain"
        style="width: 100%; height: 70vh; margin: 0 auto"
      >
        <GmapMarker
          :key="index"
          v-for="(m, index) in markers"
          :position="m.position"
          :clickable="true"
          :draggable="true"
          :title="m.title"
          @click="setCenter(m.position)"
        />
      </GmapMap>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  import Navigation from "./Navigation";

  export default {
    components: {
      Navigation
    },
    data() {
      return {
        center: {
          lat: 50,
          lng: 14
        },
        zoom: 5,
        markers: [
          {
            position: {lat: 50, lng: 10},
            title: 'Prague'
          }
        ]
      }
    },
    created() {
      this.fetchMarkers()
    },
    methods: {
      fetchMarkers(options) {
        axios.post('/api/mhs/map/markers', options)
          .then(({data}) => {
            this.markers = data;
          })
      },
      setCenter(position) {
        this.center = position;
        this.zoom = 15;
      }
    }
  }
</script>