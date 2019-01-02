<template>
  <div class="flex flex-col items-center">
    <Spinner />
    <div class="mt-6">
      {{ message }}
    </div>
  </div>
</template>

<script>
  export default {
    props:{
      message:{
        type:String,
        default:"Data is being fetched, please wait!"
      }
    }
  }
</script>

<style scoped>

</style>