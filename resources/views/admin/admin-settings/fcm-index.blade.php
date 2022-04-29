@extends('layouts.admin.app')

@section('title','FCM Settings')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{\App\CentralLogics\translate('firebase')}} {{\App\CentralLogics\translate('push')}} {{\App\CentralLogics\translate('notification')}} {{\App\CentralLogics\translate('setup')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{env('APP_MODE')!='demo'?route('admin.admin-settings.update-fcm'):'javascript:'}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @php($key=\App\Model\AdminSetting::where('key','push_notification_key')->first()->value)
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{\App\CentralLogics\translate('server')}} {{\App\CentralLogics\translate('key')}}</label>
                                <textarea name="push_notification_key" class="form-control"
                                          required>{{env('APP_MODE')!='demo'?$key:''}}</textarea>
                            </div>

                            <div class="row" style="display: none">
                                @php($project_id=\App\Model\AdminSetting::where('key','fcm_project_id')->first()->value)
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">FCM Project ID</label>
                                        <input type="text" value="{{$project_id}}"
                                               name="fcm_project_id" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}" class="btn btn-primary">{{\App\CentralLogics\translate('submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
@endpush
