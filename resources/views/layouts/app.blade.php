<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@stop