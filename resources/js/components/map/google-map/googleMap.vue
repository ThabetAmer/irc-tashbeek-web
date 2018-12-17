<template>
  <!--

    -->
  <div class="google-map-container">
    <GmapMap
      ref="googlemap"
      :options="options"
      :center="center"
      :zoom="7"
    >
      <GmapMarker
        v-for="marker in markers"
        :key="marker.center.lng + `-` +marker.center.lat"
        :position="marker.center"
        :clickable="true"
        :draggable="marker.draggable"
        :icon="getIconColor(marker)"
        @dragend="markerDragged"
      />
    </GmapMap>

    <div class="google-map-legend">
      <div
        v-for="type in types"
        :key="`${type.name}-${type.color}`"
        class="legend-item"
      >
        <img
          :src="type.color"
          alt=""
        >
        <p :title="type.name">
          {{ type.name }}
        </p>
      </div>
    </div>
  </div>
</template>

<style>
    .vue-map-container {
        height: 200px;
    }
</style>

<script>
    import Vue from 'vue';
    import * as VueGoogleMaps from 'vue2-google-maps';
    import mapMixin from "../../../mixins/mapMixin"
    import _ from 'underscore';

    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyC15tNySN218IXsNKCwvYO-HRhxozKKBiU',
            libraries: 'places'
        }
    });
    export default {
        mixins: [mapMixin],
        /**
         *
         */
        props: {},
        data() {
            return {
                icons: {},
                iconBase: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|',
                types: {}
            }
        },
        created() {
            this.fillUniqueTypes();
        },
        methods: {
            getIconColor(marker) {
                return this.types[marker.type].color;
            },
            getRandomColor() {
                return this.iconBase + Math.floor(Math.random() * 16777215).toString(16);
            },
            fillUniqueTypes() {
                let added = '';
                let _self = this;
                _.each(_self.markers, function (marker) {
                    if (!added.includes(marker.type)) {
                        let type = marker.type;
                        _self.types["" + type] = {
                            name: type,
                            color: _self.getRandomColor()
                        }

                    }
                })
            }

        }
    }
</script>

<style lang="scss">

</style>