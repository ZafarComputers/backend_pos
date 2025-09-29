@extends('layouts.app')

@section('content')
<div class="container">
    <h2>POS Returns</h2>
    <a href="{{ route('pos_returns.create') }}" class="btn btn-primary mb-3">Add Return</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Return Date</th>
                <th>POS Invoice No</th>
                <th>Return Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $ret)
            <tr>
                <td>{{ $ret->customer->name ?? 'N/A' }}</td>
                <td>{{ $ret->invRet_date }}</td>
                <td>{{ $ret->pos_inv_no }}</td>
                <td>{{ $ret->return_inv_amout }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $returns->links() }}
</div>
@endsection
