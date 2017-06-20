@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Account Configuration</h1>

                {{ Form::open(['method'=>'PUT', 'route'=>['business.account_configuration.update', $business, $account_settings['sale_cash_dr']['configuration_id'] ]]) }}

                <div class="form-group">
                    <label>Debit Cash Account </label>
                    <select class="form-control" name="form[account_id]">
                    @foreach($chart_of_accounts as $account)
                        <option value="{{ $account['id'] }}" @if($account_settings['sale_cash_dr']['account_id'] == $account['id']) selected @endif>{{ $account['name'] }} ({{ $account['code'] }})</option>
                    @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-md btn-success btn-block" value="Update"/>

                {{ Form::close() }}

                {{ Form::open(['method'=>'PUT', 'route'=>['business.account_configuration.update', $business, $account_settings['sale_cash_cr']['configuration_id'] ]]) }}

                <div class="form-group">
                    <label>Credit Cash Account </label>
                    <select class="form-control" name="form[account_id]">
                    @foreach($chart_of_accounts as $account)
                        <option value="{{ $account['id'] }}" @if($account_settings['sale_cash_cr']['account_id'] == $account['id']) selected @endif>{{ $account['name'] }} ({{ $account['code'] }})</option>
                    @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-md btn-success btn-block" value="Update"/>

                {{ Form::close() }}

                {{ Form::open(['method'=>'PUT', 'route'=>['business.account_configuration.update', $business, $account_settings['sale_due_dr']['configuration_id'] ]]) }}

                <div class="form-group">
                    <label>Debit Due Account </label>
                    <select class="form-control" name="form[account_id]">
                    @foreach($chart_of_accounts as $account)
                        <option value="{{ $account['id'] }}" @if($account_settings['sale_due_dr']['account_id'] == $account['id']) selected @endif>{{ $account['name'] }} ({{ $account['code'] }})</option>
                    @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-md btn-success btn-block" value="Update"/>

                {{ Form::close() }}

                {{ Form::open(['method'=>'PUT', 'route'=>['business.account_configuration.update', $business, $account_settings['sale_due_cr']['configuration_id'] ]]) }}

                <div class="form-group">
                    <label>Credit Due Account </label>
                    <select class="form-control" name="form[account_id]">
                    @foreach($chart_of_accounts as $account)
                        <option value="{{ $account['id'] }}" @if($account_settings['sale_due_cr']['account_id'] == $account['id']) selected @endif>{{ $account['name'] }} ({{ $account['code'] }})</option>
                    @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-md btn-success btn-block" value="Update"/>

                {{ Form::close() }}

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection