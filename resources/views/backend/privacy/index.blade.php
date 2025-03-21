@extends('admin.admin_dashboard')
@section('admin')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item active">Privacy Policy</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Privacy Policy</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('privacy.store') }}"
                                >
                                @csrf



                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="desc" class="form-label">Description </label>
                                        <textarea name="desc" id="summernote" >{{ $privacy->desc ?? '' }}</textarea>
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
