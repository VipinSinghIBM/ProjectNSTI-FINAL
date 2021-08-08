
<template>
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <h2 class="text-center mt-2">Fee Verification</h2>
          <div class="card-header">
            <h2 class="card-title">
              <strong><em>Candidates Details For Verification</em></strong>
            </h2>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <div class="col">
                  <button
                    v-if="search == false"
                    type="button"
                    class="btn btn-sm btn-primary float-right"
                    @click="viewFilters()"
                  >
                    Add Filters
                    <i class="fas fa-filter fa-fw"></i>
                  </button>
                </div>


        <!-- exportModal modal -->
                <div
                  class="modal fade export_students"
                  tabindex="-1"
                  role="dialog"
                  data-backdrop="static"
                  aria-labelledby="myLargeModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Export Data</h5>
                        <button
                          type="button"
                          class="close"
                          data-dismiss="modal"
                          aria-label="Close"
                          @click="closeExport()"
                        >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <students-export></students-export>
                    </div>
                  </div>
                </div>
                <!--Export modal end-->
                <!--******************************************************************************-->
              </div>
            </div>
          </div>
          <div class="" v-if="search">
            <div class="col">
              <div class="float-right">
                <button
                  class="btn btn-outline-info btn-sm mb-2 mr-2 rounded-pill"
                  @click="getFilteredData()"
                >
                  Filter <i class="fas fa-filter fa-fw"></i>
                </button>

                <button
                  class="btn btn-info btn-sm mr-2 mb-2 rounded-pill"
                  @click="hideFilter()"
                >
                  Clear <i class="far fa-times-circle fa-fw"></i>
                </button>
              </div>
              <h5 class="text-center mt-2 text-muted pl-5">
                <b>Filter Data</b>
              </h5>
            </div>
            <div class="row justify-content-center pl-5 seven-cols">
              <div class="col-md-2 pl-1">
                <div class="form-group text-center">
                  <label class="">Trade Name</label>
                  <select
                    class="form-control"
                    v-model="filter.trade_name"
                    name="trade_name"
                  >
                    <option disabled value="">Select Trade Name</option>
                    <option value="CITS-Mechanic RAC">
                      CITS-Mechanic Refrigeration and Air Conditioning
                    </option>
                    <option value="CITS-Electrician & Wireman">
                      CITS-Electrician & Wireman
                    </option>
                    <option value="CITS-Electronic Mechanic">
                      CITS-Electronic Mechanic
                    </option>
                    <option value="CITS-Welder">CITS-Welder</option>
                    <option value="CITS-RODA">
                      CITS-Reading Of Drawing and Arithmetic (RODA)
                    </option>
                    <option value="CTS-Solar Technician">
                      CTS-Solar Technician(Electrical)
                    </option>
                    <option value="CTS-IOT">
                      CTS-IoT TECHNICIAN (SMART HEALTHCARE)
                    </option>
                    <option value="CTS-Electrician Power Distribution">
                      CTS-Electrician – Power Distribution
                    </option>
                    <option value="ADIT">
                      Advanced Diploma in IT Networking and Cloud Computing
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group text-center">
                  <label for="Gender" class="font-weight-bold">Gender</label>
                  <select class="form-control" v-model="filter.filter_gender">
                    <option disabled value="">Select Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group text-center">
                  <label for="category" class="font-weight-bold"
                    >Category</label
                  >
                  <select class="form-control" v-model="filter.filter_category">
                    <option disabled value="">Select Category</option>
                    <option value="General">General</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group text-center">
                  <label for="category" class="font-weight-bold"
                    >Date From</label
                  >
                  <input
                    class="form-control"
                    type="date"
                    v-model="filter.date_from"
                  />
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group text-center">
                  <label for="category" class="font-weight-bold">Date To</label>
                  <input
                    class="form-control"
                    type="date"
                    v-model="filter.date_to"
                  />
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group text-center">
                  <label for="category" class="font-weight-bold"
                    >Qualification</label
                  >
                  <select
                    class="form-control"
                    v-model="filter.filter_examination_name"
                  >
                    <option disabled value="">
                      Select Name Of Examination
                    </option>
                    <option value="sslc">SSLC</option>
                    <option value="plus two">Plus Two</option>
                    <option value="iti">ITI</option>
                    <option value="Degree">Degree</option>
                    <option value="Diploma">Diploma</option>
                  </select>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group text-center">
                  <label for="category" class="font-weight-bold">Mark %</label>
                  <input
                    type="number"
                    max="100"
                    min="0"
                    class="form-control"
                    v-model="filter.filter_mark_percentage"
                    placeholder="Marks Percentage"
                  />
                </div>







              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>#Id</th>
                  <th>Name</th>
                  <th>Email ID</th>
                  <th>Phone Number</th>
                  <th>Selected Trade</th>
                  <th>Date Of Birth</th>

                  <th>Certificate <br />Verification Status</th>
                  <th>Fee <br />Verification Status</th>
                  <th>Fee Verify Actions</th>
                </tr>
              </thead>
              <tbody v-for="user in users.data" :key="user.id">
                <tr>
                  <td>{{ user.id }}</td>
                  <td>{{ user.name | upText }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.phonenumber }}</td>
                  <td>{{ user.tradeName }}</td>
                  <td>{{ user.dob | myDate }}</td>
                  <td v-if="user.certificateVerificationStatus == 0">
                    <span class="badge badge-success"
                      >Verified <i class="far fa-check-circle fa-fw"></i
                    ></span>
                  </td>

                  <td v-if="user.certificateVerificationStatus == 1">
                    <span class="badge badge-primary"
                      >Re Upload Waiting
                      <i class="far fa-times-circle fa-fw"></i
                    ></span>
                  </td>

                  <td v-if="user.certificateVerificationStatus >= 2">
                    <span class="badge badge-danger"
                      >Rejected <i class="far fa-times-circle fa-fw"></i
                    ></span>
                  </td>
                  <td v-if="user.certificateVerificationStatus == null">
                    <span class="badge badge-warning"
                      >Verification Pending
                      <i class="fas fa-hourglass-half fa-fw"></i
                    ></span>
                  </td>
                  <!-- <td>

                           {{ user.feeVerificationStatus }}
                        </td>-->
                  <td v-if="user.feeVerificationStatus == 1">
                    <span class="badge badge-success"
                      >Paid <i class="far fa-check-circle fa-fw"></i
                    ></span>
                  </td>
                  <td v-if="user.feeVerificationStatus == 2">
                    <span class="badge badge-danger"
                      >Not Paid <i class="far fa-times-circle fa-fw"></i
                    ></span>
                  </td>
                  <td v-if="user.feeVerificationStatus == null">
                    <span class="badge badge-warning"
                      >Verification Pending
                      <i class="fas fa-hourglass-half fa-fw"></i
                    ></span>
                  </td>

                  <td>
                    <!-- <button type="button" @click="verifyCert(user)" class="btn btn-outline-success btn-sm ml-3" data-toggle="modal" data-target="#certificatesView" >
                    <i class="fa fa-check" title="View Certificates"></i></button>

                    <button type="button" @click="verifyCert(user)" class="btn btn-outline-danger btn-sm ml-3" data-toggle="modal" data-target="#certificatesView" >
                    <i class="fa fa-times" title="View Certificates"></i></button> -->
                    <button
                      @click="verifyFee(user)"
                      class="btn btn-outline-success btn-sm ml-3"
                    >
                      <i class="fa fa-check fa-fw"></i>
                    </button>

                    <button
                      @click="rejectFee(user)"
                      class="btn btn-outline-danger btn-sm ml-3"
                    >
                      <i class="fa fa-times fa-fw"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->

          <div class="card-footer align-right">
            <pagination
              :data="users"
              align="right"
              @pagination-change-page="loadUsers"
            >
            </pagination>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      users: {},
      search: false,
      filter: {
        trade_name: "",
        filter_gender: "",
        filter_category: "",
        date_from: "",
        date_to: "",
        filter_examination_name: "",
        filter_mark_percentage: "",
      },

      user_id: "",
      user_name: "",
    };
  },

  methods: {
    verifyFee(user) {
      this.user_name = user.name;
      this.user_id = user.id;
      this.$Progress.start();

      axios
        .post("/feeVerify/" + this.user_id)
        .then(() => {
          Fire.$emit("AfterAction");
          Toast.fire({
            icon: "success",
            title: "Fee Verified Successfully",
            timer: 1000,
          });
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("not verified ..there is an error"); //want to change in future
        });
    },
    //reject certificate function
    rejectFee(user) {
      this.user_name = user.name;
      this.user_id = user.id;
      this.$Progress.start();

      axios
        .post("/feeReject/" + this.user_id)
        .then(() => {
          Fire.$emit("AfterAction");
          Toast.fire({
            icon: "error",
            title: "Fee Verification Rejected",
            timer: 1000,
          });

          this.$Progress.finish();
        })
        .catch(() => {
          console.log("not rejected ..there is an error"); //want to change in future
        });
    },

    // //get table data function
    // loadUsers(page = 1){
    //     axios.get("/TableData?page=" + page,).then((data)=>(this.users=data.data));
    // },

    //get table data function
    loadUsers(page = 1) {
      axios
        .post("/TableData?page=" + page, this.filter)
        .then((response) => (this.users = response.data));
    },

  viewFilters() {
      this.search = true;
    },
 getFilteredData() {
      this.loadUsers();
    },

    hideFilter() {
      this.search = false;
      this.filter.trade_name = "";
      this.filter.filter_gender = "";
      this.filter.filter_category = "";
      this.filter.date_of_birth = "";
      this.filter.date_from = "";
      this.filter.date_to = "";
      this.filter.filter_examination_name = "";
      this.filter.filter_mark_percentage = "";

      this.loadUsers();

    },
  },

  created() {
    this.loadUsers();

    Fire.$on("AfterAction", () => {
      this.loadUsers();
    });
  },
};
</script>

