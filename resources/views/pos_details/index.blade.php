@extends('layouts.app')

@section('content')
<div class="container">
    <h2>POS Invoice Details</h2>
    <a href="{{ route('pos_details.create') }}" class="btn btn-primary mb-3">Add Detail</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>POS ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Sale Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
            <tr>
                <td>#{{ $detail->pos->id ?? 'N/A' }}</td>
                <td>{{ $detail->product->title ?? 'N/A' }}</td>
                <td>{{ $detail->qty }}</td>
                <td>{{ $detail->sale_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $details->links() }}
</div>
@endsection
