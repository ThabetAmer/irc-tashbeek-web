<template>
  <div class="breadcrumbs-container">
    <ol
      v-if="crumbs.length>0"
      class=""
    >
      <li
        v-for="crumb in crumbs"
        :key="crumb.name"
      >
        <i class=" icon-Right_Arrow_1_1" />
        <a
          :href="crumb.link"
          class="menu-link no-underline text-sm"
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
            name: 'Job seekers',
            link: 'Test',
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