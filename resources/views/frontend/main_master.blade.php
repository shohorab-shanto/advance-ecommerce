<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">


<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toster.css">
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
 @include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
<!-- sweet alert cdn  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- toster cdn  -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info')}}"
     switch (type) {

         case 'info':
             toaster.info(" {{ Session::get('message') }} ");
             break;

        case 'success':
             toaster.success(" {{ Session::get('message') }} ");
             break;

        case 'warning':
             toaster.warning(" {{ Session::get('message') }} ");
             break;

        case 'error':
             toaster.error(" {{ Session::get('message') }} ");


              break;
              default:
            break;
    }

     @endif

    </script>

    <!--Add to cart Modal start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="" class="card-img-top" alt="..." style="height: 200px; width:220px;" id="pimage">

                      </div>
                </div><!-- end col 4 -->

                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">Product price: <strong class="text-danger">$<span id="pprice"></span></strong>
                            <del id="oldprice">$</del>
                        </li><!-- discount price thkle seta show korbe discount price na thakle selling price show korbe -->
                        <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                        <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                        <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                        <li class="list-group-item">Stock: <span class="badge badge-pill badge-success" id="aviable" style="background: green; color:white;"></span>
                            <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color:white;"></span>
                        </li>
                      </ul>
                </div><!-- end col 4 -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="color">Choose Color</label>
                        <select class="form-control" id="color" name="color">

                        </select>
                      </div><!-- end form group -->

                      <div class="form-group" id="sizeArea">
                        <label for="size">Choose Size</label>
                        <select class="form-control" id="size" name="size">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </div><!-- end form group -->

                      <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" id="qty" value="1" min="1">
                      </div><!-- end form group -->

                      <input type="hidden" id="product_id"><!-- jei product ta cart e add korbo tar id hidden kore pathailam and eita niche ajax field e pathiea dilam -->
                      <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to Cart</button>
                </div><!-- end col 4 -->

            </div><!-- end row -->

        </div><!-- Modal body -->
      </div>
    </div>
  </div>
    <!--Add to cart Modal end -->

    <script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') //for pass csrf token to header meta
        }
    })
 //Start Product View With Modal
    function productView(id){ //id comming from index page
       // alert(id)
       $.ajax({
           type: 'GET',
           url: '/product/view/modal/'+id,
           dataType:'json', //json type data pass korar por success function execute hobe
           success:function(data){ // productviewajax er return response thke joto data pass hobe segula ei data te ase joma hobe
                //console.log(data) //check data is getiing or not
                //ekhne data.product //product hoto method jeta controller thke pass hocce
                $('#pname').text(data.product.product_name_en); //json er maddome jei product pass korci oi product er maddhome product name dhore seta #panme id er maddhome upore product name e dynamic mane hisebe pathiea deaci //r er khne succes data o rakte hobe
                $('#price').text(data.product.selling_price);
                $('#pcode').text(data.product.product_code);
                $('#pcategory').text(data.product.category.category_name_en);//product table er model e category method er er maddhome product r cat relation kore cat er name show korano hoy
                $('#pbrand').text(data.product.brand.brand_name_en);//eikhne product holo json e rmaddhome pass kora product brand holo mehod and oi method er maddhome brand table er brand name ke dhorlam
                $('#pimage').attr('src','/'+data.product.product_thambnail);//upore src er jygy ei image show hobe tai er attr and src er kotha bole dawa hoy

                $('#product_id').val(id);  //jei product ta modal e aca seta cart e pathanor jonno tar id dhorlam and eta upore addtocart e hidden input e pathaie dilam
                $('#qty').val(1); //quantity update
                    //product price
                if(data.product.discount_price == null){
                    $('#pprice').text('');//dis price null hole suru te previous price empty diea suru hobe
                    $('#oldprice').text('');//empty korar karon old data jate nadhore rakhe
                    $('#pprice').text(data.product.selling_price);

                }else{
                    $('#pprice').text(data.product.discount_price);
                    $('#oldprice').text(data.product.selling_price);
                }//end product price

                //product stock
                if(data.product.product_qty > 0){

                    $('#aviable').text('');//previous value 0 kore nilam
                    $('#stockout').text('');//previous value 0 kore nilam
                    $('#aviable').text('aviable');
                }else{
                    $('#stockout').text('stockout');
                }//end stock

                //color
                $('select[name="color"]').empty(); //first e jokhn load korbe tokhn empty thakbe field
                $.each(data.color,function(key,value){ //data color er maddhome jei value asbe seta value te bosbe//color er value controller thke pass hocce
                    $('select[name="color"]').append('<option value=" '+value+' ">'+value+'</option>') //ei value er maddhome upore function e jei value asbe seta dhora hoice //and append er maddhome data load kora hoy//name=color uprer field er name
                })

                //size
                $('select[name="size"]').empty(); //first e jokhn load korbe tokhn empty thakbe field
                $.each(data.size,function(key,value){ //data size er maddhome jei value asbe seta value te bosbe//size er value controller thke pass hocce
                    $('select[name="size"]').append('<option value=" '+value+' ">'+value+'</option>') //ei value er maddhome upore function e jei value asbe seta dhora hoice //and append er maddhome data load kora hoy//name=size uprer field er name
                    //jodi oikhne kono data na thake tahle oi area hide hoiea jabe
                    if(data.size==""){
                        $('#sizeArea').hide();
                    }else{
                        $('#sizeArea').show();
                    }

                })

           }
       })
    }
//End Product View With Modal

    // Start add to cart Product
    //add to cart e click korle ei function execute hobe
    //variable e sob id er data gula rakhlam
    function addToCart(){

        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text(); //jeta select kora hobe seta jabe
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val(); //val er maddhome value pass korlam
        //we have to post all data
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                product_name:product_name, color:color, size:size, quantity:quantity   //etar maddhome variable er data pass korteci
            },
            url:"/cart/data/store/"+id,//ei url e ei id er data jabe
            success:function(data){
                miniCart() //akhon product cart add korlei //mane data pass holei minicart function method call hobe and mini cart er sb update hobe //akhon cart add korar por puro page mini cart update newar jonno load dite hobe na//mini cart method auto call hoiea update hoiea jabe
                //data cart e add korle mini cart o auto load hobe //without loading the page
                $('#closeModal').click(); //for close modal
                // console.log(data)

                //start msg
                const Toast = Swal.mixin({
                                toast:true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 3000
                                })

                                if($.isEmptyObject(data.error)){
                                    Toast.fire({
                                        type: 'success',
                                        title: data.success
                                    })
                                }else{
                                    Toast.fire({
                                        type: 'error',
                                        title: data.error
                                    })
                                }

                //end msg

            }
        })
    }





    //End add to cart

    </script>

    <script type="text/javascript">
        function miniCart(){
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType:'json',
                success:function(response){ //json theke data asar somoy response hoiea ase//and oi data pass korteci mini cart e and ei data show korbo
                    // console.log(response)
                    $('span[id="cartSubTotal"]').text(response.cartTotal); //to show total in div area in header file on span area
                    $('#cartQty').text(response.cartQty); //to show qty in header file in mini cart option
                    var miniCart = ""
                    $.each(response.carts,function(key,value){ //take all value pass it by value area
                        //jei tuku part dynamic vabe show korbo oituku cut kore ane eikhne bosalam r oikhne div create kore id = minCart diea dieaci
                        miniCart += `<div class="cart-item product-summary">
                                            <div class="row">
                                            <div class="col-xs-4">
                                                <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                                <div class="price">${value.price} * ${value.qty}</div>
                                            </div>
                                            <div class="col-xs-1 action">
                                            <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                        </div>
                                        <!-- /.cart-item -->
                                        <div class="clearfix"></div>
                                        <hr>`
                    });

                    $('#miniCart').html(miniCart); //miniCart is id name of div in header file
                }
            })
        }

           miniCart();

           // mini cart remove start

        function miniCartRemove(rowId){
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/'+rowId,
                dataType:'json',
                success:function(data){
                    miniCart(); //without loading the page data will remove from mini cart
                    cart();

                    //start msg
                    const Toast = Swal.mixin({
                                toast:true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 3000
                                })

                                if($.isEmptyObject(data.error)){
                                    Toast.fire({
                                        type: 'success',
                                        title: data.success
                                    })
                                }else{
                                    Toast.fire({
                                        type: 'error',
                                        title: data.error
                                    })
                                }


                    //end msg
                }
            })
        }

           //mini cart remove end

    </script>

            <!-- Start Add Wishlist -->
    <script type="text/javascript">
        function addToWishList(product_id){ //id comming from index page
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/"+product_id, //if it successfully post this data then the success function will work
                success:function(data){

                    //start msg
                    const Toast = Swal.mixin({
                                toast:true,
                                position: 'top-end',

                                showConfirmButton: false,
                                timer: 3000
                                })

                                if($.isEmptyObject(data.error)){
                                    Toast.fire({
                                        type: 'success',
                                        icon: 'success',
                                        title: data.success
                                    })
                                }else{
                                    Toast.fire({
                                        type: 'error',
                                        icon: 'error',
                                        title: data.error
                                    })
                                }


                    //end msg
                }
            })
        }

    </script>

    <!-- end Add Wishlist -->

    <!-- start load Wishlist data -->
    <script type="text/javascript">
        function wishlist(){
            $.ajax({
                type: 'GET',
                url: '/user/get-wishlist-product',
                dataType:'json',
                success:function(response){ //json theke data asar somoy response hoiea ase//and oi data pass korteci mini cart e and ei data show korbo
                    // console.log(response)

                    var rows = ""
                    $.each(response,function(key,value){ //take all value pass it by value area
                        //jei tuku part dynamic vabe show korbo oituku view wishlist tbody thke cut kore ane eikhne bosalam r oikhne div create kore id = minCart diea dieaci
                        rows += `<tr>
					<td class="col-md-2"><img src="/${value.product.product_thambnail}" alt="imga"></td>
					<td class="col-md-7">
						<div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
						<div class="price">
                            ${value.product.discount_price == null
                                ? `${value.product.selling_price}`
                                :
                                `${value.product.discount_price} <span>${value.product.selling_price}</span>`
                            }

						</div>
					</td>
					<td class="col-md-2">
                        <button  class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
					</td>
					<td class="col-md-1 close-btn">
						<button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
					</td>
				</tr>`
                    });

                    $('#wishlist').html(rows); //wishlist is id name of div in header file //row is variable where we put html
                }
            })
        }

        wishlist();

        //wishlist remove start

        function wishlistRemove(id){
            $.ajax({
                type: 'GET',
                url: '/user/wishlist-remove/'+id,
                dataType:'json',
                success:function(data){
                    wishlist(); //without loading the page data will remove from wishlist

                    //start msg
                    const Toast = Swal.mixin({
                                toast:true,
                                position: 'top-end',

                                showConfirmButton: false,
                                timer: 3000
                                })

                                if($.isEmptyObject(data.error)){
                                    Toast.fire({
                                        type: 'success',
                                        icon: 'success',
                                        title: data.success
                                    })
                                }else{
                                    Toast.fire({
                                        type: 'error',
                                        icon: 'error',
                                        title: data.error
                                    })
                                }


                    //end msg
                }
            })
        }

           //wishlist remove end
    </script>

    <!-- end load Wishlist data -->


    <!-- start load Mycart data -->
    <script type="text/javascript">
        function cart(){
            $.ajax({
                type: 'GET',
                url: '/user/get-cart-product',
                dataType:'json',
                success:function(response){ //json theke data asar somoy response hoiea ase//and oi data pass korteci mini cart e and ei data show korbo
                    // console.log(response)

                    var rows = ""
                    $.each(response.carts,function(key,value){ //take all value pass it by value area from carts
                        //jei tuku part dynamic vabe show korbo oituku view wishlist tbody thke cut kore ane eikhne bosalam r oikhne div create kore id = minCart diea dieaci
                        rows += `<tr>
					<td class="col-md-2"><img src="/${value.options.image}" alt="imga" style="width:60px; height:60px;"></td>
					<td class="col-md-2">
						<div class="product-name"><a href="#">${value.name}</a></div>
						<div class="price">
                            $${value.price}

						</div>
					</td>

                    <td class="col-md-2">
						<strong>${value.options.color}</strong>
					</td>
                    <td class="col-md-2">
                        ${value.options.size == null
                            ?`<span>..</span>`//if size == null then show .., : else value size
                            :
                            `<strong>${value.options.size}</strong>`
                        }
					</td>
                    <td class="col-md-2">
                        ${value.qty > 1
                            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                            : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button>`
                        }

                        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;">
                        <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
					</td>
                    <td class="col-md-2">
						<strong>$${value.subtotal}</strong>
					</td>

					<td class="col-md-1 close-btn">
						<button type="submit" class="" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
					</td>
				</tr>`
                    });

                    $('#cartPage').html(rows); //wishlist is id name of div in header file //row is variable where we put html
                }
            })
        }

        cart();

        //cart remove start

        function cartRemove(id){
            $.ajax({
                type: 'GET',
                url: '/user/cart-remove/'+id,
                dataType:'json',
                success:function(data){
                    cart(); //without loading the page data will remove from cartpage
                    miniCart();//without loading the page data will remove from minicart
                    //start msg
                    const Toast = Swal.mixin({
                                toast:true,
                                position: 'top-end',

                                showConfirmButton: false,
                                timer: 3000
                                })

                                if($.isEmptyObject(data.error)){
                                    Toast.fire({
                                        type: 'success',
                                        icon: 'success',
                                        title: data.success
                                    })
                                }else{
                                    Toast.fire({
                                        type: 'error',
                                        icon: 'error',
                                        title: data.error
                                    })
                                }


                    //end msg
                }
            })
        }

            //cart remove end

        //cart increment start
        function cartIncrement(rowId){
            $.ajax({
                type: 'GET',
                url: "/cart-increment"+rowId,
                dataType:'json',
                success:function(data){
                    cart(); //to load cart page
                    miniCart(); //to load mini cart page

                }
            });
        }
        //cart increment end

        //cart decrement start
        function cartDecrement(rowId){
            $.ajax({
                type: 'GET',
                url: "/cart-decrement"+rowId,
                dataType:'json',
                success:function(data){
                    cart(); //to load cart page
                    miniCart(); //to load mini cart page

                }
            });
        }
        //cart decrement end

    </script>

    <!-- end load mycart data -->



</body>
</html>

