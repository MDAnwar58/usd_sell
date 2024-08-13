@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Personal</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Personal</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('personal.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label"> Name <span
                                                class="text-danger ">*</span></label>
                                        <input type="text" name="name" class="form-control" id="inputEmail4"
                                            placeholder="Name " value="{{ $personal->name ?? '' }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="header" class="form-label"> Header <span
                                                class="text-danger ">*</span></label>
                                        <input type="text" name="header" class="form-control" id="header"
                                            placeholder="header " value="{{ $personal->header ?? '' }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="header_desc" class="form-label"> Header Description <span
                                                class="text-danger ">*</span></label>
                                        <textarea type="text" name="header_desc" class="form-control" id="header_desc" placeholder="header Description "
                                            value="">{{ $personal->header ?? '' }} </textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Email </label>
                                        <input type="email" name="email" class="form-control" id="inputEmail4"
                                            placeholder="Email" value="{{ $personal->email ?? '' }}">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Phone 1 </label>
                                        <input type="phone" name="phone" class="form-control" id="inputEmail4"
                                            placeholder="Phone Number" value="{{ $personal->phone ?? '' }}">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Phone 2 </label>
                                        <input type="phone" name="phone_2" class="form-control" id="inputEmail4"
                                            placeholder="Phone Number" value="{{ $personal->phone_2 ?? '' }}">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Logo </label>
                                        <input type="file" name="logo" class="form-control" id="inputEmail4"
                                            placeholder="Logo ">
                                    </div>
                                </div>
                                <img src="{{ $personal->logo ?? '' }}" width="80px" height="50px" alt="">


                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="background_image" class="form-label">Background Image </label>
                                        <input type="file" name="background_image" class="form-control"
                                            id="background_image" placeholder="Background Image ">
                                    </div>
                                </div>
                                <img src="{{ $personal->background_image ?? '' }}" width="80px" height="50px"
                                    alt="">

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="address" class="form-label">Address </label>
                                        <textarea name="address" class="form-control">{{ $personal->address ?? '' }}</textarea>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="desc" class="form-label">Short Description </label>
                                        <textarea name="desc" class="form-control">{{ $personal->desc ?? '' }}</textarea>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                    Changes</button>

                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
