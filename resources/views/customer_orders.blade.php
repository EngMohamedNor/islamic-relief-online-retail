@extends('layout')

@section('title', 'Products')

@section('content')
 
<h3>My Orders</h3>

    <div class="container products">

        <table class="table table-bordered">

        <thead>
            <tr>
                <th> Order # </th>
                <th> Order Date </th>
                <th> Payment Method </th>
                <th> Order Status </th>
                <th>..</th>
            </tr>
            
</thead><tbody>
            @foreach($orders as $order)

            <tr>
                <td> {{ $order->id }} </td>
                <td> {{ $order->order_date }} </td>
                <td> {{ $order->payment_method }} </td>
                <td> {{ $order->status }} </td>
                
                <td>  <a href='/orders/receipt/{{ $order->id }}'  display:inline;' class='btn btn-info'>View Receipt</a> 
</th>
            </tr>
                
            @endforeach
</tbody>
        </table><!-- End row -->

    </div>

@endsection