@extends('layouts.app-master')

@section('activeMakeApt')
active
@endsection

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-md-5 rounded">
        @auth
        <h1 class="mb-3">Type of Sickeness</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card mx-md-5">
                        <div class="card-header" style="background-color: rgba(201,35,75,1)">
                        <h4 class="mb-0 py-1 text-white">Sickness Information</h4></div>
                        <div class="card-body">      
                            <form method="post" action="{{ route('appointments.sicknessStore',['form_id' => $form_id]) }}">
                                @csrf
                                <input type="hidden" name="form_id" value="{{ $appointments->id }}">
                                <div class="px-md-5 px-2">
                                    <div class="mb-3 row">
                                        <label for="sickness" class="form-label col-md-2">Type of Sickness</label>
                                        <select class="form-select col" id="sickness" name="sickness" required>
                                            <option value="" {{ (isset($appointments) && $appointments->sickness == '') ? 'selected' : '' }}>-Please Select-</option>
                                            <option value="Respiratory" {{ (isset($appointments) && $appointments->sickness == 'Respiratory') ? 'selected' : '' }}> Respiratory Conditions (Cold, Flu, Asthma, Bronchitis)</option>
                                            <option value="Infections" {{ (isset($appointments) && $appointments->sickness == 'Infections') ? 'selected' : '' }}> Infections (Urinary Tract Infection, Sinus Infection, Skin Infections)</option>
                                            <option value="Gastrointestinal" {{ (isset($appointments) && $appointments->sickness == 'Gastrointestinal') ? 'selected' : '' }}> Gastrointestinal Issues (Diarrhea, Gastroenteritis (Stomach Flu), Gastritis)</option>
                                            <option value="Musculoskeletal" {{ (isset($appointments) && $appointments->sickness == 'Musculoskeletal') ? 'selected' : '' }}> Musculoskeletal Disorders (Back Pain, Arthritis, Fractures)</option>
                                            <option value="Cardiovascular" {{ (isset($appointments) && $appointments->sickness == 'Cardiovascular') ? 'selected' : '' }}> Cardiovascular Conditions (Coronary Artery Disease, Heart Attack)</option>
                                            <option value="Allergies" {{ (isset($appointments) && $appointments->sickness == 'Allergies') ? 'selected' : '' }}> Allergies (Allergic Rhinitis (Hay Fever), Allergic Reactions)</option>
                                            <option value="Dermatological" {{ (isset($appointments) && $appointments->sickness == 'Dermatological') ? 'selected' : '' }}> Dermatological Issues (Eczema, Acne, Dermatitis)</option>
                                            <option value="Dental" {{ (isset($appointments) && $appointments->sickness == 'Dental') ? 'selected' : '' }}> Dental Issues (Toothache, Tooth Decay)</option>
                                            <option value="Eye" {{ (isset($appointments) && $appointments->sickness == 'Eye') ? 'selected' : '' }}> Eye Conditions (Cataracts, Conjunctivitis (Pink Eye))</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="seriousness" class="form-label col-md-2">Seriousness</label>
                                        <select class="form-select col" id="seriousness" name="seriousness" required>
                                            <option value="" {{ (isset($appointments) && $appointments->seriousness == '') ? 'selected' : '' }}>-Please Select-</option>
                                            <option value="1" {{ (isset($appointments) && $appointments->seriousness == '1') ? 'selected' : '' }}>1 - Very Low</option>
                                            <option value="2" {{ (isset($appointments) && $appointments->seriousness == '2') ? 'selected' : '' }}>2 - Low</option>
                                            <option value="3" {{ (isset($appointments) && $appointments->seriousness == '3') ? 'selected' : '' }}>3 - Medium</option>
                                            <option value="4" {{ (isset($appointments) && $appointments->seriousness == '4') ? 'selected' : '' }}>4 - High</option>
                                            <option value="5" {{ (isset($appointments) && $appointments->seriousness == '5') ? 'selected' : '' }}>5 - Very High</option>
                                        </select>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-md-2 mb-2" for="email">Specify</label>
                                        <textarea type="text" class="form-control col" id="specification" name="specification" value="{{ old('specification', $users->specification ?? '') }}" rows="5"></textarea>
                                    </div>
        
                                <div class="row">
                                    <div class="col-6" style="justify-content: flex-start"> 
                                        <a href="{{route('appointments.create', ['id' => $userDetails->id])}}" class="btn btn-secondary mb-3 webbutton" style="">Back</a>
                                    </div>

                                    <div class="col-6 d-flex" style="justify-content: flex-end"> 
                                        <button type="submit" class="btn btn-warning col-md-2 col-6 mb-3 webbutton" style="">Save</button>
                                    </div>
                                </div>
                            </form>
                            @php
                                $form_id = $time_slots->form_id ?? '';
                            @endphp
                            @if(strlen($appointments->sickness) > 0 && strlen($appointments->seriousness) > 0 && $form_id != null)
                            <div class="row">
                            <div class="col-6"></div>
                                <div class="d-flex col-6" style="justify-content: flex-end"> 
                                    <a href="{{ route('appointments.slotForm', ['form_id' => $form_id]) }}" class="btn btn-success col-md-2 col-6 webbutton">Next</a>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        @endauth
@endsection