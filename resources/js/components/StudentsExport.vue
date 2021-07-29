<template>
  <!-- /.card-header -->
          <div class="card-body table-responsive p-0 ">
            <table class="table table-hover text-nowrap" id="exportTable" >
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
                  <th>Gender</th>
                  <th>Category</th>

  <th>#Id</th>
                  <th>Name</th>
                  <th>Email ID</th>
                  <th>Phone Number</th>
                  <th>Selected Trade</th>
                  <th>Date Of Birth</th>
                  <th>Father's Name</th>
                  <th>Mother's Name</th>
                  <th>Gender</th>
                  <th>Category</th>

 <th>#Id</th>
                  <th>Name</th>
                  <th>Email ID</th>
                  <th>Phone Number</th>
                  <th>Selected Trade</th>
                  <th>Date Of Birth</th>
                  <th>Father's Name</th>
                  <th>Mother's Name</th>
                  <th>Gender</th>
                  <th>Category</th>

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
        { "data": "gender" },
        { "data": "category" },

  { "data": "id" },
        { "data": "name" },
        { "data": "email" },
        { "data": "phonenumber" },
        { "data": "tradeName" },
        { "data": "dob" },
        { "data": "fatherGuardianName" },
        { "data": "motherName" },
        { "data": "gender" },
        { "data": "category" },

  { "data": "id" },
        { "data": "name" },
        { "data": "email" },
        { "data": "phonenumber" },
        { "data": "tradeName" },
        { "data": "dob" },
        { "data": "fatherGuardianName" },
        { "data": "motherName" },
        { "data": "gender" },
        { "data": "category" },
    ],
    "autoWidth": false,
 dom: 'Bfrtip',
  pageLength: 5,

        buttons: [
            'copy', 'csv', 'excel', 'pdf','print',
            {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'TABLOID' }
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

