@extends('layouts.admin.app')

@section('title','Exhibition Preview')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h1 class="page-header-title">{{ Str::limit($exhibition['title'], 30) }}</h1>
                </div>
                <div class="col-6">
                    <a href="{{url()->previous()}}" class="btn btn-primary float-right">
                        <i class="tio-back-ui"></i> {{\App\CentralLogics\translate('back')}}
                    </a>
                </div>
            </div>
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:">
                        {{\App\CentralLogics\translate('Exhibition')}} {{\App\CentralLogics\translate('Details')}}
                    </a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card mb-3 mb-lg-5">
            <!-- Body -->
            <div class="card-body">
                <div class="row align-items-md-center gx-md-5">
                    <div class="col-md-auto mb-3 mb-md-0">
                        <div class="d-flex align-items-center">
                            <img class="avatar avatar-xxl avatar-4by3 mr-4"
                                 src="{{asset('storage/app/public/exhibitions')}}/{{json_decode($exhibition['image'],true)[0]}}"
                                 onerror="this.src='{{asset('assets/admin/img/160x160/img2.jpg')}}'"
                                 alt="Image Description">
                            
                        </div>
                    </div>
                    <div class="col-2 pt-2 border-left">
                        <h4>{{\App\CentralLogics\translate('Venue')}} : </h4>
                        <p>{!! $exhibition['location'] !!}</p>
                    </div>
                    <div class="col-2 pt-2 border-left">
                        <h4>{{\App\CentralLogics\translate('Start Date')}} : </h4>
                        <p>{!! $exhibition['startdate'] !!}</p>
                    </div>
                    
                    <div class="col-2 pt-2 border-left">
                        <h4>{{\App\CentralLogics\translate('End Date')}} : </h4>
                        <p>{!! $exhibition['enddate'] !!}</p>
                    </div>
                    <div class="col-8 pt-2 border-left">
                        <h4>{{\App\CentralLogics\translate('Details')}} : </h4>
                        <p>{!! $exhibition['description'] !!}</p>
                    </div>
                   
                   
                </div>
            </div>
            <!-- End Body -->
        </div>
        <!-- End Card -->

           
    </div>
@endsection

@push('script_2')
    <script>
        $('.ql-hidden').hide()
    </script>
@endpush
