<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/18c274e5f3.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js','resources/css/app.css'])



</head>

<body class="font-sans antialiased">

    <div class="bg-gray-50 min-h-screen flex items-center justify-center px-3">
        <div class="lg:w-[900px] border bg-white shadow">
            <div class="py-5 font-semibold text-sm text-gray-700">
                <h3 class="font-bold w-full text-center my-10 text-gray-700 text-2xl uppercase">E-commerce Platform
                </h3>

                <p class="text-center text-md font-semibold text-orange-600 mb-5">
                    Your order is placed!
                </p>

                <div class="px-10 space-y-5">
                    <p class="font-bold">
                        Dear {{ $order->user->name }},
                    </p>

                    <p>We are excited for you to receive your order
                        <span class="text-orange-600">
                            {{ $order->tracking_no}}
                        </span> and will
                        notify
                        you once its on its way. If you have ordered from multiple sellers, your items will be delivered
                        in
                        separate packages. We hope you had a great shopping experience! You can check your order status
                        <a href="#" class="text-orange-600 underline">
                            here.
                        </a>
                    </p>

                    <p>
                        Please note, we are unable to change your delivery address once your order is
                        placed.
                    </p>

                    <p>
                        Here's a confirmation of what you bought in your order.
                    </p>


                    <p class="text-sm font-bold">Delivery details :</p>

                    <div class="space-y-3 flex flex-col items-start font-bold text-sm text-gray-800">
                        <div>
                            <span class="text-orange-600">
                                Name
                            </span>
                            : {{ $address->name }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Email
                            </span> : {{ $address->email }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Phone
                            </span> :{{ $address->phone }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Address
                            </span> : {{ $address->address }}
                        </div>
                    </div>

                    <p class="text-sm font-bold">Order details :</p>

                    <div class="space-y-3 flex flex-col items-start">
                        @foreach ($order->orderItems as $item)
                        <div class="flex flex-col md:flex-row items-start">
                            <img src="{{ $item->product->image }}" alt="" class=" h-28 object-cover mr-3 mb-5">
                            <div class="mb-5 space-y-3">
                                <p class="text-md font-bold text-gray-700">
                                    {{ $item->product->name }}
                                </p>


                                @if ($item->attributes !== null)
                                @php
                                $attributes = is_array($item->attributes)
                                ? $item->attributes
                                : json_decode($item->attributes, true);
                                @endphp

                                @if (count($attributes))
                                <p class="text-xs text-orange-500">
                                    @foreach ($attributes as $attribute => $value)
                                    {{ ucfirst($attribute) }}: {{ ucfirst($value) }}{{ !$loop->last ? ' | ' : '' }}
                                    @endforeach
                                </p>
                                @endif
                                @endif

                                <p class="text-xs">Quantity: {{ $item->qty }}</p>
                                <p class="text-xs">Unit Price: $ {{ $item->unit_price }}</p>
                                <p class="text-xs">Total: $ {{ $item->total_price }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <p class="text-sm font-bold">Payment details :</p>

                    <div class="space-y-3 flex flex-col items-start font-bold text-sm text-gray-800">
                        <div>
                            <span class="text-orange-600">
                                Subtotal
                            </span>
                            : $ {{ $order->orderItems->sum('total_price') }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Shipping Fee
                            </span> : $ {{ $order->shipping_fee }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Payment Type
                            </span> : {{ Str::camel($order->payment_method) }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Total
                            </span> : $ {{ $order->total_amount }}
                        </div>
                    </div>

                    <p>
                        If you have any questions or need assistance, please feel free to reach out to our support team.
                    </p>

                    <p class="text-sm font-bold text-gray-800">
                        Sincerely,
                        <br>
                        E-commerce Team
                    </p>
                </div>

            </div>

            <div class="w-full bg-orange-600 text-white text-sm my-5 p-3">
                <p class="font-bold text-center">Still have questions?
                    <a :href="route('help-center')" class="underline hover:animate-bounce">
                        Go to help center
                    </a>
                </p>
            </div>

            <div class="flex items-center justify-center mt-3">
                <a href="#" class="text-gray-800 hover:text-blue-600 font-bold text-2xl mx-3">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="#" class="text-gray-800 hover:text-pink-600 font-bold text-2xl mx-3">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" class="text-gray-800 hover:text-sky-600 font-bold text-2xl mx-3">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="#" class="text-gray-800 hover:text-red-600 font-bold text-2xl mx-3">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </div>

            <p class="text-center text-sm font-bold text-gray-700 mb-5">This is an automatically generated e-mail.
                Please do
                not reply to this e-mail.
            </p>

        </div>
    </div>
</body>

</html>