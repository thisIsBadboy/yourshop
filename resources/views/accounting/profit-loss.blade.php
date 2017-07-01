@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profit & Loss</h1>

                <h4 style="text-align:center;">
                    @if($profit_loss_bundle['profit_loss']['info']['total'] >= 0)
                        Profit = {{ $profit_loss_bundle['profit_loss']['info']['total'] }}
                    @else
                        Loss = {{ $profit_loss_bundle['profit_loss']['info']['total'] }}
                    @endif
                </h4>

                <br/>

                @if(isset($profit_loss_bundle['profit_loss']))
                    @foreach($profit_loss_bundle['profit_loss']['group'] as $key => $bundle)
                        @if($key == 4 || $key == 5) {{-- Revenue = 4 && Expense = 5 --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $bundle['info']['name'] }}</h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Account Group</th>
                                                <th>Account Name</th>
                                                <th style="text-align:right;">Balance</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            
                                            @foreach($bundle['group'] as $account)
                                            
                                            <tr>
                                                <td>{{ $account->ancestor }}</td>
                                                <td>{{ $account->account_name }} ({{ $account->account_code }})</td>
                                                <td style="text-align:right;">@if($account->account_balance < 0)
                                                ({{ $account->account_balance * -1 }})
                                                @else
                                                {{ $account->account_balance }}
                                                @endif
                                                </td>
                                            </tr>
                                            
                                            @endforeach

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align:right;">
                                                @if($bundle['info']['total'] < 0)
                                                ({{ $bundle['info']['total'] * -1 }})
                                                @else
                                                {{ $bundle['info']['total'] }}
                                                @endif
                                                <hr style="border:1px solid; margin:5px 0;" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="panel-footer" style="text-align:right;">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <p>Total</p>
                                    </div>

                                    <div class="col-lg-4">
                                        <div style="width:45%; float:right;">
                                            <p>
                                            @if($bundle['info']['total'] < 0)
                                            ({{ $bundle['info']['total'] * -1 }})
                                            @else
                                            {{ $bundle['info']['total'] }}
                                            @endif
                                            </p>
                                            <hr style="border:1px solid; margin:5px 0;" />
                                            <hr style="border:1px solid; margin:5px 0;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection