@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default" style="margin-top:25%;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add your product</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['method'=>'POST', 'route'=>['business.product.store', $business]]) !!}
                            
                            {{-- csrf_field() --}}

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Product name" name="form[title]" type="text" >
                                    <p>{{ $errors->first('title') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <select class="form-control" name="form[category]">
                                        @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}">
                                            @for($i=0;$i<($category['level'] - 1);$i++)
                                            &nbsp;&nbsp;&nbsp;
                                            @endfor
                                            {{ $category['name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p>{{ $errors->first('category') }}</p>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Product price" name="form[price]" type="text" >
                                    <p>{{ $errors->first('price') }}</p>
                                </div>

                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Add"/>
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