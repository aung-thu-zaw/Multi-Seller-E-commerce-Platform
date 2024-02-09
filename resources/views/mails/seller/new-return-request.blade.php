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
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="font-sans antialiased">

    <div class="bg-gray-50 min-h-screen flex items-center justify-center px-3">
        <div class="lg:w-[900px] border bg-white shadow">
            <div class="py-5 font-semibold text-sm text-gray-700">
                <h3 class="font-bold w-full text-center my-10 text-gray-700 text-2xl uppercase">E-commerce Platform
                </h3>

                <div class="px-10 space-y-5">
                    <p class="font-bold">
                        Dear {{ $sellerName }},
                    </p>

                    <p>

                        A new cancellation request has been initiated by a customer for the order with <span
                            class="text-orange-600">
                            {{ $orderNo }}
                        </span>. Please review the details below:

                    </p>


                    <p class="text-sm font-bold">Details :</p>

                    <div class="space-y-3 flex flex-col items-start font-bold text-sm text-gray-800">
                        <div>
                            <span class="text-orange-600">
                                Request Type :
                            </span>
                            Return
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Order ID :
                            </span>
                            {{ $orderNo }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                User :
                            </span>
                            {{ $userName }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Reason :
                            </span>
                            {{ $reason }}
                        </div>
                    </div>

                    <p class="text-sm font-bold">Product details :</p>

                    <div class="space-y-3 flex flex-col items-start">
                        <div class="flex flex-col md:flex-row items-start">
                            <img src="{{ $item->product->image }}" alt="" class=" h-28 object-cover mr-3 mb-5">
                            <div class="mb-5 space-y-3">
                                <p class="text-md font-bold text-gray-700">
                                    {{ $item->product->name }}
                                </p>


                                @if ($item->attributes !== null)
                                    @php
                                        $attributes = is_array($item->attributes) ? $item->attributes : json_decode($item->attributes, true);
                                    @endphp

                                    @if (count($attributes))
                                        <p class="text-xs text-orange-500">
                                            @foreach ($attributes as $attribute => $value)
                                                {{ ucfirst($attribute) }}:
                                                {{ ucfirst($value) }}{{ !$loop->last ? ' | ' : '' }}
                                            @endforeach
                                        </p>
                                    @endif
                                @endif
                                <p class="text-xs">Quantity: {{ $returnItem->qty }}</p>
                                <p class="text-xs">Unit Price: $ {{ $returnItem->unit_price }}</p>
                                <p class="text-xs">Total: $ {{ $returnItem->total_price }}</p>
                            </div>
                        </div>
                    </div>


                    <p>
                        Please log in to your seller dashboard to view and respond to the request promptly.
                    </p>
                    <p>
                        Thank you for your attention.
                    </p>

                    <p class="text-sm font-bold text-gray-800">
                        Best regards,
                        <br>
                        E-commerce Team
                    </p>
                </div>

                <hr class="mt-5">
            </div>

            <p class="text-center text-sm font-bold text-gray-600 mb-5">
                This is an automatically generated e-mail.Please do not reply to this e-mail.
            </p>

        </div>
    </div>
</body>

</html>
