<template>
  <div
    v-tooltip="{content:'Click to Copy',classes:['tooltip-datatable']}"
    @click="doCopy"
  >
    <slot
      name="copyTemplate"
    />
  </div>
</template>
<script>
  import VTooltip from 'v-tooltip'
  import Toasted from 'vue-toasted';
  Vue.use(Toasted,{
    icon : 'icon-Paper_Clip_1 mr-2',
    position:'bottom-right',
    duration:23000,
    iconPack:'custom-class',
    theme:'bubble',
    className:'clipboard-custom-class'
  });
  export default {
    mixins: [],
    props: {
      toBeCopied: {
        type: String,
        default: ''
      }
    },
    methods: {
      doCopy: function () {
        var dummy = document.createElement("input");
        document.body.appendChild(dummy);
        dummy.setAttribute('value', this.toBeCopied);
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        this.$toasted.show('Copied!')
      }
    }
  }
</script>
