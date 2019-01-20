<template>
  <CaseListing
    :end-point="route"
    type="job-seeker"
    @fetch="onFetch"
  >
    <template slot="header">
      <div class="text-left mb-2">
        <div class="flex mb-2">
          <h1 class="flex-1">
            {{ jobOpening.job_title }}
          </h1>
          <Btn
            btn-class="text-xs"
            theme="success"
            :loading="loading"
            :disabled="loading"
            @click="saveMatches"
          >
            <span slot="text">
              {{ 'irc.save_matches' | trans }}
            </span>
          </Btn>
        </div>
        <div class="mb-4">
          <label class="text-green-theme font-bold text-xs uppercase mb-2">
            {{ 'irc.job_description' | trans }}
          </label>
          <div class="text-black">
            {{ jobOpening.job_description }}
          </div>
        </div>
      </div>
    </template>
    <template
      slot="head-start-td"
    >
      Select
    </template>

    <template
      slot="start-td"
      slot-scope="{row}"
      class="pl-6"
    >
      <CheckboxField
        :checked="selections.indexOf(row.id) !== -1"
        label=""
        label-class="theme-radio-label -mt-6"
        @change="handleSelection(row.id)"
      />
    </template>
  </CaseListing>
</template>

<script>
  import axios from 'axios'

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
        selections: [],
        loading: false
      }
    },
    methods: {
      onFetch(response) {
        this.selections = response.matches
      },
      handleSelection(id) {
        const index = this.selections.indexOf(id)

        if (index !== -1) {
          this.selections.splice(index, 1)
        } else {
          this.selections.push(id)
        }
      },
      saveMatches() {
        this.loading = true;
        let _self = this;
        axios.post(`/api/job-openings/${this.jobOpening.id}/matches`, {
          matches: this.selections
        }).then(({data}) => {
          setTimeout(function () {
            _self.loading = false;
          }, 700)
          this.$toasted.show('Matches saved', {
            icon: 'icon-Floppy_Disk_1_1',
          })

        })

      }
    }
  }
</script>

<style scoped>

</style>