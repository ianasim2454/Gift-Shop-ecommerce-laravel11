<!DOCTYPE html>
<html>

<head>
@include('home.css')


<style type="text/css">
    input[type='search']
        {
          width: 400px;
          height: 50px;
          /* margin-left: 60px; */
          
        }
        .search{
          text-align: right;
          margin-top: 20px;
        }
</style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

  </div>
  

  <!-- shop section -->

  <div class="search">
          <form action="{{route('product.search')}}" method="get">
            @csrf
            <input type="search" name="search">
            <input type="submit" class="btn btn-secondary" value="search">
          </form>
        </div>
  @include('home.all_shop')

  <!-- end shop section -->

  
   


  <!-- info section -->

    @include('home.footer')

</body>

</html>















