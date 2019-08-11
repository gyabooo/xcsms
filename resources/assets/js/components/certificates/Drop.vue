<template>
  <div>
    <pre class="text-danger" v-show="files.length > 4">ファイルが4つ以上選択されています</pre>
    <div class="drop" @dragleave.prevent @dragover.prevent @drop.prevent="onDrop">
        <label>ファイルを一括アップロード</label>
    </div>
    <div class="drop-table" v-for="(file, index) in files" v-bind:key="index">
      <div class="drop-title bg-success">ファイル {{ index + 1 }}</div>
      <div class="drop-text">{{ file.name }}</div>
      <button class="drop-delete-btn" @click.prevent="deleteFile(index)">削除</button>
    </div>
  </div>
</template>

<style>
.drop {
  border-style: dotted;
  height: 200px;
  line-height: 200px;
  text-align: center;
  background-color: #fff;
  margin-bottom: 10px;
}
.drop-table {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 40px;
}
.drop-title {
  height: 40px;
  width: 100px;
  border: solid 1px #ccc;
  line-height: 40px;
  text-align: center;
}
.drop-text {
  background-color: #fff;
  width: 100%;
  height: 100%;
  border: solid 1px #ccc;
  line-height: 40px;
  margin-right: 10px;
  padding-left: 10px;
}
.drop-delete-btn {
  width: 60px;
}
</style>

<script>
  export default {
    data: function(){
      return {
        files: [],
        errors: '',
        is_symlink: false
      }
    },
    methods:{
      onDrop(event){
        let fileList = event.target.files ? event.target.files : event.dataTransfer.files;
        console.log(event.dataTransfer.files)
        console.log(fileList.length)

        for(let i = 0; i < fileList.length; i++){
            this.files.push(fileList[i]);
            this.errors = '';
        }
      },
      deleteFile(index) {
        this.files.splice(index, 1)
      },
      fileUpload(){
        const formData = new FormData();
        formData.append('file', this.files);
        axios.post('http://localhost:8000/api/fileupload', formData).then(res =>{
            console.log(res)
        })
        .catch((error) => {
            console.log(error);
        });
      }
    },
    computed: {
    }
  }
</script>
