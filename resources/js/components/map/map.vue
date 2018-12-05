<template>
    <!--

    -->
    <google-map
            :options="options"
            :center="center"
            :markers="markers"
            :clustersEnabled="clustersEnabled"
    >
    </google-map>

</template>


<script>
    import googleMap from "./google-map/googleMap"
    import mapMixin from "../../mixins/mapMixin"

    export default {
        /**
         *
         */
        props: {},
        components: {
            googleMap
        },
        methods: {
        },
        mixins: [mapMixin]
    }
</script>

<style lang="scss">

</style>