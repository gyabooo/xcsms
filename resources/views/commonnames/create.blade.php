{{-- layouts/app.blade.php を継承 --}}
@extends('layouts.app')

<!-- ページタイトルを入力 -->
@section('title', 'コモンネーム作成')

<!-- ページの見出しを入力 -->
@section('content_header')
@stop

<!-- ナビヘッダーにテキスト追加 -->
@section('nav_header_menu')
    <h4 class="navbar-text">コモンネーム作成</h4>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <form class="form-horizontal" action="{{ route('commonnames.store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="commonname" class="col-sm-2 control-label">コモンネーム</label>
        <div class="col-sm-10">
          <input type="text" name="commonname" id="commonname" class="form-control">
        </div>
      </div>

      <div class="form-group">
        <label for="virtualdomain_id" class="col-sm-2 control-label">バーチャルドメイン</label>
        <div class="col-sm-10">
          <select class="form-control" id="virtualdomain_id" name="virtualdomain_id">
            <option value="0">なし</option>
            @foreach ($virtualdomains as $virtualdomain)
              <option value="{{ $virtualdomain->get_id() }}">{{ $virtualdomain->get_name() }}</option>
            @endforeach
          </select>
        </div>
      </div>

      @include('shared.create-form-select', ['certificate_services' => $certificate_services])
    </form>
@stop