@extends('layouts.admin.app')

@section('title','Update category')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{trans('messages.category')}} {{trans('messages.update')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.category.update',[$category['id']])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.name')}}</label>
                                <input type="text" name="name" value="{{$category['name']}}" class="form-control" placeholder="">
                            </div>
                            <input name="position" value="0" style="display: none">
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{trans('messages.image')}}</label><small style="color: red">* ( {{trans('messages.ratio')}} 3:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg1">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12">
                            <center>
                                <img style="width: 30%;border: 1px solid; border-radius: 10px;" id="viewer"
                                     src="{{asset('storage/app/public/category')}}/{{$category['image']}}" alt=""/>
                            </center>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label"
                               for="exampleFormControlInput1"> {{\App\CentralLogics\translate('description')}} (EN)</label>
                         
                        <textarea name="description" value="{{$category['description']}}" style="min-height: 15rem; width: 100%; height:30%" class="form-control"  ></textarea>
                   
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{trans('messages.update')}}</button>
                </form>
            </div>
            <!-- End Table -->
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
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
@endpush
