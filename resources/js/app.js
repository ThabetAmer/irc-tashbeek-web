import Toasted from 'vue-toasted';
import VTooltip from 'v-tooltip'

import Builder from './builder/builder'
import Dashboard from './dashboard/dashboard'
import FirmProfile from './firm-profile/firmProfile'
import CaseListing from './case-listing/index'
import Seekers from './seekers/seekers'
import SeekerProfile from './seeker-profile/seekerProfile'
import Icon from './components/icon/icon'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.use(Toasted, {
  position: 'bottom-right',
  duration: 3000,
  iconPack: 'custom-class',
  theme: 'bubble',
  className: 'clipboard-custom-class'
});

Vue.use(VTooltip)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  components:{
    Builder,
    Dashboard,
    FirmProfile, // will Delete
    Firm:FirmProfile,
    CaseListing,
    Seekers,
    SeekerProfile, // will delete
    JobSeeker:SeekerProfile,
    Icon,
  },
});