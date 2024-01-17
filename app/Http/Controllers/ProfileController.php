<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


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
                    'profile_picture' => $this->storeProfilePicture($request),
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

        protected function storeProfilePicture(Request $request)
        {
            $user = auth()->user();
            $userDetail = $user->userDetails;

            if ($request->hasFile('profile_picture')) {
        
                // Get the old profile picture path
                $oldProfilePicturePath = $userDetail ? $userDetail->profile_picture : null;
        
                // Upload the new profile picture
                $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        
                // Delete the old profile picture if it exists
                if ($oldProfilePicturePath && Storage::disk('public')->exists($oldProfilePicturePath)) {
                    Storage::disk('public')->delete($oldProfilePicturePath);
                }
        
                return $profilePicturePath;
            }
        
            return $userDetail->profile_picture; // Handle case where no file is uploaded
        }
        


}
