<template>
<div class="container ">
<button class="btn btn-sm btn-primary float-right" @click="download">Download <i class="fas fa-download fa-fw"></i></button>

<div id="content" >

<div class="container">
  <div class="row">
    <div class="col-12 ">
<img src="/assets/images/web c.png" class="float-left mt-3 " alt="..." style="width:45px;">
<img src="/assets/images/web a.png" class="float-right mt-1" alt="..." style="width:35px;">
<h6 class="text-center mt-2 font-weight-bold">National Skill Training Institute , Calicut</h6>
<h6 class="text-center">Application Form</h6>

<hr>
    </div>
  </div>
<div class="container">
<p class="font-weight-bold text-center">Personal Details</p>
  <div class="row">
    <div class="col ">

<p><span class="font-weight-bold font-italic">id  :</span>  {{ impotedUserId }}</p>
<p><span class="font-weight-bold font-italic">Name of Trainee :</span>  {{ importedName }}</p>
<p><span class="font-weight-bold font-italic">Email ID :</span>  {{ importedEmail }}</p>
<p><span class="font-weight-bold font-italic">Selected Trade :</span>  {{ importedTrade }}</p>
<p><span class="font-weight-bold font-italic">Whether ITI Passed :</span>  {{ importedIti }}</p>
<p><span class="font-weight-bold font-italic">Is Diploma Holder :</span>  {{ importedDiploma }}</p>
    </div>

<div class="col" v-for="document in impDocuments" :key="document.id">
{{ document.doc_title }}
</div>


</div>
  </div>


</div>

</div>



</div>

</template>
<script>

import { jsPDF } from "jspdf";
import html2canvas from "html2canvas";


export default {

  data() {
    return {

impotedUserId:"",
importedName:"",
importedEmail:"",
importedTrade:"",
importedIti:"",
importedDiploma:"",



usersData:{},

impDocuments:{},

    };


  },

  methods: {

download(){
    window.html2canvas=html2canvas;
    var doc=new jsPDF("p","pt","a4");
    doc.html(document.querySelector("#content"), {

        callback:function(pdf){

            pdf.save("test.pdf");
        }
    });


}
},

  created() {

var _this=this;
bus.$on("export-applicationForm", function (userId,user_name,user_email,user_trade,user_itiPassed,user_diploma,documents) {

_this.impotedUserId=userId;
_this.importedName=user_name;
_this.importedEmail=user_email;
_this.importedTrade=user_trade;
_this.importedIti=user_itiPassed;
_this.importedDiploma=user_diploma;
_this.impDocuments=documents;
console.log(_this.impotedUserId);

});



  }
};
</script>


<style>

#content{
height: 11.7in;
width: 6in;
font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;


}



</style>
