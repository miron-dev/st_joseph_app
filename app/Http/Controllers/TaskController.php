<?php

namespace App\Http\Controllers;

use App\Task;
use App\Type;
use App\User;
use App\Image;
use App\Approve;
use App\Building;
use App\Priority;
use App\Stat_Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Les données sont envoyé dans ajax avant d'etre traité dans le controller
 */
class TaskController extends Controller
{
    private $approve = 1;

    public function index(){
        if(Auth::user()->type_id == 1) // Affiche toutes les tâches des utilisateurs => Admin
        {
            $tasks = Task::all();
        }
        else if(Auth::user()->type_id == 4){ // Affiche les tâches validé par l'admin => Traitants
            $user = User::find(Auth::id());
            $tasks = $user->tasks->where('approve_id', 2);
            return view('tasks.agents.index', compact('tasks'));
        }
        else { //Affiche les tâches ajouté par les utilisateurs => Prof, Secretaires
            $tasks = Task::where('user_id', Auth::id())->get();
        }
        return view('tasks.index',compact('tasks'));
    }
  
    public function addTask(Request $request){
        $rules = array(
            'description' => 'required',
            // 'date' => 'required',
            // 'buildings_id' => 'required',
            // 'classrooms_id' => 'required',
            // 'users_id' => 'required',
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
            $task->date = ($request->date) ? $request->date : '';
            $task->user_id = (int)$request->user_id;
            $task->approve_id = $this->approve;
            $task->save();
            
            
            $task->date_create = $task->created_at->format('d/m/Y');
            $task->priorityName = Priority::find(1)->name;
            $task->priority_id = Priority::find(1)->id;
            /**
             * @var Variables Préparation des variables
             * Récupération des variables par jquery => view('template.blade.php') method('create')
            */   

            // Récupérer le nom du demandeur dynamiquement
            $user = $task->user()->pluck('name')->toArray();
            $task->user = $user;

            //Récupérer les id des Bâtiments
            $buildings_id = $request->input('buildings_id');
            if($buildings_id) // ajouter cette fonctionnalité si les champs ne sont pas requis
            {
                $buildings_id = explode(',',$buildings_id);
                $task->buildings_id = array_map('intval',$buildings_id);
                $task->buildings()->attach($buildings_id);
                //Récupérer les noms des Bâtiments
                $buildingsNames = $task->buildings()->pluck('name')->toArray();
                $task->buildingsNames = $buildingsNames;
            } else {
                $task->buildings_id = [];
                $task->buildingsNames = '';
            }

            //Récupérer les id des Classes
            $classrooms_id = $request->input('classrooms_id');
            if($classrooms_id) // ajouter cette fonctionnalité si les champs ne sont pas requis
            {
                $classrooms_id = explode(',',$classrooms_id);
                $task->classrooms_id = array_map('intval',$classrooms_id);
                $task->classrooms()->attach($classrooms_id);
                //Récupérer les noms des Classes
                $classroomsNames = $task->classrooms()->pluck('name')->toArray();
                $task->classroomsNames = $classroomsNames;
            } else {
                $task->classrooms_id = [];
                $task->classroomsNames = "";
            }

            if(Auth::user()->type_id == 1):
                //Récupérer les id des Traitants
                $users_id = $request->input('users_id');
                if($users_id) // ajouter cette fonctionnalité si les champs ne sont pas requis
                {
                    $users_id = explode(',',$users_id);
                    $task->users_id = array_map('intval',$users_id);
                    $task->users()->attach($users_id);
                    //Récupérer les noms des Traitants
                    $usersNames = $task->users()->pluck('name')->toArray();
                    $task->usersNames = $usersNames;
                } else {
                    $task->users_id = [];
                    $task->usersNames = "";
                }
            endif;

            //Récupérer l'id Approve
            $approveId = $task->approve()->pluck('id')->toArray();
            $task->approveId = $approveId;
            //Récupérer le nom Approve
            $approveName = $task->approve()->pluck('name');
            $task->approveName = $approveName;

            //Récupérer l'id du type
            $userTypeId = Auth::user()->type_id;
            $task->userTypeId = $userTypeId;

            //============ Images uploads ============
            if($request->hasFile('files')) {
                foreach($request->file('files') as $file){
                    // rename & upload files to uploads folder
                    $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                    $path = public_path() . '/uploads';
                    $file->move($path, $name);
                    // store in db
                    $fileUpload = new Image();
                    $fileUpload->filename = $name;
                    $fileUpload->user_id = Auth::id();
                    // $task = User::find(Auth::id());
                    $task->images()->save($fileUpload);
                    $task->files = $fileUpload;
                }
            } else {
                $task->files = '';
            }

            return response()->json($task);
        }
        
    }
  
    public function editTask(Request $request){
        $rules = array(
            'description' => 'required',
            // 'date' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        //===> les donnees sont sensibles à la casse
        $task = Task::find($request->id); // on récupère l'id dans data avec ajax
        $task->user_id = $request->user_id;
        $task->description = $request->description;
        $task->date = ($request->date) ? $request->date : '';
        $task->save();

        //Récupérer les id des Bâtiments
        $buildings_id = $request->input('buildings_id');
        // dd($buildings_id);
        if($buildings_id)
        {
            $buildings_id = explode(',',$buildings_id);
            $task->buildings_id = $buildings_id;
        }
        $task->buildings()->sync($task->buildings_id);

        //Récupérer les id des Classes
        $classrooms_id = $request->input('classrooms_id');
        if($classrooms_id)
        {
            $classrooms_id = explode(',',$classrooms_id);
            $task->classrooms_id = $classrooms_id;
        }
        $task->classrooms()->sync($task->classrooms_id);

        //Récupérer les id des Traitants
        $users_id = $request->input('users_id');
        // dd($users_id);
        if($users_id)
        {
            $users_id = explode(',',$users_id);
            $task->users_id = $users_id;
        }
        $task->users()->sync($task->users_id);

        //Récupérer les noms de chaque entité
        $task->userName = $request->userName;
        $task->buildingsNames = $task->buildings()->pluck('name')->toArray();
        $task->classroomsNames = $task->classrooms()->pluck('name')->toArray();
        $task->usersNames = $task->users()->pluck('name')->toArray();
        $task->priorityName = $task->priority()->pluck('name')->toArray();
        $task->approveName = Approve::find($task->approve_id)->name;

        //Récupérer le type_id du user
        $task->userTypeId = Type::find($task->user->type_id)->id;

        //Récupérer le type_id du user actuelle
        $task->is_admin = Auth::user()->type_id;

        // Récupère la date de creation
        $task->date_create = $task->created_at->format('d/m/Y');

        
        //============ Images uploads ============
        $file = json_decode($request->file);
        $task->file = $file;
        // print_r($task->file);
        // if($filename)
        // {
        //     $task->filename = $filename;
        //     if($request->hasFile('files')) {
        //         foreach($request->file('files') as $file){
        //             // rename & upload files to uploads folder
        //             $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
        //             $path = public_path() . '/uploads';
        //             $file->move($path, $name);
        //             // store in db
        //             $fileUpload = Image::where('imageable_id',$request->id);
        //             $fileUpload->filename = $name;
        //             $fileUpload->user_id = Auth::id();
        //             // $task = User::find(Auth::id());
        //             // $task->images()->sync([$fileUpload]);
        //             $task->filename = $fileUpload;
        //         }
            
        //     }
        // }
        // $task->images()->sync($filename);

        // print_r($request->hasFile('files'));

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

    public function editPriority(request $request){
        
        $task = Task::find($request->id);
        $task->priority_id = $request->priority_id;
        $task->save();
        
        $task->priorityName = Priority::find($request->priority_id)->name;

        return response()->json([$task]);
    }

    public function taskDone(Request $request)
    {        
        // dd($request->all());
        
        if($request->done_worker == "on"){
            
            $taskId = Stat_Task::where('task_id',$request->task_id)->select('task_id')->first();
            // dd($taskId);

            if(!isset($taskId)) // Si l'id de la tâche n'existe pas dans la table on créé un nouveau
            {
                $done = new Stat_Task();
                $request->done_worker = 1;
                $done->task_id = $request->task_id;
                $done->worker_id = Auth::id();
                $done->done_worker = $request->done_worker;
                $done->save();
                // dd('new');
            } else // Si la variable existe alors on update les données
            {
                $statId = Stat_Task::where('task_id',$request->task_id)->select('id')->first();
                // // dd($statId);
                $statId = $statId->id;
                $done = Stat_Task::find($statId);
                $done->done_worker = 1;
                $done->update($request->all());
                // dd('update');
            }
        } else // Si le checkbox est sur "off" on update les données
        {
            $statId = Stat_Task::where('task_id',$request->task_id)->first();
            $statId = $statId->id;

            $done = Stat_Task::find($statId);
            $done->id = $statId;
            $done->done_worker = 0;
            $done->update($request->all());
            // dd('unchecked');
        }

        return response()->json($done);
    }

    public function taskDoneAdmin(Request $request)
    {
        if(Auth::user()->type_id == 1){ // Admin
            if($request->done_admin == "on"){
                // dd($request->all());
                $statId = Stat_Task::where('task_id',$request->task_id)->select('id')->first();
                // // dd($statId);
                $statId = $statId->id;
                $done = Stat_Task::find($statId);
                $done->admin_id = Auth::id();
                $done->done_admin = 1;
                $done->update($request->all());
            } else {
                // dd($request->all());
                $statId = Stat_Task::where('task_id',$request->task_id)->first();
                $statId = $statId->id;

                $done = Stat_Task::find($statId);
                $done->id = $statId;
                $done->done_admin = 0;
                $done->update($request->all());
            }
        }
        return response()->json($done);
    }

    public function indexTasksDones()
    {
        $stat_task = Stat_Task::select('task_id')->where('done_admin',1)->get();
        return view('tasks.task-done', compact('stat_task'));
    }
}
