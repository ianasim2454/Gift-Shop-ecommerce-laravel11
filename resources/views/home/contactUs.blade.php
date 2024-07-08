<!DOCTYPE html>
<html>

<head>
@include('home.css')

<style type="text/css">
   .button{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            
        }
    input[type='submit']
    {
      width: 160px;
      text-align: center;
      background-color: red;
    }

</style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
   
  </div>

  <section class="contact_section ">
    <div class="container px-0">
      <div class="heading_container ">
        <h2 class="text-center mt-5">
          Contact Us
        </h2>
      </div>
    </div>
    <div class="container container-bg">
      <div class="row">
        <div class="col-lg-7 col-md-6 px-0">
          <div class="map_container">
            <div class="map-responsive">
              <iframe src="https://www.google.com/maps/embed/v1/place?" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-5 px-0">
          <form action="{{route('user.message')}}" method="post">
            @csrf
            <div>
              <input class="@error('name') is-invalid @enderror" type="text" name="name" placeholder="Name" >
              @error('name')
                  <p class="invalid-feedback">{{$message}}</p>
               @enderror
            </div>
            <div>
              <input class="@error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" >
              @error('email')
                  <p class="invalid-feedback">{{$message}}</p>
               @enderror
            </div>
            <div>
              <input class="@error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Phone" />
              @error('phone')
                  <p class="invalid-feedback">{{$message}}</p>
               @enderror
            </div>
            <div>
             <textarea class="@error('message') is-invalid @enderror" placeholder="Message" name="message" id="" cols="53" rows="5"></textarea>
             @error('message')
                  <p class="invalid-feedback">{{$message}}</p>
               @enderror
            </div>
            
         
            <div class="button">
                    <input class="btn btn-success" type="submit" value="SEND MESSAGE">
              </div>
        </div>
      </div>
    </div>
  </section>

  <br><br><br>



    @include('home.footer')

</body>

</html>