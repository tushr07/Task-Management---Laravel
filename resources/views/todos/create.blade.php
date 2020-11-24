@extends('layouts/app')

@section('title')
    Create a new Todos
@endsection

@section('content')
<h1 class="text-center my-5">CREATE A NEW TASK</h1>
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
            <form action="/store-todo" method="post">
                @csrf
                <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Task Title" value="">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" name="assignedto" placeholder="Task Assigned To" value="">
                </div>                
                <div class="form-group">
                        <textarea name="description" cols="5" rows="5" class="form-control" placeholder="Description"></textarea>
                </div>
                <label for="priority">Task priority: </label>
                <select id="priority" name="priority">                    
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>                    
                </select>                  
                <div class="form-group text-center">
                    <button type="submit" class="btn-success">Create</button>
                    <a class="btn-secondary" href="/">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
