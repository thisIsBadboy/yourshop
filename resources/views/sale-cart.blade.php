@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid" style="margin-bottom:20px;">

        {{ Form::open(['method'=>'POST', 'route'=>['business.sale_invoice.store', $business]]) }}

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sale Cart</h1>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th style="text-align:right;">Quantity</th>
                                        <th style="text-align:right;">Sub total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sale_cart['contents'] as $content)
                                    <tr>
                                        <td><img src="http://placehold.it/700x400" alt="" class="img-responsive" width="200" height="150"></td>
                                        <td>{{ $content['title'] }}</td>
                                        <td style="text-align:right;">{{ $content['qty'] }}</td>
                                        <td style="text-align:right;">{{ $content['subtotal'] }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;">Total Quantity = {{ $sale_cart['total_qty'] }}</td>
                                    <td style="text-align:right;">Total Amount = {{ $sale_cart['total_amount'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                
            </div>
            <!-- /.col-lg-12 -->

            <div class="col-lg-4 pull-right">
                <div class="form-group">
                    <label>Paid Amount: </label>
                    <input class="form-control" placeholder="Paid Amount" name="form[paid_amount]" type="text" >
                    <p>{{ $errors->first('paid_amount') }}</p>
                </div>

                <input type="submit" class="btn btn-lg btn-success btn-block" value="Create Invoice"/>
            </div>
        </div>
        <!-- /.row -->

        {{ Form::close() }}

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection