<template>
  <toggle-button
    @change="onChange"
    :value="this.symlink"
    :labels="{checked: '有効', unchecked: '無効'}"
    :width="100"
    :height="30"
    :font-size="14"
  ></toggle-button>
</template>

<style>

</style>

<script>
  import { ToggleButton } from 'vue-js-toggle-button'
  Vue.component('ToggleButton', ToggleButton);

  export default {
    data: function() {
      return {
      }
    },
    methods: {
      onChange(payload) {
        this.$eventHub.$emit('postDataEvent', {
          'is_symlink': payload.value,
        });
      }
    },
    props: {
      symlink: Boolean,
    },
    mounted: function() {
      this.$eventHub.$emit('postDataEvent', {
        'is_symlink': this.symlink
      });
    }
  }
</script>