@extends('layouts.app-master')

@section('activeMakeApt')
    active
@endsection

@section('content')
    @include('layouts.partials.messages')
    <div class="bg-light p-md-5 rounded">
        @auth
            <h1 class="mb-3">Select Slot Available</h1>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card mx-md-5">
                            <div class="card-header" style="background-color: rgba(201,35,75,1)">
                                <h4 class="mb-0 py-1 text-white">Time Slot</h4>
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{ route('appointments.slotForm', ['form_id' => $form_id]) }}">
                                    <div class="px-md-5 px-2">
                                        <div class="mb-3 row">
                                            <label for="aptDate" class="form-label col-md-2">Appointment Date</label>
                                            <input type="date" class="form-control col" id="aptDate" name="aptDate"
                                                   value="{{ \Carbon\Carbon::parse($time_slots->aptDate)->format('Y-m-d') ?? now()->format('Y-m-d') }}">
                                        </div>
                                    </div>

                                    <div class="d-flex px-md-5" style="justify-content: flex-end">
                                        <button type="submit" class="btn btn-warning col-md-2 col-6 mb-3 webbutton" style="">Search Date</button>
                                    </div>
                                </form>

                                @if(isset($availableSlots))
                                    <div class="mt-3 d-flex" style="justify-content: center; flex-direction:column; align-items:center">
                                        <h5>Available Slots</h5>
                                        <table class="table text-center" style="width:50%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Slot</th>
                                                    <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Select</th>
                                                    {{-- <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Status</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>                                            
                                                @foreach($availableSlots as $slot)
                                                <tr>
                                                    <td>{{ $slot }}</td>
                                                    <td>
                                                        @php
                                                            $selectedSlots = $all_slots->pluck('selected_slot')->toArray();
                                                            $slotsID = $all_slots->where('form_id', $form_id)->pluck('selected_slot')->toArray();
                                                            // $slotsID = $all_slots->where('form_id',$appointments->id)->pluck('form_id');
                                                        @endphp
                                                        @if (in_array($slot, $slotsID))
                                                            <button class="btn btn-outline-primary" disabled>Selected</button>
                                                        @elseif (in_array($slot, $selectedSlots))
                                                            <button class="btn btn-outline-danger" disabled>Unavailable</button>
                                                        @elseif ($all_slots->whereNotNull('selected_slot')->where('form_id',$appointments->id)->count() > 0 )
                                                            <button class="btn btn-outline-secondary disabled">Available</button>
                                                        @else
                                                            <form method="POST" action="{{ route('appointments.slotStore', ['form_id' => $form_id, 'aptDate' => $aptDate]) }}">
                                                                @csrf
                                                                <input type="hidden" name="selected_date" value="{{ $aptDate }}">
                                                                <input type="hidden" name="selected_slot" value="{{ $slot }}">
                                                                <input type="hidden" name="selected_date" value="{{ $slot }}">
                                                                <input type="hidden" name="form_id" value="{{ $form_id }}">
                                                                <button type="submit" class="btn btn-outline-success">Available</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                        @php
                                                            $selectedSlots = $all_slots->where('form_id', $form_id)->pluck('selected_slot')->toArray();
                                                        @endphp
                                                        @if (in_array($slot, $selectedSlots))
                                                            @foreach ($all_slots->where('form_id', $form_id)->where('selected_slot', $slot) as $selectedSlot)
                                                                <form method="POST" action="{{ route('appointments.cancelSlot', ['id' => $selectedSlot->id]) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                                                </form>
                                                            @endforeach
                                                        @else

                                                        @endif
                                                    </td>                                                     --}}
                                                </tr>
                                            @endforeach
                                                                                                                               
                                        </tbody>
                                        </table>
                                    </div>
                                @endif

                                <div class="row px-md-5">
                                    <div class="col-6" style="justify-content: flex-start">
                                        <a href="{{route('appointments.sicknessForm',['form_id' => $time_slots->form_id])}}"
                                           class="btn btn-secondary col-md-2 col-6 mb-3 webbutton" style="">Back</a>
                                    </div>
                                    @if($all_slots->whereNotNull('selected_slot')->isNotEmpty())
                                        <div class="col-6 d-flex" style="justify-content: flex-end"> 
                                            <a href="{{ route('appointments.index') }}" 
                                                class="btn btn-success col-md-2 col-6 mb-3 webbutton" style="">Next</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@section('scripts')
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('checkDate').addEventListener('click', function () {
            var aptDate = document.getElementById('aptDate').value;
            window.location.href = "{{ route('appointments.slotForm', ['form_id' => $form_id]) }}?aptDate=" + aptDate;
        });
    });
</script> --}}

@endsection
@endsection