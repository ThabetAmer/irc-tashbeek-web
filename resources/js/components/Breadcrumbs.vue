<template>
  <div class="breadcrumbs-container">
    <ol>
      <li>
        <i class=" icon-Right_Arrow_1_1" />
        <a
          :href="'/'"
          class="menu-link no-underline text-sm"
        >
          <!--<a>Login</a>-->
          Dashboard
        </a>
      </li>
      <li
        v-for="crumb in crumbs"
        :key="crumb.name"
      >
        <i class=" icon-Right_Arrow_1_1" />
        <a
          :href="crumb.link ? crumb.link :'javascript:void(0)'"
          :class="`menu-link no-underline text-sm ${crumb.link ? 'cursor-pointer':'cursor-default'}`"
        >
          <!--<a>Login</a>-->
          {{ crumb.name }}
        </a>
      </li>
    </ol>
  </div>
</template>

<script>


  export default {
    mixins: [],
    props: {
      crumbs: {
        type: Array,
        default: () => [
          {
            name: 'Dashboard',
            link: '/',
          },
          {
            name: 'View',
            link: 'Test',
          },
          {
            name: 'Ahmad Ali',
            link: 'Test',
          }
        ]
      }
    },
    data() {
      return {}
    },
    mounted() {
    },
    methods: {},

  }
</script>