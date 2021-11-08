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
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
     @foreach($datas as $data)
    <tr>
      <td class="table-light">{{$data->name}}</td>
      <td class="table-light">{{$data->email}}</td>
      @if($data->usertype=="0")
      <td  class="table-light">
      <button type="button" class="btn btn-success" data-bs-toggle="modal"data-bs-target="#deletemodal-{{$data->id}}">Delete </button>
      </td>
      @else
      <td  class="table-light">
         <button type="button" class="btn btn-danger" href="#" >Not Allowed</button>
      </td>
      @endif
    </tr>
    @endforeach
  </tbody>
  @foreach($datas as $data)



<!--Delete Modal -->
<div class="modal fade" id="deletemodal-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
         <div class="modal-body">
                <p>Are you sure want to delete</p>
                <form method="POST" action="{{url('/deleteuser')}}">
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
