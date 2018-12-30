<template>
  <!--
    -->
  <div :class="' notebox p-8 text-left  border-solid  border-grey-light relative mb-3 '+' '+`${customClass}`">
    <div class=" text-grey-dark text-sm mb-1">
      WEDNESDAY 12 NOVEMBER
    </div>

    <div class="mb-4 text-base text-black font-bold ">
      Candidate screened for a job ID 0109 with Souktel Inc.
    </div>
    <div class=" text-sm text-black font-semibold">
      Lorem Ipsum is simply dummy text of the printing
      and typesetting industry. Lorem Ipsum has been the industry's
      standard dummy text ever since the 1500s, when an unknown printer
      took a galley of type and scrambled it to make a type specimen book.
      It has survived not only five centuries, but also the leap into electronic
      typesetting, remaining essentially unchanged
    </div>
  </div>
</template>


<script>

    export default {
        mixins: [],
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props: {

            customClass:{
                type:[String],
                default:'border'
            }
        }
    }
</script>

<style lang="scss">

</style>