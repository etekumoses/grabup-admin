
<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{route('admin.job.list')}}" style="background: #3E215D">
        <div class="card-body">
            <h6 class="card-subtitle"
                style="color: white!important;">All Job Data</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                                    <span class="card-title h2" style="color: white!important;">
                                        {{$data['all']}}
                                    </span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-info ml-6" style="font-size: 30px;color: white"></i>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </a>
    <!-- End Card -->
</div>
<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{route('admin.category.add')}}" style="background: #078a8a">
        <div class="card-body">
            <h6 class="card-subtitle"
                style="color: white!important;">All Categories</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                                    <span class="card-title h2" style="color: white!important;">
                                        {{$data['category']}}
                                    </span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-text ml-6" style="font-size: 30px;color: white"></i>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </a>
    <!-- End Card -->
</div>




