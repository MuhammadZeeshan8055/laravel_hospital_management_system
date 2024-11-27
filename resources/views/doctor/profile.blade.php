<!DOCTYPE html>
<html lang="en">
  <head>
  @include('doctor.css')

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('doctor.sidebar')
     
      <!-- partial -->
        <!-- partial:partials/_navbar.html -->
       @include('doctor.navbar')
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

                        <form action="{{url('complete_doctors_profile')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                           
                            <div class="form-group">
                                <label for="name" class="mt-2">Doctor Sepeciality</label>
                                <select name="speciality" id="" class="form-control" style="color:white">
                                    <option value="">Select Option</option>
                                    <option value="orthodontics and dentofacial orthopedics">orthodontics and dentofacial orthopedics</option>
                                    <option value="pediatric dentistry">pediatric dentistry</option>
                                    <option value="prosthodontics">prosthodontics</option>
                                    <option value="oral and maxillofacial surgery">oral and maxillofacial surgery</option>
                                    <option value="oral and maxillofacial pathology;"> oral and maxillofacial pathology;</option>
                                    <option value="endodontics">endodontics</option>
                                    <option value="public health dentistry"> public health dentistry</option>
                                    <option value="oral and maxillofacial radiology">oral and maxillofacial radiology</option>
                                  
                                </select>
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
    @include('doctor.script')
  
  </body>
</html>