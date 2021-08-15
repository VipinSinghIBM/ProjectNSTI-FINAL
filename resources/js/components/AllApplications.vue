
<template>
<div class="container-fluid ">
<div class="row mt-3">
          <div class="col-md-12">

            <div class="card ">
<h2 class="text-center mt-2"><span class="badge badge-info">All Registered Sudents List <i class="fas fa-users fa-fw"></i></span></h2>
              <div class="card-header">
                <h2 class="card-title "><strong><em>All Registered Students</em></strong></h2>
 <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <div class="col">

   <button
                    type="button"
                    class="btn btn-sm btn-primary float-right mb-3"
                    data-toggle="modal"
                    data-target=".export_students"
                    @click="exportStudents()"
                  >
                    Export Data <i class="fas fa-file-export fa-fw"></i>
                  </button>


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

                     <all-students-export></all-students-export>
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

              <div class="col-md-4">
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
              <div class="col-md-4">
                <div class="form-group text-center">
                  <label for="category" class="font-weight-bold">Date To</label>
                  <input
                    class="form-control"
                    type="date"
                    v-model="filter.date_to"
                  />
                </div>
              </div>

              </div>
            </div>





              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>#Id</th>
                      <th>Name</th>
                      <th>Email ID</th>
                      <th>Phone Number</th>
                      <th>Personal <br>Details</th>
                      <th>Educational <br>Qualifications</th>
                    <th>Experience <br>Details</th>
                      <th>Documents<br> Upload</th>

                    </tr>
                    </thead>
                <tbody v-for="user in users.data" :key="user.id">
                    <tr>
                      <td>{{user.id}}</td>
                      <td>{{user.name | upText}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.phonenumber}}</td>

                     <td v-if="user.formNextStatus >= 2">
                    <span class="badge badge-success"
                      >Updated
                      <i class="fas fa-check-circle fa-fw"></i
                    ></span>
                  </td>
                    <td v-else>
                    <span class="badge badge-warning"
                      >Pending
                      <i class="fas fa-hourglass-half fa-fw"></i
                    ></span>
                  </td>

                       <td v-if="user.formNextStatus >= 3">
                    <span class="badge badge-success"
                      >Updated
                      <i class="fas fa-check-circle fa-fw"></i
                    ></span>
                  </td>
                    <td v-else>
                    <span class="badge badge-warning"
                      >Pending
                      <i class="fas fa-hourglass-half fa-fw"></i
                    ></span>
                  </td>


     <td v-if="user.formNextStatus >= 4">
                    <span class="badge badge-success"
                      >Updated
                      <i class="fas fa-check-circle fa-fw"></i
                    ></span>
                  </td>
                    <td v-else>
                    <span class="badge badge-warning"
                      >Pending
                      <i class="fas fa-hourglass-half fa-fw"></i
                    ></span>
                  </td>

                             <td v-if="user.formNextStatus >= 5">
                    <span class="badge badge-success"
                      >Updated
                      <i class="fas fa-check-circle fa-fw"></i
                    ></span>
                  </td>
                    <td v-else>
                    <span class="badge badge-warning"
                      >Pending
                      <i class="fas fa-hourglass-half fa-fw"></i
                    ></span>
                  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

<div class="card-footer align-right">
      <pagination
        :data="users"
        align="right"
        @pagination-change-page="loadAllUsers"
      >

    </pagination>
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
     users:{},
 exportAllUsers: [],

 search: false,
      filter: {
        date_from: "",
        date_to: "",
      },


    }
 },

  methods:{

viewFilters() {
      this.search = true;
    },
   //get table data function
    loadAllUsers(page = 1){
        axios.post("/GetLoadAllUsers?page="+page,this.filter).then((data)=>(this.users=data.data));
    },

  hideFilter() {
      this.search = false;

      this.filter.date_from = "";
      this.filter.date_to = "";

      this.loadAllUsers();
this.loadAllUsersForExcelExport();

    },

 getFilteredData() {
      this.loadAllUsers();
this.loadAllUsersForExcelExport();
    },

 exportStudents() {
      bus.$emit("export-tableAll");
    },

 closeExport() {
      bus.$emit("close-exportAll");
    },


    //get table data for export excel function
    loadAllUsersForExcelExport() {
      this.$Progress.start();

      axios.post("/GetAllDataForExport", this.filter).then((response) => {
        this.exportAllUsers = response.data;
        bus.$emit("export-details", this.exportAllUsers);
      });
      this.$Progress.finish();
    },

  },

  created() {

this.loadAllUsers();
this.loadAllUsersForExcelExport();
  },


};


</script>

<style>

</style>

