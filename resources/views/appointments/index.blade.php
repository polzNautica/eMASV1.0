@extends('layouts.app-master')

@section('activeMakeApt')
active
@endsection

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-md-5 rounded">
        @auth
        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('appointments.create',['id' => $userDetails->id]) }}" class="btn btn-warning">Apply New Appointment</a>
        </div>
        <h1 class="mb-3">Appointment Records</h1>
        <div class="container">
            <table class="table text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">No</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Name</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Phone No.</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Type of Sickness</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Seriousness</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Slot</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Appointment Date</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Applied Date</th>
                        <th class="text-white" style="background-color: rgba(201,35,75,1)" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>                                       
                    @forelse($time_slots as $index => $time_slot)
                    @php
                    $seriousness = $time_slot->appointments->seriousness;
                        switch ($seriousness) {
                            case '1':
                                $seriousness = "Very Low";
                                break;
                            case '2':
                                $seriousness = "Low";
                                break;
                            case '3':
                                $seriousness = "Medium";
                                break;
                            case '4':
                                $seriousness = "High";
                                break;
                            case '5':
                                $seriousness = "Very High";
                                break;                           
                            default:
                                $seriousness = "Unidentified";
                                break;
                        }
                    @endphp
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$time_slot->appointments->userDetails->full_name}}</td>
                            <td>{{$time_slot->appointments->userDetails->phone_number}}</td>
                            <td>{{$time_slot->appointments->sickness}}</td>
                            <td>{{$seriousness}}</td>
                            <td>{{ explode('.', $time_slot->selected_slot)[1] ?? '' }}</td>
                            <td>{{\Carbon\Carbon::parse($time_slot->selected_date)->format('Y-m-d') }}</td>
                            <td>{{\Carbon\Carbon::parse($time_slot->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <form method="POST" action="{{ route('appointments.cancelSlot', ['id' => $time_slot->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style=""><i class="fa-solid fa-xmark"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No time slots available</td>
                        </tr>
                    @endforelse                                                                                        
            </tbody>
            </table>
        </div>
    </div>


        @endauth
@endsection