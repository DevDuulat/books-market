<h1 class="text-xl font-bold mb-4">
    Заказ №{{ $order->id }}
</h1>

<p>Статус: {{ $order->status->label() }}</p>
<p>Итого: {{ number_format($order->total, 2) }}</p>

<table class="w-full mt-4 border">
    @foreach($order->items as $item)
        <tr>
            <td class="border p-2">{{ $item->product->name ?? 'Товар' }}</td>
            <td class="border p-2">{{ $item->quantity }}</td>
            <td class="border p-2">{{ number_format($item->price, 2) }}</td>
            <td class="border p-2">{{ number_format($item->total, 2) }}</td>
        </tr>
    @endforeach
</table>
