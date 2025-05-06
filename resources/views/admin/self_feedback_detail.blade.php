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
            <h2>Attempt #{{ $scoreEntry->attempt }} - {{ $scoreEntry->category->name }}</h2>
            <div class="card-datatable table-responsive">
                <table class="table border-top" id="userScoreTable">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Your Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userAnswers as $answer)
                            <tr>
                                <td>{{ $answer->question->question }}</td>
                                <td>{{ $answer->answer }}</td>
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
                ]
            });
        });
    </script>
@endpush