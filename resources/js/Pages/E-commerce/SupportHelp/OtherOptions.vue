<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head :title="__('Options')" />

  <AppLayout>
    <div class="max-w-[85rem] px-14 py-14 mx-auto">
      <div class="flex items-center justify-center">
        <img src="../../../assets/images/support.png" class="h-72" />
      </div>
      <div class="text-center text-gray-700">
        <h1 class="font-semibold my-5 text-md">
          {{ __("Sorry no agents are available right now.") }}
        </h1>
        <p class="text-sm">
          {{ __("We apologize for any inconvenience") }}
        </p>
        <p class="mb-3 text-sm">
          {{ __("Please consider one of the following options") }}:
        </p>

        <ul class="space-y-3 text-sm">
          <li>
            <strong>1. {{ __("Send an email") }}:</strong><br />
            You can send us an email at
            <span class="text-orange-600 font-bold">support@example.com</span>.
          </li>
          <li>
            <strong>2. {{ __("Fill out a contact form") }}:</strong><br />
            Visit our
            <a href="#" class="text-orange-600 font-bold underline">
              Contact Us
            </a>
            page and fill out the contact form.
          </li>

          <li>
            <strong>3. {{ __("Visit our help center") }}:</strong><br />
            You can find answers to common questions in our
            <a href="#" class="text-orange-600 font-bold underline">
              Help Center </a
            >.
          </li>
          <li>
            <strong>4. {{ __("Check our faqs") }}:</strong><br />
            Frequently Asked Questions (FAQs) are available
            <a href="#" class="text-orange-600 font-bold underline"> here </a>.
          </li>
          <li>
            <strong>5. {{ __("Call us") }}:</strong><br />
            If you prefer to speak with someone, you can reach us at

            <span class="text-orange-600 font-bold">+95 9935385834</span>.
          </li>
        </ul>

        <p class="my-2 font-semibold">
          {{ __("Thank you for your understanding") }}
        </p>
      </div>
    </div>
  </AppLayout>
</template>
