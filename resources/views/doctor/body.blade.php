        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-lg-12 mb-4">
                  <form action="{{ route('search') }}" method="post">
                    @csrf 
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" required>

                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" required>

                    <button type="submit">Search</button>
                  </form>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$in_progress}}</h3>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <!-- <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div> -->
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-4">In Progress Appointments</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$approved}}</h3>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <!-- <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div> -->
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-4">Approved</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$cancelled}}</h3>
                          <!-- <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <!-- <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div> -->
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-4">Cancelled</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$totalFee}}</h3>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-4">Total Fee</h6>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
        
          <!-- partial -->
        </div>