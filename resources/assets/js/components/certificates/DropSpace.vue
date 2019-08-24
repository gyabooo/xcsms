<template>
  <div class="drop-space">
    <div class="alert alert-danger alert-dismissible" role="alert" v-for="(error, index) in errors" v-bind:key="index">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{ error.message }}
      </div>
    <certificates-drop></certificates-drop>
    <certificates-submit :name="submitName" :errors="errors"></certificates-submit>
  </div>
</template>

<style>
.drop-space {
  margin-top: 10px;
}
</style>

<script>
  export default {
    data: function() {
      return {
        errors: []
      }
    },
    props: {
      submitName: String,
    },
    created: function () {
      this.$eventHub.$on('setErrorEvent',(error) => {

        let is_add = true;
        if(error['type'] === 'php') {
          this.errors.push(error)
          return;
        }

        for (let i=0; i < this.errors.length; i++) {
          let err = this.errors[i];
          if (err['type'] === error['type']) is_add = false;
        }
        if(is_add) this.errors.push(error)
      })

      this.$eventHub.$on('setErrorsEvent', (errors) => {
        this.errors = errors;
        console.log('After setErrorsEvent: ' + this.errors)
      })

      this.$eventHub.$on('deleteErrorEvent',(key) => {
        for (let i=0; i < this.errors.length; i++) {
          let error = this.errors[i]
          if (error['type'] === key) {
            this.errors.splice(i, 1)
            break;
          }
        }
      })

      this.$eventHub.$on('deleteAllErrorsEvent', () => {
        console.log('deleteAllErrorsEvent')
        this.errors.length = 0;
      })
    }
  }
</script>
