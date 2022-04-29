@extends('layouts.admin.app')

@section('title','Update Exhibition')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/admin/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-edit"></i> {{\App\CentralLogics\translate('Exhibition')}} {{\App\CentralLogics\translate('update')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="javascript:" method="post" id="exhibition_form"
                      enctype="multipart/form-data">
                    @csrf
                    @php($language=\App\Model\BusinessSetting::where('key','language')->first())
                    @php($language = $language->value ?? null)
                    @if($language)
                    @php($default_lang = json_decode($language)[0])
                        <ul class="nav nav-tabs mb-4">

                            @foreach(json_decode($language) as $lang)
                                <li class="nav-item">
                                    <a class="nav-link lang_link {{$lang == 'en'? 'active':''}}" href="#" id="{{$lang}}-link">{{\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                </li>
                            @endforeach

                        </ul>
                        {{-- @foreach(json_decode($language) as $lang)
                        <div class="card p-4 {{$lang != $default_lang ? 'd-none':''}} lang_form" id="{{$lang}}-form">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label" for="{{$lang}}_name">{{\App\CentralLogics\translate('title')}}</label>
                                    <input type="text" {{$lang == $default_lang? 'required':''}} name="title[]" id="{{$lang}}_name"  value="{{$exhibition['title']}}" class="form-control" placeholder="New Exhibition" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label" for="{{$lang}}_name">{{\App\CentralLogics\translate('Venue')}}</label>
                                    <input type="text" {{$lang == $default_lang? 'required':''}} name="location" id="{{$lang}}_name" value="{{$exhibition['location']}}" class="form-control" placeholder="Venue" >
                                </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label"
                                        for="exampleFormControlSelect1">{{\App\CentralLogics\translate('Start Date')}}<span
                                            class="input-label-secondary">*</span></label>
                                            <input type="date" class="form-control" name="startdate" value="{{$exhibition['startdate']}}" placeholder="Event Start Date" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="input-label"
                                        for="exampleFormControlSelect1">{{\App\CentralLogics\translate('End Date')}}<span
                                            class="input-label-secondary">*</span></label>
                                            <input type="date" class="form-control" name="enddate" value="{{$exhibition['enddate']}}" placeholder="Event End Date" required="">
                                </div>
                            </div>
                            </div>

                            <input type="hidden" name="lang[]" value="{{$lang}}">
                            <div class="form-group pt-4">
                                <label class="input-label"
                                    for="{{$lang}}_description"> {{\App\CentralLogics\translate('details')}}</label>
                                <div id="{{$lang}}_editor" style="min-height: 15rem;"></div>
                                <textarea name="description[]" style="display:none" id="{{$lang}}_hiddenArea" value="{{$exhibition['description']}}"></textarea>
                            </div> 
                        </div>
                        @endforeach --}}
                        @foreach(json_decode($language) as $lang)
                            <div class="card p-4 {{$lang != $default_lang ? 'd-none':''}} lang_form" id="{{$lang}}-form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="{{$lang}}_name">{{\App\CentralLogics\translate('title')}}</label>
                                        <input type="text" {{$lang == $default_lang? 'required':''}} name="title[]" id="{{$lang}}_name" value="{{$exhibition['title']}}" class="form-control" placeholder="New Exhibition" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="{{$lang}}_name">{{\App\CentralLogics\translate('Venue')}}</label>
                                        <input type="text" {{$lang == $default_lang? 'required':''}} name="location" id="{{$lang}}_name" value="{{$exhibition['location']}}" class="form-control" placeholder="Location" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlSelect1">{{\App\CentralLogics\translate('Start Date')}}<span
                                                class="input-label-secondary">*</span></label>
                                                <input type="date" class="form-control" name="startdate" value="{{$exhibition['startdate']}}" placeholder="Event Start Date" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlSelect1">{{\App\CentralLogics\translate('End Date')}}<span
                                                class="input-label-secondary">*</span></label>
                                                <input type="date" class="form-control" name="enddate" value="{{$exhibition['enddate']}}" placeholder="Event End Date" required="">
                                    </div>
                                </div>
                                </div>

                                <input type="hidden" name="lang[]" value="{{$lang}}">
                                 <div class="form-group pt-4">
                                    <label class="input-label"
                                           for="{{$lang}}_description"> {{\App\CentralLogics\translate('details')}}</label>
                                    <div id="{{$lang}}_editor" style="min-height: 15rem;"></div>
                                    <textarea name="description[]" style="display:none" id="{{$lang}}_hiddenArea" value="{{$exhibition['description']}}"></textarea>
                                </div> 
                            </div>
                        @endforeach
                    @else
                    <div class="card p-4" id="{{$default_lang}}-form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="{{$lang}}_name">{{\App\CentralLogics\translate('title')}}</label>
                                <input type="text" {{$lang == $default_lang? 'required':''}} name="title[]" id="{{$lang}}_name"  value="{{$exhibition['title']}}" class="form-control" placeholder="New Exhibition" >
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="{{$lang}}_name">{{\App\CentralLogics\translate('Venue')}}</label>
                                <input type="text" {{$lang == $default_lang? 'required':''}} name="location" id="{{$lang}}_name" value="{{$exhibition['location']}}" class="form-control" placeholder="Venue" >
                            </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlSelect1">{{\App\CentralLogics\translate('Start Date')}}<span
                                        class="input-label-secondary">*</span></label>
                                        <input type="date" class="form-control" name="startdate" value="{{$exhibition['startdate']}}" placeholder="Event Start Date" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlSelect1">{{\App\CentralLogics\translate('End Date')}}<span
                                        class="input-label-secondary">*</span></label>
                                        <input type="date" class="form-control" name="enddate" value="{{$exhibition['enddate']}}" placeholder="Event End Date" required="">
                            </div>
                        </div>
                        </div>
                    
                        <input type="hidden" name="lang[]" value="{{$lang}}">
                         <div class="form-group pt-4">
                            <label class="input-label"
                                   for="{{$lang}}_description"> {{\App\CentralLogics\translate('Details')}}</label>
                            <div id="{{$lang}}_editor" style="min-height: 15rem;"></div>
                            <textarea name="description[]" style="display:none" id="{{$lang}}_hiddenArea"  value="{{$exhibition['description']}}"></textarea>
                        </div> 
                    </div>
                    @endif
                    <div id="from_part_2">
                        <div class="form-group">
                            <label>{{\App\CentralLogics\translate('Exhibition')}} {{\App\CentralLogics\translate('image')}}</label><small
                                style="color: red">* ( {{\App\CentralLogics\translate('ratio')}} 1:1 )</small>
                            <div>
                                <div class="row mb-3">
                                    @foreach(json_decode($exhibition['image'],true) as $img)
                                        <div class="col-3">
                                            <img style="height: 200px;width: 100%"
                                                 src="{{asset('storage/app/public/exhibitions')}}/{{$img}}">
                                            <a href="{{route('admin.exhibition.remove-image',[$exhibition['id'],$img])}}"
                                               style="margin-top: -35px;border-radius: 0"
                                               class="btn btn-danger btn-block btn-sm">Remove</a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row" id="coba"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('update')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')

@endpush

@push('script_2')
    <script src="{{asset('assets/admin/js/spartan-multi-image-picker.js')}}"></script>
    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == 'en')
            {
                $("#from_part_2").removeClass('d-none');
            }
            else
            {
                $("#from_part_2").addClass('d-none');
            }


        })
    </script>
    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 10,
                rowHeight: '215px',
                groupClassName: 'col-3',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('assets/admin/img/400x400/img2.jpg')}}',
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


    <script>
        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script src="{{asset('assets/admin')}}/js/tags-input.min.js"></script>

    
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        @if($language)
        @foreach(json_decode($language) as $lang)
        var en_quill = new Quill('#{{$lang}}_editor', {
            theme: 'snow'
        });
        @endforeach
        @else
        var bn_quill = new Quill('#editor', {
            theme: 'snow'
        });
        @endif

        $('#exhibition_form').on('submit', function () {


            var formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.exhibition.update',[$exhibition['id']])}}',
                // data: $('#exhibition_form').serialize(),
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
                        toastr.success('exhibition updated successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '{{route('admin.exhibition.list')}}';
                        }, 2000);
                    }
                }
            });
        });
    </script>
@endpush


