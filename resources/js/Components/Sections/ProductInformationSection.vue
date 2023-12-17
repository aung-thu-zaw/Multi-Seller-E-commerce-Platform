<script setup>
</script>

<template>
  <div class="border border-gray-300 bg-white p-5 rounded-md">
    <nav class="flex space-x-3" aria-label="Tabs" role="tablist">
      <button
        type="button"
        class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-700 hover:text-orange-600"
        id="tabs-with-icons-item-1"
        data-hs-tab="#tabs-with-icons-1"
        aria-controls="tabs-with-icons-1"
        role="tab"
      >
        <i class="fa-solid fa-file-lines"></i>
        {{ __('Product Description') }}
      </button>
      <button
        type="button"
        class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-700 hover:text-orange-600"
        id="tabs-with-icons-item-2"
        data-hs-tab="#tabs-with-icons-2"
        aria-controls="tabs-with-icons-2"
        role="tab"
      >
        <i class="fa-solid fa-circle-question"></i>
        {{ __('Product Questions & Answers') }}
      </button>

      <button
        type="button"
        class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-700 hover:text-orange-600"
        id="tabs-with-icons-item-2"
        data-hs-tab="#tabs-with-icons-2"
        aria-controls="tabs-with-icons-2"
        role="tab"
      >
        <i class="fa-solid fa-truck"></i>
        {{ __('Delivery & Services') }}
      </button>

      <button
        type="button"
        class="hs-tab-active:font-semibold hs-tab-active:border-orange-600 hs-tab-active:text-orange-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm font-medium whitespace-nowrap text-gray-700 hover:text-orange-600"
        id="tabs-with-icons-item-2"
        data-hs-tab="#tabs-with-icons-2"
        aria-controls="tabs-with-icons-2"
        role="tab"
      >
        <i class="fa-solid fa-star"></i>
        {{ __('Product Reviews') }}
      </button>
    </nav>
  </div>

  <div class="mt-3">
    <div id="tabs-with-icons-1" role="tabpanel" aria-labelledby="tabs-with-icons-item-1">
      <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
        <div class="px-5">
          <div class="mb-5">
            <h3 class="font-bold text-md text-gray-800">K Mobile Shop</h3>
            <p class="text-xs text-gray-500 font-medium">Purchased on 13 Oct 2023</p>
          </div>

          <div class="grid grid-cols-2 gap-5">
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
            >
              <div class="w-[400px] flex items-start">
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>

                  <div class="flex items-center justify-end pt-5">
                    <a class="text-orange-600 text-xs font-bold hover:text-orange-500">
                      <i class="fa-solid fa-pen"></i>
                      Write Review
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
            >
              <div class="w-[400px] flex items-start">
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>

                  <div class="flex items-center justify-end pt-5">
                    <a class="text-orange-600 text-xs font-bold hover:text-orange-500">
                      <i class="fa-solid fa-pen"></i>
                      Write Review
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
            >
              <div class="w-[400px] flex items-start">
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>

                  <div class="flex items-center justify-end pt-5">
                    <a class="text-orange-600 text-xs font-bold hover:text-orange-500">
                      <i class="fa-solid fa-pen"></i>
                      Write Review
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr />

        <div class="px-5">
          <div class="mb-5">
            <h3 class="font-bold text-md text-gray-800">K Mobile Shop</h3>
            <p class="text-xs text-gray-500 font-medium">Purchased on 13 Oct 2023</p>
          </div>

          <div class="grid grid-cols-2 gap-5">
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
            >
              <div class="w-[400px] flex items-start">
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>

                  <div class="flex items-center justify-end pt-5">
                    <a class="text-orange-600 text-xs font-bold hover:text-orange-500">
                      <i class="fa-solid fa-pen"></i>
                      Write Review
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
            >
              <div class="w-[400px] flex items-start">
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>

                  <div class="flex items-center justify-end pt-5">
                    <a class="text-orange-600 text-xs font-bold hover:text-orange-500">
                      <i class="fa-solid fa-pen"></i>
                      Write Review
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr />

        <div class="px-5">
          <div class="mb-5">
            <h3 class="font-bold text-md text-gray-800">K Mobile Shop</h3>
            <p class="text-xs text-gray-500 font-medium">Purchased on 13 Oct 2023</p>
          </div>

          <div class="grid grid-cols-2 gap-5">
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex items-start justify-between space-x-5 p-5"
            >
              <div class="w-[400px] flex items-start">
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>

                  <div class="flex items-center justify-end pt-5">
                    <a class="text-orange-600 text-xs font-bold hover:text-orange-500">
                      <i class="fa-solid fa-pen"></i>
                      Write Review
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      id="tabs-with-icons-2"
      class="hidden"
      role="tabpanel"
      aria-labelledby="tabs-with-icons-item-2"
    >
      <div class="py-10 border border-gray-200 bg-white rounded-md space-y-5">
        <div class="px-5">
          <div class="mb-5">
            <h3 class="font-bold text-md text-gray-800">K Mobile Shop</h3>
            <p class="text-xs text-gray-500 font-medium">Purchased on 13 Oct 2023</p>
          </div>
          <div class="space-y-5">
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex flex-col items-center space-y-3 justify-between p-5"
            >
              <div
                class="w-full flex items-start bg-gray-100 px-5 py-2.5 rounded-md border border-gray-200"
              >
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between w-full">
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
                <!-- End Rating -->
                <button class="text-orange-600 text-sm font-bold">
                  <i class="fa-solid fa-edit"></i>
                  Edit
                </button>
              </div>

              <p class="text-sm font-medium text-gray-700">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos similique vitae
                nobis debitis cupiditate odit incidunt eaque nihil ipsum quasi harum perferendis
                magni voluptates vel ex, aperiam rerum fugiat laboriosam?
              </p>
            </div>

            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex flex-col items-center space-y-3 justify-between p-5"
            >
              <div
                class="w-full flex items-start bg-gray-100 px-5 py-2.5 rounded-md border border-gray-200"
              >
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between w-full">
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
                <!-- End Rating -->
                <button class="text-orange-600 text-sm font-bold">
                  <i class="fa-solid fa-edit"></i>
                  Edit
                </button>
              </div>

              <p class="text-sm font-medium text-gray-700">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos similique vitae
                nobis debitis cupiditate odit incidunt eaque nihil ipsum quasi harum perferendis
                magni voluptates vel ex, aperiam rerum fugiat laboriosam?
              </p>
            </div>

            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex flex-col items-center space-y-3 justify-between p-5"
            >
              <div
                class="w-full flex items-start bg-gray-100 px-5 py-2.5 rounded-md border border-gray-200"
              >
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between w-full">
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
                <!-- End Rating -->
                <button class="text-orange-600 text-sm font-bold">
                  <i class="fa-solid fa-edit"></i>
                  Edit
                </button>
              </div>

              <p class="text-sm font-medium text-gray-700">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos similique vitae
                nobis debitis cupiditate odit incidunt eaque nihil ipsum quasi harum perferendis
                magni voluptates vel ex, aperiam rerum fugiat laboriosam?
              </p>
            </div>
          </div>
        </div>

        <hr />
        <div class="px-5">
          <div class="mb-5">
            <h3 class="font-bold text-md text-gray-800">K Mobile Shop</h3>
            <p class="text-xs text-gray-500 font-medium">Purchased on 13 Oct 2023</p>
          </div>
          <div class="space-y-5">
            <!-- card -->
            <div
              class="border border-gray-200 rounded-md flex flex-col items-center space-y-3 justify-between p-5"
            >
              <div
                class="w-full flex items-start bg-gray-100 px-5 py-2.5 rounded-md border border-gray-200"
              >
                <div class="min-w-[100px] overflow-hidden">
                  <img
                    src="https://www.junglescout.com/wp-content/uploads/2021/01/product-photo-water-bottle-hero.png"
                    alt="product image"
                    class="w-20 h-20 object-cover"
                  />
                </div>
                <div class="space-y-1">
                  <h3 class="font-semibold text-sm text-gray-700 line-clamp-2">
                    Naviforce NF9049 | Men’s Dual Movement Stainless Steel Watch, Original, Black &
                    Blue Watch Strap Color:Black
                  </h3>

                  <div class="space-x-1 flex items-center text-xs font-medium mb-5">
                    <p>Brand : Water</p>
                    <span class="text-gray-500">|</span>
                    <p>Color : Orange</p>
                    <span class="text-gray-500">|</span>
                    <p>Size : Lg</p>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between w-full">
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
                <!-- End Rating -->
                <button class="text-orange-600 text-sm font-bold">
                  <i class="fa-solid fa-edit"></i>
                  Edit
                </button>
              </div>

              <p class="text-sm font-medium text-gray-700">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos similique vitae
                nobis debitis cupiditate odit incidunt eaque nihil ipsum quasi harum perferendis
                magni voluptates vel ex, aperiam rerum fugiat laboriosam?
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
