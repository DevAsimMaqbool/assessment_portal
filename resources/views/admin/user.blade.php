@extends('layouts.app')
@push('style')
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/%40form-validation/form-validation.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endpush
@section('content')
      <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Users List Table -->
            <div class="card">
                <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Filters</h5>
                <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
                </div>
                <div class="card-datatable">
                <table class="table" id="userTable">
                    <thead class="border-top">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
                </div>
                <!-- Offcanvas to add new user -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                    <form class="add-new-user pt-0" id="addNewUserForm">
                    <input type="hidden" id="adminuserId">
                    <div class="mb-6 form-control-validation">
                        <label class="form-label" for="add-user-fullname">Full Name</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="Add Name" name="name" required />
                        <div class="invalid-feedback" id="nameError"></div>
                    </div>
                    <div class="mb-6 form-control-validation">
                        <label class="form-label" for="add-user-email">Email</label>
                        <input type="text" id="add-user-email" class="form-control" placeholder="example@gmail.com"  name="email" required/>
                        <div class="invalid-feedback" id="emailError"></div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="add-user-employee-code">Employee Cod</label>
                        <input type="text" id="add-user-employee-code" class="form-control" placeholder="12345"  name="employee_code"required />
                        <div class="invalid-feedback" id="employee_codeError"></div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="add-user-department">Department</label>
                        <input type="text" id="add-user-department" class="form-control" placeholder="MIS" aria-label="jdoe1" name="department" required/>
                        <div class="invalid-feedback" id="departmentError"></div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="user-role">User Role</label>
                        <select id="user-role" class="form-select" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        </select>
                        <div class="invalid-feedback" id="roleError"></div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="user-level">Select Level</label>
                        <select id="user-level" class="form-select" name="level" required>
                        <option value="Managerial">Managerial</option>
                        <option value="Operational">Operational</option>
                        </select>
                        <div class="invalid-feedback" id="levelError"></div>
                    </div>
                     <div class="mb-6">
                        <label class="form-label" for="user-manager">Select Manager</label>
                        <select id="user-manager" class="form-select" name="manager_id" required>
                        </select>
                        <div class="invalid-feedback" id="manager_idError"></div>
                    </div>
                     <div class="mb-6">
                        <label class="form-label" for="user-status">Select Status</label>
                        <select id="user-status" class="form-select" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        </select>
                        <div class="invalid-feedback" id="statusError"></div>
                    </div>
                    <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
                    <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
          <!-- / Content -->
@endsection
@push('script')
    
<script src="{{ asset('admin/assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/popular.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('admin/assets/js/extended-ui-sweetalert2.js') }}"></script>
{{-- <script src="{{ asset('admin/assets/js/app-user-list.js') }}"></script> --}}
@endpush
@push('script')
<script>
$('#offcanvasAddUser').on('hidden.bs.offcanvas', function () {
    $('#addNewUserForm')[0].reset();          // Reset form fields
    $('#adminuserId').val('');                // Clear hidden ID
    $('#nameError').hide().text('');          // Clear errors if any
})
function fetchUsers() {
    $.ajax({
        url: "{{ route('admin.users.index') }}", // Your Laravel route
        method: "GET",
        dataType: "json",
        success: function (data) {
            const managerial_users = data.managerial_users;
            let manageruserOptions = '<option value="">Select Manager</option>';
                managerial_users.forEach(manageruser => {
                    manageruserOptions += `<option value="${manageruser.id}">${manageruser.name}</option>`;
                });
                $('#user-manager').html(manageruserOptions);
            const statusMap = {
                pending: { title: "pending", class: "bg-label-warning" },
                active: { title: "active", class: "bg-label-success" },
                inactive: { title: "inactive", class: "bg-label-secondary" }
            };

            // Prepare rows
            const rowData = data.users.map((user, index) => {
                const createdAt = new Date(user.created_at);
                const formattedDate = createdAt.toISOString().split('T')[0];

                // Example roles icons mapping (you can adjust)
                const roleIcons = {
                    user: '<i class="icon-base ti tabler-user icon-md text-success me-2"></i>',
                    admin: '<i class="icon-base ti tabler-device-desktop icon-md text-danger me-2"></i>'
                };

                return {
                    id: user.id,
                    checkbox: '', // Checkbox rendered later
                    full_name: user.name,
                    email: user.email,
                    role: user.roles ||"user", // default role if missing
                    department: user.department, // example, change as needed
                    level: user.level || "N/A", // example, change as needed
                    status: user.status || 2, // default Active if missing
                    created_at: formattedDate,
                    actions: '' // Actions rendered later
                };
            });

            if ($.fn.DataTable.isDataTable('#userTable')) {
                // If table exists, reload data
                $('#userTable').DataTable().clear().rows.add(rowData).draw();
            } else {
                // Initialize DataTable
                $('#userTable').DataTable({
                    data: rowData,
                    columns: [
                        {
                            data: 'id',
                            orderable: false,
                            searchable: false,
                            className: 'control',
                            render: function () {
                                return '';
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `<input type="checkbox" class="dt-checkboxes form-check-input" data-user-id="${data.id}">`;
                            }
                        },
                        {
                            data: null,
                            render: function (data) {
                                return `
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-4">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    ${data.full_name.charAt(0).toUpperCase()}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="app-user-view-account.html" class="text-heading text-truncate">
                                                <span class="fw-medium">${data.full_name}</span>
                                            </a>
                                            <small>${data.email}</small>
                                        </div>
                                    </div>
                                `;
                            }
                        },
                       {
                            data: 'role',
                            render: function (role) {
                                const safeRole = role || 'user';
                                let icon = '';

                                if (safeRole == 'admin') {
                                    icon = '<i class="icon-base ti tabler-device-desktop icon-md text-danger me-2"></i>';
                                } else if (safeRole == 'user') {
                                    icon = '<i class="icon-base ti tabler-user icon-md text-success me-2"></i>';
                                } else {
                                    icon = '<i class="icon-base ti tabler-circle icon-md text-primary me-2"></i>'; // default or other role
                                }

                                return `<span class='text-truncate d-flex align-items-center text-heading'>
                                    ${icon} ${safeRole}
                                </span>`;
                            }
                        },
                        { data: 'department' },
                        { data: 'level' },
                        {
                            data: 'status',
                            render: function (status) {
                                const s = statusMap[status] || statusMap['inactive']; // Default Active
                                return `<span class="badge ${s.class}" text-capitalized>${s.title}</span>`;
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `
                                <div class="d-flex align-items-center">
                                    <a href="javascript:;" class="btn btn-text-secondary rounded-pill waves-effect btn-icon" onclick="editUser(${data.id})">
                                        <i class="icon-base ti tabler-edit icon-22px"></i>
                                    </a>
                                    <a class="btn btn-icon btn-text-secondary rounded-pill waves-effect" onclick="deleteUser(${data.id})">
                                        <i class="icon-base ti tabler-trash icon-md"></i>
                                    </a>
                                </div>
                                `;
                            }
                        }
                    ],
                    order: [[2, 'asc']],
                   
                    layout: {
                            topStart: {
                                rowClass: "row m-3 my-0 justify-content-between",
                                features: [
                                    {
                                        pageLength: {
                                            menu: [10, 25, 50, 100],
                                            text: "Show _MENU_"
                                        }
                                    },
                                    {
                                        buttons: [
                                             {
                                                text: '<span class="d-flex align-items-center gap-2">' +
                                                    '<i class="icon-base ti tabler-plus icon-xs"></i>' +
                                                    '<span class="d-none d-sm-inline-block">Add New Record</span>' +
                                                    '</span>',
                                                className: "add-new btn btn-primary",
                                                attr: {
                                                    "data-bs-toggle": "offcanvas",
                                                    "data-bs-target": "#offcanvasAddUser"
                                                }
                                            }
                                        ]
                                    }
                                ]
                            }
                        }
                  
                });
            }
        },
        error: function (xhr) {
            console.error("Error fetching user data:", xhr.responseText);
        }
    });
}
$('#addNewUserForm').submit(function (e) {
        e.preventDefault();
        const isEdit = $('#adminuserId').val() !== '';
        const id = $('#adminuserId').val();
        const url = isEdit ? `/admin/users/${id}` : "{{ route('admin.users.store') }}";
        const method = isEdit ? 'PUT' : 'POST';
          const formData = {
            _token: "{{ csrf_token() }}",
            _method: method,
            name: $('#add-user-fullname').val(),
            email: $('#add-user-email').val(),
            employee_code: $('#add-user-employee-code').val(),
            department: $('#add-user-department').val(),
            role: $('#user-role').val(),
            level: $('#user-level').val(),
            manager_id: $('#user-manager').val(),
            status: $('#user-status').val()
        };
        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function (res) {
                Swal.fire({
                title: "Good job!",
                icon: "success",
                 customClass: {
                    confirmButton: "btn btn-primary waves-effect waves-light"
                },
                buttonsStyling: !1
                });
                 $('#addNewUserForm')[0].reset();
                    $('#adminuserId').val('');

                    // ✅ Close Bootstrap 5 Offcanvas
                    let offcanvasEl = document.getElementById('offcanvasAddUser');
                    let offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasEl);
                    if (offcanvasInstance) {
                        offcanvasInstance.hide();
                    }
                                fetchUsers();
            },
            error: function (xhr) {
                const errors = xhr.responseJSON.errors;
                 $.each(errors, function (key, value) {
                        $(`#${key}Error`).text(value[0]).show();
                    });
            }
        });
    });
    function editUser(id) {
        $.get(`/admin/users/${id}/edit`, function (data) {
            const user = data.user;
            const roles = data.roles;
            $('#adminuserId').val(user.id);
            $('#add-user-fullname').val(user.name);
            $('#add-user-email').val(user.email);
            $('#add-user-employee-code').val(user.employee_code);
            $('#add-user-department').val(user.department);
             if (roles.length > 0) {
                $('#user-role').val(roles[0]);
            } else {
                $('#user-role').val('');
            }
            $('#user-level').val(user.level);
            $('#user-manager').val(user.manager_id);
            $('#user-status').val(user.status);

            $('#offcanvasAddUserLabel').text('Edit User');
            const offcanvas = new bootstrap.Offcanvas('#offcanvasAddUser');
            offcanvas.show();
        });
    }
    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/users/${id}`,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE'
                    },
                    success: function (res) {
                        fetchUsers(); // Refresh the table
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The user has been deleted.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong while deleting.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }



$(document).ready(function () {
    fetchUsers();
});

</script>
@endpush