<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use App\Ideas;
use App\Position;
use Illuminate\Support\Str;
use App\Task;
use App\Project;
use Auth;
use App\Country;

class AdminController extends Controller
{
    public function adduser(){
      return view('create.adduser');
    }
    public function countries(){
      return view('create.addcountry');
    }
    public function addproject(){
      return view('create.addproject');
    }
    public function addtask(){
      return view('create.addtask');
    }
    public function updatepermissions(){
      return view('update.controlpermissions');
    }
    public function alltasks(){
      $tasks = Task::where('status','!=',2)->orderBy('created_at','desc')->get();
      return view('list.alltasks',['tasks' => $tasks]);
    }
    public function allfinishedtasks(){
      $tasks = Task::where('status','=',2)->get();
      return view('list.allfinishedtasks',['tasks' => $tasks]);
    }
    public function resetpassword(Request $request, $id){
      $user = User::find($id);
      $user->password = Hash::make($request->password);
      $user->update();
      return redirect()->back()->with('success','Password changed');
    }
    public function addcountry(Request $req){
      $con = new Country;
      $con->country_id = $req->name;
      $con->token = md5(microtime());
      $con->save();
      return redirect()->back()->with('success','Country added');
    }
    public function toadduser(Request $req){
      $user = new User;
      $user->name = $req->name;
      $user->surname = $req->surname;
      $user->username = $req->username;
      $user->gender = $req->gender;
      $user->role_id = $req->role_id;
      $user->email = $req->email;
      $user->password = bcrypt($req->password);
      $user->save();
      return Redirect()->back()->with('success','User added!');
    }
    public function userpermission(Request $req, $id){
         $user = User::find($id);
         $user->role_id = $req->role_id;
         $user->update();
         return Redirect()->back()->with('success','Status changed');
    }
    public function deleteuser($id){
         DB::table('users')->where('id',$id)->delete();
         return redirect()->back()->with('danger','User removed!');
    }

    public function deleteidea($id){
       DB::table('ideas')->where('id',$id)->delete();
       return redirect()->back()->with('danger','Idea removed!');
    }
    public function deletetask($id){
       DB::table('tasks')->where('id',$id)->delete();
       return redirect()->route('home')->with('danger','Task deleted!');
    }
    public function userpositions(){
      return view('list.positions');
    }
    public function addposition(Request $req){
      $pos =  new Position;
      $pos->position = $req->position;
      $pos->member_id = $req->member_id;
      // $pos->middleware_id = $pos->middleware_id;
      $pos->save();
      return redirect()->back()->with('success','Position changed');
    }
    public function updateposition(Request $req, $id){
      $pos = Position::find($id);
      $pos->position = $req->position;
      $pos->update();
      return redirect()->back()->with('success','Position changed');
    }
    public function addnewtask(Request $req){
      $this->validate($req, [
        'title' => 'required',
        'details' => 'required|min:8',
        'start_date' => 'required|date|before:deadline',
        'deadline' => 'date|after:start_date',
      ]);
      $task = new Task;
      $task->title = $req->title;
      $task->details = $req->details;
      $task->start_date = $req->start_date;
      $task->deadline = $req->deadline;
      $task->assigned_member = $req->assigned_member;
      $newuser = User::where('id','=',[$req->assigned_member])->get();
      foreach($newuser as $nu){
        $task->assigned_member_name = "$nu->name $nu->surname";
      }
      $task->related_project = $req->related_project;
      $task->access_token = md5(microtime());
      $task->save();
      return Redirect()->back()->with('success','Task added!');
    }
    public function createproject(Request $req){
      $this->validate($req, [
        'name' => 'required|unique:projects',
        'start_date' => 'required|date|before:deadline',
        'deadline' => 'date|after:start_date',
      ]);
      $pro = new Project;
      $pro->name = $req->name;
      $pro->details = $req->details;
      $pro->goal = $req->goal;
      $pro->project_manager = $req->project_manager;
      $pro->start_country = $req->start_country;
      $pro->budget = $req->budget;
      $pro->budget_needed = $req->budget_needed;
      $pro->focused_group = $req->focused_group;
      $pro->project_sponsor = $req->project_sponsor;
      $pro->deadline = $req->deadline;
      $pro->start_date = $req->start_date;
      $pro->document = $req->document;
      $pro->token = md5(microtime());
      $pro->save();
      return redirect()->back()->with('success','Project Created Successfully');
    }
    public function displayallprojects(){
      return view('list.projects');
    }
    public function displaymyprojects(){
      $project = Project::where('project_manager',[Auth::user()->id])->get();
      return view('list.myprojects',['project' => $project]);
    }
    public function deleteItem(Request $req) {
        Data::find ( $req->id )->delete ();
        return response ()->json ();
    }
}
