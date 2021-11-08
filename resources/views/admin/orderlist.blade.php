<!DOCTYPE html>
<x-app-layout>
  
</x-app-layout>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    @include("admin.admincss")
  </head>
  <body>
  <div class="container-scroller">
   @include("admin.navbar")
   
     <div class="container">
      <form action="{{url('/search')}}" method="get">
       @csrf
      <input type="text" name="search" style="color:blue;">
      <input type="submit" value="search" class="btn btn-success">

      </form>


 <table class="table table-light table-striped "style="width:70rem;">
  <thead>
    <tr>
      <th scope="col">FoodName</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Total Price</th>
    </tr>
  </thead>
  <tbody>
     @foreach($order
      as $data)
    <tr>
      <td class="table-light">{{$data->foodname}}</td>
      <td class="table-light">{{$data->price}}</td>
      <td class="table-light">{{$data->quantity}}</td>
      <td class="table-light">{{$data->name}}</td>
      <td class="table-light">{{$data->phone}}</td>
      <td class="table-light">{{$data->address}}</td>
      <td class="table-light">{{$data->price * $data->quantity}}</td>  
    </tr>
    @endforeach
  </tbody>
 
</table>
</div>
  
  
  
</div>
</div>


 @include("admin.adminscript")
</body>
</html>
