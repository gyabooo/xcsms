<template>
  <div>
    <div class="alert alert-danger" v-for="(error, key) in errors" v-bind:key="key">{{ error }}</div>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        errors: {}
      }
    },
    created: function () {
      this.$eventHub.$on('setErrorEvent',(error) => {
        for (let key of Object.keys(error)) {
          this.$set(this.errors, key, error[key]);
        }
        // this.$eventHub.$emit('setSubmitErrorEvent');
      })

      this.$eventHub.$on('deleteErrorEvent',(error) => {
        // debugger
        // if (this.errors[error])
        this.$delete(this.errors, error);
        // console.log(this.errors)
        // this.$eventHub.$emit('deleteSubmitErrorEvent');
      })

      this.$eventHub.$on('deleteAllErrorsEvent', () => {
        for (let key of Object.keys(this.errors)) {
          this.$delete(this.errors, key);
        }
        // this.$eventHub.$emit('deleteSubmitAllErrorEvent');
      })
    }
  }
</script>