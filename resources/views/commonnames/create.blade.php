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
  <div class="container" id="app">
    <form action="{{ route('commonnames.create') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="btn-group certificate-btn-group" role="group">
        <input type="submit" value="作成" class="btn btn-primary">
        <a href="{{ url()->previous() }}" class="btn btn-default" role="button">戻る</a>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-solid">
            <table class="certificate-table table table-bordered">
              <tr>
                <th class="col-md-2 bg-success">シンボリックリンク</th>
                <td colspan="3">
                  <toggle-button
                    :value="{{ var_export($certificate->get_symlink()) }}"
                    :labels="{checked: '有効', unchecked: '無効'}"
                    :width="100"
                    :height="30"
                    :font-size="14"
                  ></toggle-button>
                </td>
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
          </div>
          {{-- <div id="app"> --}}
              <drop></drop>
          {{-- </div> --}}
        </div>
      </div>
    </form>
  </div>
@stop