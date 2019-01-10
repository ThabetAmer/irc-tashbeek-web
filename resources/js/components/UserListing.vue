<template>
  <div>
    <Panel
      custom-class=""
    >
      <div class="text-right">
        <Btn
          theme="success"
          @click="addUser"
        >
          <div
            slot="text"
            class="flex items-center"
          >
            <i class="icon-Add_x40_2xpng_2 mr-2" />
            Add user
          </div>
        </Btn>
      </div>

      <!--<Filters-->
      <!--v-if="filters.length > 0"-->
      <!--:filters="filters"-->
      <!--:user-filters="userFilters"-->
      <!--@change="filterChange($event, loadData)"-->
      <!--@filterSelect="filterSelect($event, loadData)"-->
      <!--/>-->
      <Datatable
        v-if="!loading"
        :header="headers"
        :rows="rows"
        :pagination="pagination"
        @pagechanged="loadData({page: $event})"
        @perPage="loadData({perPage: $event})"
      >
        <td
          slot="extra"
          slot-scope="{row}"
        >
          <button
            v-tooltip="{placement: 'top',content:'View account',classes:['tooltip-datatable']}"
            class="flex-1 text-xl mr-1 text-green-dark"
            @click="viewAccount(row)"
          >
            <i class="icon-Eye_x40_2xpng_2" />
          </button>

          <button
            v-tooltip="{placement: 'top',content:'Edit account',classes:['tooltip-datatable']}"
            class="flex-1 text-xl mr-1 text-green-dark"
            @click="editAccount(row)"
          >
            <i class="icon-Pencil_x40_2xpng_2" />
          </button>

          <button
            v-if="row.status ==='activated'"
            v-tooltip="{placement: 'top',content:'Deactivate account',classes:['tooltip-datatable']}"
            class="flex-1 text-xl  text-green-dark"
            @click="deActivateUser(row)"
          >
            <i class="icon-Lock_x40_2xpng_2" />
          </button>

          <button
            v-else
            v-tooltip="{placement: 'top',content:'Reactivate account',classes:['tooltip-datatable']}"
            class="flex-1 text-xl  text-green-dark"
            @click="reActivateUser(row)"
          >
            <i class="icon-Unlock_x40_2xpng_2" />
          </button>
        </td>
      </Datatable>
      <PageLoader v-else />
    </Panel>
  </div>
</template>

<script>

  import queryString from '../helpers/QueryString'
  import {get as getUsers} from '../API/userAPI'
  import {activateUser as activateUser} from '../API/userAPI'
  import {deactivateUser as deactivateUser} from '../API/userAPI'

  export default {
    mixins: [],
    props: {},
    data() {
      return {
        users: [],
        rows: [],
        headers: [
          {
            name: "name",
            translations: {
              ara: "الاسم",
              en: "Name"
            }

          },
          {
            name: "commcare_id",
            translations: {
              ara: "الاسم",
              en: "Commcare ID"
            }

          },
          {
            name: "created_at",
            translations: {
              ara: "الاسم",
              en: "Created At"
            }

          },
          {
            name: "email",
            translations: {
              ara: "الايميل",
              en: "Email"
            }

          },

        ],
        loading: false,
        pagination: {
          total: 0,
          lastPage: 1,
          perPage: 15,
          currentPage: 1
        },
      }
    },
    mounted() {
      const queryStringObject = queryString.parse();

      this.loadData({
        page: queryStringObject.page,
        perPage: queryStringObject.perPage
      });
    },
    methods: {
      loadData({filters = {}, page = null, sorting = {}, perPage = 15} = {}) {
        // filters = filters && typeof filters === "object" ? filters : {}
        // sorting = sorting && typeof sorting === "object" ? sorting : {}
        const params = {
          page: !isNaN(parseInt(page, 10)) ? page : this.pagination.currentPage,
          perPage: !isNaN(parseInt(perPage, 15)) ? perPage : this.pagination.perPage,
        };
        this.loading = true;
        return getUsers(params)
            .then(({data}) => {
              this.changeUrlUsingParams(params);
              console.log(' data ', data);
              this.loading = false;
              this.rows = data.data;
              this.pagination = {
                total: data.meta.total,
                lastPage: data.meta.last_page,
                perPage: parseInt(data.meta.per_page),
                currentPage: data.meta.current_page
              };
            }).catch(error => {
              console.log('Error : ', error);
            });
      },
      changeUrlUsingParams(params) {

        let serializedQueryString = queryString.serialize(params);

        serializedQueryString = serializedQueryString !== '' ? '?' + serializedQueryString : '';

        const url = window.location.protocol + "//" + window.location.host + window.location.pathname + serializedQueryString;

        history.pushState({}, document.title, url);
      },
      deActivateUser(user) {
        this.$swal('Hello Vue world!!!');

        Vue.swal({
          title: 'Deactivate User?',
          type: 'warning',
          allowEscapeKey: true,
          confirmButtonText: 'Deactivate',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
        }).then(result => {
          if(result.value){
            deactivateUser(user.id)
                .then(resp => {
                  this.$toasted.show(resp.data.message, {
                    icon: 'icon-Lock_x40_2xpng_2'
                  });
                  this.loadData();

                })
                .catch(error => {
                  console.log(' error !', error);
                });
          }
          // console.log(' res is ', result)
        });

      },
      reActivateUser(user) {
        Vue.swal({
          title: 'Activate User?',
          type: 'warning',
          allowEscapeKey: true,
          confirmButtonText: 'Activate',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
        }).then(result => {
          if(result.value){
            activateUser(user.id)
                .then(resp => {
                  this.$toasted.show(resp.data.message, {
                    icon: 'icon-Unlock_x40_2xpng_2'
                  })

                  this.loadData();
                })
                .catch(error => {
                  console.log(' error !', error);
                });
          }
        });

      },
      editAccount(user) {
        window.location.href = `users/${user.id}/edit`;
      },
      viewAccount(user) {
        window.location.href = `users/${user.id}`;
      },
      addUser(){
        window.location.href = `users/create`;

      }


    },

  }
</script>