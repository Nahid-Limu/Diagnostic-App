
<!-- Modal start -->
<div class="modal fade" id="AddUserModal">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInLeft">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus" aria-hidden="true" style="color: red"></i> New User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="AddUserForm">  
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="name">Name</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name [EX: Nahid] ">
                            <span id="nameError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="email">Email</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email [EX: nahid@email.com] ">
                            <span id="emailError"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="role">Role</label>
                        </div>
                        <div class="form-group col-md-9">
                            <select name="role" id="role" class="form-control">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                            </select>
                            <span id="roleError"></span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-control" for="test_price">Password</label>
                        </div>
                        <div class="form-group col-md-9">
                            <input type="password" class="form-control" id="password" name="password" placeholder="8 Char [EX: ********] ">
                            <span id="passwordError"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="form-control" for="confirm_password">Confirm Password</label>
                        </div>
                        <div class="form-group col-md-7">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="same as password [EX: ********] ">
                            <span id="confirm_passwordError"></span>
                        </div>
                    </div>
                    <input type="checkbox" onclick="showPassword()">Show Password
                </form>
            </div>

            <!-- Modal footer  class="modal-footer"-->
            <div class="modal-footer" style="display: inline">
                <button onclick="addUser()" type="button" class="btn btn-success float-right">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                {{-- <button onclick="testfun()" type="button" class="btn btn-danger">test</button> --}}
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->
<script>

</script>