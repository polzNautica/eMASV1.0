<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Http\Requests\UpdateProfileRequest;


    class ProfileController extends Controller
    {
        public function index()
        {
            $userDetails = UserDetail::where('user_id', auth()->user()->id)->first();
            return view('profile.index' , compact('userDetails'));
        }

        public function update(UpdateProfileRequest $request)
        {
            $user = auth()->user();

            $users = User::updateOrCreate(
                ['id' => $user->id],
                [
                    'name' => $request->input('full_name'),
                ]);

            $userDetails = UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $request->input('full_name'),
                    'gender' => $request->input('gender'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'phone_number' => $request->input('phone_number'),
                    'nationality' => $request->input('nationality'),
                    'religion' => $request->input('religion'),
                    'address1' => $request->input('address1'),
                    'address2' => $request->input('address2'),
                    'address3' => $request->input('address3'),
                    'ic' => $request->input('ic'),
                    'username' => $user->username,
                    'email' => $user->email,
                ]
            );

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
        }


}
