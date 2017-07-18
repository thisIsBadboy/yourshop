@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sale Invoices</h1>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Total Amount</th>
                                <th>Total Quantity</th>
                                <th>Total Paid Amount</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale_invoice as $key=>$invoice)
                            <tr>
                                <td><a href="/business/{{ $business->id }}/sale_invoice/{{ $invoice->id }}">{{ $key+1 }}</a></td>
                                <td>{{ $invoice->total_amount }}</td>
                                <td>{{ $invoice->total_qty }}</td>
                                <td>{{ $invoice->total_paid_amount }}</td>
                                <td>{{ Carbon\Carbon::parse($invoice->created_at)->format('M d, Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($invoice->updated_at)->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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