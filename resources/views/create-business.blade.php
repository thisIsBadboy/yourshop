@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" style="margin-top:25%;">
                <div class="panel-heading">
                    <h3 class="panel-title">Create your business</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['method'=>'POST', 'route'=>'business.store']) !!}
                        
                        {{ csrf_field() }}

                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Business name" name="form[name]" type="text" >
                                <p>{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Business Description" name="form[description]"></textarea>
                                <p>{{ $errors->first('description') }}</p>
                            </div>
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Create"/>
                        </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection