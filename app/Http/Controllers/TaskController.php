<?php

namespace App\Http\Controllers;

use App\Task;
use App\Type;
use App\User;
use App\Approve;
use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Les données sont envoyé dans ajax avant d'etre traité dans le controller
 */
class TaskController extends Controller
{
    public $approve = 1;

    public function index(){
        if(Auth::user()->type_id == 1)
        {
            $tasks = Task::paginate(20);
        } else {
            $tasks = Task::where('user_id', Auth::id())->paginate(20);
        }
        return view('tasks.index',compact('tasks'));
    }
  
    public function addTask(Request $request){
        $rules = array(
            'description' => 'required',
            'date' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        else {
            
            if(Auth::user()->type_id == 1)
            {
                $this->approve = 2;
            }

            $task = new Task;
            $task->description = $request->description;
            $task->date = $request->date;
            $task->user_id = $request->user_id;
            $task->approve_id = $this->approve;
            $task->save();


            /**
             * @var Variables Préparation des variables
             * Récupération des variables par jquery => view('template.blade.php') method('create')
            */   

            // Récupérer le nom du demandeur dynamiquement
            $user = $task->user()->pluck('name')->toArray();
            $task->user = $user;

            //Récupérer les id des Bâtiments
            $buildings_id = $request->input('buildings_id');
            $task->buildings_id = array_map('intval',$buildings_id);
            $task->buildings()->attach($buildings_id);
            //Récupérer les noms des Bâtiments
            $buildingsNames = $task->buildings()->pluck('name')->toArray();
            $task->buildingsNames = $buildingsNames;

            //Récupérer les id des Classes
            $classrooms_id = $request->input('classrooms_id');
            $task->classrooms_id = array_map('intval',$classrooms_id);
            $task->classrooms()->attach($classrooms_id);
            //Récupérer les noms des Classes
            $classroomsNames = $task->classrooms()->pluck('name')->toArray();
            $task->classroomsNames = $classroomsNames;

            //Récupérer les id des Traitants
            $users_id = $request->input('users_id');
            $task->users_id = array_map('intval',$users_id);
            $task->users()->attach($users_id);
            //Récupérer les noms des Traitants
            $usersNames = $task->users()->pluck('name')->toArray();
            $task->usersNames = $usersNames;

            //Récupérer l'id Approve
            $approveId = $task->approve()->pluck('id')->toArray();
            $task->approveId = $approveId;
            //Récupérer le nom Approve
            $approveName = $task->approve()->pluck('name');
            $task->approveName = $approveName;

            //Récupérer l'id du type
            $userTypeId = Auth::user()->type_id;
            $task->userTypeId = $userTypeId;

            return response()->json($task);
        }
        
    }
  
    public function editTask(Request $request){
        //===> les donnees sont sensibles à la casse
        $task = Task::find($request->id); // on récupère l'id dans data dans ajax
        $task->user_id = $request->user_id;
        $task->description = $request->description;
        $task->date = $request->date;
        $task->save();

        //Récupérer les id des Bâtiments
        $buildings_id = $request->input('buildings_id');
        $task->buildings_id = array_map('intval',$buildings_id);
        $task->buildings()->sync($task->buildings_id);

        //Récupérer les id des Classes
        $classrooms_id = $request->input('classrooms_id');
        $task->classrooms_id = array_map('intval',$classrooms_id);
        $task->classrooms()->sync($task->classrooms_id);

        //Récupérer les id des Traitants
        $users_id = $request->input('users_id');
        $task->users_id = array_map('intval',$users_id);
        $task->users()->sync($task->users_id);

        $task->userName = $request->userName;
        $task->buildingsNames = $task->buildings()->pluck('name')->toArray();
        $task->classroomsNames = $task->classrooms()->pluck('name')->toArray();
        $task->usersNames = $task->users()->pluck('name')->toArray();
        $task->approveName = Approve::find($task->approve_id)->name;
        $task->userTypeId = Type::find($task->user->type_id)->id;
        
        // dd($task->approveName);exit;
        
        return response()->json($task);
    }   
  
    public function deleteTask(request $request){
        $taskDelete = Task::find($request->id);
        $task = Task::destroy($request->id);

        $taskDelete->buildings()->detach($taskDelete->buildings_id);
        $taskDelete->classrooms()->detach($taskDelete->classrooms_id);
        $taskDelete->users()->detach($taskDelete->users_id);
        
        return response()->json();

    }

    public function editApprove(request $request){
        
        $task = Task::find($request->id);
        $task->approve_id = $request->approve_id;
        $task->save();
        
        $task->approveName = Approve::find($request->approve_id)->name;

        return response()->json([$task]);
    }
}
