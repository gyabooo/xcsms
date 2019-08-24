{{-- layouts/app.blade.php を継承 --}}
@extends('layouts.app')

<!-- ページタイトルを入力 -->
@section('title', 'コモンネーム作成')

<!-- ページの見出しを入力 -->
@section('content_header')
@stop

<!-- ナビヘッダーにテキスト追加 -->
@section('nav_header_menu')
    <h4 class="navbar-text">証明書登録</h4>
    <h5 class="navbar-text">バーチャルドメイン - {{ $commonname->get_virtualdomain()->get_name() }}</h5>
    <h5 class="navbar-text">コモンネーム - {{ $commonname->get_name() }}</h5>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <form class="form-horizontal" action="{{ route('commonnames.certificates.store', $commonname->get_id()) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

      @include('shared.create-form-select', ['certificate_services' => $certificate_services])

    </form>
@stop