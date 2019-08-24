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
    <form class="form-horizontal" action="{{ route('commonnames.update', $commonname->get_id()) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}

      <div class="form-group">
        <label for="commonname" class="col-sm-2 control-label">コモンネーム</label>
        <div class="col-sm-10">
          <input type="text" name="commonname" id="commonname" class="form-control" value="{{ $commonname->get_name() }}">
        </div>
      </div>

      <div class="form-group">
        <label for="virtualdomain_id" class="col-sm-2 control-label">バーチャルドメイン</label>
        <div class="col-sm-10">
          <select class="form-control" id="virtualdomain_id" name="virtualdomain_id">
            <option value="0">なし</option>
            @foreach ($virtualdomains as $virtualdomain)
              @if ($virtualdomain['selected'])
                <option value="{{ $virtualdomain['value']->get_id() }}" selected>{{ $virtualdomain['value']->get_name() }}</option>
              @else
                <option value="{{ $virtualdomain['value']->get_id() }}">{{ $virtualdomain['value']->get_name() }}</option>
              @endif
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10" role="group">
          <input type="submit" value="更新" class="btn btn-primary">
          <a href="{{ route('commonnames.index') }}" class="btn btn-default" role="button">戻る</a>
        </div>
      </div>

    </form>
@stop