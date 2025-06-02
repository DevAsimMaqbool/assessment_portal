@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/%40form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/report.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/chartjs/chartjs.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="container" id="report-content">
                @if($dataset1 && $dataset2)
                    <header class="text-center mb-5">
                        <h1 class="display-4 text-dark">Virtue Mirror</h1>
                        <!-- <button class="btn btn-primary download-btn" onclick="downloadPDF()">Download as PDF</button> -->
                    </header>
                    <!-- Employee Information -->
                    <section class="mb-5">
                        <div class="row">
                            <h2 class="section-info">Employee Information</h2>
                            <div class="col-md-6 mb-3"><strong>Name:</strong> {{ $user->name }}</div>
                            <div class="col-md-6 mb-3"><strong>Employee ID:</strong> {{ $user->employee_code }}</div>
                            <div class="col-md-6 mb-3"><strong>Designation:</strong> {{ $user->level }}</div>
                            <div class="col-md-6 mb-3"><strong>Department:</strong> {{ $user->department }}</div>
                            <div class="col-md-6 mb-3"><strong>Unit/Campus:</strong> Your Unit/Campus</div>
                            <div class="col-md-6 mb-3"><strong>Date of Report:</strong> Report Date</div>
                        </div>
                    </section>

                    <!-- Purpose of the Report -->
                    <section class="mb-5">
                        <h2 class="section-title">Purpose of the Report</h2>
                        <p class="text-muted">
                            This report provides a personalized snapshot of character development, combining self-assessment and
                            stakeholder feedback to identify strengths and areas for growth. It highlights the role of character
                            in enhancing leadership, relationships, and service, and aims to deepen self-awareness and foster
                            meaningful development. Perception gaps may emerge; <b>positive gaps</b> indicate alignment between
                            self-view and others' perceptions, while <b>negative gaps</b> reflect a disconnect, where
                            individuals
                            see themselves differently from how others experience them. These gaps may stem from factors like
                            communication style, role expectations, or situational behavior. To bridge them, the report suggests
                            strategies such as seeking feedback, reflecting regularly, clarifying expectations, and practicing
                            consistent behavior. All findings are confidential and should not be shared without the individual's
                            consent.
                        </p>
                    </section>

                    <!-- Overview -->
                    <section class="mb-5">
                        <h2 class="section-title">Overview</h2>
                        <div>
                            <canvas class="chartjs" id="radarChart" data-height="355"></canvas>
                        </div>

                        <!-- Inside Mirror -->
                        <div class="sub-section">
                            <h3 class="h4 text-dark">Inside Mirror (Self-Assessment)</h3>
                            <div class="table-responsive">
                                <table class="table border-top">
                                    <thead>
                                        <tr class="td-bg-blk">
                                            <th class="text-color">Character Dimension</th>
                                            <th class="text-color">Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(array_slice($labels, 0, 5) as $index => $label)
                                            <tr>
                                                <td class="td-bg">{{ $label }}</td>
                                                <td>{!! generateComment($label, $dataset1[$index] ?? 'N/A', 'self') !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="page-break"></div>

                        <!-- Social Mirror -->
                        <div class="sub-section">
                            <h3 class="h4 text-dark">Social Mirror (Stakeholders' Perception)</h3>
                            <div class="table-responsive">
                                <table class="table border-top">
                                    <thead>
                                        <tr class="td-bg-blk">
                                            <th class="text-color">Character Dimension</th>
                                            <th class="text-color">Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(array_slice($labels, 0, 5) as $index => $label)
                                            <tr>
                                                <td class="td-bg">{{ $label }}</td>
                                                <td>{!! generateComment($label, $dataset2[$index] ?? 'N/A', 'stakeholder') !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @php
                            $data = [];
                            $firstFiveData = [];
                            foreach (array_slice($labels, 0, 5) as $index => $label) {
                                $score1 = $dataset1[$index] ?? null;
                                $score2 = $dataset2[$index] ?? null;
                                if (is_numeric($score1) && is_numeric($score2)) {
                                    $entry = [
                                        'label' => $label,
                                        'score1' => (int) $score1,
                                        'score2' => (int) $score2,
                                        'percentage' => ($score1 + $score2) / 2,
                                        'difference' => $score2 - $score1,
                                    ];
                                    $data[] = $entry;
                                    $firstFiveData[] = $entry;
                                }
                            }
                            usort($firstFiveData, fn($a, $b) => $a['percentage'] <=> $b['percentage']);
                            $keyStrengths = array_slice($firstFiveData, -3);
                            $areasForImprovement = array_slice($firstFiveData, 0, 2);
                        @endphp

                        <div class="sub-section">
                            <div class="table-responsive">
                                <table class="table border-top">
                                    <thead>
                                        <tr class="td-bg-blk">
                                            <th class="text-color">Character Dimension</th>
                                            <th class="text-color">Self-Assessment</th>
                                            <th class="text-color">Stakeholders’ Perception</th>
                                            <th class="text-color">Mean</th>
                                            <th class="text-color">Perception Gap</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $item)
                                            <tr>
                                                <td class="td-bg">{{ $item['label'] }}</td>
                                                <td>{{ $item['score1'] }}%</td>
                                                <td>{{ $item['score2'] }}%</td>
                                                <td>{{ round($item['percentage'], 2) }}%</td>
                                                <td>{{ $item['difference'] }}%</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <div class="page-break"></div>

                    <!-- Summary -->
                    <section class="mb-5">
                        <h2 class="section-title">Summary</h2>
                        <h3 class="h4 text-dark">Description</h3>
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead>
                                    <tr class="td-bg-blk">
                                        <th class="text-color">Character Dimension</th>
                                        <th class="text-color">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(array_slice($labels, 0, 5) as $index => $label)
                                        @php
                                            $score1 = $dataset1[$index] ?? 'N/A';
                                            $score2 = $dataset2[$index] ?? 'N/A';
                                            $selfRank = $selfRanks[$index] ?? null;
                                            $peerRank = $peerRanks[$index] ?? null;
                                            $gap = is_numeric($score1) && is_numeric($score2) ? $score2 - $score1 : null;
                                            $gapType = $gap !== null ? ($gap > 0 ? 'positive' : ($gap < 0 ? 'negative' : 'neutral')) : 'n/a';
                                            $gapText = $gap !== null ? ($gap > 0 ? 'positive' : ($gap < 0 ? 'negative' : 'alignment between self and others')) : 'insufficient data';
                                            $ordinalSuffix = match ($selfRank) {
                                                1 => 'st', 2 => 'nd', 3 => 'rd', default => 'th'
                                            };
                                            $peerSuffix = match ($peerRank) {
                                                1 => 'st', 2 => 'nd', 3 => 'rd', default => 'th'
                                            };
                                            $performanceLevel = match (true) {
                                                $score2 >= 90 => 'EE – Exceeds Expectations',
                                                $score2 >= 75 => 'ME – Meets Expectations',
                                                $score2 >= 60 => 'BE – Below Expectations',
                                                default => 'NE – Needs Improvement',
                                            };
                                        @endphp
                                        <tr>
                                            <td class="td-bg">{{ $label }}</td>
                                            <td>{!! generateComment($label, $score1, 'summary', $score2, $selfRank, $peerRank, $gapType, $gapText, $ordinalSuffix, $peerSuffix, $performanceLevel) !!}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="sub-section">
                            <div class="table-responsive">
                                <table class="table border-top mt-4">
                                    <thead>
                                        <tr class="td-bg-blk">
                                            <th class="text-color">Key Strengths</th>
                                            <th class="text-color">Areas for Improvement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td-bg">
                                                @foreach(array_reverse($keyStrengths) as $i => $item)
                                                    {{ $i + 1 }}. {{ $item['label'] }}<br>
                                                @endforeach
                                            </td>
                                            <td class="td-bg">
                                                @foreach($areasForImprovement as $i => $item)
                                                    {{ $i + 1 }}. {{ $item['label'] }}<br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <!-- Key Strengths -->
                    <section class="mb-5">
                        <h2 class="section-title">Key Strengths</h2>
                        <ol class="list-group list-group-numbered">
                            @foreach(array_reverse($keyStrengths) as $item)
                                <li class="list-group-item">
                                    <strong>{!! getUserCategoryWithDescription($item['label'])->category !!}</strong><br>
                                    {!! getUserCategoryWithDescription($item['label'])->description !!}
                                </li>
                            @endforeach
                        </ol>
                    </section>

                    <!-- Areas for Development -->
                    <section class="mb-5">
                        <h2 class="section-title">Areas for Development</h2>
                        <ol class="list-group list-group-numbered">
                            @foreach(array_reverse($areasForImprovement) as $item)
                                <li class="list-group-item">
                                    <strong>{!! getUserCategoryWithWeaknessDescription($item['label'])->category !!}</strong><br>
                                    {!! getUserCategoryWithWeaknessDescription($item['label'])->description !!}
                                </li>
                            @endforeach
                        </ol>
                    </section>

                    <!-- Conclusion -->
                    <section class="mb-5">
                        <h2 class="section-title">Conclusion</h2>
                        <p class="text-muted">
                            This report offers a comprehensive view of your character development by integrating self-reflection
                            with community feedback. The alignment and gaps between these perspectives provide critical insights
                            into how your character is perceived and the impact it creates. Strengths in Humility & Service and
                            Responsibility & Accountability indicate a strong foundation for principled leadership aligned with
                            Superior University's values. Opportunities for growth in Empathy & Compassion and Patience &
                            Gratitude
                            highlight areas that, when nurtured, can further enhance your personal and professional
                            effectiveness.
                            Leadership rooted in character is a continuous journey; this report serves as a guide to help you
                            reflect, recalibrate, and commit to embodying the virtues that define transformational and
                            value-driven
                            leadership.
                        </p>
                    </section>
                @else
                    <header class="text-center mb-5">
                        <h1 class="display-4 text-dark">There is no feedback yet</h1>
                        <!-- <button class="btn btn-primary download-btn" onclick="downloadPDF()">Download as PDF</button> -->
                    </header>
                @endif




            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const chartLabels = @json($labels);
        const dataset1 = @json($dataset1);
        const dataset2 = @json($dataset2);
    </script>
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/popular.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admin/assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('admin/assets/js/charts-chartjs-legend.js') }}"></script>
    <script src="{{ asset('admin/assets/js/charts-chartjs.js') }}"></script>
    <script src="{{ asset('admin/assets/js/report.js') }}"></script>
@endpush