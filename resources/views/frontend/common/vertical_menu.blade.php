@php
     $categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">


        @foreach ($categories as $category)
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>@if (session()->get('language') == 'hindi') {{ $category->category_name_hin }} @else {{ $category->category_name_en }} @endif</a>
          <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">

                {{-- get subcategory table data..category table er id er sathe subcat er cat id match korle subcat show korbe ei condition dite hobe --}}
                @php
                $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                @endphp

                @foreach ($subcategories as $subcat)
                <div class="col-sm-12 col-md-3">
                   <a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}"> <h2 class="title">@if (session()->get('language') == 'hindi') {{ $subcat->subcategory_name_hin }} @else {{ $subcat->subcategory_name_en }} @endif</h2></a>

                    {{-- get subcategory table data..category table er id er sathe subcat er cat id match korle subcat show korbe ei condition dite hobe --}}
                    @php
                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcat->id)->orderBy('subsubcategory_name_en','ASC')->get();
                  @endphp

                  @foreach ($subsubcategories as $subsubcat)
                  <ul class="links list-unstyled">
                    <li><a href="{{ url('subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_en) }}">@if (session()->get('language') == 'hindi') {{ $subsubcat->subsubcategory_name_hin }} @else {{ $subsubcat->subsubcategory_name_en }} @endif</a></li>
                  </ul>
                  @endforeach <!-- end subcat foreach -->
                </div>
                <!-- /.col -->
                @endforeach <!-- end subcat foreach -->

              </div>
              <!-- /.row -->
            </li>
            <!-- /.yamm-content -->
          </ul>
          <!-- /.dropdown-menu --> </li>
        @endforeach <!-- end cat foreach -->

        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->

        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a>
          <!-- ================================== MEGAMENU VERTICAL ================================== -->
          <!-- /.dropdown-menu -->
          <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
        <!-- /.menu-item -->

        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a>
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->

      </ul>
      <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
  </div>
  <!-- /.side-menu -->
