<template>
  <!-- /.card-header -->

      <div class="card-body table-responsive p-3 ">
            <table class="table arg table-hover text-nowrap" id="exportTable" >
              <thead>
                <tr>
                  <th>#Id</th>
                  <th>Name</th>
                  <th>Email ID</th>
                  <th>Phone Number</th>
                  <th>Selected Trade</th>
                  <th>Date Of Birth</th>
                  <th>Father's Name</th>
                    <th>Mother's Name</th>
                  <th>ITI Passed</th>
                  <th>Diploma Holder</th>
                  <th>Gender</th>
                  <th>Category</th>


                  <th>physically Handicapped</th>
                  <th>Trainee Type</th>
                  <th>EmployeeCode PEN</th>
                  <th>AadharNumber</th>
                  <th>maritalStatus</th>
                  <th>Address</th>


                </tr>
              </thead>
              <tbody >
<!--
                <tr>
                  <td>{{ user.id }}</td>
                  <td>{{ user.name | upText }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.phonenumber }}</td>
                  <td>{{ user.tradeName }}</td>
                  <td>{{ user.dob | myDate }}</td>
                </tr> -->

             </tbody>
</table>
         </div>
          <!-- /.card-body -->
</template>
<script>

export default {
  data() {
    return {
        exportUsers:[],
    };


  },

  methods: {

  },

  created() {


var _this = this;

_this.exportUsers=[];

bus.$on("export-details", function (exporExcelUsers) {


_this.exportUsers=exporExcelUsers;


});

bus.$on('export-table',function (){

 $('#exportTable').DataTable().destroy();//for fix in data table alert error

$('#exportTable').dataTable( {



"data":_this.exportUsers,
    "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "email" },
        { "data": "phonenumber" },
        { "data": "tradeName" },
        { "data": "dob" },
        { "data": "fatherGuardianName" },
        { "data": "motherName" },

        { "data": "itiPassed" },
        { "data": "isDiplomaHolder" },

        { "data": "gender" },
        { "data": "category" },

        { "data": "physicallyHandicapped" },
        { "data": "traineeType" },
        { "data": "employeeCodePEN" },
        { "data": "aadharNumber" },
        { "data": "maritalStatus" },
        { "data": "address" },

    ],
    "autoWidth": false,
 dom: 'Bfrtip',
  pageLength: 5,


        buttons: [

            'copy', 'csv', 'excel','print',
            {
            title: 'NSTI CALICUT STUDENTS DETAILS FOR ADMISSION',
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'TABLOID'
            }
        ]

});

});

//close
bus.$on("close-export", function () {

    $(document).ready( function () {
        $('#exportTable').DataTable().destroy();
    } );

});

  },
};
</script>

