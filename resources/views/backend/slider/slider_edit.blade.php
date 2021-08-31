@extends('admin.admin_master')
@section('admin')


    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row">

{{-- --------------- edit slider page ------------- --}}


                <div class="col-12">

                    <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">

                            <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data"> <!-- brand controller edit er maddhome je id data brand e asbe sei id ttei update kore data pathano lgbe  -->

                                @csrf
                                <input type ="hidden" name="id" value="{{ $sliders->id }}">  <!-- update route url e id r pass korte hobe na cause eikhne ami hidden kore id niea nici -->
                                <input type ="hidden" name="old_image" value="{{ $sliders->slider_img }}"> <!-- old img controller e padai karon ild image oikhne nia unlink kore dibo -->


                                            <div class="form-group">
                                                <h5>Slider Title<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="title" class="form-control" value="{{ $sliders->title }}" >


                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>Slider Description<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="description" class="form-control" value="{{ $sliders->description }}" >

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>Brand Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="slider_img" class="form-control" value="{{ $sliders->slider_img }}" >

                                                    @error('slider_img')
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
