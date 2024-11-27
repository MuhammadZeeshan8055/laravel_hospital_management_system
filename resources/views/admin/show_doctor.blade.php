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

        <div class="container-fluid page-body-wrapper mt-5">

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <th>S.no</th>
                                <th>Doctor Name</th>
                                <th>Phone</th>
                                <th>Speciality</th>
                                <!-- <th>Room No</th> -->
                                <th>Image</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </thead>
                            <tbody>
                                <?php
                                    $i=0;
                                ?>
                                    @foreach($doctor as  $doctors)
                                <?php
                                    $i++;
                                ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$doctors->doctor_name}}</td>
                                    <td>{{$doctors->doctor_phone}}</td>
                                    <td>{{$doctors->speciality}}</td>
                                    <!-- <td>{{$doctors->room}}</td> -->
                                    <td><img src="doctorimage/{{$doctors->image}}" alt=""></td>
                                    <td>{{$doctors->fee}}</td>
                                   
                                    <td>
                                        @php  

                                            if($doctors->status=='0'){
                                                $status='Pending';
                                            }else{
                                                $status='Approved';
                                            }

                                        @endphp
                                        {{$status}}
                                    </td>
                                    
                                    <td><a href="{{url('delete',$doctors->id)}}" onclick="return confirm('Are you sure want to delete Doctor Record')" class="btn btn-danger">Delete</a></td>
                                    <td><a href="{{url('update',$doctors->id)}}" class="btn btn-success">Update</a></td>
                                    
                                </tr>
                                    @endforeach
                            </tbody>
                        </table>
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