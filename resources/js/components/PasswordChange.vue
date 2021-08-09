<template>
<div class="container">
<div class="modal fade" id="changePasswordModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="exampleModalLabel">Change Your Password</h5> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
<div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Change your Password</h4></div>
                <div class="card-body">

                  <form method="POST" enctype="multipart/form-data" @submit.prevent="changePassword">

                    <div class="form-group">
                      <label for="current_password"><strong>Current Password:</strong></label>
                      <input type="password" class="form-control" v-model="form.currentPassword" name="currentPassword" >
                    <small class="text-danger" v-if="errors.currentPassword">{{ errors.currentPassword[0] }}</small>
                    </div>
                    <!-- End Current Password Input -->
                    <div class="form-group">
                      <label for="new_password"><strong>New Password:</strong></label>
                      <input type="password" class="form-control" v-model="form.password" name="password" >
                    <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                    </div>
                    <!-- End New Password Input -->
                    <div class="form-group">
                      <label for="new_password_confirmation"><strong>Confirm New Password:</strong></label>
                      <input type="password" class="form-control" v-model="form.password_confirmation " name="password_confirmation" >
 <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                    </div>
                    <!-- End New Confirm Password Input -->
  <div class="modal-footer">
      <button class="btn btn-success btn-sm" type="submit">Change Password</button>
<button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal" @click="closeModal">Close</button>
        </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
       </div>
      </div>
</div></div>



</template>

<script>


export default {

 data() {

    return {

            errors:[],
            form:{

                currentPassword:'',
                password:'',
                password_confirmation :'',
            },

    }
 },

  methods:{

 //for clear error data after return to the page
        clear_error_data(){
            for(let er in this.errors){
                this.errors[er]=null;
                }
        },
        clearModalData(){
            this.form={};
                $('#changePasswordModal').hide();
                $('.modal-backdrop').hide();

        },

        changePassword(){

                var _this=this;

                axios.post('/updatePassword',this.form).then(function(res){

                    if(res.data=='changed'){
                        _this.clearModalData();
                        Swal.fire(
                        'Password Changed!',
                        'Your Password Has Been Changed Successfully',
                        'success'
                        )
                        _this.errors=[];
                    }

                    if(res.data=='notChanged'){

                        _this.clearModalData();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Password not changed!',
                                })
                    }

                    if(res.data=='mismatch'){

                        // _this.clearModalData();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Your Current Password is Wrong!',
                                })
                    }

                    if(res.data=='doNotSamePw'){

                        // _this.clearModalData();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Your current password cannot be same with the new password!',
                                })
                    }
                }).catch((error)=>{
                        this.errors=error.response.data.errors;
                    });;
        },

            closeModal(){
                this.errors=[];
this.form={};
                $('#changePasswordModal').hide();
            },

  },


  created() {



  },


};


</script>
