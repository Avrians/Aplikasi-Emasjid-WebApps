<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function edit($id)
    {
        return view('userprofil_edit');
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|Max:100',
            'email' => 'required|email|Max:100',
            'password' => 'nullable|Max:10',
        ]);

        if ($request->password != '') {
            $data['password'] = bcrypt($request->password); // jika password ada isinya maka fungsi ini jalan
        } else {
            unset($data['password']); // jika password kosong buat variabel password jadi password tidak di update
        }

        $user = auth()->user();
        $user->fill($data);
        flash('Data Berhasil Diubah')->success();
        $user->save();

        return back();
    }
}
