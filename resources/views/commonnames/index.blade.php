{{-- layouts/app.blade.php を継承 --}}
@extends('layouts.app')

<!-- ページタイトルを入力 -->
@section('title', 'コモンネーム一覧')

<!-- ページの見出しを入力 -->
@section('content_header')
@stop

@section('nav_header_menu')
    <h4 class="navbar-text">コモンネーム一覧</h4>
    <div class="btn-group navbar-btn-group" role="group">
        <a href="{{ route('commonnames.create') }}" class="btn btn-primary navbar-btn" role="button">新規作成</a>
    </div>
@stop

<!-- ページの内容を入力 -->
@section('content')
{{-- <div class="container" id="app"> --}}
    @if (count($commonnames) > 0)
        <div class="row">
          @foreach ($commonnames as $commonname)
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <p class="box-title">{{ $commonname->get_name() }}</p>
                </div>
                <div class="box-body">
                  <p class="box-text">有効期限: {{ $commonname->get_expiration_date() }}</p>
                  <p class="box-text">バーチャルドメイン: {{ $commonname->get_virtualdomain()->get_name() }}</p>
                </div>
                <div class="box-footer">
                  <ul class="nav nav-pills">
                    <li>
                      <a href="{{ route('commonnames.certificates.create', $commonname->get_id()) }}" class="content_detail" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="証明書新規登録">
                        <i class="fa fa-plus-square text-info"></i>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('commonnames.show', $commonname->get_id()) }}" class="content_detail" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="詳細">
                        <i class="fa fa-list-alt"></i>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('commonnames.edit', $commonname->get_id()) }}" class="content_edit" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="編集">
                        <i class="fa fa-edit"></i>
                      </a>
                    </li>
                    <li class='commonname-destroy-box' data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="削除">
                      <a class="content_destroy"  data-toggle="modal" data-target="#destroy-commonname-{{ $commonname->get_id() }}">
                        <i class="fa fa-trash text-danger"></i>
                      </a>
                      {{-- <delete-modal></delete-modal> --}}
                      <div class="modal fade destroy-modal" id="destroy-commonname-{{ $commonname->get_id() }}" tabindex="-1" style="z-index: 9999;">
                        <div class="moda-dialog modal-lg modal-dialog-center">
                          <form class="form-horizontal" action="{{ route('commonnames.destroy', $commonname->get_id()) }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3>削除してもよろしいですか？</h3>
                              </div>
                              <div class="modal-body">
                                <div>コモンネーム：{{ $commonname->get_name() }}</div>
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
          @endforeach
        </div>
    @endif
    
@stop
