<template>
  <!--
   Select with search that takes props
   options can be array of values or array
   of objects. multiple is either true or false
   to allow for selecting multiple objects at once
   track-by is the key the objects get tracked
   by. by default it is set to the name.
   label is the key which gets shown in the
   select dropdown
   @input and @select are events that emit the
   select object/s
   -->
  <Multiselect
    :class="selectStyle"
    :options="filters"
    :value="value"
    select-label=""
    :multiple="multiple"
    :track-by="trackBy"
    :label="label"
    :placeholder="placeholder"
    @input="handleInput"
    @select="handleSelect"
  >
    <template
      slot="singleLabel"
      slot-scope="{option}"
    >
      {{ option.label }}
    </template>
    <template
      slot="option"
      slot-scope="{option}"
    >
      <label
        v-tooltip="{content:option.label,classes:['tooltip-datatable']}"
      >
        <input
          type="checkbox"
          class="mr-1"
          :checked="userFilters.map(filter => filter.name).indexOf(option.name) > -1"
          @click="handleSelect(option)"
        >
        {{ option.label }}
      </label>
    </template>
  </Multiselect>
</template>

<script>
  import Multiselect from 'vue-multiselect'
  import classNames from 'classnames'
  import VTooltip from 'v-tooltip'

  export default {
    components: {Multiselect},
    /**
     * all props have their needed types
     * and they also have their default
     * non-effecting values/default values
     */
    props: {
      label: {
        type: String,
        default: ''
      },
      value: {
        type: [String, Number, Object, Array],
        default: null
      },
      filters: {
        type: Array,
        default: function () {
          return []
        }
      },
      userFilters: {
        type: Array,
        default: function () {
          return []
        }
      },
      multiple: {
        type: [Boolean, String],
        default: false
      },
      placeholder: {
        type: String,
        default: 'select'
      },
      trackBy: {
        type: String,
        default: "name"
      },
      customClass: {
        type: String,
        default: ''
      }
    },
    computed: {
      selectStyle() {
        return classNames([
          'multiselect-field', this.customClass]);
      }
    },
    methods: {
      handleInput(value, id) {
        this.$emit('input', value);
      },
      handleSelect(selectedOption) {
        this.$emit('select', selectedOption);
      }
    }
  }
</script>

<style lang="scss">

</style>