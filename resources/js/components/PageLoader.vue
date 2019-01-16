<template>
  <div class="flex flex-col items-center">
    <Spinner />
    <div class="mt-6">
      {{ message | trans }}
    </div>
  </div>
</template>

<script>
  export default {
    props:{
      message:{
        type:String,
        default:"irc.data_is_being_fetch"
      }
    }
  }
</script>

<style scoped>

</style>