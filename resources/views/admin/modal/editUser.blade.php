
<!-- Modal start -->
<div class="modal fade" id="EditUserModal">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true" style="color: red"></i> Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="EditUserForm">  
                    @csrf
                    <input type="hidden" id="edit_user_id" name="id">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="name">Name</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="text" class="form-control" id="ename" name="name" placeholder="Name [EX: Nahid] ">
                            <span id="enameError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="eemail">Email</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="email" class="form-control" id="eemail" name="email" placeholder="Email [EX: nahid@email.com] ">
                            <span id="eemailError"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="erole">Role</label>
                        </div>
                        <div class="form-group col-md-9">
                            <select name="role" id="erole" class="form-control">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                            </select>
                            <span id="eroleError"></span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="epassword">Password</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="password" class="form-control" id="epassword" name="password" placeholder="8 Char [EX: ********] ">
                            <span id="epasswordError"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="form-control" for="econfirm_password">Confirm Password</label>
                        </div>
                        <div class="form-group col-md-7">
                            <input type="password" class="form-control" id="econfirm_password" name="confirm_password" placeholder="same as password [EX: ********] ">
                            <span id="econfirm_passwordError"></span>
                        </div>
                    </div>
                    <input type="checkbox" onclick="showPassword()">Show Password
                </form>
            </div>

            <!-- Modal footer  class="modal-footer"-->
            <div class="modal-footer" style="display: inline">
                <button onclick="updateUser()" type="button" class="btn btn-success float-right">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {{-- <button onclick="testfun()" type="button" class="btn btn-danger">test</button> --}}
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>

</script>