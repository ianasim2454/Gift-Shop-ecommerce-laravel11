<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Order</title>
    @include('home.css')
<style type="text/css">
    .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
            margin-bottom: 30px;
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
            color: black;
        }
</style>
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>

  <div><h1 class="h1 text-center">My Order</h1><hr></div>
  <div class="div_deg">
    <table class="table_deg">
        <tr>
            <th>Product Title</th>
            <th>Code</th>
            <th>Price</th>
            <th>Delivery Status</th>
            <th>Image</th>
            
        </tr>

        @foreach($order as $data)
        <tr>
            <td>{{$data->product->title}}</td>
            <td>{{$data->product->code}}</td>
            <td>${{$data->product->price}}</td>
            <td>

                @if($data->status === 'Delivered')
                        <span style="color: red;">{{$data->status}}</span>

                        @elseif($data->status === 'On The Way')
                        <span style="color: #E90074;">{{$data->status}}</span>

                        @else
                        <span style="color: #071952;">{{$data->status}}</span>

                        @endif
            </td>
            <td><img width="90px" height="70px" src="{{asset('products/'.$data->product->image)}}" alt=""></td>
            
        </tr>
        @endforeach
    </table>
  </div>



  @include('home.footer')
</body>
</html>