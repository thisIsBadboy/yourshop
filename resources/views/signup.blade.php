@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" style="margin-top:25%;">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign Up</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="sign_me_up">
                        
                        {{ csrf_field() }}

                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="First name" name="form[fname]" type="text" >
                                <p>{{ $errors->first('fname') }}</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="form[email]" type="email" >
                                <p>{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="form[password]" type="password">
                                <p>{{ $errors->first('password') }}</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Confirm password" name="form[password_confirmation]" type="password">
                            </div>
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Signup"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection