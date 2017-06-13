@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

        {{ Form::open(['method'=>'POST', 'route'=>['business.sale_invoice.store', $business]]) }}

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sale Cart</h1>

                @forelse($sale_cart['contents'] as $content)
                    <li>{{ $content['title'] }} ({{ $content['qty'] }}) -- TK {{ $content['subtotal'] }}</li>
                @empty
                    <p>Your sale cart has no product!</p>
                @endforelse

                <p>Total = {{ $sale_cart['total_amount'] }}</p>
            </div>
            <!-- /.col-lg-12 -->

            <div class="form-group">
                <label>Paid Amount: </label>
                <input class="form-control" placeholder="Paid Amount" name="form[paid_amount]" type="text" >
                <p>{{ $errors->first('paid_amount') }}</p>
            </div>

            <input type="submit" class="btn btn-lg btn-success btn-block" value="Create Invoice"/>
        </div>
        <!-- /.row -->

        {{ Form::close() }}

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection