<template>
  <CaseListing
    :end-point="route"
    type="job-seeker"
    @fetch="onFetch"
  >
    <template slot="header">
      <div class="text-left">
        <div class="flex">
          <h1 class="flex-1">
            {{ jobOpening.job_title }}
          </h1>
          <button>Save matches</button>
        </div>
        <div>
          <label>Job Description</label>
          <div>{{ jobOpening.job_description }}</div>
        </div>
      </div>
    </template>

    <template
      slot="start-td"
      slot-scope="{row}"
    >
      <CheckboxField
        :checked="selections.indexOf(row.id) !== -1"
        label=""
        @change="handleSelection(row.id)"
      />
    </template>
  </CaseListing>
</template>

<script>
  export default {
    name: "JobOpeningMatch",
    props: {
      jobOpening: {
        type: Object,
        required: true
      },
      route: {
        type: String,
        required: true
      }
    },
    data() {
      return {
        selections: []
      }
    },
    methods: {
      onFetch(response) {
        this.selections = response.data.filter(item => Boolean(item.pivot.is_candidate) === true)
          .map(item => item.id)
      },
      handleSelection(id) {
        const index = this.selections.indexOf(id)

        if(index !== -1){
          this.selections.splice(index, 1)
        }else{
          this.selections.push(id)
        }
      }
    }
  }
</script>

<style scoped>

</style>