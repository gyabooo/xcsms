<template>
      <div class="col-md-6">
        <div class="box box-solid">
          <div class="box-header with-border">
            <div class="box-body">
              <h3 class="box-title">{{ certificate.name }}</h3>
              <p class="box-text">有効期限: {{ certificate.expiration_date }}</p>
            </div>
          </div>
          <div class="box-footer">
            <ul class="nav nav-pills">
              <li>
                <a v-bind:href="'/certificates/' + certificate.id" class="content_detail" data-toggle="tooltip" data-placement="top" data-original-title="詳細">
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
            </ul>
          </div>
        </div>
      </div>
</template>



