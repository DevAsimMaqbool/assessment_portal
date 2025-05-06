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
      <table class="table border-top" id="permissionsTable">
        <thead>
          <tr>
            <th>#</th>
            <th>NAME</th>
            <th>CREATED DATE</th>
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
    <div class="modal fade" id="permissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple">
            <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h3 class="modal-title" id="modalTitle">Add Permission</h3>
                    <p class="text-body-secondary">Permissions you may use and assign to your users.</p>
                </div>
                
                <form id="permissionForm" class="row">
                    <input type="hidden" id="permissionId">
                    <div class="col-12 form-control-validation mb-4">
                        <label class="form-label" for="modalPermissionName">Permission Name</label>
                        <input type="text" id="permissionName" name="permissionName" required class="form-control" placeholder="Permission Name" autofocus />
                        <div class="invalid-feedback" id="nameError"></div>
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
    const modal = new bootstrap.Modal(document.getElementById('permissionModal'));
    let isEdit = false;

    function fetchPermissions() {
        $.ajax({
            url: "{{ route('permission.index') }}",
            method: "GET",
            dataType: "json",
            success: function (data) {
                
                // Prepare formatted row data for DataTables
                const rowData = data.map((p, i) => {
                    const createdAt = new Date(p.created_at);
                    const formattedDate = createdAt.toISOString().split('T')[0];
                    return [
                        i + 1,
                        p.name,
                        formattedDate,
                        `<div class="d-flex align-items-center">
                            <a class="btn btn-icon btn-text-secondary rounded-pill waves-effect" onclick="editPermission(${p.id})">
                                <i class="icon-base ti tabler-edit icon-22px"></i>
                            </a>
                            <a class="btn btn-icon btn-text-secondary rounded-pill waves-effect" onclick="deletePermission(${p.id})">
                                <i class="icon-base ti tabler-trash icon-md"></i>
                            </a>
                        </div>`
                    ];
                });

                // Initialize DataTable only once
                if (!$.fn.DataTable.isDataTable('#permissionsTable')) {
                    window.permissionsTable = $('#permissionsTable').DataTable({
                        processing: true,
                        paging: true,
                        searching: true,
                        ordering: true,
                        data: rowData,
                        columns: [
                            { title: "#" },
                            { title: "Name" },
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
                                                text: '<i class="icon-base ti tabler-plus icon-xs me-0 me-sm-2"></i> <span class="d-none d-sm-inline-block">Add Permission</span>',
                                                className: "btn",
                                                action: function () {
                                                    openAddModal();
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
                    window.permissionsTable.clear().rows.add(rowData).draw();
                }
            },
            error: function (xhr) {
                console.error("Error fetching permissions:", xhr.responseText);
            }
        });
    }

    function openAddModal() {
        isEdit = false;
        $('#modalTitle').text('Add Permission');
        $('#permissionForm')[0].reset();
        $('#permissionId').val('');
        $('#nameError').text('');
        modal.show();
    }

    function editPermission(id) {
        isEdit = true;
        $.get(`/permission/${id}/edit`, function (data) {
            $('#permissionId').val(data.id);
            $('#permissionName').val(data.name);
            $('#modalTitle').text('Edit Permission');
            $('#nameError').text('');
            modal.show();
        });
    }

    $('#permissionForm').submit(function (e) {
        e.preventDefault();
        const id = $('#permissionId').val();
        const name = $('#permissionName').val();
        const url = isEdit ? `/permission/${id}` : "{{ route('permission.store') }}";
        const method = isEdit ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: {
                name: name,
                _token: "{{ csrf_token() }}",
                _method: method
            },
            success: function (res) {
                modal.hide();
                Swal.fire({
                title: "Good job!",
                icon: "success",
                 customClass: {
                    confirmButton: "btn btn-primary waves-effect waves-light"
                },
                buttonsStyling: !1
                });
                fetchPermissions();
            },
            error: function (xhr) {
                $('#nameError').text(xhr.responseJSON.errors.name[0]).show();
            }
        });
    });
    function deletePermission(id) {
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
                    url: `/permission/${id}`,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE'
                    },
                    success: function (res) {
                        fetchPermissions(); // Refresh the table
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The permission has been deleted.',
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
        fetchPermissions();
    });
</script>
@endpush