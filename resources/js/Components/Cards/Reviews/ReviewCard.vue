<script setup></script>

<template>
  <div class="">
    <div class="w-full">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3 ml-4">
          <!-- avatar -->
          <span
            class="w-10 h-10 text-sm text-white bg-slate-200 inline-flex items-center justify-center rounded-full ring-2"
          >
            <img
              alt="user-photo"
              class="w-full h-full object-cover rounded-full align-middle border-none shadow-lg ring-2 ring-orange-300"
              src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=1352"
            />
          </span>

          <h3 class="font-bold text-gray-700 text-md">Aung Thu Zaw</h3>

          <span class="font-bold text-xs text-green-600">
            <i class="fa-solid fa-circle-check"></i>
            Verified Purchaser
          </span>
        </div>

        <div class="flex items-center space-x-2">
          <p class="font-semibold text-sm text-gray-700">22 September, 2023</p>

          <div class="hs-dropdown relative inline-flex">
            <button
              id="hs-dropdown-custom-icon-trigger"
              type="button"
              class="hs-dropdown-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold text-gray-800"
            >
              <svg
                class="flex-none w-4 h-4 text-gray-600"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="12" cy="12" r="1" />
                <circle cx="12" cy="5" r="1" />
                <circle cx="12" cy="19" r="1" />
              </svg>
            </button>

            <div
              class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 border"
              aria-labelledby="hs-dropdown-custom-icon-trigger"
            >
              <a
                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                href="#"
              >
                Report Abuse
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="pl-16 space-y-3">
        <!-- Rating -->
        <div class="flex items-center space-x-0.5">
          <svg
            class="flex-shrink-0 w-3.5 h-3.5 text-yellow-400"
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            viewBox="0 0 16 16"
          >
            <path
              d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
            />
          </svg>
          <svg
            class="flex-shrink-0 w-3.5 h-3.5 text-yellow-400"
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            viewBox="0 0 16 16"
          >
            <path
              d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
            />
          </svg>
          <svg
            class="flex-shrink-0 w-3.5 h-3.5 text-yellow-400"
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            viewBox="0 0 16 16"
          >
            <path
              d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
            />
          </svg>
          <svg
            class="flex-shrink-0 w-3.5 h-3.5 text-gray-300"
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            viewBox="0 0 16 16"
          >
            <path
              d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
            />
          </svg>
          <svg
            class="flex-shrink-0 w-3.5 h-3.5 text-gray-300"
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            viewBox="0 0 16 16"
          >
            <path
              d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
            />
          </svg>
        </div>
        <p class="text-sm font-medium text-gray-700">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos similique vitae nobis
          debitis cupiditate odit incidunt eaque nihil ipsum quasi harum perferendis magni
          voluptates vel ex, aperiam rerum fugiat laboriosam?
        </p>

        <div class="flex items-start space-x-5 w-full">
          <img
            src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D"
            alt="product image"
            class="w-20 h-20 object-cover rounded-md"
          />
          <img
            src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D"
            alt="product image"
            class="w-20 h-20 object-cover rounded-md"
          />
          <img
            src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D"
            alt="product image"
            class="w-20 h-20 object-cover rounded-md"
          />
          <img
            src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D"
            alt="product image"
            class="w-20 h-20 object-cover rounded-md"
          />
          <img
            src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D"
            alt="product image"
            class="w-20 h-20 object-cover rounded-md"
          />
        </div>
      </div>
    </div>
  </div>
</template>
