<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="hs-dropdown relative inline-flex [--trigger:hover] [--placement:bottom-right]">
    <button
      id="hs-dropdown-hover-event"
      type="button"
      class="relative hs-dropdown-toggle text-md text-white font-normal disabled:opacity-50 disabled:pointer-events-none hover:text-gray-300 ml-5"
    >
      <i class="fa-regular fa-bell"></i>

      <div
        class="absolute -top-1 -right-2 bg-white flex items-center justify-center w-3.5 h-3.5 rounded-full"
      >
        <span class="font-bold text-orange-500 text-[.6rem]">5</span>
      </div>
    </button>

    <div
      class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-[25rem] h-auto max-h-[40rem] overflow-auto bg-white shadow-md rounded-lg mt-2 border border-gray-300 divide-gray-500 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
      aria-labelledby="hs-dropdown-hover-event"
    >
      <div class="px-4 py-3 bg-gray-100 flex items-center justify-between border-b">
        <span class="text-gray-700 font-semibold text-md"> Notifications </span>
        <button href="#" class="text-orange-600 hover:text-orange-500 text-sm font-bold">
          Mark all us read
        </button>
      </div>
      <!-- Notification Card -->
      <!-- <Link
        as="button"
        class="text-sm font-semibold px-5 py-3.5 hover:bg-gray-100 w-full transition-all border"
        href="#"
      >
        <div class="space-x-3 flex items-center">
          <div
            class="border w-10 h-10 flex items-center justify-center rounded-md bg-blue-500 text-white border-blue-600 ring-2 ring-blue-300"
          >
            <i class="fa-solid fa-newspaper"></i>
          </div>
          <span class="font-bold text-gray-600 text-sm">
            Your blog received a new comment from a user.
          </span>
        </div>
      </Link> -->

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
        <div class="flex-shrink-0">
          <img
            class="rounded-full w-11 h-11"
            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D"
            alt="Joseph image"
          />
          <div
            class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-gray-700 border border-white rounded-full"
          >
            <svg
              class="w-2.5 h-2.5"
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
                <g transform="scale(8.53333,8.53333)">
                  <path
                    d="M15,3c-7.18,0 -13,4.925 -13,11c0,3.368 1.79333,6.37848 4.61133,8.39648c0.07195,1.53598 -0.16605,3.6569 -2.28516,4.63477c-0.0013,0.00065 -0.00261,0.0013 -0.00391,0.00195c-0.19383,0.07371 -0.32204,0.25942 -0.32227,0.4668c0,0.27614 0.22386,0.5 0.5,0.5c0.01194,0 0.02324,-0.00189 0.03516,-0.00195c0.0026,0.00002 0.00521,0.00002 0.00781,0c2.43403,-0.0156 4.5003,-1.33101 5.92578,-2.7207c0.452,-0.441 1.08212,-0.65802 1.70313,-0.54102c0.91,0.173 1.85613,0.26367 2.82813,0.26367c7.18,0 13,-4.925 13,-11c0,-6.075 -5.82,-11 -13,-11z"
                  ></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
        <div class="w-full ps-3">
          <div class="text-gray-600 text-sm mb-1.5">
            New blog comment from
            <span class="font-semibold text-gray-800">Aung Thu Zaw</span>: "Hey, what's up? All set
            for the presentation?"
          </div>
          <div class="text-xs font-medium text-orange-600">10 minutes ago</div>
        </div>
      </a>

      <!-- No notification -->
      <!-- <div class="py-5">
        <p class="font-bold text-sm text-gray-600 text-center">
          There are no notifications.
        </p>
      </div> -->
    </div>
  </div>
</template>
