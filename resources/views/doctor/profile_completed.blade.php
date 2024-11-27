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
                    <div class="col-lg-6 mt-5">
                        <h5>Profile Completed</h5>
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