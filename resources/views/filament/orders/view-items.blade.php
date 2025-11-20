<table class="w-full text-left border border-gray-200">
    <thead>
    <tr class="bg-gray-100">
        <th class="p-2 border">Продукт</th>
        <th class="p-2 border">Количество</th>
        <th class="p-2 border">Цена</th>
        <th class="p-2 border">Итого</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td class="p-2 border">{{ $item->product->name }}</td>
            <td class="p-2 border">{{ $item->quantity }}</td>
            <td class="p-2 border">{{ $item->price }}</td>
            <td class="p-2 border">{{ $item->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
