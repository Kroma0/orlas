<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>jQuery UI Draggable - Constrain movement</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  .draggable3 { width: 150px; height: 150px; padding: 0.5em; float: left; margin: 0 10px 10px 0; }
  #containment-wrapper { width: 80%; height:500px; border:2px solid #ccc; padding: 10px; }
  h3 { clear: left; }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".draggable3" ).draggable({ 
        containment: "#containment-wrapper", 
        scroll: false,
        stop: function() {
            var x = $(this)[0].style.left;
            var y = $(this)[0].style.top;
            x = x.substring(0, x.length - 2);
            y = y.substring(0, y.length - 2);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/update',
                data: {"x":x, "y":y, "id":$(this)[0].id},
                success:function(data) {
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
        
    });
  } );
  </script>
</head>
<body>
<form action="codeaguardar" enctype="multipart/form-data" method="POST">
        @csrf    
        <input type="text" name="nombre" placeholder="ingrese nombre:" required>
        <input type="file" name="imagen">
        <button type="submit">GUARDAR</button>
</form>
<br>
<div id="containment-wrapper">
    @foreach ($img as $images)
    <div id="{{$images->id}}" class="ui-widget-content draggable3" style= "left:{{$images->x}}px; top:{{$images->y}}px;">
        <img src="./img/post/{{$images->imagen}}" width="150" height="150" alt="{{$images->nombre}}">
    </div>
    @endforeach
</div>
 
 
</body>
</html>