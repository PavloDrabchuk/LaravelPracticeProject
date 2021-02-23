<h3>Order information</h3>

<div>
    <h4>Name: {{ $cart->user->name }}</h4>
    <h3>Items:</h3>
    <table border="1" cellspacing="0" cellpadding="5px">
        <tr>
            <th>#</th>
            <th>Tour</th>
            <th>Quantity</th>
            <th>Price (x1)</th>
            <th>Cost</th>
        </tr>
        @foreach($cart->cartItems as $cartItem)
            <tr>
                <td>{{($loop->index)+1}}</td>
                <td>{{$cartItem->product->name}}</td>
                <td>{{$cartItem->quantity}}</td>
                <td>{{$cartItem->product->prices->first()->value}}</td>
                <td>{{$cartItem->product->prices->first()->value * $cartItem->quantity}}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4">Total</th>
            <th>{{$totalCost}}</th>
        </tr>
    </table>
</div>

