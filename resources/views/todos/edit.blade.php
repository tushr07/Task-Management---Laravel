@extends('layouts/app')

@section('title')
    Update {{$todo->name}}
@endsection

@section('content')
<h1 class="text-center my-5">UPDATE TASK</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-primary">
            <div class="card-header bg-info"></div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
            <form action="/todos/{{$todo->id}}/update" method="post">
                @csrf
                <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Task Title" value="{{$todo->name}}">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" name="assignedto" placeholder="Task Assigned To" value="{{$todo->assignedto}}">
                </div>                                
                <label for="priority">Task priority: </label>
                <select id="priority" name="priority">
                    <option value="{{$todo->priority}}" disabled>{{$todo->priority}}</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>                    
                </select>  

                <div class="form-group">
                <textarea name="description" cols="5" rows="5" class="form-control" placeholder="Description">{{$todo->description}}</textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn-success">Update</button>
                    <a class="btn-secondary" href="/">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
