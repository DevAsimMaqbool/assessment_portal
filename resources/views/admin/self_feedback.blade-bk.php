@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
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
                    <table class="table border-top" id="userScoreTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Attempt</th>
                                <th>Score</th>
                                <!-- <th>View Attempt Detail</th> -->
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userScore as $index => $score)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ str_replace('and', '&', $score->category->name) }}</td>
                                    <td>{{ $score->attempt }}</td>
                                    <td>{{ $score->average_score }}%</td>
                                    <!-- <td><a
                                                                                                                                                                                                                                                href="{{ route('admin.self_feedback.details', ['attempt' => $score->attempt, 'category_id' => $score->category_id]) }}">
                                                                                                                                                                                                                                                Click here
                                                                                                                                                                                                                                            </a></td> -->
                                    <td>{{ $score->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Permission Table -->
    </div>
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
        $(document).ready(function () {
            $('#userScoreTable').DataTable({
                processing: true,
                paging: true,
                searching: true,
                ordering: true,
                order: [[2, 'desc']], // Default order by attempt desc
                columnDefs: [
                    { targets: 0, searchable: false, orderable: false }, // disable ordering on index
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
                                        text: '<i class="icon-base tabler icon-tabler-eye icon-xs me-0 me-sm-2"></i> <span class="d-none d-sm-inline-block">Latest Report</span>',
                                        className: "btn",
                                        action: function () {
                                            window.open('{{ asset('admin/assets/img/pdf/ReportFormat.pdf') }}', '_blank');
                                        }
                                    }
                                ]
                            }
                        ]
                    }
                }
            });
        });
    </script>
@endpush