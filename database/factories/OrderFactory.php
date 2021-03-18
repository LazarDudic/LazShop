<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    public function configure()
    {
        return $this->afterCreating(function(Order $order) {
            $order->address()->create([
                'order_id' => $order->id,
                'address'  => $order->user->address->address,
                'city'     => $order->user->address->city,
                'state'    => $order->user->address->state,
                'country'  => $order->user->address->country,
                'zipcode'  => $order->user->address->zipcode,
            ]);

            $product = Product::find(rand(1,20));

            $order->orderItems()->create([
                'product_name' => $product->name,
                'product_id'   => $product->id,
                'unit_price'   => $product->price,
                'order_id'     => $order->id,
                'quantity'     => rand(1,5),
            ]);
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $total = $this->faker->randomFloat(2, 20, 5000);
        return [
            'total'          => $total,
            'subtotal'       => $total / 2,
            'tax'            => $total / 5,
            'shipping'       => $total / 20,
            'status'         => $this->faker->randomElement(['paid', 'shipped', 'delivered', 'refunded', 'dispute']),
            'email'          => $this->faker->email,
            'transaction_id' => rand(100000000, 10000000000000),
            'user_id'        => rand(1,10)
        ];
    }
}
