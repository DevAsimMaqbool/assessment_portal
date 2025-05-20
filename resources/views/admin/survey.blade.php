@extends('layouts.app')
@push('style')
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/%40form-validation/form-validation.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endpush
@section('content')
   <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
  <!-- Permission Table -->
  <div class="card">
    <div class="card-datatable table-responsive">
      <table class="table border-top" id="complaintTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
  <!--/ Permission Table -->

  <!-- Modal -->
  <!-- Add Permission Modal -->
    <div class="modal fade" id="complaintModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple">
            <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h3 class="modal-title" id="modalTitle">Add Survey</h3>
                    <p class="text-body-secondary">Survey you may use and assign to your users.</p>
                </div>
                
                <form id="complaintForm" class="row">
                    <input type="hidden" id="complaintId">
                    <div class="col-12 form-control-validation mb-4">
                        <label class="form-label" for="modalPermissionName">Permission Name</label>
                        <input type="text" id="permissionName" name="permissionName" required class="form-control" placeholder="Permission Name" autofocus />
                        <div class="invalid-feedback" id="nameError"></div>
                    </div>
                    <div class="col-12 form-control-validation mb-4">
                       <label class="form-label" for="complaint-category">Virtue</label>
                        <select id="complaint-category" class="form-select" name="complaint_category" required>
                        </select>
                        <div class="invalid-feedback" id="complaint_categoryError"></div>
                    </div>
                    <div class="col-12 form-control-validation mb-4">
                        <label class="form-label" for="complaint-severity">Severity</label>
                        <select id="complaint-severity" class="form-select" name="complaint_severity" required>
                        <option value="severe">Severe</option>
                        <option value="mild">Mild</option>
                        <option value="minor">Minor</option>
                        </select>
                        <div class="invalid-feedback" id="complaint_severityError"></div>
                    </div>
                    <div class="col-12 form-control-validation mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="complaint-isresokved" name="complaint_isresokved">
                        <label class="form-check-label" for="complaint-isresokved"> isresolved </label>
                    </div>
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-4 me-1">Save</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<!--/ Add Permission Modal -->


  <!-- /Modal --></div>
          <!-- / Content -->
@endsection
@push('script')
<script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/popular.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('admin/assets/js/extended-ui-sweetalert2.js') }}"></script>
@endpush
@push('script')
<script>
    const modal = new bootstrap.Modal(document.getElementById('complaintModal'));
    let isEdit = false;

    function fetchComplaint() {
        $.ajax({
            url: "{{ route('survey.index') }}",
            method: "GET",
            dataType: "json",
            success: function (data) {
                
                const complaints = data.complaints;
                const users = data.users;
                const categories = data.categories;
                // Populate user dropdown
                let userOptions = '<option value="">Select User</option>';
                users.forEach(user => {
                    userOptions += `<option value="${user.id}">${user.name}</option>`;
                });
                $('#complaint-user').html(userOptions);

                let categoryOptions = '<option value="">Select Category</option>';
                categories.forEach(category => {
                    categoryOptions += `<option value="${category.id}">${category.name}</option>`;
                });
                $('#complaint-category').html(categoryOptions);
                const rowData = complaints.map((c, i) => {
                    const createdAt = new Date(c.created_at);
                    const formattedDate = createdAt.toISOString().split('T')[0];
                    return [
                        i + 1,
                        c.user?.name || 'N/A',
                        c.category?.name || 'N/A',
                        c.severity.charAt(0).toUpperCase() + c.severity.slice(1),
                        c.is_resolved ? 'Yes' : 'No',
                        formattedDate,
                        `<div class="d-flex align-items-center">
                            <a class="btn btn-icon btn-text-secondary rounded-pill waves-effect" onclick="editComplaint(${c.id})">
                                <i class="icon-base ti tabler-edit icon-22px"></i>
                            </a>
                            <a class="btn btn-icon btn-text-secondary rounded-pill waves-effect" onclick="deleteComplaint(${c.id})">
                                <i class="icon-base ti tabler-trash icon-md"></i>
                            </a>
                        </div>`
                    ];
                });

                // Initialize DataTable only once
                if (!$.fn.DataTable.isDataTable('#complaintTable')) {
                    window.complaintTable = $('#complaintTable').DataTable({
                        processing: true,
                        paging: true,
                        searching: true,
                        ordering: true,
                        data: rowData,
                        columns: [
                            { title: "#" },
                            { title: "Start Date" },
                            { title: "End Date" },
                            { title: "Status" },
                            { title: "Created Date" },
                            { title: "Actions", orderable: false }
                        ],
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
                                                text: '<i class="icon-base ti tabler-plus icon-xs me-0 me-sm-2"></i> <span class="d-none d-sm-inline-block">Add Complaint</span>',
                                                className: "btn",
                                                action: function () {
                                                    openAddComplaintModal();
                                                }
                                            }
                                        ]
                                    }
                                ]
                            }
                        }
                    });
                } else {
                    // If already initialized, just refresh data
                    window.complaintTable.clear().rows.add(rowData).draw();
                }
            },
            error: function (xhr) {
                console.error("Error fetching complaint:", xhr.responseText);
            }
        });
    }

    function openAddComplaintModal() {
        isEdit = false;
        $('#modalTitle').text('Add Complaints');
        $('#complaintForm')[0].reset();
        $('#complaintId').val('');
        $('#nameError').text('');
        modal.show();
    }

    function editComplaint(id) {
        isEdit = true;
        $.get(`/admin/survey/${id}/edit`, function (data) {
            $('#complaintId').val(data.id);
            $('#complaint-user').val(data.user.id);
            $('#complaint-category').val(data.category.id);
            $('#complaint-severity').val(data.severity);

            $('#complaint-isresokved').prop('checked', data.is_resolved)
            $('#modalTitle').text('Edit Complaints');
            $('#nameError').text('');
            modal.show();
        });
    }

    $('#complaintForm').submit(function (e) {
        e.preventDefault();
        const id = $('#complaintId').val();
        const url = isEdit ? `/complanits/${id}` : "{{ route('complanits.store') }}";
        const method = isEdit ? 'PUT' : 'POST';
        const formData = {
            _token: "{{ csrf_token() }}",
            _method: method,
            complaint_user: $('#complaint-user').val(),
            complaint_category: $('#complaint-category').val(),
            complaint_severity: $('#complaint-severity').val(),
            complaint_isresokved: $('#complaint-isresokved').is(':checked') ? 1 : 0
        };

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function (res) {
                $('#complaintForm')[0].reset();
                $('#complaintId').val('');
                modal.hide();
                Swal.fire({
                title: "Good job!",
                icon: "success",
                 customClass: {
                    confirmButton: "btn btn-primary waves-effect waves-light"
                },
                buttonsStyling: !1
                });
                fetchComplaint();
            },
            error: function (xhr) {
                const errors = xhr.responseJSON.errors;
                 $.each(errors, function (key, value) {
                        $(`#${key}Error`).text(value[0]).show();
                    });
            }
        });
    });
    function deleteComplaint(id) {
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
                    url: `/complanits/${id}`,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE'
                    },
                    success: function (res) {
                        fetchComplaint(); // Refresh the table
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The complaint has been deleted.',
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
        fetchComplaint();
    });
</script>
@endpush