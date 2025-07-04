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
    @php
    $attemptKeys = $userScores->keys()->all(); // e.g. [3, 4]

        $attempt1 = collect();
        $attempt2 = collect();

        if (isset($attemptKeys[0])) {
            $attempt1 = $userScores->get($attemptKeys[0], collect());
        }

        if (isset($attemptKeys[1])) {
            $attempt2 = $userScores->get($attemptKeys[1], collect());
        }

    // Map Attempt 1 scores by category_id for fast lookup
    $attempt1Scores = $attempt1->keyBy('category_id');
    $attempt2Scores = $attempt2->keyBy('category_id');
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Permission Table -->
            @if (!empty($attempt2) && $attempt2->isNotEmpty())
            <div class="card">
            <div class="card-header">
            <h5 class="mb-3 card-title">Attempt 2</h5>
            </div>
                <div class="card-datatable table-responsive">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Virtues</th>
                                <th>Score</th>
                                <th>Rank</th>
                                <th>Increase/Decrease</th>
                            </tr>
                        </thead>
                        <tbody
                            @foreach ($attempt2 as $index => $score)
                              @php
                                    $prevScore = $attempt1Scores[$score->category_id]->average_score ?? null;
                                     $difference = $prevScore !== null ? abs($score->average_score - $prevScore) : 'N/A';
                                @endphp
                            <tr>
                               <td>{{ $index + 1 }}</td>
                               <td>{{ $score->category->name ?? 'N/A' }}</td>
                               <td>{{ $score->average_score }}%</td>
                               <td> @if ($score->average_score >= 90)
                                    Role Model
                                @elseif ($score->average_score >= 80 && $score->average_score < 90)
                                    Influencer
                                @elseif ($score->average_score >= 70 && $score->average_score < 80)
                                    Influencer
                                @elseif ($score->average_score >= 60 && $score->average_score < 70)
                                    Aspirant        
                                @else
                                   Initiator
                                @endif</td>
                               <td>
                               @if ($prevScore === null)
                                    No Previous
                                @elseif ($score->average_score > $prevScore)
                                    <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    {{ is_numeric($difference) ? $difference : 'N/A' }}
                                </p>
                                @elseif ($score->average_score < $prevScore)
                                    <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-down"></i>
                                    {{ is_numeric($difference) ? $difference : 'N/A' }}
                                </p>
                                @else
                                    <p class="text-dark fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-line-dashed"></i>
                                    {{ is_numeric($difference) ? $difference : 'N/A' }}
                                </p>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            @endif
            <!--/ Permission Table -->
            <!-- Permission Table -->
            @if (!empty($attempt1) && $attempt1->isNotEmpty())
            <div class="card">
            <div class="card-header">
            <h5 class="mb-3 card-title">Attempt 1</h5>
            </div>
                <div class="card-datatable table-responsive">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Virtues</th>
                                <th>Score</th>
                                <th>Rank</th>
                                <th>Increase/Decrease</th>
                            </tr>
                        </thead>
                        <tbody
                               @foreach ($attempt1 as $index => $score)
                                @php
                                    $nextScore = $attempt2Scores[$score->category_id]->average_score ?? null;
                                    $difference = $nextScore !== null ? abs($score->average_score - $nextScore) : 'N/A';
                                @endphp
                              <tr>
                               <td>{{ $index + 1 }}</td>
                               <td>{{ $score->category->name ?? 'N/A' }}</td>
                               <td>{{ $score->average_score }}%</td>
                               <td> @if ($score->average_score >= 90)
                                    Role Model
                                @elseif ($score->average_score >= 80 && $score->average_score < 90)
                                    Influencer
                                @elseif ($score->average_score >= 70 && $score->average_score < 80)
                                    Influencer
                                @elseif ($score->average_score >= 60 && $score->average_score < 70)
                                    Aspirant        
                                @else
                                   Initiator
                                @endif</td>
                               <td>
                               @if ($nextScore === null)
                                    No Next
                                @elseif ($nextScore > $score->average_score)
                                    <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-down"></i>
                                    {{ is_numeric($difference) ? $difference : 'N/A' }}
                                    </p>
                                @elseif ($nextScore < $score->average_score)
                                    <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-chevron-up"></i>
                                    {{ is_numeric($difference) ? $difference : 'N/A' }}
                                </p>
                                @else
                                     <p class="text-dark fw-medium mb-0 d-flex align-items-center gap-1">
                                    <i class="icon-base ti tabler-line-dashed"></i>
                                    {{ is_numeric($difference) ? $difference : 'N/A' }}
                                </p>
                                @endif
                             </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            @endif
            <!--/ Permission Table -->
            <br>

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
             $('#userScoreTable1').DataTable({
                processing: true,
                paging: true,
                searching: true,
                ordering: true,
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
                                }
                            }
                        ]
                    }
                }
            });
        });
    </script>
@endpush