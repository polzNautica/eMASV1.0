<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Appoinment;

class AppointmentController extends Controller
{
    public function showForm()
        {
            $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();
            $users = User::where('id', auth()->user()->id)->first();
            return view('appointments.create' , compact('userDetails', 'users'));
        }

        public function store(UpdateProfileRequest $request)
        {

            // Find or create the user details based on the email
            $users = User::where('id', auth()->user()->id)->first();

            $userDetail = UserDetail::updateOrCreate(
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

            // Redirect to a success page or show a success message
            return redirect()->route('appointments.create')->with('success', 'Profile Updated.');
        }
}
