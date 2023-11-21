<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BlogSearchBox from "@/Components/Forms/SearchBoxs/BlogSearchBox.vue";
import BlogSortingSelectBox from "@/Components/Forms/SelectBoxs/BlogSortingSelectBox.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <AppLayout>
    <Head title="Help Center : E-commerce Online Shopping" />

    <section id="blog-content" class="py-5">
      <div class="container mx-auto flex items-start">
        <div class="min-w-[300px] py-5 space-y-2">
          <!-- category -->
          <div
            class="border border-gray-300 flex items-center justify-between px-3 py-3 rounded-sm hover:bg-gray-100 hover:scale-105 transition-all"
          >
            <img
              src="https://images.unsplash.com/photo-1613323593608-abc90fec84ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="w-10 h-10 object-cover rounded-full"
            />

            <h5 class="font-bold text-md text-gray-600">Fashion</h5>

            <div
              class="border-2 border-slate-300 w-5 h-5 flex items-center justify-center rounded-full p-3"
            >
              <span class="font-semibold text-gray-600 text-xs"> 29 </span>
            </div>
          </div>
          <!-- category -->
          <div
            class="border border-gray-300 flex items-center justify-between px-3 py-3 rounded-sm hover:bg-gray-100 hover:scale-105 transition-all"
          >
            <img
              src="https://images.unsplash.com/photo-1613323593608-abc90fec84ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="w-10 h-10 object-cover rounded-full"
            />

            <h5 class="font-bold text-md text-gray-600">Fashion</h5>

            <div
              class="border-2 border-slate-300 w-5 h-5 flex items-center justify-center rounded-full p-3"
            >
              <span class="font-semibold text-gray-600 text-xs"> 29 </span>
            </div>
          </div>
          <!-- category -->
          <div
            class="border border-gray-300 flex items-center justify-between px-3 py-3 rounded-sm hover:bg-gray-100 hover:scale-105 transition-all"
          >
            <img
              src="https://images.unsplash.com/photo-1613323593608-abc90fec84ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="w-10 h-10 object-cover rounded-full"
            />

            <h5 class="font-bold text-md text-gray-600">Fashion</h5>

            <div
              class="border-2 border-slate-300 w-5 h-5 flex items-center justify-center rounded-full p-3"
            >
              <span class="font-semibold text-gray-600 text-xs"> 29 </span>
            </div>
          </div>
          <!-- category -->
          <div
            class="border border-gray-300 flex items-center justify-between px-3 py-3 rounded-sm hover:bg-gray-100 hover:scale-105 transition-all"
          >
            <img
              src="https://images.unsplash.com/photo-1613323593608-abc90fec84ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="w-10 h-10 object-cover rounded-full"
            />

            <h5 class="font-bold text-md text-gray-600">Fashion</h5>

            <div
              class="border-2 border-slate-300 w-5 h-5 flex items-center justify-center rounded-full p-3"
            >
              <span class="font-semibold text-gray-600 text-xs"> 29 </span>
            </div>
          </div>
          <!-- category -->
          <div
            class="border border-gray-300 flex items-center justify-between px-3 py-3 rounded-sm hover:bg-gray-100 hover:scale-105 transition-all"
          >
            <img
              src="https://images.unsplash.com/photo-1613323593608-abc90fec84ff?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
              alt=""
              class="w-10 h-10 object-cover rounded-full"
            />

            <h5 class="font-bold text-md text-gray-600">Fashion</h5>

            <div
              class="border-2 border-slate-300 w-5 h-5 flex items-center justify-center rounded-full p-3"
            >
              <span class="font-semibold text-gray-600 text-xs"> 29 </span>
            </div>
          </div>
        </div>
        <div class="w-full py-5 pl-5">
          <div
            class="py-2 mb-3 flex items-center justify-between border-t border-b"
          >
            <BlogSearchBox />

            <div class="flex items-center space-x-5">
              <BlogSortingSelectBox />

              <div class="">
                <label for="view" class="font-bold text-sm text-gray-600">
                  View :
                </label>

                <a
                  href="#"
                  class="px-2 py-1 rounded-md cursor-pointer bg-orange-500 text-white hover:bg-orange-600 transition-none mr-2"
                >
                  <i class="fa-solid fa-grip"></i>
                </a>
                <a
                  href="#"
                  class="px-2 py-1 rounded-md cursor-pointer bg-gray-200 text-gray-600 hover:bg-gray-300 transition-none"
                >
                  <i class="fa-solid fa-list"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Filtered By -->
          <div class="my-5 px-2 flex items-center">
            <p class="font-bold text-blueGray-700 text-sm mr-1">
              {{ __("Filtered By") }} :
            </p>

            <div class="flex items-center space-x-3">
              <div
                class="inline-flex flex-nowrap items-center bg-white border border-gray-200 rounded-full px-2 py-1.5"
              >
                <div class="whitespace-nowrap text-xs font-bold text-gray-700">
                  Category : Foods
                </div>
                <div
                  class="ms-2.5 inline-flex justify-center items-center h-2 w-2 rounded-full text-gray-600 text-xs hover:text-red-600 transition-all cursor-pointer"
                >
                  <i class="fa-solid fa-circle-xmark"></i>
                </div>
              </div>
            </div>

            <p class="text-sm font-medium text-gray-700 ml-auto">
              0 post(s) found for result
              <span class="text-orange-500 font-semibold"> "contents" </span>
            </p>
          </div>
          <div class="grid grid-cols-3 gap-5">
            <!-- Card -->
            <a
              class="group rounded-xl overflow-hidden focus:outline-none focus:ring-1 focus:ring-gray-600"
              href="#"
            >
              <div
                class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden"
              >
                <img
                  class="w-full h-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                  src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                  alt="Image Description"
                />
              </div>

              <div class="mt-7">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>

                <h3
                  class="text-md font-semibold text-gray-800 group-hover:text-gray-600 line-clamp-2"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Voluptates in eius suscipit neque voluptatibus! Exercitationem
                  necessitatibus dolorem, eius enim nulla vero, aspernatur
                  cupiditate delectus totam vitae iure consequuntur repudiandae
                  animi?
                </h3>
                <p class="text-xs mt-3 text-gray-800 line-clamp-3">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum
                  ipsum suscipit est placeat! Harum ex fugiat amet, molestias
                  delectus a quia eaque possimus velit nihil, quasi sequi ab
                  deserunt odio?
                </p>
                <p
                  class="mt-5 text-sm inline-flex items-center gap-x-1 text-orange-600 decoration-2 group-hover:underline font-medium"
                >
                  Read more
                  <svg
                    class="flex-shrink-0 w-4 h-4"
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
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </p>
              </div>
            </a>
            <!-- Card -->
            <a
              class="group rounded-xl overflow-hidden focus:outline-none focus:ring-1 focus:ring-gray-600"
              href="#"
            >
              <div
                class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden"
              >
                <img
                  class="w-full h-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                  src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                  alt="Image Description"
                />
              </div>

              <div class="mt-7">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>

                <h3
                  class="text-md font-semibold text-gray-800 group-hover:text-gray-600 line-clamp-2"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Voluptates in eius suscipit neque voluptatibus! Exercitationem
                  necessitatibus dolorem, eius enim nulla vero, aspernatur
                  cupiditate delectus totam vitae iure consequuntur repudiandae
                  animi?
                </h3>
                <p class="text-xs mt-3 text-gray-800 line-clamp-3">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum
                  ipsum suscipit est placeat! Harum ex fugiat amet, molestias
                  delectus a quia eaque possimus velit nihil, quasi sequi ab
                  deserunt odio?
                </p>
                <p
                  class="mt-5 text-sm inline-flex items-center gap-x-1 text-orange-600 decoration-2 group-hover:underline font-medium"
                >
                  Read more
                  <svg
                    class="flex-shrink-0 w-4 h-4"
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
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </p>
              </div>
            </a>
            <!-- Card -->
            <a
              class="group rounded-xl overflow-hidden focus:outline-none focus:ring-1 focus:ring-gray-600"
              href="#"
            >
              <div
                class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden"
              >
                <img
                  class="w-full h-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                  src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                  alt="Image Description"
                />
              </div>

              <div class="mt-7">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>

                <h3
                  class="text-md font-semibold text-gray-800 group-hover:text-gray-600 line-clamp-2"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Voluptates in eius suscipit neque voluptatibus! Exercitationem
                  necessitatibus dolorem, eius enim nulla vero, aspernatur
                  cupiditate delectus totam vitae iure consequuntur repudiandae
                  animi?
                </h3>
                <p class="text-xs mt-3 text-gray-800 line-clamp-3">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum
                  ipsum suscipit est placeat! Harum ex fugiat amet, molestias
                  delectus a quia eaque possimus velit nihil, quasi sequi ab
                  deserunt odio?
                </p>
                <p
                  class="mt-5 text-sm inline-flex items-center gap-x-1 text-orange-600 decoration-2 group-hover:underline font-medium"
                >
                  Read more
                  <svg
                    class="flex-shrink-0 w-4 h-4"
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
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </p>
              </div>
            </a>
            <!-- Card -->
            <a
              class="group rounded-xl overflow-hidden focus:outline-none focus:ring-1 focus:ring-gray-600"
              href="#"
            >
              <div
                class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden"
              >
                <img
                  class="w-full h-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                  src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                  alt="Image Description"
                />
              </div>

              <div class="mt-7">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>

                <h3
                  class="text-md font-semibold text-gray-800 group-hover:text-gray-600 line-clamp-2"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Voluptates in eius suscipit neque voluptatibus! Exercitationem
                  necessitatibus dolorem, eius enim nulla vero, aspernatur
                  cupiditate delectus totam vitae iure consequuntur repudiandae
                  animi?
                </h3>
                <p class="text-xs mt-3 text-gray-800 line-clamp-3">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum
                  ipsum suscipit est placeat! Harum ex fugiat amet, molestias
                  delectus a quia eaque possimus velit nihil, quasi sequi ab
                  deserunt odio?
                </p>
                <p
                  class="mt-5 text-sm inline-flex items-center gap-x-1 text-orange-600 decoration-2 group-hover:underline font-medium"
                >
                  Read more
                  <svg
                    class="flex-shrink-0 w-4 h-4"
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
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </p>
              </div>
            </a>
            <!-- Card -->
            <a
              class="group rounded-xl overflow-hidden focus:outline-none focus:ring-1 focus:ring-gray-600"
              href="#"
            >
              <div
                class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden"
              >
                <img
                  class="w-full h-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                  src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                  alt="Image Description"
                />
              </div>

              <div class="mt-7">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>

                <h3
                  class="text-md font-semibold text-gray-800 group-hover:text-gray-600 line-clamp-2"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Voluptates in eius suscipit neque voluptatibus! Exercitationem
                  necessitatibus dolorem, eius enim nulla vero, aspernatur
                  cupiditate delectus totam vitae iure consequuntur repudiandae
                  animi?
                </h3>
                <p class="text-xs mt-3 text-gray-800 line-clamp-3">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum
                  ipsum suscipit est placeat! Harum ex fugiat amet, molestias
                  delectus a quia eaque possimus velit nihil, quasi sequi ab
                  deserunt odio?
                </p>
                <p
                  class="mt-5 text-sm inline-flex items-center gap-x-1 text-orange-600 decoration-2 group-hover:underline font-medium"
                >
                  Read more
                  <svg
                    class="flex-shrink-0 w-4 h-4"
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
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
