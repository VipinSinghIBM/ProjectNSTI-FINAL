<template>
<div class="container-fluid">



<div class="row pt-2">

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ totalCountsData.totalAppli }}</h3>

                <p>Total Registered Students</p>
              </div>
       <div class="icon">
                <i class="fas fa-users"></i>
              </div>

             <router-link to="/Certificate-Verification" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </router-link>
            </div>
          </div>
          <!-- ./col -->

<div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner row ml-4">
                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                    <h3>{{ totalCountsData.male }}</h3>
                                    <p>Male</p>
                    </div>
                <div class="icon">
               <i class="fas fa-th-list"></i>
              </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 ">

                                    <h3>{{ totalCountsData.female }}</h3>
                                    <p>Female</p>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                    <h3>{{ totalCountsData.others }}</h3>
                                    <p>Others</p>
                    </div>
            </div>


              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

  <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ totalCountsData.totalAppliFormFilled }}</h3>

                <p>Total Applications Recieved</p>
              </div>
       <div class="icon">
                <i class="fas fa-users"></i>
              </div>

             <router-link to="/Certificate-Verification" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </router-link>
            </div>
          </div>
          <!-- ./col -->



          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ totalCountsData.certVerifyPending }}</h3>

                <p>Documents Verification Pending</p>
              </div>
              <div class="icon">
               <i class="fas fa-hourglass-half"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

  <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ totalCountsData.reUploaded }}</h3>

                <p class="">Documents Re-Uploaded</p>
              </div>
              <div class="icon">
               <i class="fas fa-file-import"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ totalCountsData.certVerified }}</h3>

                <p>Documents Verified</p>
              </div>
              <div class="icon">
               <i class="fas fa-check-double"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

 <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ totalCountsData.feeVerifyPending }}</h3>

                <p>Fee Verification Pending</p>
              </div>
              <div class="icon">
               <i class="fas fa-hourglass-half"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

 <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ totalCountsData.feeVerified }}</h3>

                <p>Fee Verified</p>
              </div>
              <div class="icon">
              <i class="fas fa-check-double"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

 <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ totalCountsData.feeRejected }}</h3>

                <p>Fee Verification Rejected</p>
              </div>
              <div class="icon">
              <i class="far fa-times-circle"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

 <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ totalCountsData.admissionPending }}</h3>

                <p>Admission Pending</p>
              </div>
              <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

 <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ totalCountsData.waitingList }}</h3>

                <p>Waiting List Students</p>
              </div>
              <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

 <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ totalCountsData.rejected }}</h3>

                <p>Rejected Students</p>
              </div>
              <div class="icon">
                  <i class="fas fa-user-times"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

 <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ totalCountsData.admitted }}</h3>

                <p>Admitted Students</p>
              </div>
              <div class="icon">
                  <i class="fas fa-user-check"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->


        </div>
</div>



</template>

<script>

export default {

 data() {
    return {

        totalCountsData:{},

    }
 },

  methods:{


        getTotalCounts(){
                axios.get('totalApp').then((data)=>(this.totalCountsData=data.data));
        },


  },

  mounted() {

console.log('dashboard here');
this.getTotalCounts();

  },


};


</script>
<style>

</style>
