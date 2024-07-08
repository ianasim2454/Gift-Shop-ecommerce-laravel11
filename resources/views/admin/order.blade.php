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

        table{
            border: 2px solid skyblue;
            text-align: center;
        }

        th{
            background-color: skyblue;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            color: black;
        }

        td{
            padding: 10px;
            border: 1px solid skyblue;
            text-align: center;
            color: white;
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
            <h1 class="h1 text-center text-white">Customer Order</h1>
            <hr>
        </div>

        <div class="div_deg">
            <table>
                <tr>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Print</th>
                </tr>

                @foreach($order as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->rec_add}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->product->title}}</td>
                    <td>{{$data->product->code}}</td>
                    <td>{{$data->product->price}}</td>
                    <td>
                        <img width="100px" height="80px" src="{{asset('products/'.$data->product->image)}}" alt="">
                    </td>
                    <td>{{$data->payment_status}}</td>
                    <td>
                        @if($data->status === 'Delivered')
                        <span style="color: green;">{{$data->status}}</span>

                        @elseif($data->status === 'On The Way')
                        <span style="color: greenyellow;">{{$data->status}}</span>

                        @else
                        <span style="color: skyblue;">{{$data->status}}</span>

                        @endif
                    </td>
                    <td>
                        <a href="{{url('on_the_way',$data->id)}}" class="btn btn-primary">On The Way</a>
                        <a href="{{url('delivered',$data->id)}}" class="btn btn-success mt-2">Delivered</a>
                    </td>

                    <td>
                        <a href="{{route('print.pdf',$data->id)}}" class="btn btn-secondary">PDF</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        
        <!-- Pagination Start -->
        <div class="div_deg">
          {{$order->links()}}
        </div>
         <!-- Pagination End -->
       

          @include('admin.footer')
      </div>
    </div>
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