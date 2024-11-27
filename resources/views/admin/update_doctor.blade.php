<!DOCTYPE html>
<html lang="en">
  <head>

  <base href="/public">

  @include('admin.css')

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
     
      <!-- partial -->
        <!-- partial:partials/_navbar.html -->
       @include('admin.navbar')
        <!-- partial -->

        <div class="container-fluid page-body-wrapper mt-5">

            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-md-6">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert">x</button>
                                {{session()->get('message')}}
                            </div>
                        @endif
                        <form action="{{url('edit_doctor',$doctor_detail->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <!-- <div class="form-group">
                                <label for="name" class="mt-2">Doctor Name</label>
                                <input type="text" name="name" value="{{$doctor_detail->name}}" required id="name" class="form-control" style="color:white">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="mt-2">Doctor Phone</label>
                                <input type="text" name="phone" value="{{$doctor_detail->phone}}" id="phone" class="form-control" style="color:white">
                            </div>
                           
                            <div class="form-group">
                                <label for="name" class="mt-2">Doctor Sepeciality</label>
                                <select name="speciality" id="" class="form-control" style="color:white">
                                    <option value="{{$doctor_detail->speciality}}">{{$doctor_detail->speciality}}</option>
                                    <option value="Skin">Skin</option>
                                    <option value="Heart">Heart</option>
                                    <option value="Eye">Eye</option>
                                    <option value="Nose">Nose</option>
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="room" class="mt-2">Room No</label>
                                <input type="text" name="room" value="{{$doctor_detail->room}}" required id="room" class="form-control" style="color:white">
                            </div>
                            <div class="form-group">
                                <label for="name" class="mt-2">Doctor Image</label>
                                <img src="doctorimage/{{$doctor_detail->image}}" height="100px" width="100px" alt="" >
                            </div> -->
                            <div class="form-group">
                                <label for="name" class="mt-2">Doctor Status</label>
                                    @php  

                                    if($doctor_detail->status=='0'){
                                        $status='Pending';
                                    @endphp
                                    <select name="status" id="" class="form-control" style="color:white">
                                        <option value="0">{{$status}}</option>
                                        <option value="1">Approved</option>
                                    </select>
                                    @php
                                    }else{
                                        $status='Approved';

                                    @endphp

                                    <select name="status" id="" class="form-control" style="color:white">
                                        <option value="1">{{$status}}</option>
                                        <option value="0">Pending</option>
                                    </select>
                                    @php
                                    }

                                    @endphp
                                
                            </div>
                            <!-- <div class="form-group">
                                <label for="name" class="mt-2">Doctor Image</label>
                                <input type="file" name="file"  id="name" class="form-control" style="color:white">
                            </div> -->
                            <div class="form-group">
                                <input type="submit" name="submit" id="name" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3"></div>

                </div>
            </div>

        </div>
        
        <!-- main-panel ends -->
     
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
  
  </body>
</html>