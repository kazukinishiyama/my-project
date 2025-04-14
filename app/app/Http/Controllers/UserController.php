<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        return redirect()->route('users.show', $id)->with('success', 'ユーザーネームを更新しました！');
    }
    // UserController.php または ThreadController.php の中の show メソッド

    public function show($id)
    {
        return redirect()->route('thread.create');
    }

}
