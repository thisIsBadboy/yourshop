@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Trial Balance</h1>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Account Group</th>
                                <th>Account Name</th>
                                <th style="text-align:right;">Debit Amount</th>
                                <th style="text-align:right;">Credit Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($bundle['accounts'] as $key=>$account)
                            <tr>
                                <td>{{ $account->ancestor }}</td>
                                <td>{{ $account->account_name }} ({{ $account->account_code }})</td>
                                <td style="text-align:right;">{{ $account->debit_amount }}</td>
                                <td style="text-align:right;">{{ $account->credit_amount }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;">
                                    {{ $bundle['total_debit'] }}
                                    <hr style="border: 1px solid; margin:5px 0;">
                                    <hr style="border: 1px solid; margin:5px 0;">
                                </td>
                                <td style="text-align:right;">
                                    {{ $bundle['total_credit'] }}
                                    <hr style="border: 1px solid; margin:5px 0;">
                                    <hr style="border: 1px solid; margin:5px 0;">
                                </td>
                            </tr>
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