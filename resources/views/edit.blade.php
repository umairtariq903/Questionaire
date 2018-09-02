@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">EDIT QUESTIONNAIRE</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/Questionnaire/update') }}" aria-label="{{ __('Create') }}">
                        @csrf
                        <input name="id" type="hidden" value="{{$editid}}">
                        <div class="form-group row">
                            <label for="Questionnaire" class="col-sm-4 col-form-label text-md-right">{{ __('Questionnaire') }}</label>

                            <div class="col-md-6">
                                <input id="questionnaire" type="text" class="form-control" name="questionnaire" value="{{$questionnaires->questionnairename}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="text" class="form-control duration" name="duration" value="{{$questionnaires->duration}}" required>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <label class="form-check-label" for="resumable">
                                        {{ __('Resumable') }}
                                    </label>

                                    <input type="radio" name="resumable" value="yes" @if($questionnaires->resumable =="yes") checked @endif required autofocus> Yes
                                    <input type="radio" name="resumable" value="no" @if($questionnaires->resumable =="no") checked @endif> No<br>
                                    
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">$(document).ready(function() {
    $("#duration").durationPicker();
});</script>
@endsection
