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
                                <th>Debit Amount</th>
                                <th>Credit Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($bundle['accounts'] as $key=>$account)
                            <tr>
                                <td>{{ $account->ancestor }}</td>
                                <td>{{ $account->account_name }} ({{ $account->account_code }})</td>
                                <td>{{ $account->debit_amount }}</td>
                                <td>{{ $account->credit_amount }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $bundle['total_debit'] }}</td>
                                <td>{{ $bundle['total_credit'] }}</td>
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