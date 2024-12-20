<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Pesanan Anda</h1>

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="text-left font-bold border-b-2">
                    <th class="px-4 py-2">Produk</th>
                    <th class="px-4 py-2">Nama Produk</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Tanggal Pemesanan</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b">
                        <td class="px-4 py-2 flex items-center">
                            @php
                                $quantity = 0;
                            @endphp
                            @foreach ($order->orderItems as $item)
                            @php
                                $quantity += $item->quantity
                            @endphp
                                <a href="{{ route('product.details', $item->product->id) }}"><img
                                        src="{{ asset('storage/'.$item->product->image) }}" class="w-20 h-20 mr-4 rounded"></a>
                            @endforeach
                        </td>
                        <td class="px-4 py-2">
                           <ul>
                            @foreach ($order->orderItems as $item)
                                <li>
                                    <a href="{{ route('product.details', $item->product->id) }}">
                                      -  {{ $item->product->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        </td>
                        <td class="px-4 py-2">{{ $order->status }}</td>
                        <td class="px-4 py-2">Rp. {{ number_format($order->total, 2, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $order->created_at->format('d F Y') }}</td>
                        <td class="px-4 py-2">{{ $quantity }}</td>
                        <td class="px-4 py-2">
                            <a href="{{route('invoice', $order)}}" class="bg-orange-500 text-white px-4 py-2 font-semibold rounded-full">
                                Lihat Detail</a>
                            
                            @if($order->status == 'pending')
                                <form action="{{ route('order.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 font-semibold rounded-full mt-2">
                                        Pesan Diterima
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</x-app-layout>
