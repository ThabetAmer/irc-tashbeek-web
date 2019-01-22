<template>
  <div :class="[typeClass]">
    {{message}}
  </div>
</template>

<script>
  export default {
    name: "Alert",
    props:{
      message:{
        type:String
      },
      type:{
        type:String
      }
    },
    computed:{
      typeClass(){
        return 'bg-green-lightest p-4 rounded border border-green text-xs mx-auto mb-4';
      }
    }
  }
</script>

<style scoped>

</style>