<div class="pt-4">

    <h5 class="mb-3">The total amount of</h5>

    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Subtotal
            <span>${{ $subtotal }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
            Shipping
            <span>${{ $shipping }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Tax
            <span>${{ $tax }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
                <strong>The total amount: </strong>
            </div>
            <span><strong>${{ $total }}</strong></span>
        </li>
    </ul>

    <button type="button" class="btn btn-primary btn-block">go to checkout</button>

</div>
