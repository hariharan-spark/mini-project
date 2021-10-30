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
   

 <table class="table table-light table-striped "style="width:70rem;">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Guest</th>
      <th scope="col">Data</th>
      <th scope="col">Time</th>
      <th scope="col">Message</th>
    </tr>
  </thead>
  <tbody>
     @foreach($datas as $data)
    <tr>
      <td class="table-light">{{$data->name}}</td>
      <td class="table-light">{{$data->email}}</td>
      <td class="table-light">{{$data->phone}}</td>
      <td class="table-light">{{$data->guest}}</td>
      <td class="table-light">{{$data->date}}</td>
      <td class="table-light">{{$data->time}}</td>
      <td class="table-light">{{$data->message}}</td>  
    </tr>
    @endforeach
  </tbody>
 
</table>
</div>
  
  
  
</div>


 @include("admin.adminscript")
</body>
</html>
