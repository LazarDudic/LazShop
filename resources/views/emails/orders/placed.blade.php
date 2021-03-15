@component('mail::message')
# Order Placed
Order items:
<table style="width:100%; text-align: center" border="1px solid black">
<tr>
<th scope="col">Name</th>
<th scope="col">Quantity</th>
<th scope="col">Unit Price</th>
</tr>
@foreach($order->orderItems as $item)
<tr>
<td>{{ $item->product_name }}</td>
<td>{{ $item->quantity }}</td>
<td>${{ $item->unit_price }}</td>
</tr>
@endforeach
</table>

<ul>
<li>Subtotal: ${{ $order->subtotal }}</li>
<li>Tax: ${{ $order->tax }}</li>
<li>Shipping: ${{ $order->shipping }}</li>
<li>Total: <strong>${{ $order->total }}</strong></li>
</ul>

@component('mail::button', ['url' => route('user-orders.show', $order->id)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

