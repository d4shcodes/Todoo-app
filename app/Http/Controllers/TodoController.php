<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Todo;
use App\Models\User;
use App\Facades\TodoFacade;


class TodoController extends Controller
{
    public function add_task(Request $request)
    {

        TodoFacade::addTodo([
            'title' => $request->title,
            'description' => $request->task_description,
            'task_status' => 1,
            'assigned_to' => $request->assigned_to,
        ]);
        return redirect()->back()->with('task_status', 'Task added!');
    }

    public function update_task(Request $request, $id, $type)
    {

        if ($type == 1) {
            TodoFacade::updateTodo($id, ['task_status' => 3]);
        } else {
            TodoFacade::updateTodo($id, [
                'title' => $request->edt_title,
                'description' => $request->edt_task_description,
                'task_status' => $request->edt_task_status,
                'assigned_to' => $request->edt_assigned_to,
            ]);
        }

        return redirect()->back()->with('task_status', 'Task updated!');
    }

    public function delete_task($id)
    {

        TodoFacade::deleteTodo($id);

        return redirect()->back()->with('task_status', 'Task has been deleted!');
    }

    public function dashboard()
    {
        $user_session = array();
        $workers = User::where('status', '!=', 0)->get();

        if (Session::has('loginID')) {

            $user_session = User::where('id', '=', Session::get('loginID'))->first();

            if (Session::get('loginID') == '2') {
                $todo_task = Todo::all();
            } else {
                $todo_task = Todo::where('assigned_to', '=', Session::get('loginID'))->get();
            }
        }
        return view('dashboard.home', compact('user_session', 'todo_task', 'workers'));
    }

    public function user_auth(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        if ($user && Hash::check($request->pass_key, $user->password)) {
            $request->session()->put('loginID', $user->id);
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('auth_status', 'Entered wrong passkey !');
        }
    }

    public function logout()
    {

        if (Session::has('loginID')) {
            Session::pull('loginID');
            return redirect()->route('welcome');
        }
    }
}
