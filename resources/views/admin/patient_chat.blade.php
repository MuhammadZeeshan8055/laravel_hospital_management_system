@php
    $url = url()->full();
    $segments = collect(explode('/', $url))->filter(); // filter to remove any empty segments
    $id = $segments->last();
    $to_id= $id;
   
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="refresh" content="20">

  <base href="/public">

  @include('admin.css')
    
  </head>
  
  <body>
    <div class="container-scroller">
    

        <div class="container-fluid page-body-wrapper mt-4">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mt-5">
                            <div class="card-header">
                                <a href="{{url('/my_appointment')}}" class="btn btn-primary" style="float:right;">Back</a>

                                <h4>{{$doctorName}}</h4>
                                @if(session()->has('message'))

                                <div class="alert alert-success">

                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    {{session()->get('message')}}
                                </div>

                                @endif
                            </div>
                            <div class="card-body" id="scrollable-div" style="height:400px;overflow:auto">
                            @php
                            $auth_id=Auth::user()->id;
                            
                                @endphp
                                @foreach($chat as $chats)

                                        @php
                                            $check=$chats->from_id;
                                            
                                        
                                        @endphp

                                        @if($check==$auth_id)
                                        
                                            <p class="admin_msgs" style="margin-left:50%;background:black;width:50%;padding:15px 15px 20px 15px;;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">{{$chats->message}} <br><span style="float:right;font-size:.8rem">{{$chats->time}}</span></p><br>
                                        
                                        @else
                                            <p class="user_msgs" style="background:black;width:50%;padding:15px 15px 20px 15px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">{{$chats->message}} <br><span style="float:right;font-size:.8rem">{{$chats->time}}</span></p><br>
                                            
                                        
                                        @endif
                                
                                    <!-- <a href="">{{$chats->message}}</a><br> -->
                                @endforeach

                                @php
                                    $url= url()->full();
                                    $segments=explode('/',$url);
                                    $reply_id=last($segments);
                                @endphp
                        
                            </div>
                            <div class="card-footer">
                                <form action="{{url('send_message')}}" method="post">
                                @csrf
                                    <div class="form-group mt-2">
                                        <!-- <label for="phone" class="mt-2">Doctor Phone</label> -->
                                        <input type="hidden" name="from_id" id="message" value="{{$auth_id}}" class="form-control">
                                        <input type="hidden" name="to_id" id="message" value="{{$to_id}}" class="form-control">
                                        <div class="inline" style="display:inline-flex;width:100% !Important">
                                            <input type="text" name="message" id="message" style="color:white" class="form-control">
                                            <input type="submit" name="send" id="send" value="Send" style="background:green;float:right;width:10%" class="form-control">
                                    
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                                  
                      
                            
                           
                    <div>
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
<script>
    window.onload=function(){
        var scrollablediv = document.getElementById("scrollable-div");
        scrollablediv.scrollTop=scrollablediv.scrollHeight;
    };
</script>