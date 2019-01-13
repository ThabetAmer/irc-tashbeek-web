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
          Edit user
        </div>
      </Btn>
      <div class="w-full flex-wrap flex mb-10">
        <div class="sm:w-full lg:w-1/3 hd:w-1/5 pt-5 pl-5">
          <Avatar
            class="sm:mx-auto"
            :src="imageSrc"
            :size="150"
            :username="name"
            @click="console.log('clicked')"
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
                  {{ imageSrc? 'Change': 'Upload' }}
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
                Name
              </label>
              <input
                id="grid-first-name"
                v-model="user.name"
                :disabled="!showEdit"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white ${!showEdit ? 'cursor-not-allowed':''}  ${!internalError['name'] ? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="text"
                placeholder="Name"
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
                Email
              </label>
              <input
                id="email"
                v-model="user.email"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white  ${!internalError['email']? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="text"
                placeholder="Email"
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
                Password
              </label>
              <input
                id="password"
                v-model="user.password"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white  ${!internalError['password']? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="password"
                placeholder="******************"
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
                Confirm password
              </label>
              <input
                id="password_confirm"
                v-model="user.password_confirmation"
                :class="`appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3
               px-4 leading-tight focus:outline-none focus:bg-white  ${!internalError['password']? 'focus:border-grey border border-grey-lighter focus:border-grey':'border border-red '}`"
                type="password"
                placeholder="******************"
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
            class="text-left block uppercase tracking-wide text-grey-darker text-md font-bold mb-2"
            for="password_confirm"
          >
            User Roles
          </label>

          <div class="md:flex md:items-center mb-6">
            <!--<label class="md:w-2/3 block text-grey font-bold">-->
            <!--<input-->
            <!--class="mr-2 leading-tight"-->
            <!--type="checkbox"-->
            <!--&gt;-->
            <!--<span class="text-sm">-->
            <!--Send me your newsletter!-->
            <!--</span>-->
            <!--</label>-->
            [TODO]
            <!--<CheckboxGroup-->
            <!--:checkboxes="checkboxes"-->
            <!--display="inline"-->
            <!--/>-->
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
              {{ userProp ? 'Update user':'Create user' }}
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
      }
    },
    data() {
      return {
        internalError:[],
        showEdit: true,
        imageSrc: 'https://picsum.photos/200/300',
        user: {},
        name: '',
        checkboxes: [
          {
            value: 1,
            label: 'Admin'
          },
          {
            value: 2,
            label: 'Other'
          },
          {
            value: 3,
            label: 'Viewer'
          }
        ]
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
        this.name = "New User";
      }
    },
    methods: {
      handleUserCreate() {
        if (this.userProp) {
          updateUser(this.user.id, this.user)
              .then(resp => {
                this.$toasted.show(resp.data.message, {
                  icon: 'icon-Checkmark_2_x40_2xpng_2'
                });
                this.name = this.user.name;
              })
              .catch(error => {
              });
        }
        else {
          createUser(this.user)
              .then(resp => {
                console.log(' resp is ', resp);
                this.name = this.user.name;
                this.internalError = [];
                this.$toasted.show(resp.data.message, {
                  icon: 'icon-Checkmark_2_x40_2xpng_2'
                });
              })
              .catch(error => {
                if (error.response.status === 422) {
                  this.internalError = error.response.data.errors
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
      }
    },

  }
</script>