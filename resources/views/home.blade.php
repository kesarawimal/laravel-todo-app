@extends('layouts.app')

@section('css')
    <style>
        .addition {
            margin-bottom: 40px;
        }

        .btn-addition {
            margin-top: 10px;
        }

        .token {
            margin-top: 40px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if(\Request::route()->getName() == "add")
            <div class="row justify-content-center addition">
                <div class="col-md-4">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Task Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn w-100 btn-primary btn-addition">Add</button>
                    </form>
                </div>
            </div>
        @endif

        @if(\Request::route()->getName() == "edit")
            <div class="row justify-content-center addition">
                <div class="col-md-4">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Task Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="3">{!! $edit->description !!}</textarea>
                        </div>
                        <button type="submit" class="btn w-100 btn-primary btn-addition">Edit</button>
                    </form>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                {{ __('To Do') }}
                            </div>
                            <div class="col-md-4">
                                <a href="/home/add">add</a>
                            </div>
                        </div>
                    </div>
                    @foreach($tasks as $task)
                        @if ($task->status == 0)
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <form action="/home/status/{{$task->id}}" method="post">
                                                        @csrf
                                                        <input class="form-check-input" onChange="this.form.submit()"
                                                               type="checkbox" name="status">
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6 float-lg-end">
                                                <a href="/home/edit/{{$task->id}}">edit</a>
                                                <a href="/home/delete/{{$task->id}}">delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {!! $task->description !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Done') }}</div>
                    @foreach($tasks as $task)
                        @if ($task->status == 1)
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <form action="/home/status/{{$task->id}}" method="post">
                                                        @csrf
                                                        <input class="form-check-input" onChange="this.form.submit()"
                                                               type="checkbox" name="status" checked>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6 float-lg-end">
                                                <a href="/home/edit/{{$task->id}}">edit</a>
                                                <a href="/home/delete/{{$task->id}}">delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {!! $task->description !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-md-5 token">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                {{ __('Personal Access Token') }}
                            </div>
                            <div class="col-md-4">
                                <a href="/home/token">reveal</a>
                            </div>
                        </div>
                    </div>
                    @if(\Request::route()->getName() == "token")
                    <div class="card-body">
                        {!! Auth::user()->createToken('MyApp')->plainTextToken !!}
                    </div>
                    @endif
                </div>
        </div>
    </div>
@endsection
