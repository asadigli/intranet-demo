<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Task;
use Auth;
use File;

class TaskController extends Controller
{
  public function updatepercentage(Request $request, $id){
    $task = Task::find($id);
    $task->percent = $request->percent;
    if($request->percent == 0){
      $task->status = 0;
    }elseif(($request->percent != 100) && ($request->percent != 0)){
      $task->status = 1;
    }elseif($request->percent == 100){
      $task->status = 2;
    }
    $task->update();
    return redirect()->back()->with('success','Task Updated');
  }
  public function changestatus(Request $request, $id){
    $task = Task::find($id);
    $task->status = $request->status;
    if($request->status == 0){
      $task->percent = 0;
    }elseif(($request->status == 1)){
      $task->percent = 1;
    }elseif($request->status == 2){
      $task->percent = 100;
    }
    $task->update();
    return redirect()->back()->with('success','Task status updated');
  }
  public function changetasktitle(Request $req, $id){
    $task = Task::find($id);
    $task->title = $req->title;
    $task->update();
    return redirect()->back()->with('success','Task title updated');
  }
  public function changetaskdetails(Request $req, $id){
    $task = Task::find($id);
    $task->details = $req->details;
    $task->update();
    return redirect()->back()->with('success','Task details updated');
  }
  public function changetaskstart_date(Request $req, $id){
    $task = Task::find($id);
    $task->start_date = $req->start_date;
    $task->update();
    return redirect()->back()->with('success','Task start date updated');
  }
  public function changetaskdeadline(Request $req, $id){
    $task = Task::find($id);
    $task->deadline = $req->deadline;
    $task->update();
    return redirect()->back()->with('success','Task deadline date updated');
  }
  public function changerelatedproject(Request $req, $id){
    $task = Task::find($id);
    $task->related_project = $req->related_project;
    $task->update();
    return redirect()->back()->with('success','Task related project updated');
  }
}
