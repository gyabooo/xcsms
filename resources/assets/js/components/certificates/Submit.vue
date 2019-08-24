<template>
  <button class="submit btn btn-primary" @click.prevent="onSubmit">{{ name }}</button>
</template>

<style>
.submit {
  margin-bottom: 10px;
}
</style>

<script>
  export default {
    data: function() {
      return {
        postData: {},
      }
    },
    methods: {
      onSubmit(event) {
        let formData = new FormData(event.target.form);

        for (let key of Object.keys(this.postData)) {
          if (key === 'files[]') {
            for (let i=0; i < this.postData[key].length; i++) {
              formData.append(key, this.postData[key][i].file);
            }
          }
          else{
            formData.append(key, this.postData[key]);
          }
          
        }

        let js_errors = this.errors.filter(error => error.type !== 'php');

        this.$eventHub.$emit('deleteAllErrorsEvent');
        if (js_errors.length > 0) {
          this.$eventHub.$emit('setErrorsEvent', js_errors);
          return false;
        }

        axios.post(event.target.form.getAttribute('action'), formData)
        .then(res => {
            location.href = res.data.location_href
        })
        .catch(res => {
            let data = res.response.data
            if (data.status === 'error') {

              for (let key of Object.keys(data.errors)) {
                let error = {
                  'type': 'php',
                  'message': data.errors[key].join('\n')
                };
                // error['type'] = data.errors[key].join('\n');
                this.$eventHub.$emit('setErrorEvent', error);
              }
            }
            else {
              alert('送信に失敗しました')
            }
            console.log('after axios: ' + this.errors)
        });
      }
    },
    props: {
      name: String,
      errors: null,
    },
    created: function() {
      this.$eventHub.$on('postDataEvent', (postData) => {
        for (let key of Object.keys(postData)) {
          this.postData[key] = postData[key];
        }
      })
    }
  }
</script>