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
  <div class="container">
    <form action="{{ route('commonnames.certificates.update', [$commonname_id, $certificate->get_id()] ) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="btn-group certificate-btn-group" role="group">
        <input type="submit" value="更新" class="btn btn-primary">
        <a href="{{ url()->previous() }}" class="btn btn-default" role="button">戻る</a>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-solid">
            <table class="certificate-table table table-bordered">
              <tr>
                <th class="col-md-2 bg-success">シンボリックリンク</th>
                @if ($certificate->get_symlink())
                  <td colspan="3" class="text-danger"><strong>有効</strong></td>
                @else
                  <td colspan="3">無効</td>
                @endif
              </tr>
              <tr>
                <th class="bg-success">有効期限</th>
                <td colspan="3">{{ $certificate->get_expiration_date() }}</td>
              </tr>
              <tr>
                <th class="bg-success">証明書サービス</th>
                <td colspan="3">{{ $certificate->get_service() }}</td>
              </tr>
              <tr>
                <th class="bg-success">保存先ディレクトリ</th>
                <td colspan="3"><input class="col-xs-12 col-sm-12 col-md-12 col-lg-12" type="text" name="save_dir_path" id="save_dir_path" placeholder="{{ $certificate->get_save_dir_path() }}"></td>
              </tr>
              <tr>
                <th class="bg-success">csrファイル</th>
                <td class="col-md-3">{{ $certificate->get_csr() }}</td>
                <td class="col-md-3">
                  <label for="file-select-csr-{{ $certificate->get_id() }}" class="file-select-csr" role="button">
                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>ファイル選択
                    <input type="file" name="csr-file[{{ $certificate->get_id() }}]" id="file-select-csr-{{ $certificate->get_id() }}" role="button"class="hidden">
                  </label>
                </td>
                <td class="col-md-2">
                  <label for="file-upload-csr-{{ $certificate->get_id() }}" class="file-upload-csr" role="button">
                    <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>サーバーへアップロード
                    <div id="file-upload-csr-{{ $certificate->get_id() }}" class="hidden"></div>
                  </label>
                </td>
              </tr>
              <tr>
                <th class="bg-success">crtファイル</th>
                <td>{{ $certificate->get_crt() }}</td>
                <td class="col-md-3">
                  <label for="file-select-crt-{{ $certificate->get_id() }}" class="file-select-crt" role="button">
                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>ファイル選択
                    <input type="file" name="crt-file[{{ $certificate->get_id() }}]" id="file-select-crt-{{ $certificate->get_id() }}" role="button"class="hidden">
                  </label>
                </td>
              </tr>
              <tr>
                <th class="bg-success">cacertファイル</th>
                <td>{{ $certificate->get_cacert() }}</td>
                <td class="col-md-3">
                  <label for="file-select-cacert-{{ $certificate->get_id() }}" class="file-select-cacert" role="button">
                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>ファイル選択
                    <input type="file" name="cacert-file[{{ $certificate->get_id() }}]" id="file-select-cacert-{{ $certificate->get_id() }}" role="button"class="hidden">
                  </label>
                </td>
              </tr>
              <tr>
                <th class="bg-success">keyファイル</th>
                <td>{{ $certificate->get_key() }}</td>
                <td class="col-md-3">
                  <label for="file-select-key-{{ $certificate->get_id() }}" class="file-select-key" role="button">
                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>ファイル選択
                    <input type="file" name="cacert-file[{{ $certificate->get_id() }}]" id="file-select-key-{{ $certificate->get_id() }}" role="button"class="hidden">
                  </label>
                </td>
              </tr>
            </table>
            <div id="app">
              <drop></drop>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
@stop