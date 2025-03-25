**Sample Product Creation**

use App\Models\Product;

Product::create(['name' => 'Laptop', 'price' => 800, 'stock_quantity' => 10]);
Product::create(['name' => 'Headphones', 'price' => 50, 'stock_quantity' => 20]);
Product::create(['name' => 'Mouse', 'price' => 25, 'stock_quantity' => 30]);


**Order Placing**

use Illuminate\Support\Facades\Http;

Http::post('http://127.0.0.1:8000/api/place-orders', [
    'items' => [
        ['product_id' => 2, 'quantity' => 2],
        ['product_id' => 3, 'quantity' => 2]
    ]
]);


**Order with items**

use App\Models\Order;

Order::with('items')->get();
