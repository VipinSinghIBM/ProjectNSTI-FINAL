
<template>
<div class="container-fluid ">
<div class="row mt-3">
          <div class="col-md-12">

            <div class="card ">
<h2 class="text-center mt-2">Admission Pending Candidates</h2>
              <div class="card-header">
                <h2 class="card-title"><strong><em>Candidates Details For Admission (Certificate/Fee Verifications Completed)</em></strong></h2>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">


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

                      <th>Admission Status</th>


                      <th>Admission Actions</th>

                    </tr>
                    </thead>
                <tbody v-for="user in users.data" :key="user.id">
                    <tr>
                    <td>{{user.id}}</td>
                      <td>{{user.name | upText}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.phonenumber}}</td>
                      <td>{{user.tradeName }}</td>
                      <td>{{user.dob | myDate}}</td>

                      <td v-if="(user.AdmissionStatus ==1)"><span class="badge badge-success">Admitted <i class="far fa-check-circle fa-fw"></i></span></td>

                        <td v-if="(user.AdmissionStatus ==2)"><span class="badge badge-danger">Rejected <i class="far fa-times-circle fa-fw"></i></span></td>

                        <td v-if="(user.AdmissionStatus ==3)"><span class="badge badge-info">Waiting List <i class="far fa-clock fa-fw"></i></span></td>

                    <td v-if="(user.AdmissionStatus==null)"><span class="badge badge-warning">Admission Pending <i class="fas fa-hourglass-half fa-fw"></i></span>

                                            </td>



                      <td>

                    <button type="button" @click="verifyCert(user)" class="btn btn-outline-secondary btn-sm ml-4" data-toggle="modal" data-target="#certificatesView" >
                    <i class="fa fa-eye" title="View Details"></i></button>



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

<!-- Modal main -->
<div class="modal fade" id="certificatesView" tabindex="-1" role="dialog" aria-labelledby="certificatesView" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="certificatesView">Admission Details Of {{  user_name | upText }}</h5>

      </div>
    <div class="modal-body">
<table class="table text-nowrap" style="width=100%">
<div class="row ">

<div class="col-md-6 col-sm-6">
  <tr>
    <th>Name   :</th>
    <td>{{  user_name | upText }}</td>
  </tr>

 <tr>
    <th>Email ID  :</th>
    <td>{{user_email}}</td>
  </tr>

<tr>
    <th>Phone Number :</th>
    <td>{{user_phone}}</td>
  </tr>



</div>
<div class="col-md-6 col-sm-12  border-left ">

<tr>
    <th>Selected Trade :</th>
    <td>{{user_trade}}</td>
  </tr>

<tr>
    <th>Dob :</th>
    <td>{{ user_dob }}</td>
  </tr>

<tr>
    <th>Gender :</th>
    <td>{{ user_gender }}</td>
  </tr>



</div>
</div>
<div class="d-flex justify-content-around">
<tr>
    <th>Certificate Verification Status :</th>

   <td v-if="(user_cert_status==0)"><span class="badge badge-success">Verified <i class="far fa-check-circle fa-fw"></i></span>
  <td v-if="(user_cert_status  >= 2)"><span class="badge badge-danger">Rejected <i class="far fa-times-circle fa-fw"></i></span>

                        </td>
                <td v-if="(user_cert_status==null)"><span class="badge badge-warning">Verification Pending <i class="fas fa-hourglass-half fa-fw"></i></span>



                        </td>



    <th>Fee Verification Status :</th>

 <td v-if="(user_fee_status==1)"><span class="badge badge-success">Paid <i class="far fa-check-circle fa-fw"></i></span>
                        </td>
                        <td v-if="(user_fee_status==2)"><span class="badge badge-danger">Not Paid <i class="far fa-times-circle fa-fw"></i></span>
                        </td>
                        <td v-if="(user_fee_status==null)"><span class="badge badge-warning">Verification Pending <i class="fas fa-hourglass-half fa-fw"></i></span>
                        </td>
  </tr>
</div>
</table>


</div>
      <div class="modal-footer">


        <button @click="AdmitStudent()" class="btn btn-success" data-dismiss="modal" >Admit <i class="fa fa-check fa-fw"></i></button>

        <button @click="RejectStudent()" class="btn btn-danger" data-dismiss="modal">Reject <i class="fa fa-times fa-fw"></i></button>

    <button @click="addToWaitingList()" class="btn btn-warning" data-dismiss="modal">Add To Waiting List <i class="fas fa-hourglass-half fa-fw"></i></button>

    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeMainModal()">Close <i class="fas fa-door-open fa-fw"></i></button>

      </div>
    </div>
  </div>
</div>
<!--**********************************************************-->








</div>


</template>


<script>

export default {

 data() {
    return {
     users:{},
     documents:{},

 exporExcelUsers: [],

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


doc_title:'',


     userId:'',
     user_name:'',
     user_email:'',
     user_phone:'',
user_trade:'',
user_dob:'',
user_cert_status:'',
user_fee_status:'',
user_gender:'',


user_ExaminationName:'',


expandedImage:'',
expandedImageTitle:'',

    }
 },

  methods:{



closeExpandImage(){

 $('#certificatesView').modal('show');

},

//28/06/2021Overlay issue want to change
closeMainModal(){
 $('#certificatesView').modal('hide');
 $('.modal-backdrop').hide();
},

    verifyCert(user){

        this.user_name=user.name;
        this.userId=user.id;
        this.user_email=user.email;
        this.user_phone=user.phonenumber;
        this.user_trade=user.tradeName;
        this.user_cert_status=user.certificateVerificationStatus;
        this.user_fee_status=user.feeVerificationStatus;
        this.user_dob=user.dob;
        this.user_gender=user.gender;






      },
        //AdmitStudents
  AdmitStudent(){


        axios.post("/admitStudents/"+this.userId).then((res)=>{

                if(res.data=='alreadyAdmitted'){
                        Swal.fire({
                        icon: 'warning',
                        title: 'Already Admitted',
                        })
                }else{
            this.$Progress.start();
            Fire.$emit('AfterAction');

            $('#certificatesView').modal('hide')

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Successfully Admitted',
                })
            this.$Progress.finish();
                }
        }).catch(()=>{
            console.log("not Admitted ..there is an error")//want to change in future
        })


    },

        RejectStudent(){


                axios.post("/rejectStudents/"+this.userId).then((res)=>{

                if(res.data=='alreadyRejected'){
                        Swal.fire({
                        icon: 'warning',
                        title: 'Already Rejected',
                        })
                }else{
                this.$Progress.start();
                Fire.$emit('AfterAction');

                    $('#certificatesView').modal('hide')
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully Rejected',
                        })
                    this.$Progress.finish();

                }

                }).catch(()=>{
                    console.log("not Rejected ..there is an error")//want to change in future
                })


            },

   addToWaitingList(){


                axios.post("/addWaiting/"+this.userId).then((res)=>{

                    if(res.data=='alreadyWaited'){
                                            Swal.fire({
                                            icon: 'warning',
                                            title: 'Already Added To Waiting List',
                                            })
                                    }else{
                                            this.$Progress.start();

                                        Fire.$emit('AfterAction');

                                                $('#certificatesView').modal('hide')
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'success',
                                                    title: 'Added To Waiting List',
                                                    })
                                                this.$Progress.finish();
                                    }

                }).catch(()=>{
                    console.log("not added to waiting list ..there is an error")//want to change in future
                })


            },






 loadUsers(page = 1){
        axios.post("/TableDataAdmission?page=" + page,this.filter).then((data)=>(this.users=data.data));
    },

    //get table data for export  function
    loadUsersForExcelExport() {
      this.$Progress.start();

      axios.post("/TableDataAdmissionForExport", this.filter).then((data) => {
        this.exporExcelUsers = data.data;
        bus.$emit("export-details", this.exporExcelUsers);
      });
      this.$Progress.finish();
    },

  viewFilters() {
      this.search = true;
    },
 getFilteredData() {
      this.loadUsers();
this.loadUsersForExcelExport();
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
this.loadUsersForExcelExport();

    },

exportStudents() {
      bus.$emit("export-table");
    },

    closeExport() {
      bus.$emit("close-export");
    },

  },

  created() {

this.loadUsersForExcelExport();
    this.loadUsers();

    Fire.$on('AfterAction',()=>{
        this.loadUsers();
    });
  },


};


</script>

<style>

</style>
