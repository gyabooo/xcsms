<template>
  <div class="content">
    <h1>File Upload</h1>
    <p><input type="file" multiple="multiple" @change="onDrop"></p>
    <button @click="fileUpload">アップロード</button>
  </div>
</template>

<script>
  export default {
    data: function(){
      return {
        fileinfo: ''
      }
    },
    methods:{
      onDrop(event){
        // console.log(event)
        this.fileinfo = event.target.files[0];
      },
      fileUpload(){
        // window.csrf_token = "{{ csrf_token() }}"
        // axios.defaults.headers.common = {
        //   'X-Requested-With': 'XMLHttpRequest',
        //   'X-CSRF-TOKEN': window.csrf_token
        // };
        const formData = new FormData();
        formData.append('file', this.fileinfo);
        axios.post('/api/fileupload', formData).then(res =>{
            console.log(res)
        })
        .catch((error) => {
            console.log(error);
        });
      }
    }
  }
</script>

<style>

</style>