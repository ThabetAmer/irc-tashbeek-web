<template>
  <div class="flex">
    <div class=" w-2/3">
      <div class="flex flex-wrap">
        <div class="flex-1 px-2">
          <MetricCard
            :icon-class="'icon-Add_x40_2xpng_2'"
            :value="'11'"
            :label="'Current Jobs'"
          />
        </div>

        <div class="flex-1 px-2">
          <MetricCard
            :icon-class="'icon-Calendar_2_x40_2xpng_2'"
            :value="'11'"
            :label="'Current Jobs'"
          />
        </div>
        <div class="flex-1 px-2">
          <MetricCard
            :icon-class="'icon-Briefcase_x40_2xpng_2'"
            :value="'11'"
            :label="'Current Jobs'"
          />
        </div>

        <div class="px-2 flex-grow w-full">
          <Panel
            custom-class="min-h-630 pt-8 max-h-630 overflow-y-auto"
            title="Follow-ups"
          >
            <ul class=" list-reset border-0 custom-navs mb-4 absolute pin-r pin-t mt-4 mr-4">
              <li
                class="inline-flex"
                @click="clickCal"
              >
                <button
                  data-toggle="tab"
                  class="nav-link border-0
                                            rounded-full p-3 h-50 w-50
                                            text-grey-dark text-2xl font-semibold"
                  :class="{active: viewType == 'calendar'}"
                >
                  <i class="icon-Calendar_2_x40_2xpng_2" />
                </button>
              </li>
              <li
                class="inline-flex"
                @click="viewType = 'table';"
              >
                <button
                  data-toggle="tab"
                  class="nav-link border-0 p-3  h-50 w-50 text-grey-dark text-2xl font-semibold"
                  :class="{active: viewType != 'calendar'}"
                >
                  <i
                    class="icon-List_3_x40_2xpng_2"
                  />
                </button>
              </li>
            </ul>

            <div class="tab-content">
              <div
                v-if="viewType =='calendar'"
                id="calendarTab"
                class="tab-pane fade in active show "
              >
                <div class="calendar xl:pr-24">
                  <FullCalendar
                    ref="fullCalendar"
                    :events="events"
                    :config="config"
                    @day-click="dayClicked"
                  />
                </div>

                <div class="selected-day mt-4">
                  <EmptyState
                    v-if="!daySelected && !loading"
                    icon="icon-Calendar_1_x40_2xpng_2 text-5xl mt-3 block"
                    message="No date selected"
                    custom-class="mt-5 min-h-200 text-lg"
                  />
                  <PageLoader
                    v-else-if="loading"
                    message="Events are being loaded!"
                  />

                  <div v-else>
                    <Panel
                      :title="selectedDate"
                      custom-class="bg-transparent border-transparent border-0"
                    >
                      <Datatable
                        :fixed-header="true"
                        :has-pagination="true"
                        :has-filters="false"
                        :striped="false"
                      />
                    </Panel>
                  </div>
                </div>
              </div>

              <div
                v-else
                id="list"
                class="tab-pane fade in"
              >
                <Datatable
                  :fixed-header="true"
                  :has-filters="false"
                  :has-pagination="false"
                />
              </div>
            </div>
          </Panel>
        </div>
      </div>
    </div>
    <div class=" w-1/3">
      <Panel
        title="Recent activity"
        custom-class=" pl-6 pr-2  max-h-750 min-h-750"
      >
        <div class="days-container max-h-680 overflow-y-auto">
          <div
            v-for="day in recentActivity"
            :key="day.date"
            class=""
          >
            <div class="text-left text-green-dark font-bold text-xs mt-8 -mb-1">
              {{ day.date }}
            </div>
            <ul class="list-reset">
              <li
                v-for="event in day.events"
                :key="event.label"
                class="relative text-left text-black border-grey-lighter border-solid
                            border-b-2 font-semibold text-md  py-5 flex items-center "
              >
                <Component
                  :is="event.component"
                  :icon-class="event.iconClass+' text-grey-darker text-1xl mr-2'"
                />
                <span class="text-sm">
                  {{ event.label }}
                </span>
              </li>
            </ul>
          </div>
        </div>
      </Panel>
    </div>
  </div>
</template>


<script>
  import moment from 'moment';
  import {FullCalendar} from 'vue-full-calendar'
  import {upcomingFollowups as getFollowups} from '../API/followupAPI'
  import {upcomingFollowupsCount as getCounts} from '../API/followupAPI'

  export default {
    components: {
      FullCalendar
    },
    filters: {},
    props: {},
    data() {
      return {
        tableHeaders: [
          {
            name: "followup_type",
            translations: {
              ara: "نوع المتابعة",
              en: "Type"
            }

          },
          {
            name: "followup_type",
            translations: {
              ara: "نوع المتابعة",
              en: "Type"
            }

          }
        ],
        loading: false,
        viewType: 'calendar',
        events: [
          {
            title: 1,
            start: "2019-01-9"
          }
        ],
        followups: [],
        selectedFollowups: [],
        recentActivity: [
          {
            date: 'Wednesday 14 November',
            events: [
              {
                label: 'Monthy follow-up • Ismael Ghassan',
                component: 'icon',
                iconClass: 'icon-Calendar_2_x40_2xpng_2'
              },
              {
                label: 'Match follow-up • Boutros Baqaeen',
                component: 'icon',
                iconClass: 'icon-Filter_x40_2xpng_2'
              },
              {
                label: 'Hired follow-up • Sara Hourani',
                component: 'icon',
                iconClass: 'icon-Star_in_Circle_x40_2xpng_2'
              },
            ]
          },
          {
            date: 'Wednesday 15 November',
            events: [
              {
                label: 'Monthy follow-up • Ismael Ghassan',
                component: 'icon',
                iconClass: 'icon-Calendar_2_x40_2xpng_2'
              },
              {
                label: 'Match follow-up • Boutros Baqaeen',
                component: 'icon',
                iconClass: 'icon-Filter_x40_2xpng_2'
              },
              {
                label: 'Hired follow-up • Sara Hourani',
                component: 'icon',
                iconClass: 'icon-Star_in_Circle_x40_2xpng_2'
              },
            ]
          },
          {
            date: 'Wednesday 16 November',
            events: [
              {
                label: 'Monthy follow-up • Ismael Ghassan',
                component: 'icon',
                iconClass: 'icon-Calendar_2_x40_2xpng_2'
              },
              {
                label: 'Match follow-up • Boutros Baqaeen',
                component: 'icon',
                iconClass: 'icon-Filter_x40_2xpng_2'
              },
              {
                label: 'Hired follow-up • Sara Hourani',
                component: 'icon',
                iconClass: 'icon-Star_in_Circle_x40_2xpng_2'
              },
            ]
          },
          {
            date: 'Wednesday 17 November',
            events: [
              {
                label: 'Monthy follow-up • Ismael Ghassan',
                component: 'icon',
                iconClass: 'icon-Calendar_2_x40_2xpng_2'
              },
              {
                label: 'Match follow-up • Boutros Baqaeen',
                component: 'icon',
                iconClass: 'icon-Filter_x40_2xpng_2'
              },
              {
                label: 'Hired follow-up • Sara Hourani',
                component: 'icon',
                iconClass: 'icon-Star_in_Circle_x40_2xpng_2'
              },
            ]
          }
        ],
        selectedDate: '',
        daySelected: false,
        hasTitle: true,
        config: {
          editable: false,
          self: this,
          eventLimitText: "",
          views: {
            month: {
              eventLimit: 1// adjust to 6 only for agendaWeek/agendaDay
            }
          },
          eventLimit: true,
          fixedWeekCount: false,
          aspectRatio: 1.3,
          contentHeight: 250,
          defaultView: 'month',
          header: {
            left: 'title',
            center: '',
            right: 'prev,next'
          },
          themeSystem: 'bootstrap4',
          themeButtonIcons: {
            prev: 'left-single-arrow',
            next: 'fa-arrow-right',
          },
          eventRender: function (event, element) {

          },
          viewRender: function (view, el) {
            console.log(' view si ', view, ' el is ', el);
            console.log('hhh', view, ' el is ', el);
            this.getCounts(view.calendar.currentDate.format("YYYY-MM"));
          }.bind(this),
          unselect: function (view, el) {
            this.dayUnselected(view, el);
          }.bind(this)
        },

      }
    },
    computed: {},
    watch: {},
    created() {
    },
    mounted() {
    },
    methods: {
      getCounts(date) {
        this.loading = true;
        this.events = [];
        getCounts(date)
            .then(resp => {
              this.counts = resp.data.data;
              this.counts.forEach(day => {
                this.events.push({
                  start: day.followup_date,
                  title: day.followup_count,
                  className: moment().diff(moment(day.followup_date), 'days') > 0 ? 'past' : 'future',
                })
              });
              this.loading = false;
            })
            .catch(error => {
              console.log('error');
            });
      },
      clickCal() {
        this.viewType = 'calendar';
      },
      dayClicked: function (date, jsEvent, view) {
        this.daySelected = true;
        let selectedString = moment(date, "DD MMMM");
        this.selectedDate = selectedString.format("DD MMMM");
        this.loading = true;
        getFollowups(selectedString.format('YYYY-MM-DD'))
            .then(resp => {
              this.followups = resp.data.data;
              this.loading = false;

            })
            .catch(error => {
            });


      },
      dayUnselected(view, el) {
        if (!view.target.className || !(view.target.className === 'fc-day-number')) {
          this.daySelected = false;
        }


      }

    }
  }
</script>