<template>
  <div class="flex flex-wrap">
    <div class="sm:w-full xl:w-2/3">
      <div class="flex flex-wrap">
        <div
          v-for="card in cards"
          :key="card.label + card.value"
          class="lg:pr-2 sm:w-full lg:w-1/2 qhd:w-1/3"
        >
          <Component
            :is="card.component"
            :icon-class="'icon-Add_x40_2xpng_2'"
            :value="parseInt(card.value)"
            :label="card.label"
          />
        </div>
        <div class=" flex-grow w-full lg:pr-2">
          <Panel
            custom-class="min-h-784 pt-8 overflow-y-auto"
            :title="`irc.followups` | trans"
          >
            <ul class=" list-reset border-0 custom-navs mb-4 absolute pin-r pin-t mt-4 mr-4">
              <li
                class="inline-flex"
                @click="changeViewType('calendar')"
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
                @click="changeViewType('table')"
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


            <button
              class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-3 border border-blue hover:border-transparent rounded float-right"
              @click="exportData"
            >
              Export
            </button>


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
                    v-if="followups.length===0 && !loading"
                    icon="icon-Calendar_1_x40_2xpng_2 text-5xl mt-3 block"
                    message="No date selected"
                    custom-class="mt-5 min-h-300 text-lg"
                  />
                  <PageLoader
                    v-else-if="loading"
                    message="Events are being loaded!"
                  />

                  <div v-else>
                    <Panel
                      :title="selectedDateHuman"
                      custom-class="bg-grey border-transparent border-0"
                    >
                      <Datatable
                        :header="tableHeaders"
                        :rows="followups"
                        :pagination="pagination"
                        :fixed-header="true"
                        :has-pagination="true"
                        :has-filters="false"
                        :striped="false"
                        :per-page-enabled="false"
                        @pagechanged="getFollowups(selectedDate,$event)"
                      />
                    </Panel>
                  </div>
                </div>
              </div>

              <div
                v-else
                id="list"
                class="tab-pane fade in max-h-600"
              >
                <Datatable
                  :header="tableHeaders"
                  :rows="followups"
                  :pagination="pagination"
                  :has-pagination="true"
                  :has-filters="false"
                  :per-page-enabled="false"
                  @pagechanged="getFollowups(null,$event)"
                />
              </div>
            </div>
          </Panel>
        </div>
      </div>
    </div>
    <div class="sm:w-full xl:w-1/3">
      <Panel
        :title="`irc.recent_activity` | trans"
        custom-class=" pl-6 pr-2   min-h-900"
      >
        <div class="days-container max-h-800 overflow-y-auto">
          <div
            v-for="day in recent"
            :key="day.name"
            class=""
          >
            <div class="text-left text-green-dark font-bold text-xs mt-8 -mb-1">
              {{ day.name }}
            </div>
            <ul class="list-reset">
              <li
                v-for="activity in day.items"
                :key="activity.id"
                class="relative text-left text-black border-grey-lighter border-solid
                            border-b-2 font-semibold text-md  py-5 flex items-center "
              >
                <Component
                  :is="activity.component.name"
                  v-if="activity.component"
                  :icon-class="activity.component.value+' text-grey-darker text-1xl mr-2'"
                />
                <a
                  class="no-underline text-black"
                  :href="activity.entity.details_url"
                >
                  <span class="text-sm">
                    {{ activity.title }} •  {{ activity.entity.name }}
                  </span>
                </a>
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
  import {exportData as exportDataByUrl} from '../API/followupAPI'
  import {get as getRecentActivity} from '../API/recentActivityAPI'
  import {get as getCards} from '../API/cardsAPI'
  import exportDataHelper from '../helpers/ExportData'

  export default {
    components: {
      FullCalendar
    },
    filters: {},
    props: {},
    data() {
      return {
        selectedDateHuman: "",
        endPoint: "",
        cards: [],
        tableHeaders: [
          {
            name: "type",
            translations: {
              ara: "نوع المتابعة",
              en: "Type"
            }

          },
          {
            name: "followup",
            translations: {
              ara: "نوع المتابعة",
              en: "Job seeker"
            },
            valueHandler: (row) => row.followup.name

          }
        ],
        loading: false,
        viewType: 'calendar',
        events: [],
        followups: [],
        recent: [],
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
            this.getCounts(view.calendar.currentDate.format("YYYY-MM"));
          }.bind(this),
          unselect: function (view, el) {
            this.dayUnselected(view, el);
          }.bind(this)
        },
        page: 1,
        pagination: {
          total: 0,
          lastPage: 3,
          perPage: 15,
          currentPage: 1
        },

      }
    },
    computed: {},
    watch: {},
    created() {
    },
    mounted() {
      this.getRecentActivity();
      getCards()
          .then(resp => {
            this.cards = resp.data;
          })
          .catch(error => {
          });

    },
    methods: {
      getRecentActivity() {
        getRecentActivity()
            .then(resp => {
              this.recent = resp.data.data;
            })
            .catch(error => {
            });
      },
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
      changeViewType(type) {
        this.viewType = type;
        if (type === 'table') {
          this.getFollowups(null, this.pagination.currentPage);
        }
      },
      dayClicked: function (date, jsEvent, view) {
        this.daySelected = true;
        let selectedString = moment(date, "DD MMMM");
        this.selectedDateHuman = selectedString.format("DD MMMM");
        this.selectedDate = selectedString.format("YYYY-MM-DD");
        this.loading = true;
        this.getFollowups(this.selectedDate, this.pagination.page);

      },
      getFollowups(date, page) {
        this.loading = true;
        getFollowups(date, page)
            .then(resp => {
              console.log(' full resp is ', resp);
              this.followups = resp.data.data;
              this.pagination = {
                total: resp.data.meta.total,
                lastPage: resp.data.meta.last_page,
                perPage: resp.data.meta.per_page,
                currentPage: resp.data.meta.current_page
              }
              this.loading = false;

            })
            .catch(error => {
            });
      },
      dayUnselected(view, el) {
        if (!view.target.className || !(view.target.className === 'fc-day-number')) {
          this.daySelected = false;
        }


      },
      exportData(){

        let selectedDate = this.selectedDate;
        if(this.viewType == "table"){
            selectedDate = null;
        }

          exportDataByUrl(selectedDate, this.pagination.page, {export: true})
            .then(response => {
                exportDataHelper.exportCallback(response);
            });
      }

    }
  }
</script>