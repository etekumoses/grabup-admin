@extends('layouts.admin.app')

@section('title','Add new Job')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('public/assets/admin/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('add')}} {{\App\CentralLogics\translate('new')}} {{\App\CentralLogics\translate('Job')}}
                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="javascript:" method="post" id="job_form"
                      enctype="multipart/form-data">
                       @csrf
                   
                            <div class="card p-4 lang_form" id="job-form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label">{{\App\CentralLogics\translate('title')}}</label>
                                        <input type="text" required name="title" id="job_name" class="form-control" placeholder="New Job" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlSelect1">{{\App\CentralLogics\translate('category')}}<span
                                                class="input-label-secondary">*</span></label>
                                        <select name="category_id" class="form-control js-select2-custom"
                                               >
                                            <option value="">---{{\App\CentralLogics\translate('select')}}---</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label" >{{\App\CentralLogics\translate('Company Name')}}</label>
                                        <input type="text"required name="company"  class="form-control" placeholder="Company Name" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlSelect1">{{\App\CentralLogics\translate('Deadline Date')}}<span
                                                class="input-label-secondary">*</span></label>
                                                <input type="date" class="form-control" name="dead_line" placeholder="Select Deadline Date" required="">
                                    </div>
                                </div>
                                
                                </div>

                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('Company Description')}}</label>
                                    <textarea name="comp_details" style="min-height: 8rem;" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('Role')}}</label>
                                    <textarea name="role" style="min-height: 8rem;" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('Responsibilities')}}</label>
                                    <textarea name="responsibilities" style="min-height: 8rem;" class="form-control" required></textarea>
                                </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label">{{\App\CentralLogics\translate('Address')}}</label>
                                    <input type="text" required name="address"  class="form-control" placeholder="Address" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label">{{\App\CentralLogics\translate('Country')}}</label>
                                    <input type="text" required name="country"  class="form-control" placeholder="Enter Country" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlSelect1">{{\App\CentralLogics\translate('Min Experience')}}<span
                                            class="input-label-secondary">*</span></label>
                                    <select name="min_experience" class="form-control js-select2-custom"
                                           >
                                        <option value="">---{{\App\CentralLogics\translate('select')}}---</option>
                                        
                                            <option value="1">1 year</option>
                                            <option value="2">2 years</option>
                                            <option value="3">3 years</option>
                                            <option value="4">4 years</option>
                                            <option value="4">5+ years</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label" >{{\App\CentralLogics\translate('Required Skills')}}</label>
                                    <input type="text"required name="required_skills"  class="form-control" placeholder="Required Skills" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlSelect1">{{\App\CentralLogics\translate('Work Type')}}<span
                                            class="input-label-secondary">*</span></label>
                                            <select name="work_type" class="form-control js-select2-custom"
                                           >
                                        <option value="">---{{\App\CentralLogics\translate('select')}}---</option>
                                        
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-Time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Remote">Remote</option>
                                            
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label">{{\App\CentralLogics\translate('Estimated Salary')}}(optional)</label>
                                    <input type="text"  name="min_price"  class="form-control" placeholder="Estimated Salary" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label">{{\App\CentralLogics\translate('Application Url')}}</label>
                                    <input type="text"  name="url"  class="form-control" placeholder="Website Url" >
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('Benefits')}}(optional)</label>
                                <textarea name="benefits" style="min-height: 8rem;" class="form-control" ></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                                <label>{{\App\CentralLogics\translate('Company')}} {{\App\CentralLogics\translate('image')}}</label><small
                                    style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 1:1 )</small>
                                <div>
                                    <div class="row" id="coba"></div>
                                </div>
                            </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('submit')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
<script src="{{asset('public/assets/admin/js/spartan-multi-image-picker.js')}}"></script>
    
<script>
   $('#job_form').on('submit', function () {
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post({
            url: '{{route('admin.job.store')}}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    toastr.success('Job Added successfully!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function () {
                        location.href = '{{route('admin.job.list')}}';
                    }, 2000);
                }
            }
        });
});
</script>
<script>
    $(document).on('ready', function () {
        $('.js-select2-custom').each(function () {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#coba").spartanMultiImagePicker({
            fieldName: 'image',
            maxCount: 1,
            rowHeight: '215px',
            groupClassName: 'col-3',
            maxFileSize: '',
            placeholderImage: {
                image: '{{asset('public/assets/admin/img/400x400/img2.jpg')}}',
                width: '100%'
            },
            dropFileLabel: "Drop Here",
            onAddRow: function (index, file) {

            },
            onRenderedPreview: function (index) {

            },
            onRemoveRow: function (index) {

            },
            onExtensionErr: function (index, file) {
                toastr.error('Please only input png or jpg type file', {
                    CloseButton: true,
                    ProgressBar: true
                });
            },
            onSizeErr: function (index, file) {
                toastr.error('File size too big', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        });
    });
</script>
@endpush

 


