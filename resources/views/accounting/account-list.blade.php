@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Accounts</h1>

                @forelse($chart_of_accounts as $account)
                    <li>{{ $account['name'] }}</li>
                @empty
                    <p>Your business has no account!</p>
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