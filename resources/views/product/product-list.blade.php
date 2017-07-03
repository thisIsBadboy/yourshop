@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Products</h1>

                @forelse($products as $product)
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/700x400" alt="" class="img-responsive">

                            <div class="caption">
                              <h4 class="pull-right">TK {{ $product['price'] }}</h4>
                              <h4><a href="#">{{ $product['title'] }}</a></h4>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>

                            {{--
                            <div class="ratings">
                              <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                 (15 reviews)
                              </p>
                            </div>
                            --}}

                            <div class="btn-ground text-center">
                                <div class="row">
                                    <div class="col-lg-6">
                                    {{ Form::open(['method'=>'POST', 'route'=>['business.cart.store', $business]]) }}

                                        <input type="hidden" name="form[product_id]" value="{{ $product['id'] }}"/>

                                        <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
                                    {{ Form::close() }}
                                    </div>

                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#product_view"><i class="fa fa-search"></i> Quick View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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