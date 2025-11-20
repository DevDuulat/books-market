<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = json_decode($request->cart, true);
        session(['cart' => $cart]);

        return redirect()->route('checkout.index');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:500',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout.index')
                ->with('error', 'Корзина пуста');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => OrderStatus::Pending->value,
                'total' => collect($cart)->sum(fn ($i) => $i['price'] * $i['quantity']),
            ]);

            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                if ($product) {
                    $product->update([
                        'quantity' => $product->quantity - $item['quantity']
                    ]);
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            $chatId = env('TELEGRAM_CHAT_ID');
            $botToken = env('TELEGRAM_BOT_TOKEN');

            $message = "Новый заказ #{$order->id}\n"
                . "Имя: {$order->name}\n"
                . "Телефон: {$order->phone}\n"
                . "Адрес: {$order->address}\n"
                . "Сумма: {$order->total}\n"
                . "Товары:\n";

            foreach ($cart as $item) {
                $message .= "- " . $item['name'] . " x " . $item['quantity'] . " = " . ($item['price'] * $item['quantity']) . "\n";
            }

            // Логируем сообщение перед отправкой
            Log::info('Telegram message payload', [
                'chat_id' => $chatId,
                'text' => $message
            ]);

            $response = Http::get("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message
            ]);

            // Логируем ответ Telegram API
            Log::info('Telegram response', $response->json());

            session()->forget('cart');

            return redirect()
                ->route('orders.show', $order)
                ->with('success', 'Заказ успешно создан');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Ошибка при создании заказа или отправке Telegram', ['error' => $e->getMessage()]);
            throw $e;
        }
    }


}
