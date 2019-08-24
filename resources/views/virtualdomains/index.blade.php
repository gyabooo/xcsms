{{-- layouts/app.blade.php を継承 --}}
@extends('layouts.app')

<!-- ページタイトルを入力 -->
@section('title', 'バーチャルドメイン一覧')

<!-- ページの見出しを入力 -->
@section('content_header')
@stop

@section('nav_header_menu')
    <h4 class="navbar-text">バーチャルドメイン一覧</h4>
    <div class="btn-group navbar-btn-group" role="group">
        <a href="{{ route('virtualdomains.create') }}" class="btn btn-primary navbar-btn" role="button">新規作成</a>
    </div>
@stop

<!-- ページの内容を入力 -->
@section('content')
    @if (count($virtualdomains) > 0)
        <div class="row">
          @foreach ($virtualdomains as $virtualdomain)
            <div class="col-md-6">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title">バーチャルドメイン：{{ $virtualdomain->get_name() }}</h3>
                </div>
                {{-- <div class="panel-body">
                </div> --}}
                <div class="panel-footer">
                  <ul class="nav nav-pills">
                    <li role="presentation">
                      <a href="{{ route('virtualdomains.show', $virtualdomain->get_id()) }}" class="content_detail" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="詳細">
                        <i class="fa fa-list-alt"></i>
                      </a>
                    </li>
                    <li role="presentation">
                      <a href="{{ route('virtualdomains.edit', $virtualdomain->get_id()) }}" class="content_edit" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="編集">
                        <i class="fa fa-edit"></i>
                      </a>
                    </li>
                    <li class='virtualdomain-destroy-box' role="presentation" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="削除">
                      <a class="content_destroy"  data-toggle="modal" data-target="#destroy-virtualdomain-{{ $virtualdomain->get_id() }}">
                        <i class="fa fa-trash text-danger"></i>
                      </a>
                      <div class="modal fade destroy-modal" id="destroy-virtualdomain-{{ $virtualdomain->get_id() }}" tabindex="-1" style="z-index: 9999;">
                        <div class="moda-dialog modal-lg modal-dialog-center">
                          <form class="form-horizontal" action="{{ route('virtualdomains.destroy', $virtualdomain->get_id()) }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3>削除してもよろしいですか？</h3>
                              </div>
                              <div class="modal-body">
                                <div>バーチャルドメイン：{{ $virtualdomain->get_name() }}</div>
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
