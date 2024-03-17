<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Ideas;
use Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Project;
use DB;
use App\Task;
use Auth;
use File;

class UserController extends Controller
{

    public function sendidea(){
      return view('create.sendidea');
    }
    public function changepassword(Request $req, $id){
      $this->validate($req,[
        'password' => 'required|string|min:6|confirmed',
      ]);
      $user = User::find($id);
      $user->password = Hash::make($req->password);
      $user->update();
      return Redirect()->back()->with('success','Password Changed');
    }
    public function changeuserdata(Request $request, $id){
      $user = User::find($id);
      $this->validate($request, [
          'username' => 'required|min:5|unique:users,username,' . $user->id,
          'email' => 'required|string|min:6|unique:users,email,' . $user->id,
          'name' => 'required|min:2',
          'surname' => 'required|min:2',
      ]);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->surname = $request->surname;
      $user->username = $request->username;
      $user->update();
      return redirect()->back()->with('success','You have successfully changed your settings.');
    }
    public function changeprofilephoto(Request $request, $id){
      $user = User::find($id);
      if($request->hasFile('avatar')){
          $avatar = $request->file('avatar');
          $filename = time() . '.' . $avatar->getClientOriginalExtension();
          Image::make($avatar)->save(public_path('/uploads/profilephotos/' . $filename));
          $user->avatar = $filename;
        }
      $user->update();
      return redirect()->back()->with('success','You have successfully changed your photo.');
    }
    public function deleteprofilephoto(Request $request, $id){
      $user = User::find($id);
      $user->avatar = $request->avatar;
      $user->update();
      return redirect()->back()->with('danger','You have deleted your photo.');

    }
    public function finishedtasks(){
      $tasks = Task::where('status','=',2)->where('assigned_member','=',[Auth::user()->id])->get();
      return view('list.finishedtasks',['tasks' => $tasks]);
    }
    public function sendideato(Request $request){
      $ideas = new Ideas();
      $ideas->title = $request->title;
      $ideas->user_id = $request->user_id;
      if($request->hasFile('image1')){
          $image1 = $request->file('image1');
          $filename = time() . '.' . $image1->getClientOriginalExtension();
          Image::make($image1)->save(public_path('/uploads/ideas/' . $filename));
          $ideas->image1 = $filename;
        }
      $ideas->description = $request->description;
      $ideas->save();
      return redirect()->back()->with('success','Idea sent! We are strong together.');
    }
    public function mytasks(){
      $tasks = Task::where('status','=',0)->where('assigned_member','=',[Auth::user()->id])->orderBy('created_at','desc')->get();
      return view('list.mytasks',['tasks' => $tasks]);
    }
    public function gettasksinprogress(){
      $tasks = Task::where('status','=',1)->where('assigned_member','=',[Auth::user()->id])->orderBy('created_at','desc')->get();
      return view('list.tasksinprogress',['tasks' => $tasks]);
    }
    public function getideas(){
      $ideas = Ideas::orderBy('created_at','desc')->get();
      return view('list.ideas',['ideas'=>$ideas]);
    }
    public function displayproject($token){
      $project = DB::table('projects')->where('token', $token)->first();
      return view('pages.project',['project'=>$project]);
    }
    public function displaytask($access_token){
      $task = DB::table('tasks')->where('access_token', $access_token)->first();
      return view('pages.task',['task'=>$task]);
    }
}
