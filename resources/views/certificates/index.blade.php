{{-- layouts/app.blade.php を継承 --}}
@extends('layouts.app')

<!-- ページタイトルを入力 -->
@section('title', '証明書一覧')

<!-- ページの見出しを入力 -->
@section('content_header')
@stop

@section('nav_header_menu')
    <h4 class="navbar-text">証明書一覧</h4>
@stop

<!-- ページの内容を入力 -->
@section('content')
  {{-- <div id="app">
        <certificate_index></certificate_index>
  </div> --}}
    @if (count($commonnames) > 0)
        <div class="row">
          @foreach ($commonnames as $commonname)
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div class="box-body">
                    <p class="box-title">{{ $commonname->get_name() }}</p>
                    <p class="box-text">有効期限: {{ $commonname->get_expiration_date() }}</p>
                    <p class="box-text">バーチャルドメイン: {{ $commonname->get_virtualdomain() }}</p>
                  </div>
                </div>
                <div class="box-footer">
                  <ul class="nav nav-pills">
                    <li>
                      <a href="{{ route('commonnames.show', $commonname->get_id()) }}" class="content_detail" data-toggle="tooltip" data-placement="top" data-original-title="詳細">
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
          @endforeach
        </div>
    @endif
@stop
