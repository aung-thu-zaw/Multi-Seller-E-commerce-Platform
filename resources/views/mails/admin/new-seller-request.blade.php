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
                        Dear Admin,
                    </p>

                    <p>
                        A new seller request has been submitted on Our E-commerce Platform. Here are the details:
                    </p>


                    <p class="text-sm font-bold">User Details :</p>

                    <div class="space-y-3 flex flex-col items-start font-bold text-sm text-gray-800">
                        <div>
                            <span class="text-orange-600">
                                Id
                            </span>
                            : {{ $id }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Name
                            </span> : {{ $name }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Email
                            </span> : {{ $email }}
                        </div>
                    </div>
                    <p class="text-sm font-bold">Store Details :</p>

                    <div class="space-y-3 flex flex-col items-start font-bold text-sm text-gray-800">
                        <div>
                            <span class="text-orange-600">
                                Store Name
                            </span>
                            : {{ $store_name }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Store Type
                            </span> : {{ $store_type }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Contact Email
                            </span> : {{ $contact_email }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Contact Phone
                            </span> : {{ $contact_phone }}
                        </div>
                        <div>
                            <span class="text-orange-600">
                                Additional Information
                            </span> : {{$additional_information}}
                        </div>
                    </div>
                    <p>
                        Please log in to the admin dashboard to review and process the request. You can find more
                        details
                        and take action on the seller request from there.
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
