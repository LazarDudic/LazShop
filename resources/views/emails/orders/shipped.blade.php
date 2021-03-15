@component('mail::message')
# Order Shipped at {{ $order->shippingDates->shipped_at }}

# Estimated time of delivery at {{ $order->shippingDates->deliver_at }}

@component('mail::button', ['url' => route('user-orders.show', $order->id)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
