<template>
      <div class="col-md-6">
        <div class="box box-solid">
          <div class="box-header with-border">
            <div class="box-body">
              <h3 class="box-title">{{ commonname.name }}</h3>
              <p class="box-text">有効期限: {{ commonname.expiration_date }}</p>
            </div>
          </div>
          <div class="box-footer">
            <ul class="nav nav-pills">
              <li>
                <a v-bind:href="'/certificates/' + commonname.id" class="content_detail" data-toggle="tooltip" data-placement="top" data-original-title="詳細">
                  <i class="fa fa-list-alt"></i>
                </a>
              </li>
              <li>
                <a href="#" class="content_edit" data-toggle="tooltip" data-placement="top" data-original-title="編集">
                  <i class="fa fa-edit"></i>
                </a>
              </li>
              <li>
                <a href="#" class="content_destroy" data-toggle="tooltip" data-placement="top" data-original-title="削除">
                  <i class="fa fa-trash"></i>
                </a>
              </li>
              <li>
                <a :href="'/commonnames/' + commonname.id + '/certificates/create'" class="content_detail" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="証明書新規登録">
                  <i class="fa fa-plus-square"></i>
                </a>
              </li>
              <li>
                <a :href="'/commonnames/' + commonname.id" class="content_detail" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="詳細">
                  <i class="fa fa-list-alt"></i>
                </a>
              </li>
              <li>
                <a :href="'/commonnames/' + commonname.id + '/edit'" class="content_edit" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="編集">
                  <i class="fa fa-edit"></i>
                </a>
              </li>
              <li class='commonname-destroy-box' data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="削除">
                <a class="content_destroy"  data-toggle="modal" :data-target="modalDataTargetString">
                  <i class="fa fa-trash"></i>
                </a>
                {{-- <delete-modal></delete-modal> --}}
                <div class="modal fade destroy-modal" :id="modalDataTargetID" tabindex="-1" style="z-index: 9999;">
                  <div class="moda-dialog modal-lg modal-dialog-center">
                    <form class="form-horizontal" :action="'/commonnames/' + commonname.id" method="post" enctype="multipart/form-data">
                    {{ csrf }}
                    {{ delete_field }}
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3>削除してもよろしいですか？</h3>
                        </div>
                        <div class="modal-body">
                          <div>コモンネーム：{{ commonname.name }}</div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" value="削除" class="btn btn-primary">
                          <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
</template>

<script>
  export default {
    data: function() {
      return {
      }
    },
    props:['commonname', 'csrf', 'delete_field'],
    computed: {
      modalDataTargetID: function() {
        return 'destroy-commonname-' + this.commonname.name
      },
      modalDataTargetString: function() {
        return '#destroy-commonname-' + this.commonname.name
      }
    }
  }
</script>