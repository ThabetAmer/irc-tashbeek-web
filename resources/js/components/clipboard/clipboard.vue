<template>
  <div
    v-tooltip="{content:`Click to Copy ${toBeCopied}`,classes:['tooltip-datatable']}"
    class="truncate max-w-2xl pl-2 cursor-pointer"
    @click="doCopy"
  >
    <input
      ref="inputCopy"
      v-model="toBeCopied"
      type="text"
      aria-hidden="true"
    >
    <slot
      name="copyTemplate"
    />
  </div>
</template>
<script>
  import VTooltip from 'v-tooltip'

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
        this.$refs.inputCopy.select();
        document.execCommand("copy");
        this.$toasted.show('Copied!',{
          icon: 'icon-Paper_Clip_1 mr-2'
        })
      }
    }
  }
</script>
