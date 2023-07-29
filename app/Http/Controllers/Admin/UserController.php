<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create()
    {
        $users = User::where('delete_at',0)->get();
        return view('admin.pages.users.create', compact('users'));
    }

    public function store(Request $request)
    {
        if ($request->active == "") {
            User::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tel' => $request->tel,
                'whatsapp' => $request->whatsapp,
                'active' => 0,
            ]);
        } else {
            User::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tel' => $request->tel,
                'whatsapp' => $request->whatsapp,
                'active' => $request->active,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.pages.users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        if ($request->active == "") {
            if (empty($request->password)){
                $users->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'email' => $request->email,
                    'password' => $request->oldPassword,
                    'tel' => $request->tel,
                    'whatsapp' => $request->whatsapp,
                    'active' => 0,
                ]);
            }else{
                $users->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'tel' => $request->tel,
                    'whatsapp' => $request->whatsapp,
                    'active' => 0,
                ]);
            }
        } else {
            if (empty($request->password)){
                $users->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'email' => $request->email,
                    'password' => $request->oldPassword,
                    'tel' => $request->tel,
                    'whatsapp' => $request->whatsapp,
                    'active' => $request->active,
                ]);
            }else{
                $users->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'tel' => $request->tel,
                    'whatsapp' => $request->whatsapp,
                    'active' => $request->active,
                ]);
            }
        }
        return redirect()->route('user.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        if($id == Auth::user()->id ){
            return redirect()->back()->with(['error' => "لا يمكن حذف المستخدم الحالى"]);
        }
        User::where('delete_at',0)->where('id','!=',Auth::user()->id)->delete();
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
