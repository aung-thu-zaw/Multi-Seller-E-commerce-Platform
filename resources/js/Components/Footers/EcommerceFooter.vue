<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <!-- Footer -->
  <footer class="bg-orange-600 w-full">
    <div class="w-full max-w-[85rem] py-10 px-4 pt-14 mx-auto">
      <!-- Grid -->
      <div class="grid grid-cols-4 gap-6">
        <div class="col-span-1 text-center">
          <a class="flex-none text-xl font-semibold text-white" href="#" aria-label="Brand">
            E-commerce Platform
          </a>

          <p class="inline-flex text-xs text-white">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum cupiditate,
            repellat, vero nobis laboriosam labore unde nisi quo possimus commodi culpa perferendis
            dolores impedit minima ipsam! Maiores modi perferendis voluptatum!
          </p>
        </div>
        <!-- End Col -->

        <div class="col-span-1 text-center">
          <h4 class="font-semibold text-white">{{ __('Store') }}</h4>

          <div class="mt-3 grid space-y-3">
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Join us') }}
              </a>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Find Store') }}
              </a>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Partnership') }}
              </a>
            </p>
          </div>
        </div>
        <!-- End Col -->

        <div class="col-span-1 text-center">
          <h4 class="font-semibold text-white">
            {{ __('Company') }}
          </h4>

          <div class="mt-3 grid space-y-3">
            <p>
              <Link
                :href="route('about-us')"
                class="inline-flex gap-x-2 text-white hover:text-gray-300"
              >
                {{ __('About us') }}
              </Link>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Terms & Conditions') }}
              </a>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Privacy & Policy') }}
              </a>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Support Center') }}
              </a>
            </p>
          </div>
        </div>
        <!-- End Col -->

        <div class="col-span-1 text-center">
          <h4 class="font-semibold text-white">{{ __('Help') }}</h4>

          <div class="mt-3 grid space-y-3">
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Help Center') }}
              </a>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Contact us') }}
              </a>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('Returns & Refunds') }}
              </a>
            </p>
            <p>
              <a class="inline-flex gap-x-2 text-white hover:text-gray-300" href="#">
                {{ __('FAQs') }}
              </a>
            </p>
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Grid -->

      <div class="mt-5 flex items-center justify-between">
        <div class="flex justify-between items-center">
          <p class="text-sm text-white">© 2023 E-commerce Platform. All rights reserved.</p>
        </div>
        <!-- Social Brands -->
        <div>
          <a
            class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
            href="#"
          >
            <svg
              class="flex-shrink-0 w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              viewBox="0 0 16 16"
            >
              <path
                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"
              />
            </svg>
          </a>

          <a
            class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
            href="#"
          >
            <svg
              class="flex-shrink-0 w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              viewBox="0 0 16 16"
            >
              <path
                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"
              />
            </svg>
          </a>

          <a
            class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
            href="#"
          >
            <svg
              class="flex-shrink-0 w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              x="0px"
              y="0px"
              width="100"
              height="100"
              viewBox="0,0,256,256"
            >
              <g
                fill="#ffffff"
                fill-rule="nonzero"
                stroke="none"
                stroke-width="1"
                stroke-linecap="butt"
                stroke-linejoin="miter"
                stroke-miterlimit="10"
                stroke-dasharray=""
                stroke-dashoffset="0"
                font-family="none"
                font-weight="none"
                font-size="none"
                text-anchor="none"
                style="mix-blend-mode: normal"
              >
                <g transform="scale(5.12,5.12)">
                  <path
                    d="M16,3c-7.17,0 -13,5.83 -13,13v18c0,7.17 5.83,13 13,13h18c7.17,0 13,-5.83 13,-13v-18c0,-7.17 -5.83,-13 -13,-13zM37,11c1.1,0 2,0.9 2,2c0,1.1 -0.9,2 -2,2c-1.1,0 -2,-0.9 -2,-2c0,-1.1 0.9,-2 2,-2zM25,14c6.07,0 11,4.93 11,11c0,6.07 -4.93,11 -11,11c-6.07,0 -11,-4.93 -11,-11c0,-6.07 4.93,-11 11,-11zM25,16c-4.96,0 -9,4.04 -9,9c0,4.96 4.04,9 9,9c4.96,0 9,-4.04 9,-9c0,-4.96 -4.04,-9 -9,-9z"
                  ></path>
                </g>
              </g>
            </svg>
          </a>

          <a
            class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
            href="#"
          >
            <svg
              class="flex-shrink-0 w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              x="0px"
              y="0px"
              width="100"
              height="100"
              viewBox="0,0,256,256"
            >
              <g
                fill="#ffffff"
                fill-rule="nonzero"
                stroke="none"
                stroke-width="1"
                stroke-linecap="butt"
                stroke-linejoin="miter"
                stroke-miterlimit="10"
                stroke-dasharray=""
                stroke-dashoffset="0"
                font-family="none"
                font-weight="none"
                font-size="none"
                text-anchor="none"
                style="mix-blend-mode: normal"
              >
                <g transform="scale(5.12,5.12)">
                  <path
                    d="M44.89844,14.5c-0.39844,-2.19922 -2.29687,-3.80078 -4.5,-4.30078c-3.29687,-0.69922 -9.39844,-1.19922 -16,-1.19922c-6.59766,0 -12.79687,0.5 -16.09766,1.19922c-2.19922,0.5 -4.10156,2 -4.5,4.30078c-0.40234,2.5 -0.80078,6 -0.80078,10.5c0,4.5 0.39844,8 0.89844,10.5c0.40234,2.19922 2.30078,3.80078 4.5,4.30078c3.5,0.69922 9.5,1.19922 16.10156,1.19922c6.60156,0 12.60156,-0.5 16.10156,-1.19922c2.19922,-0.5 4.09766,-2 4.5,-4.30078c0.39844,-2.5 0.89844,-6.10156 1,-10.5c-0.20312,-4.5 -0.70312,-8 -1.20312,-10.5zM19,32v-14l12.19922,7z"
                  ></path>
                </g>
              </g>
            </svg>
          </a>

          <a
            class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
            href="#"
          >
            <svg
              class="flex-shrink-0 w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              x="0px"
              y="0px"
              width="100"
              height="100"
              viewBox="0,0,256,256"
            >
              <g
                fill="#ffffff"
                fill-rule="nonzero"
                stroke="none"
                stroke-width="1"
                stroke-linecap="butt"
                stroke-linejoin="miter"
                stroke-miterlimit="10"
                stroke-dasharray=""
                stroke-dashoffset="0"
                font-family="none"
                font-weight="none"
                font-size="none"
                text-anchor="none"
                style="mix-blend-mode: normal"
              >
                <g transform="scale(5.12,5.12)">
                  <path
                    d="M41,4h-32c-2.76,0 -5,2.24 -5,5v32c0,2.76 2.24,5 5,5h32c2.76,0 5,-2.24 5,-5v-32c0,-2.76 -2.24,-5 -5,-5zM17,20v19h-6v-19zM11,14.47c0,-1.4 1.2,-2.47 3,-2.47c1.8,0 2.93,1.07 3,2.47c0,1.4 -1.12,2.53 -3,2.53c-1.8,0 -3,-1.13 -3,-2.53zM39,39h-6c0,0 0,-9.26 0,-10c0,-2 -1,-4 -3.5,-4.04h-0.08c-2.42,0 -3.42,2.06 -3.42,4.04c0,0.91 0,10 0,10h-6v-19h6v2.56c0,0 1.93,-2.56 5.81,-2.56c3.97,0 7.19,2.73 7.19,8.26z"
                  ></path>
                </g>
              </g>
            </svg>
          </a>
        </div>
        <!-- End Social Brands -->
        <!-- End Col -->
      </div>
    </div>
  </footer>
</template>
