<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\AppointmentRecord;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{
    public function index()
        {
            $users = auth()->user();
            $userDetails = UserDetail::where('user_id', $users->id)->first();
            $appointments = Appointment::where('user_id', $userDetails->id)->first();
            $records = AppointmentRecord::where('user_id', $userDetails->id)->get();
            if ($appointments) {
                $time_slots = TimeSlot::where('form_id', $appointments->id)->get();
            } else {
                // Handle the case where $appointments is null, e.g., set $time_slots to an empty array
                $time_slots = [];
            }
            return view('appointments.index' , compact('users', 'userDetails', 'appointments', 'time_slots', 'records'));
        }

    public function showForm()
        {
            $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();
            $users = User::where('id', auth()->user()->id)->first();
            $appointments = Appointment::updateOrCreate(
                ['user_id' => $userDetails->id],
            );            

            $form_id = $appointments->id;
            return view('appointments.create' , compact('userDetails', 'users', 'form_id', 'appointments'));
        }

        public function store(UpdateProfileRequest $request)
        {
            $users = User::where('id', auth()->user()->id)->first();

            $userDetails = UserDetail::updateOrCreate(
                ['user_id' => $users->id],
                [
                    'full_name' => $request->input('full_name'),
                    'email' => $request->input('email'),
                    'ic' => $request->input('ic'),
                    'phone_number' => $request->input('phone_number'),
            ]);

            $user = User::updateOrCreate(
                ['id' => $users->id],
                [
                    'name' => $request->input('full_name'),
                    'email' => $request->input('email'),
            ]);

            $form_id = Appointment::updateOrCreate(
                ['user_id' => $userDetails->id],
            );

            $id = $userDetails->user_id;

            // Redirect to a success page or show a success message
            return redirect()->route('appointments.create', compact('id'))->with('success', 'Profile Updated.');
        }

        public function sicknessForm($form_id)
        {
            $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();
            $users = User::where('id', auth()->user()->id)->first();
            $appointments = Appointment::updateOrCreate(
                ['user_id' => $userDetails->id],
            );
            $appointments = Appointment::where('user_id', $userDetails->id)->first();
            $form_id = $appointments->id;
            $time_slots = TimeSlot::where('form_id', $appointments->id)->first();
            return view('appointments.sickness' , compact('userDetails', 'users', 'form_id', 'appointments', 'time_slots'));
        }

        public function sicknessStore(Request $request)
        {
            $users = User::where('id', auth()->user()->id)->first();
            $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();

            $userDetail = Appointment::updateOrCreate(
                ['user_id' => $userDetails->id],
                [
                    'sickness' => $request->input('sickness'),
                    'seriousness' => $request->input('seriousness'),
                    'specification' => $request->input('specification'),
                ]);
            
                $form_id = $userDetail->id;
                
            $time_slots = TimeSlot::updateOrCreate(
                [
                    'form_id' => $request->input('form_id'),
                ]);

            // Redirect to a success page or show a success message
            return redirect()->route('appointments.sicknessForm', compact('form_id'))->with('success', 'Details Updated.');
        }

        public function slotForm(Request $request)
        {
            $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();
            $users = User::where('id', auth()->user()->id)->first();
            $appointments = Appointment::where('user_id', $userDetails->id)->first();

            $time_slots = TimeSlot::where('form_id', $appointments->id)->first();
            
            // Fetch available slots based on the selected date
            if ($time_slots && $time_slots->form_id == null) {
                $time_slots->form_id = $userDetails->id;
                $time_slots->save();
            } elseif ($time_slots->aptDate != null && $time_slots->aptDate == now()->format('Y-m-d')) {
                $aptDate = $time_slots->aptDate;
            } else {
                $aptDate = $request->input('aptDate') ?? now()->format('Y-m-d');
        
                // Check if the selected date is before the current date
                if (Carbon::parse($aptDate)->lt(now()->startOfDay())) {
                    return back()->with('error', 'Invalid date. Please select a date from today onwards.');
                }
        
                $time_slots->aptDate = $aptDate;
                $time_slots->save();
            }

            $all_slots = TimeSlot::where('aptDate', $time_slots->aptDate)->get();
            $form_id = $time_slots->form_id;

            $availableSlots = $this->getAvailableSlots($aptDate, $all_slots);
            
            return view('appointments.slot' , compact('userDetails', 'users', 'time_slots', 'availableSlots', 'all_slots', 'aptDate', 'appointments', 'form_id'));
        }

        public function slotStore(Request $request)
{
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $userDetails->update(['profile_picture' => $path]);
    }
    
    $form_id = $request->input('form_id');
    $aptDate = $request->input('aptDate');
    $selected_slot = $request->input('selected_slot');

    // Check if there's an existing record for the specified form_id, aptDate, and selected_slot
    $existingSlot = TimeSlot::where('form_id', $form_id)
        ->where('aptDate', $aptDate)
        ->where('selected_slot', $selected_slot)
        ->first();

    if ($existingSlot) {
        // If the record exists, update the existing record
        $existingSlot->update([
            'is_available' => true,
            'selected_slot' => null,
            'selected_date' => null,
        ]);

        return redirect()->route('appointments.slotForm', compact('form_id'))->with('success', 'Slot Canceled.');
    } else {
        // If the record doesn't exist, create a new record
        TimeSlot::updateOrCreate(
            [
                'form_id' => $form_id,
                'aptDate' => $aptDate,
                'selected_slot' => null, // or set it to the default value
            ],
            [
                'is_available' => false,
                'selected_slot' => $selected_slot,
                'selected_date' => $aptDate,  
            ]
        );

        return redirect()->route('appointments.slotForm', compact('form_id','aptDate'))->with('success', 'Slot Reserved.');
    }
}



        private function getAvailableSlots($aptDate, $all_slots)
        {
            $defaultSlots = ['09:00-10:00', '10:00-11:00', '11:00-12:00', '14:00-15:00', '15:00-16:00', '16:00-17:00'];
            $availableSlots = [
                "$aptDate.09:00-10:00", 
                "$aptDate.10:00-11:00", 
                "$aptDate.11:00-12:00", 
                "$aptDate.14:00-15:00", 
                "$aptDate.15:00-16:00", 
                "$aptDate.16:00-17:00",
            ];  

            if ($all_slots) {
                foreach ($all_slots as $all_slot) {
                    if ($all_slot->aptDate == $aptDate) {
                        // Remove the selected slot from available slots
                        $key = array_search($all_slot->selected_slot, $availableSlots);
                        if ($key !== false) {
                            unset($availableSlots[$key]);
                        }
                    }
                }
            }

            // dd($availableSlots);         

            return $availableSlots;
        }

        // Other methods...

    public function cancelSlot($id)
    {
        $slots = TimeSlot::findOrFail($id);
        $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();
        $appointments = Appointment::where('user_id', $userDetails->id)->first();

        $sickness_id = $appointments->id;
        $sickness = Appointment::findOrFail($sickness_id);

        if ($slots->form_id == $appointments->id) {
            // $recordCount = TimeSlot::where('form_id', $slot->form_id)->count();

            $cancel = 'Cancelled';
           
            AppointmentRecord::create([
                'user_id' => $slots->appointments->user_id,
                'sickness' => $slots->appointments->sickness,
                'seriousness' => $slots->appointments->seriousness,
                'specification' => $slots->appointments->specification,
                'aptDate' => $slots->aptDate,
                'selected_date' => $slots->selected_date,
                'selected_slot' => $slots->selected_slot,
                'is_available' => $slots->is_available,
                'status' => $cancel,
            ]);
      
            $slots->delete();
            $sickness->delete();

            // if ($recordCount == 1) {
            //     // Update the slot to make it available
            //     $slot->update([
            //         'is_available' => true,
            //         'selected_slot' => null,
            //         'selected_date' => null,
            //     ]);
            // } else {
            //     // Delete the slot record
            //     $slot->delete();
            // }

            return redirect()->back()->with('success', 'Slot Canceled.');
        }

        return redirect()->back()->with('error', 'Unauthorized to cancel this slot.');
    }

    public function editSlot($id)
    {
        $slots = TimeSlot::findOrFail($id);
        $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();
        $appointments = Appointment::where('user_id', $userDetails->id)->first();

        $sickness_id = $appointments->id;
        $sickness = Appointment::findOrFail($sickness_id);

        if ($slots->form_id == $appointments->id) {
      
            $slots->selected_date = null;
            $slots->selected_slot = null;
            $slots->is_available = false;
            
            $slots->save();
            
            return redirect()->back()->with('success', 'Slot Canceled.');
        }

        return redirect()->back()->with('error', 'Unauthorized to cancel this slot.');
    }
}
