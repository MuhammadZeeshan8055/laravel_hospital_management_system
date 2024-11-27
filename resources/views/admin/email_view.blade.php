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
                    <div class="col-md-12 text-center">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert">x</button>
                                {{session()->get('message')}}
                            </div>
                        @endif
                        <form action="{{url('sendemail',$data->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                                <label for="name" class="mt-2">Greeting</label>
                                <input type="text" name="greeting" required id="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="mt-2">Body</label>
                                <input type="text" name="body"  id="phone">
                            </div>

                            <div class="form-group">
                                <label for="phone" class="mt-2">Action Text</label>
                                <input type="text" name="actiontext"  id="phone">
                            </div>

                             <div class="form-group">
                                <label for="phone" class="mt-2">Action Url</label>
                                <input type="text" name="actionurl"  id="phone">
                            </div>

                            <div class="form-group">
                                <label for="phone" class="mt-2">End Part</label>
                                <input type="text" name="endpart"  id="phone">
                            </div>
                           
                          
                            <div class="form-group">
                                <input type="submit" name="submit" id="name" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
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