@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Journal Entries</h1>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Debit Amount</th>
                                <th>Credit Amount</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($journal_entries as $key=>$entry)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $entry->debit_amount }}</td>
                                <td>{{ $entry->credit_amount }}</td>
                                <td>{{ Carbon\Carbon::parse($entry->created_at)->format('d-M-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($entry->updated_at)->format('d-M-Y') }}</td>
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