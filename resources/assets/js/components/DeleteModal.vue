<template>
<a class="modal-box">
  <!-- <a href="" class='modal_box' data-toggle="tooltip" data-placement="top" data-original-title="削除"> -->

    <label for="trigger" class="open_button" data-toggle="tooltip" data-placement="top" data-original-title="削除"> 
      <i class="fa fa-trash"></i>
    </label>
  <!-- </a> -->
    <div class="modal_wrap">
      <input id="trigger" type="checkbox">
      <div class="modal_overlay">
        <label for="trigger" class="modal_trigger"></label>
        <div class="modal_content">
          <label for="trigger" class="close_button">✖️</label>
          <h2>Modal Content</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
        </div>
      </div>
    </div>
</a>
</template>

<style>
.modal-box {
  padding: 0px;
  margin: 0;
}

.modal_wrap input{
    display: none;
}

.modal_overlay{
    display: flex;
    justify-content: center;
    overflow: auto;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    opacity: 0;
    transition: opacity 0.5s, transform 0s 0.5s;
    transform: scale(0);
}

.modal_trigger{
    position: absolute;
    width: 100%;
    height: 100%;
}

.modal_content{
    align-self: center;
    width: 60%;
    max-width: 800px;
    padding: 30px 30px 15px;
    box-sizing: border-box;
    background: #fff;
    line-height: 1.4em;
    transform: scale(0.3);
    transition: 0.5s;
}

.close_button{
    position: absolute;
    top: 14px;
    right: 16px;
    font-size: 24px;
    cursor: pointer;
}

.modal_wrap input:checked ~ .modal_overlay{
    opacity: 1;
    transform: scale(1);
    transition: opacity 0.5s;
}

.modal_wrap input:checked ~ .modal_overlay .modal_content{
    transform: scale(1);
}

.open_button{
    /* position: fixed; */
    /* top: 0;
    right: 0;
    bottom: 0;
    left: 0; */
    display: flex;
    justify-content: center;
    align-items: center;
    width: 49px;
    height: 45px;
    /* margin: auto; */
    /* padding: 8px 16px; */
    color: #444;
    /* font-weight: bold; */
    /* font-family: 'Montserrat', sans-serif; */
    /* box-shadow: 0 1px 3px rgba(0,0,0,0.6); */
    /* border-radius: 16px; */
    cursor: pointer;
    margin: 0;
    /* position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0; */
    /* margin: auto; */
}

.open_button:hover {
  
}
</style>

<script>
export default {
  data () {
    return {
    }
  },
}
</script>