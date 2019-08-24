<template>
  <div>
    <!-- <div class="alert alert-danger" v-for="(error, key) in errors" v-bind:key="key">{{ error }}</div> -->
    <div class="drop" @dragleave.prevent @dragover.prevent @drop.prevent="onDrop">
        <label>ファイルを一括アップロード</label>
    </div>
    <button class="drop-all-delete-btn" v-show="is_upload" @click.prevent="deleteAllFile()">全て削除</button>
    <div class="drop-table" v-for="(file, index) in files" v-bind:key="index">
      <div class="drop-title bg-success">{{ file.title }}</div>
      <div class="drop-text">{{ file.file.name }}</div>
      <button class="drop-delete-btn" @click.prevent="deleteFile(index)">削除</button>
    </div>
    <!-- <button class="drop-submit btn btn-primary" @click.prevent="fileUpload">登録</button> -->
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
  margin-bottom: 10px;
}
.drop-title {
  height: 40px;
  width: 200px;
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
.drop-all-delete-btn {
  margin-bottom: 10px;
}
.drop-submit {
  margin-bottom: 10px;
}
</style>

<script>
  export default {
    data: function(){
      return {
        is_upload: false,
        files: [],
        errors: {},
      }
    },
    methods:{
      setFile(file) {
        let extention = file.name.split(".").pop();
        let title = '';

        switch(extention){
          case 'crt':
            title = '証明書'
            break;

          case 'pem':
            title = '中間証明書'
            break;
          
          case 'key':
            title = '秘密鍵'
            break;
          
          case 'csr':
            title = 'CSR'
            break;
          
          default:
            extention = 'none';
            title = 'サポート外の拡張子';
            break;
        }
            
        this.files.push({
          'title': title,
          'type': extention,
          'file': file
        });
      },

      onDrop(event){
        let fileList = event.target.files ? event.target.files : event.dataTransfer.files;
        this.is_upload = true;

        for(let i = 0; i < fileList.length; i++){
            this.setFile(fileList[i])
        }
        this.checkErrors();
        this.$eventHub.$emit('postDataEvent', {
          'files[]': this.files,
        });
      },

      deleteFile(index) {
        this.files.splice(index, 1)
        if (this.files.length === 0) this.is_upload = false;

        this.checkErrors();
        this.$eventHub.$emit('postDataEvent', {
          'files[]': this.files,
        });
      },

      deleteAllFile() {
        this.files.splice(0, this.files.length);
        this.is_upload = false;
        this.$eventHub.$emit('postDataEvent', {
          'files[]': this.files,
        });
      },

      setError(error){
        this.$eventHub.$emit('setErrorEvent', error);
        // this.$set(this.errors, key, value);
      },

      deleteError(key){
        this.$eventHub.$emit('deleteErrorEvent', key);
        // this.$delete(this.errors, key);
      },

      checkErrors(){
        if (this.isFilesCountError()){
          let error = {
            'type': 'file_counts',
            'message': 'ファイルが5つ以上選択されています'
          }
          this.setError(error);
        }
        else{
          this.deleteError('file_counts')
        }

        if (this.isExtentionError()){
          let error = {
            'type': 'extention',
            'message': 'サポート外の拡張子がアップロードされています'
          }
          this.setError(error);
        }
        else{
          this.deleteError('extention');
        }

        if (this.isSameFileError()){
          let error = {
            'type': 'samefile',
            'message': '拡張子が同じファイルがアップロードされています'
          }
          this.setError(error);
        }
        else{
          this.deleteError('samefile');
        }
      },

      isFilesCountError(){
        if(this.files.length > 4){
          return true;
        }
        return false;
      },

      isExtentionError(){
        for(let i = 0; i < this.files.length; i++){
          if(this.files[i].type === 'none') {
            return true;
          }
        }
        return false;
      },

      isSameFileError() {
        let types = ['crt', 'csr', 'pem', 'key'];
        for(let i = 0; i < types.length; i++){
          if (this.files.filter(file => file.type === types[i]).length > 1) {
            return true;
          }
        }
        return false;
      }
    },
  }
</script>
