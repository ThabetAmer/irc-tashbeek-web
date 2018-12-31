/**
 * Mixin for maps
 */

export default {
  props: {
    clustersEnabled: {
      type: Boolean,
      default: false
    },
    markers: {
      type: [Array, Object],
      default: () => {
        return [
          {
            center: {
              lat: 30.2,
              lng: 40,

            },
            type: 'type1',
            draggable: false
          },
          {
            center: {
              lat: 30,
              lng: 40,
              draggable: false
            },
            type: 'type2'
          }
        ]
      }
    },
    options: {
      type: Object,
      default: () => {
        return {
          zoomControl: true,
          streetViewControl: false,
          fullscreenControl: false,
          mapTypeControl: false,
        }
      }
    },
    center: {
      type: Object,
      default: () => {
        return {
          lat: 30,
          lng: 40
        }
      }
    }
  },
  computed: {},
  methods: {
    markerDragged(marker) {
      const draggedCenter = {};
      draggedCenter.lat = marker.latLng.lat();
      draggedCenter.lng = marker.latLng.lng();
      console.log(' center is ', draggedCenter);
      this.$emit('marker-dragged', draggedCenter);

    },
  }
}