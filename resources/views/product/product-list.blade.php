@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Products</h1>

                @forelse($products as $product)
                    <li>{{ $product['title'] }}</li>
                    {{ Form::open(['method'=>'POST', 'route'=>['business.cart.store', $business]]) }}

                        <input type="hidden" name="form[product_id]" value="{{ $product['id'] }}"/>

                        <input type="submit" class="btn btn-sm btn-success" value="Add to cart"/>
                    {{ Form::close() }}
                @empty
                    <p>Your business has no product!</p>
                @endforelse
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection