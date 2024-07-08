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

        label{
            display: inline-block;
            width: 230px;
            font-size: 20px !important;
            color: white !important;
        }

        .button{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        input[type='text']
        {
            width: 250px;
            height: 50px;
        }

        textarea{
            width: 350px;
            height: 50px;
        }

        input[type='number']
        {
            width: 250px;
            height: 50px;
        }

        .input_deg{
            /* margin-bottom: 7px; */
            padding: 4px;
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
            <h1 class="h1 text-center text-white">Update Product</h1>
            <hr>
          </div>

          <div class="div_deg">
            <form action="{{route('update.product',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input_deg">
                    <label>Title:</label>
                    <input type="text" name="title" value="{{$data->title}}">
                </div>

                <div class="input_deg">
                    <label>Code:</label>
                    <input type="text" name="code" value="{{$data->code}}">
                </div>

                <div class="input_deg">
                    <label>Description:</label>
                    <textarea name="description" id="">{{$data->description}}</textarea>
                </div>

                <div class="input_deg">
                    <label>Price:</label>
                    <input type="text" name="price" value="{{$data->price}}">
                </div>

                <div class="input_deg">
                    <label>Quantity:</label>
                    <input type="number" name="quantity" value="{{$data->quantity}}">
                </div>

                <div class="input_deg">
                    <label>Category:</label>
                    <select name="category">
                    <option value="{{$data->category}}">{{$data->category}}</option>
                    @foreach($category as $category)
                        <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input_deg">
                    <label>Current Image:</label>
                    <img style="height:75px; width:85px" src="{{asset('products/'.$data->image)}}">
                </div>
                <div class="input_deg">
                    <label>New Image:</label>
                    <input type="file" name="image">
                </div>

                <div class="button">
                    <input class="btn btn-success" type="submit" value="Update Product">
                </div>
            </form>
        </div>
        
        

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