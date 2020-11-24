<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
use Response;
class TodosController extends Controller
{
    public function index()
    {
        //fetch all data
        $todos = Todo::all();
        return view('todos/index')->with('todos',$todos);
    }
    public function show(Todo $todoId)
    {
        return view('todos/show')->with('todo',$todoId);
    }
    public function create()
    {
        return view('todos/create');
    }
    public function store()
    {
        $this->validate(request(),[
            'name' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'assignedto' => 'required'

        ]);

        $data = request()->all();

        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->priority = $data['priority'];
        $todo->assignedto = $data['assignedto'];

        $todo->completed = false;

        $todo->save();

        session()->flash('message','Task Created Successfully!');

        return redirect('/todos');
    }
    public function edit(Todo $todoId)
    {
        return view('todos/edit')->with('todo',$todoId);
    }

    public function export()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $todos = Todo::all();        
        $columns = array('id', 'name', 'priority', 'assignedto', 'description', 'completed', 'created_at');

        $callback = function() use ($todos, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($todos as $todo) {
                fputcsv($file, array($todo->id, $todo->name, $todo->priority, $todo->assignedto, $todo->description, $todo->completed, $todo->created_at));
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    public function update(Todo $todoId)
    {
        $this->validate(request(),[
            'name' => 'required',
            'description' => 'required'
        ]);

        $data = request()->all();

        $todoId->name = $data['name'];
        $todoId->description = $data['description'];
        $todo->priority = $data['priority'];
        $todo->assignedto = $data['assignedto'];
        $todoId->save();

        session()->flash('message','Task Updated Successfully!');

        return redirect('/todos');
    }
    public function destroy(Todo $todoId)
    {
        $todoId->delete();

        session()->flash('message','Task Deleted Successfully!');

        return redirect('/todos');
    }
    public function complete(Todo $todoId)
    {
        $todoId->completed = true;
        $todoId->save();

        session()->flash('message','Task Completed Successfully!');
        return redirect('/completed');
    }
}
