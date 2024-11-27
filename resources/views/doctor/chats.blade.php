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
                    <div class="col-lg-12 mt-5">

                      <div class="card">
                        <div class="card-header">
                          @if(session()->has('message'))

                          <div class="alert alert-success">

                              <button type="button" class="close" data-dismiss="alert">x</button>
                              {{session()->get('message')}}
                          </div>

                          @endif
                        </div>
                        <div class="card-body">
                          
                            <div class="chats-interface">
                            @foreach($chats as $chat)
                              <a class="chats mt-5" style="text-decoration: none; color: white !IMPORTANT; padding: 25px 13px 25px 13px;" href="{{url('doctor_show_chat',$chat->user_id)}}">{{$chat->name}}</a><br><br><br><br><br>
                            @endforeach
                            </div>
                         
                        </div>
                      </div>
                        


                       
                    </div>
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