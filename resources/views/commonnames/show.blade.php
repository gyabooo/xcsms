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
        <div class="btn-group certificate-btn-group" role="group">
          <a href="{{ route('commonnames.certificates.create', $commonname->get_id()) }}" class="btn btn-primary" role="button">新規登録</a>
          <a href="{{ route('commonnames.index') }}" class="btn btn-default" role="button">戻る</a>
        </div>
    @foreach ($commonname->get_certificate_list() as $certificate)
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
          <table class="certificate-table table table-bordered">
            <tr>
              <th class="col-md-2 bg-success">ID</th>
              <td>{{ $certificate->get_id() }}</td>
            </tr>
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
              <td>{{ $certificate->get_service()->get_name() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">保存先ディレクトリ</th>
              <td>{{ $certificate->get_save_dir_path() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">CSRファイル</th>
              <td>{{ $certificate->get_csr() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">証明書</th>
              <td>{{ $certificate->get_crt() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">中間証明書</th>
              <td>{{ $certificate->get_cacert() }}</td>
            </tr>
            <tr>
              <th class="col-md-2 bg-success">秘密鍵</th>
              <td>{{ $certificate->get_key() }}</td>
            </tr>
            <tr>
                <th class="col-md-2 bg-success">操作</th>
                <td>
                  <a href="{{ route('commonnames.certificates.edit', [$commonname->get_id(), $certificate->get_id()] ) }}" class="btn btn-default" role="button">編集</a>
                  <a href="{{ route('commonnames.certificates.destroy', [$commonname->get_id(), $certificate->get_id()] ) }}" class="btn btn-danger" role="button" data-toggle="modal" data-target="#destroy-certificate-{{ $certificate->get_id() }}">削除</a>
                  <div class="modal fade destroy-modal" id="destroy-certificate-{{ $certificate->get_id() }}" tabindex="-1" style="z-index: 9999;">
                    <div class="moda-dialog modal-lg modal-dialog-center">
                      <form class="form-horizontal" action="{{ route('commonnames.certificates.destroy', [$commonname->get_id(), $certificate->get_id()]) }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3>この証明書を削除してもよろしいですか？</h3>
                          </div>
                          <div class="modal-body">
                            <div>ID：{{ $certificate->get_id() }}</div>
                          </div>
                          <div class="modal-footer">
                            <input type="submit" value="削除" class="btn btn-primary">
                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
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
  @endif
@stop