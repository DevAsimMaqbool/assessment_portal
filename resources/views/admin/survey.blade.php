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
      <table class="table border-top" id="surveyTable">
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
    <div class="modal fade" id="surveyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple">
            <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h3 class="modal-title" id="modalTitle">Add Survey</h3>
                    <p class="text-body-secondary">Survey you may use and assign to your users.</p>
                </div>
                
                <form id="surveyForm" class="row">
                    <input type="hidden" id="surveyId">
                    <div class="col-6 form-control-validation mb-4">
                        <label class="form-label" for="start-date">Start Date</label>
                        <input type="date" id="start-date" name="start_date" required class="form-control" />
                        <div class="invalid-feedback" id="start_dateError"></div>
                    </div>
                    <div class="col-6 form-control-validation mb-4">
                       <label class="form-label" for="end-date">End Date</label>
                        <input type="date" id="end-date" name="end_date" required class="form-control" />
                        <div class="invalid-feedback" id="end_dateError"></div>
                    </div>
                    <div class="col-12 form-control-validation mb-4">
                         <div class="form-check form-switch mb-2">
                         <input class="form-check-input" type="checkbox" id="status" value="" name="status">
                         <label class="form-check-label" for="status">Status</label>
                         </div>
                          <div class="invalid-feedback" id="statusError"></div>
                    </div>
                    <div class="col-12 form-control-validation mb-4">
                          <label for="description" class="form-label">Description</label>
                          <textarea class="form-control" id="description" rows="3" name="description"></textarea>
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
    const modal = new bootstrap.Modal(document.getElementById('surveyModal'));
    let isEdit = false;

    function fetchSurvey() {
        $.ajax({
            url: "{{ route('admin.survey.index') }}",
            method: "GET",
            dataType: "json",
            success: function (data) {
                
                const rowData = data.map((s, i) => {
                    const createdAt = new Date(s.created_at);
                    const formattedDate = createdAt.toISOString().split('T')[0];
                    return [
                        i + 1,
                        s.start_date || 'N/A',
                        s.end_date || 'N/A',
                        s.status || 'N/A',
                        formattedDate,
                        `<div class="d-flex align-items-center">
                            <a class="btn btn-icon btn-text-secondary rounded-pill waves-effect" onclick="editSurvey(${s.id})">
                                <i class="icon-base ti tabler-edit icon-22px"></i>
                            </a>
                            <a class="btn btn-icon btn-text-secondary rounded-pill waves-effect" onclick="deleteSurvey(${s.id})">
                                <i class="icon-base ti tabler-trash icon-md"></i>
                            </a>
                        </div>`
                    ];
                });

                // Initialize DataTable only once
                if (!$.fn.DataTable.isDataTable('#surveyTable')) {
                    window.surveyTable = $('#surveyTable').DataTable({
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
                                                text: '<i class="icon-base ti tabler-plus icon-xs me-0 me-sm-2"></i> <span class="d-none d-sm-inline-block">Add Survey</span>',
                                                className: "btn",
                                                action: function () {
                                                    openAddSurveyModal();
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
                    window.surveyTable.clear().rows.add(rowData).draw();
                }
            },
            error: function (xhr) {
                console.error("Error fetching complaint:", xhr.responseText);
            }
        });
    }

    function openAddSurveyModal() {
        isEdit = false;
        $('#modalTitle').text('Add Survey');
        $('#surveyForm')[0].reset();
        $('#surveyId').val('');
        $('.invalid-feedback').text('');
        modal.show();
    }

    function editSurvey(id) {
        isEdit = true;
        $.get(`/admin/survey/${id}/edit`, function (data) {
            $('#surveyId').val(data.id);
            $('#start-date').val(data.start_date);
            $('#end-date').val(data.end_date);
            $('#description').val(data.description);

            $('#status').prop('checked', data.status === 'active');
            $('#modalTitle').text('Edit Survey');
            $('.invalid-feedback').text('');
            modal.show();
        });
    }

    $('#surveyForm').submit(function (e) {
        e.preventDefault();
        const id = $('#surveyId').val();
        const url = isEdit ? `/admin/survey/${id}` : "{{ route('admin.survey.store') }}";
        const method = isEdit ? 'PUT' : 'POST';
        const formData = {
            _token: "{{ csrf_token() }}",
            _method: method,
            start_date: $('#start-date').val(),
            end_date: $('#end-date').val(),
            description: $('#description').val(),
            status: $('#status').is(':checked') ? 'active' : 'closed'
        };

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function (res) {
                $('#surveyForm')[0].reset();
                $('#surveyId').val('');
                modal.hide();
                Swal.fire({
                title: "Good job!",
                icon: "success",
                 customClass: {
                    confirmButton: "btn btn-primary waves-effect waves-light"
                },
                buttonsStyling: !1
                });
                fetchSurvey();
            },
            error: function (xhr) {
                const errors = xhr.responseJSON.errors;
                 $.each(errors, function (key, value) {
                        $(`#${key}Error`).text(value[0]).show();
                    });
            }
        });
    });
    function deleteSurvey(id) {
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
                    url: `/admin/survey/${id}`,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE'
                    },
                    success: function (res) {
                        fetchSurvey(); // Refresh the table
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The Survey has been deleted.',
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
        fetchSurvey();
    });
</script>
@endpush