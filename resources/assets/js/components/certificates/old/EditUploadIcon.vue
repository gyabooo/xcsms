<template>
  <div class="col-md-4 edit-icon">
    <label :for="type" :class="type" role="button">
      <span class="glyphicon glyphicon-file" aria-hidden="true"></span>ファイル選択
      <input type="file" :name="type" :id="type" role="button" class="hidden" @change="onUpload">
    </label>
    <span>{{ filename }}</span>
  </div>
</template>

<style>
.edit-icon {
  border-left: solid 1px #ccc;
}
</style>

<script>
  export default {
    data: function() {
      return {
        filename: ''
      }
    },
    methods: {
      onUpload(event) {
        let fileList = event.target.files;
        this.$emit('updateFiles', fileList[0].name);
      }
    },
    props: {
      file_type: null
    },
    computed: {
      type: function() {
        return "file-select-" + this.file_type;
      }
    }
  }
</script>