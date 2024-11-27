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
       @include('doctor.body')
        
        <!-- main-panel ends -->
     
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('doctor.script')
  
  </body>
</html>