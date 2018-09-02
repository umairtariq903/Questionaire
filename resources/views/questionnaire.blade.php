@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">QUESTIONNAIRE</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Number of Questions</th>
                            <th>Duration</th>
                            <th>Resumable</th>
                            <th colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($questionnaires as $quest)
                              <tr>
                                <td>{{$quest['id']}}</td>
                                <td>{{$quest['questionnairename']}}</td>
                                <td>{{$quest['total']}}|<a  href="{{url('/addquestion/'.$quest['id'])}}">Add</a></td>
                                <td>{{$quest['duration']}}</td>
                                <td>{{$quest['resumable']}}</td>
                                
                                <td><a href="{{url('/edit/'.$quest['id'])}}"  class="btn btn-warning">Edit</a></td>
                                <td>
                                  <form  action="{{url('/destroy')}}" method="post">
                                    @csrf
                                    <input name="id" type="hidden" value="{{$quest['id']}}">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                  </form>
                                </td>
                              </tr>
                              @endforeach
                              <tr><a href="{{url('/Questionnaire/create')}}"  class="btn btn-primary">Add Questionnaire</a></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
