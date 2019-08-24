{{-- layouts/app.blade.php を継承 --}}
@extends('layouts.app')

<!-- ページタイトルを入力 -->
@section('title', '証明書編集')

<!-- ページの見出しを入力 -->
@section('content_header')
@stop

<!-- ナビヘッダーにテキスト追加 -->
@section('nav_header_menu')
    <h4 class="navbar-text">証明書編集</h4>
    <h5 class="navbar-text">バーチャルドメイン - {{ $certificate->get_virtualdomain()->get_name() }}</h5>
    <h5 class="navbar-text">コモンネーム - {{ $certificate->get_commonname()->get_name() }}</h5>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <form action="{{ route('commonnames.certificates.update', [$commonname_id, $certificate->get_id()] ) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="btn-group certificate-btn-group" role="group">
        <a href="{{ route('commonnames.index') }}" class="btn btn-default" role="button">戻る</a>
      </div>

      <div class="edit-box box box-solid" id="certificate-edit-app">

        <div class="edit-flex">
          <div class="col-md-2 bg-success edit-title">シンボリックリンク</div>
          <div style="padding-left: 15px;">
            <certificates-symlink-button :symlink="{{ var_export($certificate->get_symlink()) }}" />
          </div>
        </div>

        <certificates-edit certificate-title="有効期限" certificate-value="{{ $certificate->get_expiration_date() }}"></certificates-edit>
        <div class="edit-flex">
          <div class="col-md-2 bg-success edit-title">証明書サービス</div>
          <div class="col-md-10 edit-certificate_service">
            <select class="form-control edit-certificate_service-selectbox" id="certificate_service_id" name="certificate_service_id">
              @foreach ($certificate_services as $certificate_service)
                @if ($certificate_service['selected'])
                  <option value="{{ $certificate_service['service']->get_id() }}" selected>{{ $certificate_service['service']->get_name() }}</option>
                @else
                  <option value="{{ $certificate_service['service']->get_id() }}">{{ $certificate_service['service']->get_name() }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
        <certificates-edit certificate-title="保存先ディレクトリ" certificate-value="{{ $certificate->get_save_dir_path() }}"></certificates-edit>
        <certificates-edit certificate-title="CSRファイル" certificate-value="{{ $certificate->get_csr() }}"></certificates-edit>
        <certificates-edit certificate-title="証明書" certificate-value="{{ $certificate->get_crt() }}" /></certificates-edit>
        <certificates-edit certificate-title="中間証明書" certificate-value="{{ $certificate->get_cacert() }}" /></certificates-edit>
        <certificates-edit certificate-title="秘密鍵" certificate-value="{{ $certificate->get_key() }}" /></certificates-edit>

      </div>

      <certificates-drop-space submit-name="更新"></certificates-drop-space>

    </form>
@stop