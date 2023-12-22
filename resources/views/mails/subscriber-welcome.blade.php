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
                <h3 class="font-bold w-full text-center my-10 text-gray-800 text-2xl uppercase">E-commerce Platform
                </h3>


                <div class="px-10">
                    <p class="text-md font-semibold text-gray-800 mb-5">
                        Hi there,
                    </p>

                    <p>
                        Thank you for subscribing to our newsletter! We are thrilled to have you as part of our
                        community. As a valued subscriber, you will be the first to receive updates on our latest
                        products, exclusive promotions, and exciting news.
                    </p>
                    <br>
                    <p>
                        Here's what you can expect from our newsletter:
                    </p>
                    <br>
                    <p>
                        Product Highlights: Get a sneak peek at our newest product releases and discover exciting
                        features and enhancements.
                    </p>
                    <br>
                    <p>
                        Exclusive Offers: Enjoy special discounts and exclusive offers available only to our newsletter
                        subscribers.
                    </p>
                    <br>
                    <p>
                        Expert Tips and Insights: Stay informed with helpful tips, industry insights, and expert advice
                        related to our products and services.
                    </p>
                    <br>
                    <p>
                        We respect your privacy, and you can rest assured that we will never share your email address
                        with third parties. If at any time you wish to unsubscribe from our newsletter, you can easily
                        do so by clicking the "Unsubscribe" link at the bottom of our emails.
                    </p>
                    <br>
                    <p>
                        If you have any questions or need assistance, please don't hesitate to reach out to our customer
                        support team. We're here to help!. <span class="font-bold text-blue-600 ">
                            "support@globalecommerce.com"
                        </span>
                    </p>
                    <br>
                    <p>
                        Thank you again for subscribing. We look forward to providing you with valuable content and
                        exciting offers.
                    </p>
                    <br>

                    <p class="text-sm font-bold text-gray-800">
                        Best regards,
                        <br>
                        E-commerce Team
                    </p>
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
            </div>

            <p class="text-center text-sm font-bold text-gray-600 mb-5">
                This is an automatically generated e-mail.Please do not reply to this e-mail.
            </p>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

</body>

</html>