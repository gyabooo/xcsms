<div class="form-group">
  <label for="certificate" class="col-sm-2 control-label">証明書サービス</label>
  <div class="col-sm-10">
    <select class="form-control create-certificate_service-selectbox" id="certificate_service_id" name="certificate_service_id">
      @foreach ($certificate_services as $certificate_service)
        <option value="{{ $certificate_service->get_id() }}">{{ $certificate_service->get_name() }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label for="certificate" class="col-sm-2 control-label">証明書登録</label>
  <div class="col-sm-10">
    <certificates-drop-space submit-name="作成"></certificates-drop-space>
    <a href="{{ url()->previous() }}" class="btn btn-default" role="button">戻る</a>
  </div>
</div>