@extends('layouts.app')
@push('style')
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/%40form-validation/form-validation.css') }}" />
@endpush
@section('content')
   <!-- Content -->
              <div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="mb-1">Roles List</h4>

  <p class="mb-6">
    A role provided access to predefined menus and features so that depending on <br />
    assigned role an administrator can have access to what user needs.
  </p>
  <!-- Role cards -->
  <div class="row g-6">
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-normal mb-0 text-body">Total 4 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/5.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/12.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/6.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/3.png') }}" alt="Avatar" />
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end">
            <div class="role-heading">
              <h5 class="mb-1">Administrator</h5>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);"><i class="icon-base ti tabler-copy icon-md text-heading"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-normal mb-0 text-body">Total 7 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/4.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/1.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/2.png') }}" alt="Avatar" />
              </li>
              <li class="avatar">
                <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="4 more">+4</span>
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end">
            <div class="role-heading">
              <h5 class="mb-1">Manager</h5>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);"><i class="icon-base ti tabler-copy icon-md text-heading"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-normal mb-0 text-body">Total 5 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/6.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rishi Swaat" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/9.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/12.png') }}" alt="Avatar" />
              </li>
              <li class="avatar">
                <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="2 more">+2</span>
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end">
            <div class="role-heading">
              <h5 class="mb-1">Users</h5>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);"><i class="icon-base ti tabler-copy icon-md text-heading"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-normal mb-0 text-body">Total 3 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/3.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/9.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/4.png') }}" alt="Avatar" />
              </li>
              <li class="avatar">
                <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="3 more">+3</span>
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end">
            <div class="role-heading">
              <h5 class="mb-1">Support</h5>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);"><i class="icon-base ti tabler-copy icon-md text-heading"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-normal mb-0 text-body">Total 2 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/10.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/13.png') }}" alt="Avatar" />
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nurvi Karlos" class="avatar pull-up">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/avatars/5.png') }}" alt="Avatar" />
              </li>
              <li class="avatar">
                <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="7 more">+7</span>
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end">
            <div class="role-heading">
              <h5 class="mb-1">Restricted User</h5>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);"><i class="icon-base ti tabler-copy icon-md text-heading"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card h-100">
        <div class="row h-100">
          <div class="col-sm-5">
            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4">
              <img src="{{ asset('admin/assets/img/illustrations/add-new-roles.png') }}" class="img-fluid" alt="Image" width="83" />
            </div>
          </div>
          <div class="col-sm-7">
            <div class="card-body text-sm-end text-center ps-sm-0">
              <button id="addRole" class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">Add New Role</button>
              <p class="mb-0">
                Add new role, <br />
                if it doesn't exist.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <h4 class="mt-6 mb-1">Total users with their roles</h4>
      <p class="mb-0">Find all of your company’s administrator accounts and their associate roles.</p>
    </div>
    <div class="col-12">
      <!-- Role Table -->
      <div class="card">
        <div class="card-datatable">
          <table class="datatables-users table border-top">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th>User</th>
                <th>Role</th>
                <th>Plan</th>
                <th>Billing</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!--/ Role Table -->
    </div>
  </div>
  <!--/ Role cards -->

  <!-- Add Role Modal -->
  <!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="role-title" id="role-title"></h4>
          <p class="text-body-secondary">Set role permissions</p>
        </div>
        <!-- Add role form -->
        <form id="addRoleForm" class="row g-3" onsubmit="return false">
        <input type="hidden" name="id" id="id">
          <div class="col-12 form-control-validation mb-3">
            <label class="form-label" for="modalRoleName">Role Name</label>
            <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter a role name" tabindex="-1" required/>
          </div>
          <div class="col-12">
            <h5 class="mb-6">Role Permissions</h5>
            <!-- Permission table -->
            <div class="table-responsive">
              <table class="table table-flush-spacing">
                <tbody>
                  <tr>
                    <td class="text-nowrap fw-medium">
                      Administrator Access
                      <i class="icon-base ti tabler-info-circle icon-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i>
                    </td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check mb-0">
                          <input class="form-check-input" type="checkbox" id="selectAll" />
                          <label class="form-check-label" for="selectAll"> Select All </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                 
                  <tr>
                    <td class="text-nowrap fw-medium text-heading">Disputes Management</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check mb-0 me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="dispManagementRead" />
                          <label class="form-check-label" for="dispManagementRead"> Read </label>
                        </div>
                        <div class="form-check mb-0 me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="dispManagementWrite" />
                          <label class="form-check-label" for="dispManagementWrite"> Write </label>
                        </div>
                        <div class="form-check mb-0">
                          <input class="form-check-input" type="checkbox" id="dispManagementCreate" />
                          <label class="form-check-label" for="dispManagementCreate"> Create </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap fw-medium text-heading">Reporting</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="form-check mb-0 me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="reportingRead" />
                          <label class="form-check-label" for="reportingRead"> Read </label>
                        </div>
                        <div class="form-check mb-0 me-4 me-lg-12">
                          <input class="form-check-input" type="checkbox" id="reportingWrite" />
                          <label class="form-check-label" for="reportingWrite"> Write </label>
                        </div>
                        <div class="form-check mb-0">
                          <input class="form-check-input" type="checkbox" id="reportingCreate" />
                          <label class="form-check-label" for="reportingCreate"> Create </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
            <!-- Permission table -->
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-4 me-1" id="savedata">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
        <!--/ Add role form -->
      </div>
    </div>
  </div>
</div>
<!--/ Add Role Modal -->

  <!-- / Add Role Modal --></div>
   <!-- / Content -->
@endsection
@push('script')
<script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/popular.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script>

{{-- <script src="{{ asset('admin/assets/js/app-access-roles.js') }}"></script>
<script src="{{ asset('admin/assets/js/modal-add-role.js') }}"></script> --}}
@endpush
@push('script')
<script type="text/javascript">
  $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('role.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#addRole').click(function () {
        $('#savedata').val("create-role");
        $('#id').val('');
        $('#addRoleForm').trigger("reset");
        $('#role-title').html("Add New Role");
        $('#addRoleModal').modal('show');
    });
    
   
    
    $('#savedata').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#addRoleForm').serialize(),
          url: "{{ route('role.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#addRoleForm').trigger("reset");
              $('#ajaxModelexa').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#savedata').html('Save Changes');
          }
      });
    });
    
   
     
  });
</script>
@endpush
