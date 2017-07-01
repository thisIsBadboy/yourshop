@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Balance Sheet</h1>

                <h4 style="text-align:center;">
                    Asset (@if(isset($balance_sheet_bundle['left'])) {{ $balance_sheet_bundle['left']['info']['total'] }} @else {{0}} @endif)
                    =
                    Liability (@if(isset($balance_sheet_bundle['right']['group'][2])) {{ $balance_sheet_bundle['right']['group'][2]['info']['total'] }} @else {{0}} @endif)
                    +
                    Equity (@if(isset($balance_sheet_bundle['right']['group'][3])) {{ $balance_sheet_bundle['right']['group'][3]['info']['total'] }} @else {{0}} @endif)
                    +
                    Revenue (@if(isset($balance_sheet_bundle['right']['group'][4])) {{ $balance_sheet_bundle['right']['group'][4]['info']['total'] }} @else {{0}} @endif)
                    -
                    Expense (@if(isset($balance_sheet_bundle['right']['group'][5])) {{ $balance_sheet_bundle['right']['group'][5]['info']['total'] }} @else {{0}} @endif)
                    =
                    @if(isset($balance_sheet_bundle['right'])) {{ $balance_sheet_bundle['right']['info']['total'] }} @else {{0}} @endif
                </h4>
                
                <br/>

                @if(isset($balance_sheet_bundle['left']))
                    @foreach($balance_sheet_bundle['left']['group'] as $balance_bundle)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $balance_bundle['info']['name'] }}</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($balance_bundle['group'] as $bundle)
                            <h4 style="text-align:center;">{{ $bundle['info']['name'] }}</h4>
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
                                            <td style="text-align:right;">
                                            @if($account->account_balance < 0)
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
                            @endforeach
                        </div>

                        <div class="panel-footer" style="text-align:right;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <p>Total</p>
                                </div>

                                <div class="col-lg-4">
                                    <div style="width:45%; float:right;">
                                        <p>
                                        @if($balance_bundle['info']['total'] < 0)
                                        ({{ $balance_bundle['info']['total'] * -1 }})
                                        @else
                                        {{ $balance_bundle['info']['total'] }}
                                        @endif
                                        </p>
                                        <hr style="border:1px solid; margin:5px 0;" />
                                        <hr style="border:1px solid; margin:5px 0;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                @if(isset($balance_sheet_bundle['right']))
                    @foreach($balance_sheet_bundle['right']['group'] as $key => $balance_bundle)
                        @if($key == 2 || $key == 3)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $balance_bundle['info']['name'] }}</h3>
                            </div>
                            <div class="panel-body">
                                @foreach($balance_bundle['group'] as $bundle)
                                <h4 style="text-align:center;">{{ $bundle['info']['name'] }}</h4>
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
                                                <td style="text-align:right;">
                                                @if($account->account_balance < 0)
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
                                @endforeach
                            </div>

                            <div class="panel-footer" style="text-align:right;">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <p>Total</p>
                                    </div>

                                    <div class="col-lg-4">
                                        <div style="width:45%; float:right;">
                                            <p>
                                            @if($balance_bundle['info']['total'] < 0)
                                            ({{ $balance_bundle['info']['total'] * -1 }})
                                            @else
                                            {{ $balance_bundle['info']['total'] }}
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

                @if(isset($balance_sheet_bundle['right']))
                    @foreach($balance_sheet_bundle['right']['group'] as $key => $balance_bundle)
                        @if($key == 4 || $key == 5) {{-- Revenue = 4 && Expense = 5 --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $balance_bundle['info']['name'] }}</h3>
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
                                            
                                            @foreach($balance_bundle['group'] as $account)
                                            
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
                                                @if($balance_bundle['info']['total'] < 0)
                                                ({{ $balance_bundle['info']['total'] * -1 }})
                                                @else
                                                {{ $balance_bundle['info']['total'] }}
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
                                            @if($balance_bundle['info']['total'] < 0)
                                            ({{ $balance_bundle['info']['total'] * -1 }})
                                            @else
                                            {{ $balance_bundle['info']['total'] }}
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