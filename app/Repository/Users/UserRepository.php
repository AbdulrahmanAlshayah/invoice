<?php

namespace App\Repository\Users;

use App\Http\Requests\UserRequest;
use App\Interfaces\Users\UserRepositoryInterface;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    use UploadTrait;

    public function profile()
    {
        $user = Auth::user();
        return view('Dashboard.User.profile', compact('user'));
    }

    public function updateProfile($request)
    {
        DB::beginTransaction();

        try {

            $user = Auth::user();

            $user->name = $request->name;

            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->place = $request->place;
            $user->mobile_number = $request->mobile_number;

            $user->save();
            // update photo
            if ($request->has('photo')) {
                // Delete old photo
                if ($user->image) {
                    $old_img = $user->image->filename;
                    $this->Delete_attachment('upload_image', 'users/' . $old_img, $request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request, 'photo', 'users', 'upload_image', $request->id, 'App\Models\User');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function showUsers()
    {
        if (Auth::user()->user_type == 1) {
            $users = User::get();
            return view('Dashboard.User.users', compact('users'));
        } else
            return redirect()->back()->withErrors(['error' => 'انت لا تمتلك حق الوصول لهذه الصفحة']);
    }
    public function updateUser($request)
    {
        $user = User::findOrFail($request->id);
        if ($request->has('user_type')) {
            $user->user_type = $request->user_type;
        }
        if ($request->has('status')) {
            $user->status = $request->input('status');
        }
        $user->save();
        session()->flash('edit');
        return redirect()->back();
    }
}
