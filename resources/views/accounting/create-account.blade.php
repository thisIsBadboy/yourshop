@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default" style="margin-top:25%;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create Account</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['method'=>'POST', 'route'=>['business.account.store', $business]]) !!}
                            
                            {{-- csrf_field() --}}

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Account name" name="form[account_name]" type="text" >
                                    <p>{{ $errors->first('name') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <select class="form-control" name="form[account_type]">
                                        @foreach($account_types as $type)
                                        <option value="{{ $type['id'] }}">
                                            @for($i=0;$i<($type['level'] - 1);$i++)
                                            &nbsp;&nbsp;&nbsp;
                                            @endfor
                                            {{ $type['name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p>{{ $errors->first('account_type') }}</p>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Account code" name="form[account_code]" type="text" >
                                    <p>{{ $errors->first('account_code') }}</p>
                                </div>

                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Create"/>
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection