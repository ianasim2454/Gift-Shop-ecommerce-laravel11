<!DOCTYPE html>
<html>

<head>
@include('home.css')

<style type="text/css">
    .div_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
        
    }

    table{
        border: 2px solid black;
        text-align: center;
        width: 700px;
    }

    th{
        border: 2px solid black;
        text-align: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        background-color: black;
    }

    td{
        border: 1px solid skyblue;
    }

    .cart_deg{
        text-align: center;
        margin-bottom: 70px;
        padding: 18px;
    }

    .order_deg{
        padding-left: 150px;
    }
    label{
        display: inline-block;
        width: 150px;
    }

    .button{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        textarea{
            width: 210px;
            height: 50px;
        }
</style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>

  

    <div class="div_deg">

        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php 

            $value = 0;

            ?>

            @foreach($cart as $carts)
            <tr>
                <td>{{$carts->product->title}}</td>
                <td>${{$carts->product->price}}</td>
                <td><img style="width: 80px; height: 70px;" src="{{asset('products/'.$carts->product->image)}}" alt=""></td>
                <td>
                    <a href="{{route('remove.cart',$carts->id)}}" class="btn btn-danger">Remove</a>
                </td>
            </tr>

            <?php 

                $value = $value + $carts->product->price;

            ?>

            @endforeach
        </table>
    </div>

    <div class="cart_deg">
        <h3>Total Price: ${{$value}}</h3>
    </div>

    <div class="order_deg col-md-6 offset-md-3 mt-2" style="display:flex; justify-content:center; align-items:center;">
    <form action="{{route('confirm.order')}}" method="post">
        @csrf
        <div>
            <label for="">Receiver Name: </label>
            <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>

        <div>
            <label for="">Receiver Address: </label>
            <textarea name="address">{{Auth::user()->address}}</textarea>
        </div>

        <div>
            <label for="">Receiver Phone: </label>
            <input type="text" name="phone" value="{{Auth::user()->phone}}">
        </div>

        <div class="button col-md-6 offset-md-3">
            <input class="btn btn-primary" type="submit" value="Cash On Delivery">
        </div>
        <div class="button mb-3 col-md-6 offset-md-3 ">
        <a href="{{url('stripe',$value)}}" class="btn btn-success">Pay Using Card</a>
        </div>
        
    </form>
  </div>
 
 

  

    @include('home.footer')

</body>

</html>