<template>
  <div class="user-container">
    <Panel
      custom-class=""
      :title="name"
    >
      <!--<h1>loading user</h1>-->
      <Btn
        v-if="viewOnly && !showEdit"
        class="m-3 absolute pin-r pin-t"
        theme="default"
        @click="enableFields"
      >
        <div slot="text">
          <i class="icon-Pencil_x40_2xpng_2 mr-2" />
          {{ 'irc.edit_user' | trans }}
        </div>
      </Btn>
      <div class="w-full flex-wrap flex mb-10">
        <div class="sm:w-full lg:w-1/3 hd:w-1/5 pt-5 pl-5">
          <Avatar
            class="sm:mx-auto"
            :src="imageSrc"
            :size="150"
            :username="name"
          />
          <Transition name="fade">
            <div
              v-if="showEdit"
              class="sm:mx-auto w-150 mt-5 sm:mb-5"
            >
              <Btn
                btn-class=""
                theme="default"
                @click="openViewer"
              >
                <div
                  slot="text"
                  class="flex items-center"
                >
                  <i class="icon-Photo_x40_2xpng_2 mr-2" />
                  {{ (imageSrc? 'irc.change': 'irc.upload') | trans }}
                </div>
              </Btn>

              <input
                ref="fileInput"
                aria-hidden="true"
                type="file"
                @change="handleFileChange"
              >
            </div>
          </Transition>
        </div>
        <div class="sm:w-full lg:w-2/3 ">
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label
                class="text-left block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                for="grid-first-name"
              >
                {{ 'irc.name' | trans }}
              </label>
              <input
                id="grid-first-name"
                v-model="user.name"
                :disabled="!showEdit"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white ${!showEdit ? 'cursor-not-allowed':''}  ${!internalError['name'] ? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="text"
                :placeholder="'irc.name' | trans"
              >
              <p
                v-if="internalError['name']"
                class="text-left text-red text-xs italic"
              >
                {{ internalError['name'][0] }}
              </p>
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label
                class="text-left block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                for="email"
              >
                {{ 'irc.email' | trans }}
              </label>
              <input
                id="email"
                v-model="user.email"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white  ${!internalError['email']? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="text"
                :placeholder="'irc.email' | trans"
              >

              <p
                v-if="internalError['email']"
                class="text-left text-red text-xs italic"
              >
                {{ internalError['email'][0] }}
              </p>
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
              <label
                class="text-left block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                for="password"
              >
                {{ 'irc.password' | trans }}
              </label>
              <input
                id="password"
                v-model="user.password"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white  ${!internalError['password']? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="password"
                placeholder="******"
              >

              <p
                v-if="internalError['password']"
                class="text-left text-red text-xs italic"
              >
                {{ internalError['password'][0] }}
              </p>
            </div>


            <div class="w-full md:w-1/2 px-3">
              <label
                class="text-left block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                for="password_confirm"
              >
                {{ 'irc.confirm_password' | trans }}
              </label>
              <input
                id="password_confirm"
                v-model="user.password_confirmation"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white  ${!internalError['password']? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="password"
                placeholder="******"
              >
              <p
                v-if="internalError['password']"
                class="text-left text-red text-xs italic"
              >
                {{ internalError['password'][0] }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3">
          <label
            class="text-left block uppercase tracking-wide text-grey-darker text-md font-bold mb-4"
          >
            {{ 'irc.user_roles' | trans }}
          </label>

          <div class="mb-6">
            <CheckboxGroup
              v-if="availableRoles.length > 0"
              :disabled="viewOnly"
              :checkboxes="availableRoles"
              @change="onRoleSelection"
            />
            <div v-else>
              {{ 'irc.no_assigned_roles' | trans }}
            </div>
          </div>
        </div>
      </div>

      <Transition name="fade">
        <div
          v-if="showEdit"
          class="w-full text-right"
        >
          <Btn
            theme="default"
            @click="handleUserCreate"
          >
            <p slot="text">
              {{ (userProp ? 'irc.update_user':'irc.create_user') | trans }}
            </p>
          </Btn>
        </div>
      </Transition>
    </Panel>
  </div>
</template>

<script>

  import Avatar from 'vue-avatar'
  import {update as updateUser} from '../API/userAPI'
  import {create as createUser} from '../API/userAPI'

  export default {
    components: {Avatar},
    mixins: [],
    props: {
      userProp: {
        type: Object,
        default: () => {
        }
      },
      viewOnly: {
        type: Boolean,
        default: false
      },
      roles: {
        type: Array,
        default: () => []
      }
    },
    data() {
      return {
        internalError: [],
        showEdit: true,
        imageSrc: '',
        user: {},
        name: '',
        checkboxes: [],
        availableRoles: [],
        selectedRoles: []
      }
    },
    beforeMount() {
      if (this.viewOnly) {
        this.showEdit = false;
      }
    },
    mounted() {
      if (this.userProp) {
        this.user = this.userProp;
        this.name = this.user.name;
      }
      else {
        this.user = {};
        this.imageSrc = "";
        this.name = this.$options.filters.trans('irc.create_new_user');
      }

      this.availableRoles = this.roles.map(role => ({
        ...role,
        label: role.name,
        value: role.id,
        checked: role.has_role
      }))

      this.selectedRoles = this.roles.filter(role => role.has_role === true).map(role => role.id)
    },
    methods: {
      handleUserCreate() {
        if (this.userProp) {
          updateUser(this.user.id, {
            ...this.user,
            roles: this.selectedRoles
          }).then(resp => {
            this.$toasted.show(resp.data.message, {
              icon: 'icon-Checkmark_2_x40_2xpng_2'
            });
            this.name = this.user.name;
          }).catch(error => {
            if (error.response.status === 422) {
              this.internalError = error.response.data.errors
            } else {
              this.$toasted.error("Something went wrong, cannot update user.");
            }
          });
        }
        else {
          createUser({
            ...this.user,
            ...this.selectedRoles
          }).then(resp => {
            this.name = this.user.name;
            this.internalError = [];
            this.$toasted.show(resp.data.message, {
              icon: 'icon-Checkmark_2_x40_2xpng_2'
            });
          }).catch(error => {
            if (error.response.status === 422) {
              this.internalError = error.response.data.errors
            }else{
              this.$toasted.error("Something went wrong, cannot create user.");
            }
          });
        }
      },
      createUser() {
        console.log(' createUser user');
      },
      enableFields() {
        this.showEdit = true;
      },
      openViewer() {
        this.$refs.fileInput.click();

      },
      handleFileChange(e) {
        // Whenever the file changes, emit the 'input' event with the file data.
        console.log(e.target.files);
        // this.imageSrc = e.target.files[0].name;
      },
      onRoleSelection(selection) {
        this.selectedRoles = selection.map(selection => selection.value)
      }
    },

  }
</script>