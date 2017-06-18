@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Journal Items</h1>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Name</th>
                                <th>Amount</th>
                                <th>Entry Type</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($journal_items as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->account_name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>
                                @if($item->entry_type == 'dr') 
                                    {{ 'debit' }} 
                                @elseif($item->entry_type == 'cr') 
                                    {{ 'credit' }}
                                @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($item->updated_at)->format('M d, Y') }}</td>
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