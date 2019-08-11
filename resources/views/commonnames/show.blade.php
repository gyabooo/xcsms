{{-- layouts/app.blade.php を継承 --}}
@extends('layouts.app')

<!-- ページタイトルを入力 -->
@section('title', 'コモンネーム詳細')

<!-- ページの見出しを入力 -->
@section('content_header')
@stop

<!-- ナビヘッダーにテキスト追加 -->
@section('nav_header_menu')
    <h4 class="navbar-text">コモンネーム詳細</h4>
    <h5 class="navbar-text">バーチャルドメイン - {{ $commonname->get_virtualdomain()->get_name() }}</h5>
    <h5 class="navbar-text">コモンネーム - {{ $commonname->get_name() }}</h5>
@stop

<!-- ページの内容を入力 -->
@section('content')
  @if ($commonname->get_certificate_list())
    <div class="container" id="app">
      <form action="{{ route('commonnames.update', $commonname->get_id()) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="btn-group certificate-btn-group" role="group">
          <a href="{{ route('commonnames.certificates.create', $commonname->get_id()) }}" class="btn btn-primary" role="button">新規登録</a>
          <a href="{{ url()->previous() }}" class="btn btn-default" role="button">戻る</a>
        </div>
    @foreach ($commonname->get_certificate_list() as $certificate)
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
          <table class="certificate-table table table-bordered">
            <tr>
              <th class="col-md-2 bg-success">シンボリックリンク</th>
              <td>
                  <toggle-button
                    :value="{{ var_export($certificate->get_symlink()) }}"
                    :labels="{checked: '有効', unchecked: '無効'}"
                    :disabled="true"
                    :width="100"
                    :height="30"
                    :font-size="14"
                  ></toggle-button>
              </td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">有効期限</th>
              <td>{{ $certificate->get_expiration_date() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">証明書サービス</th>
              <td>{{ $certificate->get_service() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">保存先ディレクトリ</th>
              <td>{{ $certificate->get_save_dir_path() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">csrファイル</th>
              <td>{{ $certificate->get_csr() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">crtファイル</th>
              <td>{{ $certificate->get_crt() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">cacertファイル</th>
              <td>{{ $certificate->get_cacert() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">keyファイル</th>
              <td>{{ $certificate->get_key() }}</td>
            </tr>
            <tr>
                <th class="col-md-2 bg-success">操作</th>
                <td>
                  <a href="{{ route('commonnames.certificates.edit', [$commonname->get_id(), $certificate->get_id()] ) }}" class="btn btn-default" role="button">編集</a>
                  <a href="{{ route('commonnames.certificates.destroy', [$commonname->get_id(), $certificate->get_id()] ) }}" class="btn btn-danger" role="button">削除</a>
                </td>
                {{-- <td></td> --}}
            </tr>
            {{-- <tr>
              <drop @send-file="sendFile"></drop>
            </tr> --}}
          </table>
        </div>
        </div>
      </div>
    @endforeach
      </form>
    </div>
  @endif
@stop