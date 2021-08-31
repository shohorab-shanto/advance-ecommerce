@extends('admin.admin_master')
@section('admin')


    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row">

{{-- --------------- add brand page ------------- --}}


                <div class="col-12">

                    <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">

                            <form method="post" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data"> <!-- brand controller edit er maddhome je id data brand e asbe sei id ttei update kore data pathano lgbe  -->

                                @csrf
                                <input type ="hidden" name="id" value="{{ $brand->id }}">  <!-- update route url e id r pass korte hobe na cause eikhne ami hidden kore id niea nici -->
                                <input type ="hidden" name="old_image" value="{{ $brand->brand_image }}">


                                            <div class="form-group">
                                                <h5>Brand Name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="brand_name_en" class="form-control" value="{{ $brand->brand_name_en }}" >

                                                    @error('brand_name_hin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>Brand Name Hindi <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="brand_name_hin" class="form-control" value="{{ $brand->brand_name_hin }}" >

                                                @error('brand_name_hin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>Brand Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="brand_image" class="form-control" value="{{ $brand->brand_image }}" >

                                                    @error('brand_name_hin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                </div>
                                            </div>

                                   <div class="text-xs-right">
                                       <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                   </div>
                               </form>


                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>


        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

    </div>




@endsection
