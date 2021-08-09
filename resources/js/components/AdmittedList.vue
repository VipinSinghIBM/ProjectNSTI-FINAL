
<template>
<div class="container-fluid ">
<div class="row mt-3">
          <div class="col-md-12">

            <div class="card ">
<h2 class="text-center mt-2"><span class="badge badge-success">Admitted Students List</span></h2>
              <div class="card-header">
                <h2 class="card-title"><strong><em>Admission Completed Students Details</em></strong></h2>

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
                    <th>View Full Details</th>
                      <th>Documents & <br>Certificates</th>

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

                    <td>


                    <button type="button" @click="formView(user)" class="btn btn-light btn-sm ml-1" data-toggle="modal" data-target="#applicationAllView" >
                    <i class="fa fa-user" title="View Personal Details"></i></button>

                    <button type="button" @click="educationView(user)" class="btn btn-light btn-sm " data-toggle="modal" data-target="#applicationEducationView" >
                    <i class="fa fa-graduation-cap" title="View Educational Qualifications"></i></button>

                    <button type="button" @click="experienceView(user)" class="btn btn-light btn-sm " data-toggle="modal" data-target="#applicationExperienceView" >
                    <i class="fa fa-university" title="View Experience Details"></i></button>

                      </td>






                      <td>

                    <button type="button" @click="verifyCert(user)" class="btn btn-outline-secondary btn-sm ml-4" data-toggle="modal" data-target="#certificatesView"  data-backdrop="static" >
                    <i class="fa fa-eye" title="View Certificates"></i></button>



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
        <h5 class="modal-title" id="certificatesView">Documents Of {{  user_name | upText }}</h5>
<button type="button" aria-label="Close"  class="close" @click="closeMainModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



<div class="row" >

<div class="col-md-3 col-sm-6" v-for="document in documents" :key="document.id">
   <div class="img" style="max-width: 180px">
                  <h5 v-if="document.reUploadStatus == 1">
                    Re Uploaded {{ document.doc_title }}
                  </h5>

                  <h5 v-if="document.reUploadStatus == null">
                    {{ document.doc_title }}
                  </h5>
                  <expandable-image
                    :src="/uploads/ + document.document"
                    class="img-fluid mb-4"
                    :close-on-background-click="true"
                  />

</div>

</div>

</div>






      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeMainModal()">Close </button>

      </div>
    </div>
  </div>
</div>
<!--**********************************************************-->




<!-- ALL DETAILS@APPLICATION FORM-->
<!-- Modal -->
<div class="modal fade" id="applicationAllView" tabindex="-1" role="dialog" aria-labelledby="certificatesView" aria-hidden="true">
  <div class="modal-dialog modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="certificatesView">Application Form Details Of {{  user_name | upText }}
            <span class="text-muted">: <strong>Personal Details</strong> </span>
        </h5>

 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<table class="table text-nowrap " style="width=100%">
<div class="row ">

<div class="col">
  <tr>
    <th>Name  :</th>
    <td>{{  user_name | upText }}</td>
  </tr>
  <tr>
    <th>Email Id  :</th>
    <td>{{ user_email }}</td>
  </tr>
  <tr>
    <th>Phone Number :</th>
    <td>{{ user_phone }}</td>
  </tr>
<tr>
    <th>Selected Trade :</th>
    <td>{{ user_trade }}</td>
  </tr>

<tr>
    <th>Date Of Birth :</th>
    <td>{{ user_dob | myDate}}</td>
  </tr>

<tr>
    <th>Whether ITI Passed :</th>
    <td>{{ user_itiPassed }}</td>
  </tr>

<tr>
    <th>Is Diploma Holder :</th>
    <td>{{ user_diploma}}</td>
  </tr>

<tr>
    <th>Father/Spouse/Guardian Name :</th>
    <td>{{ user_guardian}}</td>
  </tr>

<tr>
    <th>Mothers Name :</th>
    <td>{{ user_mother}}</td>
  </tr>

  <tr>
    <th>Gender :</th>
    <td>{{ user_gender}}</td>
  </tr>

</div>
<div class="col ">

   <tr>
    <th>Category :</th>
    <td>{{ user_category}}</td>
  </tr>

   <tr>
    <th>Physically Handicap :</th>
    <td>{{ user_physicallyHandicap}}</td>
  </tr>

   <tr>
    <th>Trainee Type :</th>
    <td>{{ user_traineeType}}</td>
  </tr>

   <tr>
    <th>Employee Code (PEN) :</th>
    <td>{{ user_empCode}}</td>
  </tr>

  <tr>
    <th>Aadhar Number :</th>
    <td>{{ user_aadharNumber}}</td>
  </tr>

  <tr>
    <th>Marital Status :</th>
    <td>{{ user_maritalStatus}}</td>
  </tr>

   <tr>
    <th>Address :</th>
    <td>{{ user_address}}</td>
  </tr>

</div>
</div>

</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close </button>

      </div>
    </div>
  </div>
</div>
<!-- ALL DETAILS@APPLICATION FORM-->



<!-- Educational Details@ FORM-->
<!-- Modal -->

<div class="modal fade" id="applicationEducationView" tabindex="-1" role="dialog" aria-labelledby="certificatesView" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="certificatesView">Application Form Details Of {{  user_name | upText }}
            <span class="text-muted">: <strong>Educational Qualification Details</strong> </span>
        </h5>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" @click="clearModalData()">&times;</span>
        </button>
      </div>
      <div class="modal-body" v-for="education in educations" :key="education.id">
<table class="table text-nowrap " style="width=100%">
<div class="row ">

<div class="col-md-6 col-sm-6">
  <tr>
    <th>Name Of Examination  :</th>
    <td>{{education.nameOfExamination}}</td>
  </tr>
<tr>
    <th>Name Of University or Board  :</th>
    <td>{{education.nameOfUniversityOrBoard}}</td>
  </tr>
<tr>
    <th>Trade Or Subject:</th>
    <td>{{education.tradeOrSubject}}</td>
  </tr>
<tr>
    <th>Year Of Passing:</th>
    <td>{{education.yearOfPassing}}</td>
  </tr>


</div>
<div class="col-md-6 col-sm-12  border-left ">

   <tr>
    <th>Certificate Number :</th>
    <td> {{education.certificateNumber}}</td>
  </tr>

<tr>
    <th>Duration:</th>
    <td> {{education.duration}}</td>
  </tr>

<tr>
    <th>Percentage Of Marks:</th>
    <td> {{education.percentageOfMarks}}</td>
  </tr>
<tr>
    <th>Technical Or Academic:</th>
    <td> {{education.technicalOrAcademic}}</td>
  </tr>

</div>
</div><hr style="height:1px;border:none;color:#333;background-color:#333;" />

</table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearModalData()">Close </button>

      </div>
    </div>
  </div>
</div>
<!-- Educational Details@ FORM-->


<!-- Educational Details@ FORM-->
<!-- Modal -->

<div class="modal fade" id="applicationExperienceView" tabindex="-1" role="dialog" aria-labelledby="certificatesView" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="certificatesView">Application Form Details Of {{  user_name | upText }}
            <span class="text-muted">: <strong>Experience  Details</strong> </span>
        </h5>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" @click="clearModalData()">&times;</span>
        </button>
      </div>



<div class="modal-body" v-for="experience in experiences" :key="experience.id">
<table class="table text-nowrap " style="width=100%">
<div class="row ">

<div class="col-md-6 col-sm-6">
  <tr>
    <th>Name Of Employer  :</th>
    <td>{{experience.nameOfEmployer}}</td>
  </tr>

 <tr>
    <th>Nature Of Job  :</th>
    <td>{{experience.natureOfJob}}</td>
  </tr>

<tr>
    <th>Designation  :</th>
    <td>{{experience.designation}}</td>
  </tr>

</div>
<div class="col-md-6 col-sm-12  border-left ">

<tr>
    <th>From Date  :</th>
    <td>{{experience.fromDate}}</td>
  </tr>

<tr>
    <th>To Date  :</th>
    <td>{{experience.toDate}}</td>
  </tr>


<tr>
    <th>Current Employer Status  :</th>
    <td>{{experience.currentEmployerStatus}}</td>
  </tr>

</div>
</div><hr style="height:1px;border:none;color:#333;background-color:#333;" />

</table>


</div>




      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearModalData()">Close </button>

      </div>
    </div>
  </div>
</div>
<!-- Educational Details@ FORM-->



</div>


</template>


<script>

export default {

 data() {
    return {
     users:{},
     documents:{},
     educations:{},
     experiences:{},

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
 exporExcelUsers: [],
doc_title:'',


     userId:'',
     user_name:'',
     user_email:'',
     user_phone:'',
user_trade:'',
user_dob:'',
user_itiPassed:'',
user_diploma:'',
user_guardian:'',
user_mother:'',
user_gender:'',
user_category:'',
user_physicallyHandicap:'',
user_traineeType:'',
user_empCode:'',
user_aadharNumber:'',
user_maritalStatus:'',
user_address:'',
// user_candidatePhoto:'',

user_ExaminationName:'',


expandedImage:'',
expandedImageTitle:'',

    }
 },

  methods:{

            clearModalData(){

            this.documents={};
            this.educations={};
            this.experiences={};


            },




            closeMainModal(){
            $('#certificatesView').modal('hide');
            $('.modal-backdrop').hide();

                this.clearModalData();
            },

    getDocuments(){

        axios.get('/getDocs/'+this.userId).then((data)=>(this.documents=data.data));

    },

    educationView(user){
       this.userId=user.id;
        axios.get('/getEducation/'+this.userId).then((data)=>(this.educations=data.data));

    },

    experienceView(user){
        this.userId=user.id;
        axios.get('/getExperience/'+this.userId).then((data)=>(this.experiences=data.data));
    },


    verifyCert(user){

        this.user_name=user.name;
        this.userId=user.id;

        this.getDocuments();

      },

 formView(user){

        this.user_name=user.name;
        this.userId=user.id;
        this.user_email=user.email;
        this.user_phone=user.phonenumber;
this.user_trade=user.tradeName;
this.user_dob=user.dob;
this.user_itiPassed=user.itiPassed;
this.user_diploma=user.isDiplomaHolder;
this.user_guardian=user.fatherGuardianName;
this.user_mother=user.motherName;
this.user_gender=user.gender;
this.user_category=user.category;
this.user_physicallyHandicap=user.physicallyHandicapped;
this.user_traineeType=user.traineeType;
this.user_empCode=user.employeeCodePEN;
this.user_aadharNumber=user.aadharNumber;
this.user_maritalStatus=user.maritalStatus;
this.user_address=user.address;
// this.user_candidatePhoto=user.candidatePhoto;


      },


    //get table data function
    loadUsers(page = 1){
        axios.post("/admittedStudents?page=" + page,this.filter).then((data)=>(this.users=data.data));
    },

 //get table data for export  function
    loadUsersForExcelExport() {
      this.$Progress.start();

      axios.post("/TableDataAdmittedForExport", this.filter).then((data) => {
        this.exporExcelUsers = data.data;
        bus.$emit("export-details", this.exporExcelUsers);
      });
      this.$Progress.finish();
    },


exportStudents() {
      bus.$emit("export-table");
    },

 closeExport() {
      bus.$emit("close-export");
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
