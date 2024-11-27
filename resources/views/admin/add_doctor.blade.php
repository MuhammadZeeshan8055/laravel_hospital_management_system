<!DOCTYPE html>
<html lang="en">
  <head>
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

        
        <div class="container-fluid page-body-wrapper">

           
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 mt-5 ">
                        @if(session()->has('message'))

                        <div class="alert alert-success">

                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{session()->get('message')}}
                        </div>

                        @endif

                        <form action="{{url('upload_doctor')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="mt-2">Doctor Name</label>
                                <input type="text" name="name" required id="name" class="form-control" style="color:white"> 
                            </div>
                            <div class="form-group">
                                <label for="phone" class="mt-2">Doctor Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" style="color:white">
                            </div>
                           
                            <div class="form-group">
                                <label for="name" class="mt-2">Doctor Sepeciality</label>
                                <select name="speciality" id="" class="form-control" style="color:white">
                                    <option value="">Select Option</option>
                                    <option value="Skin">Skin</option>
                                    <option value="Heart">Heart</option>
                                    <option value="Eye">Eye</option>
                                    <option value="Nose">Nose</option>
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="room" class="mt-2">Room No</label>
                                <input type="text" name="room" required id="room" class="form-control" style="color:white">
                            </div>
                            <div class="form-group">
                                <label for="name" class="mt-2">Doctor Image</label>
                                <input type="file" name="file" required id="name" class="form-control" style="color:white">
                            </div>
                            <div class="form-group">
                                <label for="room" class="mt-2">Doctor Fee</label>
                                <input type="text" name="fee" required id="room" class="form-control" style="color:white">
                            </div>
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