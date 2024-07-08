<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
        input[type="text"]
        {
            width: 400px;
            height: 50px;
        }

        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

        .table_deg{
            text-align: center;
            margin: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
            width: 500px;
        }

        th{
            background-color: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: black;
        }

        td{
            border: 1px solid skyblue;
            color: white;
            padding: 10px;
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
            <h1 class="h1 text-white text-center">Add Category</h1>
            <hr>
        </div>

        <div class="div_deg">
            <form action="{{route('add.category')}}" method="post">
                @csrf
                <div>
                    <input type="text" name="category">
                    <input class="btn btn-success" type="submit" value="Add Category">
                </div>
            </form>
        </div>

        <div>
            <table class="table_deg">
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>

                @foreach($data as $data)
                <tr>
                    <td>{{$data->category_name}}</td>
                    <td>
                        <a onclick="confirmation(event)" href="{{route('delete.category',$data->id)}}" class="btn btn-danger">Delete</a>
                        {{-- <form id="delete-product-form-{{$data->id}}" action="{{route('delete.category',$data->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form> --}}

                        <a href="{{route('edit.category',$data->id)}}" class="btn btn-success">Edit</a>
                    </td>
                </tr>
                @endforeach
                
            </table>
        </div>
        

          @include('admin.footer')

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
      </div>
    </div>

    
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