@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ADD QUESTIONS</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/addquestion') }}"  aria-label="{{ __('Create') }}">
                        @csrf
                        <input  type="hidden"  name="id" value="{{$id}}">
                        <div id="custom">
                            <div class="form-group row">
                                <label for="type" class="col-sm-4 col-form-label text-md-right">{{ __('Question Type') }}</label>

                                <div class="col-md-6" name="test">
                                    <select name="questiontype[]" class="form-group" onchange="changevalue(event);">
                                      <option>Select Type</option>
                                      <option value="mcq">Multiple Choice Qquestion</option>
                                      <option value="text">Text</option> 
                                    </select>
                                    <a href="#" class="col-md-8" onclick="deletequestion(event);">Delete Question</a>

                                </div>
                                <div name='next'></div>
                                
                                
                            </div>
                        </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a href="#" onclick="addcustomquestion();">Add Question</a>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" >
                                        {{ __('Save') }}
                                    </button>

                                    
                                </div>
                            </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //console.log('hello');
    function changevalue(e){
        e = e || window.event;
        var target = e.target || e.srcElement;
        var parent = e.target.parentNode;
        var siblings=e.target.parentNode.nextElementSibling;
        console.log(siblings);

         questiontype=target.value;

        // // alert(questiontype);
        if(questiontype=="text")
        {
            // parent.empty();
            siblings.innerHTML='<div class="form-group row"><label for="Question" class="col-sm-4 col-form-label text-md-right">{{ __("Question") }}</label><div class="col-md-12"><input  type="text" class="form-control" name="question[]" value="" required autofocus></div></div><div class="form-group row"><label for="Answer" class="col-sm-4 col-form-label text-md-right">{{ __("Answer") }}</label><div class="col-md-12"><input  type="text" class="form-control" name="correct[]" value="" required autofocus><input  type="hidden" class="form-control" name="choice1[]" value=""><input  type="hidden" class="form-control" name="choice2[]" value=""><input  type="hidden" class="form-control" name="choice3[]" value=""></div></div>';
        }
        if(questiontype=="mcq")
        {
            // parent.empty();
            siblings.innerHTML='<div class="form-group row"><label for="Question" class="col-sm-4 col-form-label text-md-right">{{ __("Question") }}</label><div class="col-md-12"><input  type="text" class="form-control questions" name="question[]" value="" required autofocus></div></div><div class="form-group row"><label for="Choice1" class="col-sm-4 col-form-label text-md-right">{{ __("Choice1") }}</label><div class="col-md-12"><input  type="text" class="form-control" name="choice1[]" value="" required autofocus><input type="radio" name="correct[]" value="1">Correct<a href="#" class="col-md-8" onclick="deletechoice(event);">Delete Choice</a></div></div><div class="form-group row"><label for="Choice2" class="col-sm-4 col-form-label text-md-right">{{ __("Choice2") }}</label><div class="col-md-12"><input  type="text" class="form-control" name="choice2[]" value="" required autofocus><input type="radio" name="correct[]" value="1">Correct<a href="#" class="col-md-8" onclick="deletechoice(event);">Delete Choice</a></div></div><div class="form-group row"><label for="Choice3" class="col-sm-4 col-form-label text-md-right">{{ __("Choice3") }}</label><div class="col-md-12"><input  type="text" class="form-control" name="choice3[]" value="" required autofocus><input type="radio" name="correct[]" value="1">Correct<a href="#" class="col-md-8" onclick="deletechoice(event);">Delete Choice</a></div></div>';
        }
        

    }
    function addcustomquestion()
    {
        
        // $("#custom").append('hello');
        $("#custom").append('<div class="form-group row"><label for="type" class="col-sm-4 col-form-label text-md-right">{{__("QuestionType") }}</label><div class="col-md-6"><select  name="questiontype[]" class="form-group" onchange="changevalue();"><option>Select Type</option><option value="mcq">Multiple Choice Qquestion</option><option value="text">Text</option> </select><a href="#" class="col-md-8" onclick="deletequestion(event);">Delete Question</a></div><div></div></div>');
        
    }
    function deletequestion(e)
    {
        e = e || window.event;
        var target = e.target || e.srcElement;
        var parent = e.target.parentNode.parentNode;
        parent.remove(parent);
    }
    function deletechoice(e)
    {
        e = e || window.event;
        var target = e.target || e.srcElement;
        var parent = e.target.parentNode.parentNode;
        parent.remove(parent);
    }
    function submitdata()
    {
        var values=$("input[name='question']").map(function(){return $(this).val();}).get();
        console.log(values);
    }
    // $('#questiontype').change(function(){
    //     alert("The text has been changed.");
    // });
</script>
@endsection
