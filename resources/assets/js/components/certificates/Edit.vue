<template>
  <div class="edit-flex">
    <div class="col-md-2 bg-success edit-title">{{ certificateTitle }}</div>
    <div class="col-md-10">{{ certificateValue }}</div>
  </div>
</template>

<style>
.edit-box {
  border: solid 1px #ccc;
}
.edit-flex {
  display: flex;
  height: 52px;
  line-height: 52px;
  border-top: solid 1px #ccc;
}
.edit-title {
  font-weight: 700;
  border-right: solid 1px #ccc;
}
.edit-icon {
  border-left: solid 1px #ccc;
}
.edit-certificate_service {
  position: relative;
}
.edit-certificate_service-selectbox {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  position: absolute;
  margin: auto;
  width: calc(100% - 30px);
}
</style>

<script>
  export default {
    data: function() {
      return {
      }
    },
    props: {
      certificateTitle: {
        type: String,
        required: true,
        default: 'ファイル'
      },
      certificateValue: {
        type: String,
        required: true,
        default: ' '
      }
    },
  }
</script>