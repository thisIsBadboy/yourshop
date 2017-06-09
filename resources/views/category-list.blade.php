@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Categories</h1>

                <div>
                @forelse($categories as $category)
                <strong>
                	<p style="padding-left: {{ ($category['level'] - 1) * 20 }}px;">{{ $category['name'] }} 
                	<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                	<i class="fa fa-plus-circle" aria-hidden="true"></i>
                	<i class="fa fa-minus-circle" aria-hidden="true"></i>
                </p></strong>
                @empty
                <p>Your business has no category!</p>
                @endforelse
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection