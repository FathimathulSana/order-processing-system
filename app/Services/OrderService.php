<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class OrderService
{
    public function orderPlace($orderData)
    {
        return DB::transaction(function () use ($orderData) {
            $orderNumber = 'ORD' . strtoupper(Str::random(6));

            // Order creation
            $order = Order::create([
                'order_number' => $orderNumber,
                'total_price' => 0,
            ]);
            $totalPrice = 0;
            foreach ($orderData['items'] as $item) {
                $product = Product::find($item['product_id']);

                if (!$product) {
                    return response()->json(['success' => false, 'err_msg' => 'Product not found']);
                }

                if ($product->stock_quantity < $item['quantity']) {
                    return response()->json(['success' => false, 'err_msg' => "{$product->name} is out of stock."]);
                }

                $product->decrement('stock_quantity', $item['quantity']);

                // Store order items
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $product->price,
                ]);

                $totalPrice += $product->price * $item['quantity'];
            }

            // total price updation
            $order->update(['total_price' => $totalPrice]);

            return $order->load('items');
        });
    }
}
