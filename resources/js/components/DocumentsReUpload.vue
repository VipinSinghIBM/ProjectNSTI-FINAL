<template>

  <div class="container">


<section  class="border" >

       <h3 class=" font-weight-bold font-italic text-center text-muted"><span class="text-muted"></span>Please Re-Upload Your Documets </h3>



    <div class="container mt-3">


<div class="row">
<div class="col-md-6">
<div class="input-group mt-3">
<label for="c-photo" class="font-weight-bold " >Candidate Photo</label>
</div>
<div class="input-group">
<input type="file" class="form-control"  @change="onChangeCandPhoto" name="candidatePhoto" id="candidatePhoto" >
<button type="button" class="btn btn-dark btn-default" @click.prevent="upCandPhoto" ><i class="fas fa-cloud-upload-alt"></i> Upload</button>

</div>

<img v-bind:src="imagePreview" width="80" height="80" v-show="showPreview" class="mt-2"/>

<div class="input-group mt-3">
<label for="c-photo" class="font-weight-bold " >Aadhar Card -Back Side</label>
</div>
<div class="input-group">
<input type="file" class="form-control" @change="onChangeaadharB"  name="aadharCardB" id="aadharCardB" >
<button type="button" class="btn btn-dark btn-default"  @click.prevent="upAadharPhotoB" ><i class="fas fa-cloud-upload-alt"></i> Upload</button>

</div>

<img v-bind:src="imagePreviewAadharB" width="80" height="80" v-show="showPreviewAadharB" class="mt-2"/>


</div>


<!--02-->
<div class="col-md-6">
<div class="input-group mt-3">
<label for="c-photo" class="font-weight-bold " >Aadhar Card -Front Side</label>
</div>
<div class="input-group">
<input type="file" class="form-control" @change="onChangeaadharF" name="aadharCardF" id="aadharCardF" >
<button type="button" class="btn btn-dark btn-default" @click.prevent="upAadharPhotoF"><i class="fas fa-cloud-upload-alt"></i> Upload</button>

</div>

<img v-bind:src="imagePreviewAadharF" width="80" height="80" v-show="showPreviewAadharF" class="mt-2"/>



</div>

<!--TEST TEST TEST TEST TEST TEST TEST TEST -->
<div class="container">
<div class="row">

          <div class="col-md-6" v-for="d in doc" :key="d.id">
            <div class="" :ref="d.id" >
              <div class="input-group mt-3">
                <label for="ct-photo" class="font-weight-bold">{{
                  d.nameOfExamination
                }}</label>
              </div>
              <div class="input-group">
                <input
                  type="file"
                  class="form-control"
                  :name="d.nameOfExamination"
                  :ref="d.nameOfExamination"
                />
                <button
                  type="button"
                  @click="show(d)"
                  class="btn btn-dark btn-default"
                >
                  <i class="fas fa-cloud-upload-alt"></i> Upload
                </button>
              </div>
            </div>
          </div>
</div>
</div>
          <!--TEST TEST TEST TEST TEST TEST TEST TEST -->



  <button class="btn btn-primary mt-5 mb-5 ml-auto mr-5 " @click.prevent="finalSubmit">Submit</button>

</div>









    </div>



    </section>


  </div>
</template>

<script>
       export default {

         data() {
    return {


    doc: {},

      docName: "",
      docfile: "",
      docUserId: "",
nameOfExamination:'',

imagePreview: null,
showPreview: false,

imagePreviewAadharB: null,
showPreviewAadharB: false,

imagePreviewAadharF: null,
showPreviewAadharF: false,

// hideThisForm:false,
        }
         },

methods:{


  show(d) {
      this.docUserId = d.user_id;
      this.docName = d.nameOfExamination;
      this.docfile = this.$refs[d.nameOfExamination][0].files[0];



      if (this.docUserId != "" && this.docName != "" && this.docfile != "") {


        let uploadImage = new FormData();
        uploadImage.append("userId", this.docUserId);
        uploadImage.append("docName", this.docName);
        uploadImage.append("certificate", this.docfile);

        axios.post("/rePostdoc", uploadImage).then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "image added",
            });

       this.docUserId = '';
        this.docName = '';
        this.docfile = '';


     this.$refs[d.id][0].className += " hide";



          }
          if (response.data == "already Uploaded") {
            Toast.fire({
              icon: "error",
              title: "image already added",
            });
          }
        });
      }
    },



 getDataReUpload() {
      axios.get("getDocForReUpload").then((response) => {
        this.doc = response.data;
      });
    },

    onChangeCandPhoto(e){
                console.log("selected file",e.target.files[0])
                this.candidatePhoto=e.target.files[0];

                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                        this.showPreview = true;
                        this.imagePreview = reader.result;
                    }.bind(this), false);




            if( this.candidatePhoto ){
                    /*
                        Ensure the file is an image file.
                    */
                    if ( /\.(jpe?g|png|gif)$/i.test( this.candidatePhoto.name ) ) {

                        console.log("candidate photo is here");
                        /*
                        Fire the readAsDataURL method which will read the file in and
                        upon completion fire a 'load' event which we will listen to and
                        display the image in the preview.
                        */
                        reader.readAsDataURL( this.candidatePhoto );
                    }

    }




            },

//aadharBack
onChangeaadharB(e){
                console.log("selected file",e.target.files[0])
                this.aadharBack=e.target.files[0];





                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                        this.showPreviewAadharB = true;
                        this.imagePreviewAadharB = reader.result;
                    }.bind(this), false);





                if( this.aadharBack ){
                                    /*
                                        Ensure the file is an image file.
                                    */
                                    if ( /\.(jpe?g|png|gif)$/i.test( this.aadharBack.name ) ) {

                                        console.log("aadhar back side is here");
                                        /*
                                        Fire the readAsDataURL method which will read the file in and
                                        upon completion fire a 'load' event which we will listen to and
                                        display the image in the preview.
                                        */
                                        reader.readAsDataURL( this.aadharBack );
                                    }

                    }




            },


  //aadharFront
onChangeaadharF(e){
                console.log("selected file",e.target.files[0])
                this.aadharFront=e.target.files[0];





                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                        this.showPreviewAadharF = true;
                        this.imagePreviewAadharF = reader.result;
                    }.bind(this), false);





                if( this.aadharFront ){
                                    /*
                                        Ensure the file is an image file.
                                    */
                                    if ( /\.(jpe?g|png|gif)$/i.test( this.aadharFront.name ) ) {

                                        console.log("aadhar front side is here");
                                        /*
                                        Fire the readAsDataURL method which will read the file in and
                                        upon completion fire a 'load' event which we will listen to and
                                        display the image in the preview.
                                        */
                                        reader.readAsDataURL( this.aadharFront );
                                    }

                    }




            },


  upCandPhoto(){
                // let valCheckA =this.valueCheckOne=false;

                 let uploadImage=new FormData();
                 uploadImage.append('candidatePhoto',this.candidatePhoto);

                 axios.post('/reUploadCandidatePhoto',uploadImage).then(function(){
                //  valCheckA=true;

                        console.log('candidate Photo Uploaded');
                    Toast.fire({
                            icon: 'success',
                            title: 'Candidate Photo Uploaded Successfully',
                        });



                 });


            },



 upAadharPhotoB(){

// let valCheckC =this.valueCheckOne=false;
                 let uploadImage=new FormData();

                 uploadImage.append('aadharBack',this.aadharBack);


                 axios.post('/reUploadaadharBackPhoto',uploadImage).then(function(){
// valCheckC=true;
                        console.log('aadhar back side  Photo Uploaded');
                    Toast.fire({
                            icon: 'success',
                            title: 'Aadhar Back Side Uploaded Successfully',
                        });



                 });


            },

 upAadharPhotoF(){

// let valCheckB =this.valueCheckOne=false;
                 let uploadImage=new FormData();
                 uploadImage.append('aadharFront',this.aadharFront);

                 axios.post('/reUploadaadharFrontPhoto',uploadImage).then(function(){
//  valCheckB=true;

                        console.log('aadhar Front Photo Uploaded');
                    Toast.fire({
                            icon: 'success',
                            title: 'Aadhar Front Side Uploaded Successfully',
                        });



                 });


            },





        finalSubmit:function(){




                if(this.candidatePhoto && this.aadharFront && this.aadharBack  ){


// var _this=this;
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Please ensure that the documents rejection reasons are solved!Once you submitted the details you can'nt change ",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, Submit it!'
                                    }).then((result) => {
                                    if (result.isConfirmed) {

                                        axios.post('/changeReupRemarks').then(function(){

                                                });

                                        Swal.fire(
                                        'Submitted!',
                                        'Your Form has been submitted successfully.',
                                        'success'
                                        ).then(function() {
                                                // _this.hideThisForm=true;

                                            window.location = "/home";
                                        });
                                    }
                                })


                }else{
                Swal.fire(
                'Please Upload all Documents!',
                'Please Upload Your Documents One By One!',
                'warning'
                )
                }


        },

},
        mounted() {
this.getDataReUpload();
            console.log('Component mounted.okay');

        },


    }
</script>

<style scoped>
.hide{

display: none !important;

}
</style>
