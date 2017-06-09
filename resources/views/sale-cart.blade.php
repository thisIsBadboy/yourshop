@extends('master2')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sale Cart</h1>

                @forelse($contents as $content)
                    <li>{{ $content['title'] }} ({{ $content['qty'] }}) -- TK {{ $content['subtotal'] }}</li>
                @empty
                    <p>Your sale cart has no product!</p>
                @endforelse

                <p>Total = {{ Cart::instance($business->id)->total }}</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection