@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/%40form-validation/form-validation.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="col-12 d-flex justify-content-between">
                    <!-- <a href="{{ route('questions') }}"><button type="button" class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none me-sm-2">Self</span>

                    </button></a>

                        <a href="{{ route('question.stakeholder') }}"><button type="button" class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none me-sm-2">Stakeholder's</span>

                        </button></a> -->

                </div>
            </div></br></br>

            <!-- Default Wizard -->
            <div class="col-12 mb-6">

                <div class="bs-stepper wizard-numbered mt-2">
                    <div class="bs-stepper-header">
                        @foreach($questions as $index => $question)
                            <div class="step" data-target="#step{{ $index + 1 }}" style="display: none;">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">{{ $index + 1 }}</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">{{ $question->question }}</span>
                                        <span class="bs-stepper-subtitle">Please select an answer</span>
                                    </span>
                                </button>
                            </div>
                            @if(!$loop->last)
                                <div class="line" style="display: none;">
                                    <i class="icon-base ti tabler-chevron-right"></i>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="bs-stepper-content">
                        <form method="POST" action="{{ route('survey.submit') }}">
                        @csrf
                        <input type="hidden" name="survey_id" id="forUserIdHidden" value="1">
                        <input type="hidden" name="for_user_id" id="forUserIdHidden" value="">
                            @foreach($questions as $index => $question)
                                <div id="step{{ $index + 1 }}" class="content">
                                    <div class="content-header mb-4">
                                        <h6 class="mb-0"> {{ $index + 1 }}- {{ $question->question }}</h6>
                                    </div>

                                    <div class="row g-6">
                                        @foreach($question->answers as $answer)
                                            <div class="col-sm-6">
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" type="radio" name="answer[{{ $question->id }}]"
                                                        id="answer_{{ $question->id }}_{{ $answer->id }}" value="{{ $answer->answer_value }}"
                                                        data-ans_id="{{ $question->id }}" data-ans_val="{{ $answer->answer_value }}">
                                                    <label class="form-check-label" for="answer_{{ $question->id }}_{{ $answer->id }}">
                                                        <span class="mb-1 h6">{{ $answer->answer_title }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-label-secondary btn-prev">
                                                <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            @if($loop->last)
                                                <button type="submit" class="btn btn-success btn-submit">
                                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Submit</span>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/popular.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('admin/assets/js/form-wizard-numbered.js') }}"></script>
    <script src="{{ asset('admin/assets/js/form-wizard-validation.js') }}"></script>
@endpush