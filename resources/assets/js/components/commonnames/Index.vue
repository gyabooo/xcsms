<template>
    <div class="row">
        <card v-for="(commonname, index) in commonnames" v-bind:csrf="csrf" v-bind:delete="delete_field" v-bind:key="index" v-bind:commonname="commonname"></card>
    </div>
</template>

<script>
  import card from './Card.vue'

  export default {
    components: { card },
    data: function() {
      return {
        commonnames: []
      }
    },
    methods: {
        getCommonnames: function () {
            axios.get('/api/commonnames')
            .then((res) => {
                this.commonnames = res.data
            })
        }
    },
    created() {
      this.getCommonnames()
    },
    props:['csrf', 'delete_field']
  }
</script>

