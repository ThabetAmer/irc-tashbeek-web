<template>
  <div class="flex">
    <div class=" w-2/3">
      <div class="flex flex-wrap">
        <div class="flex-1 px-2">
          <MetricCard
            :icon-class="'fas fa-plus'"
            :value="'11'"
            :label="'Current Jobs'"
          />
        </div>

        <div class="flex-1 px-2">
          <MetricCard
            :icon-class="'fas fa-plus'"
            :value="'11'"
            :label="'Current Jobs'"
          />
        </div>
        <div class="flex-1 px-2">
          <MetricCard
            :icon-class="'fas fa-plus'"
            :value="'11'"
            :label="'Current Jobs'"
          />
        </div>

        <div class="px-2 flex-grow">
          <Panel
            custom-class="min-h-630 max-h-630"
            :has-title="hasTitle"
            title="Follow-ups"
          >
            <ul class=" list-reset border-0 custom-navs mb-4 absolute pin-r pin-t mt-4 mr-4">
              <li
                class="inline-flex"
                @click="viewType = 'calendar'"
              >
                <button
                  data-toggle="tab"
                  class="nav-link border-0
                                            rounded-full p-3
                                            text-grey-dark text-2xl font-semibold"
                  :class="{active: viewType == 'calendar'}"
                >
                  <i class="far fa-calendar-alt" />
                </button>
              </li>
              <li
                class="inline-flex"
                @click="viewType = 'table';"
              >
                <button
                  data-toggle="tab"
                  class="nav-link border-0 p-3 text-grey-dark text-2xl font-semibold"
                  :class="{active: viewType != 'calendar'}"
                >
                  <i class="fas fa-list-ul" />
                </button>
              </li>
            </ul>
            <div class="tab-content">
              <div
                v-if="viewType =='calendar'"
                id="calendarTab"
                class="tab-pane fade in active show "
              >
                <div class="calendar pr-24">
                  <FullCalendar
                    :events="events"
                    :config="config"
                    @day-click="dayClicked"
                  />
                </div>

                <div class="selected-day mt-4 bg-grey-lighter">
                  <div
                    v-if="!daySelected"
                    class="selected-day-content text-grey-dark text-lg"
                  >
                    No date selected
                  </div>

                  <div v-else>
                    <Panel
                      has-title="`true`"
                      :title="selectedDate"
                      custom-class="bg-transparent border-transparent border-0"
                    >
                      <Datatable
                        fixed-header="true"
                        :has-pagination="hasFilters"
                        :has-filters="hasFilters"
                        :striped="hasFilters"
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
                  fixed-header="true"
                  :has-filters="hasFilters"
                  :has-pagination="hasFilters"
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
        custom-class=" pl-6 pr-2  max-h-750 min-h-750 overflow-y-auto"
      >
        <div class="days-container">
          <div
            v-for="day in recentActivity"
            class=""
          >
            <div class="text-left text-green-dark font-bold text-xs mt-4 mb-2">
              {{ day.date }}
            </div>
            <ul class="list-reset">
              <li
                v-for="event in day.events"
                class="relative text-left text-black border-grey-lighter border-solid
                            border-b-2 font-semibold text-md  py-5 flex items-center "
              >
                <Component
                  :is="event.component"
                  :custom-class="event.iconClass+' text-grey-darker text-1xl mr-2'"
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
    import Panel from '../components/Panel/Panel'
    import MetricCard from '../components/MetricCard/MetricCard'
    import datatable from '../components/datatable/datatable'
    import icon from '../components/icon/icon'
    import moment from 'moment';
    import {FullCalendar} from 'vue-full-calendar'

    console.log(' Panel ',Panel);
    export default {
        components: {
             icon, Panel, MetricCard, datatable, FullCalendar
        },
        filters: {},
        props: {},
        data() {
            return {
                viewType: 'calendar',
                recentActivity: [
                    {
                        date: 'Wednesday 14 November',
                        events: [
                            {
                                label: 'Monthy follow-up • Ismael Ghassan',
                                component: 'icon',
                                iconClass: 'far fa-calendar-alt'
                            },
                            {
                                label: 'Match follow-up • Boutros Baqaeen',
                                component: 'icon',
                                iconClass: 'fas fa-filter'
                            },
                            {
                                label: 'Hired follow-up • Sara Hourani',
                                component: 'icon',
                                iconClass: 'fas fa-star'
                            },
                        ]
                    },
                    {
                        date: 'Wednesday 15 November',
                        events: [
                            {
                                label: 'Monthy follow-up • Ismael Ghassan',
                                component: 'icon',
                                iconClass: 'far fa-calendar-alt'
                            },
                            {
                                label: 'Match follow-up • Boutros Baqaeen',
                                component: 'icon',
                                iconClass: 'fas fa-filter'
                            },
                            {
                                label: 'Hired follow-up • Sara Hourani',
                                component: 'icon',
                                iconClass: 'fas fa-star'
                            },
                        ]
                    },
                    {
                        date: 'Wednesday 16 November',
                        events: [
                            {
                                label: 'Monthy follow-up • Ismael Ghassan',
                                component: 'icon',
                                iconClass: 'far fa-calendar-alt'
                            },
                            {
                                label: 'Match follow-up • Boutros Baqaeen',
                                component: 'icon',
                                iconClass: 'fas fa-filter'
                            },
                            {
                                label: 'Hired follow-up • Sara Hourani',
                                component: 'icon',
                                iconClass: 'fas fa-star'
                            },
                        ]
                    },
                    {
                        date: 'Wednesday 16 November',
                        events: [
                            {
                                label: 'Monthy follow-up • Ismael Ghassan',
                                component: 'icon',
                                iconClass: 'far fa-calendar-alt'
                            },
                            {
                                label: 'Match follow-up • Boutros Baqaeen',
                                component: 'icon',
                                iconClass: 'fas fa-filter'
                            },
                            {
                                label: 'Hired follow-up • Sara Hourani',
                                component: 'icon',
                                iconClass: 'fas fa-star'
                            },
                        ]
                    }
                ],
                selectedDate: '',
                daySelected: false,
                hasFilters: false,
                hasPagination: false,
                hasTitle: true,
                config: {
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
                        prev: 'fa-arrow-left',
                        next: 'fa-arrow-right',
                    },
                    eventRender: function (event, element) {

                    },
                    unselect: function (view, el) {
                        this.dayUnselected(view, el);
                    }.bind(this)
                },
                events: [
                    {
                        title: 'event1',
                        start: '2018-12-12',
                    },
                    {
                        title: 'event2',
                        start: '2018-12-12',
                    },
                    {
                        title: 'event3',
                        start: '2018-12-14',
                    },
                    {
                        title: 'event3',
                        start: '2018-12-14',
                    }, {
                        title: 'event3',
                        start: '2018-12-14',
                    },
                ]
            }
        },
        computed: {},
        watch: {},
        created() {
        },
        mounted() {

        },
        methods: {
            dayClicked: function (date, jsEvent, view) {
                // this.$parent.$emit('dayClicked', date);
                console.log('daaay clicked');
                this.daySelected = true;
                let selectedString = moment(date, "DD MMMM");
                this.selectedDate = selectedString.format("DD MMMM");


            },
            dayUnselected(view, el) {
                if (!view.target.className || !(view.target.className === 'fc-day-number')) {
                    this.daySelected = false;
                }


            }

        }
    }
</script>