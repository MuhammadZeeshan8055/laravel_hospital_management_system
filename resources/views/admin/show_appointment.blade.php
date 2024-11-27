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
                                <th>Patient Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Doctor Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Message</th>
                                <th>Status</th>
                                <!-- <th>Approved</th>
                                <th>Cancelled</th> -->
                                <!-- <th>Email</th> -->
                            </thead>
                            <tbody>
                                <?php
                                    $i=0;
                                ?>
                                    @foreach($appointments as  $appointment)
                                <?php
                                    $i++;
                                ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$appointment->name}}</td>
                                    <td>{{$appointment->email}}</td>
                                    <td>{{$appointment->phone}}</td>
                                    <td>{{$appointment->doctor_name}}</td>
                                    <td>{{$appointment->date}}</td>
                                    <td>{{$appointment->time}}</td>
                                    <td>{{$appointment->message}}</td>
                                    <td>{{$appointment->status}}</td>
                                    <!-- <td><a href="{{url('approved',$appointment->id)}}" class="btn btn-success">Approved</a></td>
                                    <td><a href="{{url('cancelled',$appointment->id)}}" class="btn btn-danger">Cancelled</a></td> -->
                                    <!-- <td><a href="{{url('email_view',$appointment->id)}}" class="btn btn-primary">Send Email</a></td> -->
                               
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