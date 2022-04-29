@extends('layouts.admin.app')

@section('title', 'Sentence upload')

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{ \App\CentralLogics\translate('Sentence') }}
                        {{ \App\CentralLogics\translate('Upload') }}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="card">
                <div class="alert"
                    style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    <strong>{{ translate('Step 1') }}:</strong>
                    <p>1. Download the skeleton file and fill it with proper data.</p>
                    <p>2. You can download the example file to understand how the data must be filled.</p>
                    <p>4. After uploading products you need to edit them and set product\'s images and choices.</p>
                </div>

                <div class="">
                    <a href="{{ static_asset('downloads/sentence_bulk_format.xlsx') }}" download><button class="btn btn-info">{{ translate('Download CSV')}}</button></a>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><strong>{{ translate('Upload Sentences File') }}</strong></h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('bulk_sentence_upload') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <label class="custom-file-label">
                                            <input type="file" name="bulk_file" class="custom-file-input" required>
                                            <span class="custom-file-name">{{ translate('Choose File') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-info">{{ translate('Upload CSV') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

