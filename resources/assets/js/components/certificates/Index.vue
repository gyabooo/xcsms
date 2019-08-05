<template>
  <div class="container">
    <div class="row">
        <card v-for="(certificate, index) in certificates" v-bind:key="index" v-bind:certificate="certificate"></card>
    </div>
  </div>
</template>

<script>
  import card from './Card.vue'

  export default {
    components: { card },
    data: function() {
      return {
        certificates: []
      }
    },
    methods: {
        getCertificates: function () {
            axios.get('/api/certificates')
            .then((res) => {
                this.certificates = res.data
            })
        }
    },
    created() {
      this.getCertificates()
    }
  }
</script>

