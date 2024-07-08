<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h3>Customer Name: {{$data->name}}</h3>
        <h3>Address: {{$data->rec_add}}</h3>
        <h3>Phone: {{$data->phone}}</h3>
        <h3>Product Title: {{$data->product->title}}</h3>
        <h3>Code: {{$data->product->code}}</h3>
        <h3>Price: {{$data->product->price}}</h3>
        <h3>Image: </h3>
       <img width="200px" height="150px" src="products/{{$data->product->image}}">
    </center>
</body>
</html>