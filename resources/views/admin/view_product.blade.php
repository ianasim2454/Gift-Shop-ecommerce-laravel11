<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
        }

        .table_deg{
            border: 2px solid yellowgreen;
        }

        th{
            background-color: skyblue;
            color: black;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
        }
        td{
            padding: 10px;
            border: 1px solid skyblue;
            text-align: center;
            color: white;
        }

        input[type='search']
        {
          width: 400px;
          height: 50px;
          /* margin-left: 60px; */
          
        }
        .search{
          text-align: right;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
        @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
         
        <div>
            <h1 class="h1 text-center text-white">Product List</h1>
            <hr>
        </div>

        <div class="search">
          <form action="{{route('search.product')}}" method="get">
            @csrf
            <input type="search" name="search">
            <input type="submit" class="btn btn-secondary" value="search">
          </form>
        </div>
        
        <div class="div_deg">
            <table class="table_deg">
                <tr>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                @foreach($product as $products)
                <tr>
                    <td>{{$products->title}}</td>
                    <td>{{$products->code}}</td>
                    <td>{{$products->description}}</td>
                    <!-- show short description 
                    <td>{!!Str::limit($products->description,50)!!}</td>
                    -->
                    <td>{{$products->price}}</td>
                    <td>{{$products->quantity}}</td>
                    <td>{{$products->category}}</td>
                    <td><img style="height:75px; width:85px" src="{{asset('products/'.$products->image)}}"></td>
                    <td>
                        <a onclick="confirmation(event)" class="btn btn-danger mb-2" href="{{route('delete.product',$products->id)}}">Delete</a>
                        <a class="btn btn-success" href="{{route('edit.product',$products->slug)}}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <!-- Pagination Start -->
        <div class="div_deg">
          {{$product->onEachSide(1)->links()}}
        </div>
         <!-- Pagination End -->



          @include('admin.footer')
      </div>
    </div>


    <script type="text/javascript">

          function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
              title: "Are You Sure To Delete This",
              text: "You won't be able to revert this delete",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })

            .then((willcancel)=>{
              if(willcancel){
                window.location.href = urlToRedirect;
              }
            });
          }
      </script>




    <!-- sweet alert   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>