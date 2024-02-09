<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Order Invoice</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/js/app.js','resources/css/app.css'])
</head>

<body>

    <div>
        <div class="border bg-white rounded-md shadow p-10">
            <div id="print-document" class="space-y-5 mb-10">
                <div>
                    <h2 class="font-bold text-md text-gray-700 mb-6">
                        Order Invoice -
                        <span class="text-orange-600 text-xs font-bold">{{ $order->invoice_no }}</span>
                    </h2>

                    <div class="space-y-5 flex items-start justify-between">
                        <div class="space-y-1 font-bold text-gray-900">
                            <h3 class="text-md mb-1.5 text-gray-800">Payment Information</h3>
                            <p class="text-xs capitalize">
                                Method : <span class="text-gray-600">{{ $order->payment_method }}</span>
                            </p>
                            <p class="text-xs">
                                Transaction Id :
                                <span class="text-gray-600">
                                    {{ $order->transaction ? $order->transaction->transaction_id : '-' }}
                                </span>
                            </p>
                            <p class="text-xs capitalize">
                                Status :
                                <span class="text-gray-600">{{ $order->payment_status }}</span>
                            </p>
                        </div>
                        <div class="space-y-1 font-bold text-gray-700 text-right">
                            <h3 class="text-md mb-1.5">Order Date</h3>
                            <p class="text-xs capitalize">{{ $order->created_at }}</p>
                        </div>
                    </div>
                </div>

                <hr />
                <div>
                    <h2 class="font-bold text-md text-gray-700 mb-3">
                        <i class="fa-solid fa-clipboard-list"></i>
                        Order Summary
                    </h2>
                </div>


                <div>
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="border rounded-lg overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-600">
                                                    Item
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-600">
                                                    Attributes
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-600">
                                                    Price
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-600">
                                                    Qty
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-600">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $item->product->name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 capitalize">
                                                    @if ($item->attributes)
                                                    {{ $item->attributes }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $item->unit_price }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $item->qty }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $item->total_price }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="w-full flex flex-col items-end justify-center font-semibold text-gray-500 text-xs space-y-5">
                    <div class="space-y-1">
                        <p>Subtotal</p>
                        <p class="text-sm font-bold text-gray-700">
                            ${{ $order->total_amount - $order->shipping_fee }}
                        </p>
                    </div>
                    <div class="space-y-1">
                        <p>Shipping Fee (+)</p>
                        <p class="text-sm font-bold text-gray-700">
                            ${{ $order->shipping_fee }}
                        </p>
                    </div>
                    <div class="space-y-1">
                        <p>Coupon (-)</p>
                        @if ($order->coupon_code && $order->coupon_type)

                        <p class="text-sm font-bold text-gray-700">
                            @if ($order->coupon_type === 'fixed')
                            <span>
                                ${{ $order->coupon_amount }}
                            </span>
                            @endif
                            @if ($order->coupon_type === 'percentage')
                            <span>
                                %{{ $order->coupon_amount }}
                            </span>
                            @endif
                        </p>
                        @else
                        <p class="text-sm font-bold text-gray-700">$ 0</p>
                        @endif


                    </div>
                    <div class="space-y-1">
                        <p>Total</p>
                        <p class="text-sm font-bold text-gray-700">
                            ${{ $order->total_amount }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>