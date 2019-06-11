<?php

namespace App\Http\Controllers\Author;

use App\User;
use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index(){
        $users = User::paginate(6);
        return view('authors',compact('users'));
    }

    public function show($id){
        $user = User::find($id);
        $files = File::where('user_id',$user->id)->paginate();
        $topThreeFiles = $user->topThreeFileUser();
        return view('author.show',compact('user','files','topThreeFiles'));
    }

    public function edit($id){
        if (Auth::id() != $id){
            return redirect()->back();
        }
        $user = User::find($id);
        return view('author.edit',compact('user'));
    }

    public function update(Request $request, $id){
            //validate

        if (Auth::id() != $id){
            return redirect()->back();
        }

        $user = User::find($id);



            if ($request->avatar != null) {
                $avatar = $request->avatar;
                $format = $avatar->extension();
                $name = time() . $request->second_name . $request->first_name . '.' . $format;
                $avatar->move(public_path('/avatars'), $name);
            }else{
                $name = $user->avatar;
            }


        $user->update([
            'second_name' => $request->second_name,
            'first_name' => $request->first_name,
            'patronymic' => $request->patronymic,
            'description' => $request->description,
            'date_birth' => $request->date_birth,
            'avatar' => $name,
        ]);



        return redirect()->route('author.show',$user->id);
    }


}
