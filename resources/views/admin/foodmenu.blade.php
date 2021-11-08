<!DOCTYPE html>
<x-app-layout>
  
</x-app-layout>
<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
  
  @include("admin.admincss")
  </head>
  <body>
  <div class="container-scroller">
   @include("admin.navbar")
   <div class="container-fluid" style="width:70rem;">
   <form action="{{url('/foodupload')}}" method="post" enctype="multipart/form-data">
   @csrf
  <div class="form-group-row">
    <div class="form-group col-md-6">
      <label >Title</label>
      <input style="color:white;" type="text" class="form-control"name="title"  required>
    </div>
    <div class="form-group col-md-6">
      <label >Price</label>
      <input style="color:white;" type="number" class="form-control" name="price"  required>
    </div>
    <div class="form-group col-md-6">
      <label >Image</label>
      <input type="file" class="form-control" name="image"  required>
    </div>
    <div class="form-group col-md-6">
      <label >Description</label>
      <input style="color:white;" type="text" class="form-control"name="description"  required>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Add Food</button>

</form>
 <table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
      <th scope="col">Action2</th>


    </tr>
  </thead>
  <tbody>
      @foreach($foodData as $data)
    <tr>
      <td>{{$data->title}}</td>
      <td>{{$data->price}}</td>
      <td>{{$data->description}}</td>
      <td><img  src="/documents/{{$data->image}}" ></td>
      <td>
      <button type="button" class="btn btn-success" data-bs-toggle="modal"data-bs-target="#deletemodal-{{$data->id}}">Delete </button>
      </td>
      <td>
      <button type="button" class="btn btn-success" data-bs-toggle="modal"data-bs-target="#editmodal-{{$data->id}}">Edit </button>
      </td>
    </tr>
    @endforeach
  </tbody>

   
  @foreach($foodData as $data)
<!-- edit model -->
  <div class="modal fade" id="editmodal-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
             <div class="modal-body">       
                 <form method="post" action="{{url('/updatefood')}}" enctype="multipart/form-data">
                         <input type="hidden" name="id" value="{{$data->id}}">
                         @csrf
                             <div class="form-group-row">
                                    <div class="form-group col-md-6">
                                    <label >Title</label>
                                    <input style="color:white;" type="text" class="form-control"name="title" value="{{$data->title}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label >Price</label>
                                    <input style="color:white;" type="number" class="form-control" name="price" value="{{$data->price}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label >Image</label>
                                            @if($data->image)
                                           <img src="/documents/{{$data->image}}" height="70" width="70">
                                             @endif
                                            <input type="file" class="form-control" name="image" value="{{$data->image }}" >
                                    </div>

                                    <div class="form-group col-md-6">
                                    <label >Description</label>
                                    <input style="color:white;" type="text" class="form-control"name="description" value="{{$data->description}}"  required>
                                    </div>
                                </div>
                             <button type="submit" class="btn btn-primary">Update Food</button>
                             <button type="reset" class="modal-action modal-close btn red waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                 </form> 
             </div>
    </div>
  </div>
</div>

<!--delete model  -->
      
  <div class="modal fade" id="deletemodal-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
         <div class="modal-body">
                <p>Are you sure want to delete</p>
                <form method="POST" action="{{url('/deletefoodmenu')}}">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    @csrf
                    <div class="row">
                        <div class="col s12 display-flex justify-content-end form-action">
                            <button type="submit" class="btn gradient-45deg-purple-deep-purple waves-effect waves-light mr-1 btn-success">Confirm
                            </button>
                            <button type="reset" class="modal-action modal-close btn red waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
  </div>
</div>
@endforeach


</table>
</div>
</div>
  

@include("admin.adminscript")
  </body>
</html>