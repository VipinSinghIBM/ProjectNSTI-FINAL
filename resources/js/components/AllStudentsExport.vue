<template>
  <!-- /.card-header -->

      <div class="card-body table-responsive p-3 ">
            <table class="table arg table-hover text-nowrap" id="exportTableAll" >
              <thead>
                <tr>
                  <th>#Id</th>
                  <th>Name</th>
                  <th>Email ID</th>
                  <th>Phone Number</th>



                </tr>
              </thead>
              <tbody >

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

bus.$on("export-details", function (exportAllUsers) {


_this.exportUsers=exportAllUsers;


});

bus.$on('export-tableAll',function (){

 $('#exportTableAll').DataTable().destroy();//for fix in data table alert error

$('#exportTableAll').dataTable( {



"data":_this.exportUsers,
    "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "email" },
        { "data": "phonenumber" },

    ],
    "autoWidth": false,
 dom: 'Bfrtip',
  pageLength: 5,


        buttons: [

            'copy', 'csv', 'excel','print',
            {
            title: 'NSTI CALICUT REGISTERED STUDENTS DETAILS ',
            extend: 'pdfHtml5',
            orientation: 'patriot',
            pageSize: 'a4'
            }
        ]

});

});

//close
bus.$on("close-exportAll", function () {

    $(document).ready( function () {
        $('#exportTableAll').DataTable().destroy();
    } );

});

  },
};
</script>

