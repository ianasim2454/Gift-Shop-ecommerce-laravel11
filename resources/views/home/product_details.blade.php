<!DOCTYPE html>
<html>

<head>
@include('home.css')


<style type="text/css">

    /* .div_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    } */
    .div_center{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .cart{
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
   
  </div>
 

    <!-- Product Details Start -->
 
    <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row div_deg">
       

        <div class="col-md-12">
          <div class="box">
            
              <div class="div_center">
                <img width="300" src="{{asset('products/'.$details->image)}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$details->title}}</h6>
                <h6>Price <span>${{$details->price}}</span></h6>
              </div>

              <div class="detail-box">
                <h6>Category : {{$details->category}}</h6>
                <h6>Available Quantity : <span>{{$details->quantity}}</span></h6>
              </div>

              <div class="detail-box">
                <p>{{$details->description}}</p>
              </div>

              <div class="cart">
                <a href="{{route('add.cart',$details->id)}}" class="btn btn-primary ml-3">Add To Cart</a>
              </div>
              
          </div>
        </div>
     

      </div>
    </div>
  </section>


   



     <!-- Product Details End -->

    @include('home.footer')

</body>

</html>