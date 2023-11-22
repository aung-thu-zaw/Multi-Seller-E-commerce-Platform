<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import TextAreaField from "@/Components/Forms/Fields/TextAreaField.vue";
import FormButton from "@/Components/Buttons/FormButton.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const isReplyBoxOpened = ref(false);
</script>

<template>
  <AppLayout>
    <Head title="Help Center : E-commerce Online Shopping" />

    <section id="blog-content" class="py-5">
      <div class="container mx-auto flex items-start">
        <div class="min-w-[300px] w-[300px] max-w-[300px]">
          <div class="py-5 space-y-2 mb-10">
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

          <div class="border border-gray-300 rounded-sm">
            <h1
              class="text-lg font-bold text-gray-700 text-center py-3 border-b border-gray-300"
            >
              Related Blogs
            </h1>

            <!-- Card -->
            <div
              class="flex items-center pl-3 py-5 hover:bg-gray-200 transition-all border-b border-gray-300"
            >
              <img
                class="w-16 h-16 object-cover object-center rounded-md"
                src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Image Description"
              />

              <div class="px-3">
                <h4
                  class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Enim, tenetur! At incidunt nostrum, ipsa omnis reiciendis
                  deleniti maiores dolore pariatur magni, beatae molestias quam
                  sint labore, nobis exercitationem dolorum. Dicta!
                </h4>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>
              </div>
            </div>
            <!-- Card -->
            <div
              class="flex items-center pl-3 py-5 hover:bg-gray-200 transition-all border-b border-gray-300"
            >
              <img
                class="w-14 h-14 object-cover object-center rounded-md"
                src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Image Description"
              />

              <div class="px-3">
                <h4
                  class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Enim, tenetur! At incidunt nostrum, ipsa omnis reiciendis
                  deleniti maiores dolore pariatur magni, beatae molestias quam
                  sint labore, nobis exercitationem dolorum. Dicta!
                </h4>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>
              </div>
            </div>
            <!-- Card -->
            <div
              class="flex items-center pl-3 py-5 hover:bg-gray-200 transition-all border-b border-gray-300"
            >
              <img
                class="w-14 h-14 object-cover object-center rounded-md"
                src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Image Description"
              />

              <div class="px-3">
                <h4
                  class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Enim, tenetur! At incidunt nostrum, ipsa omnis reiciendis
                  deleniti maiores dolore pariatur magni, beatae molestias quam
                  sint labore, nobis exercitationem dolorum. Dicta!
                </h4>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>
              </div>
            </div>
            <!-- Card -->
            <div
              class="flex items-center pl-3 py-5 hover:bg-gray-200 transition-all border-b border-gray-300"
            >
              <img
                class="w-14 h-14 object-cover object-center rounded-md"
                src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Image Description"
              />

              <div class="px-3">
                <h4
                  class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Enim, tenetur! At incidunt nostrum, ipsa omnis reiciendis
                  deleniti maiores dolore pariatur magni, beatae molestias quam
                  sint labore, nobis exercitationem dolorum. Dicta!
                </h4>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>
              </div>
            </div>
            <!-- Card -->
            <div
              class="flex items-center pl-3 py-5 hover:bg-gray-200 transition-all border-b border-gray-300"
            >
              <img
                class="w-14 h-14 object-cover object-center rounded-md"
                src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Image Description"
              />

              <div class="px-3">
                <h4
                  class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Enim, tenetur! At incidunt nostrum, ipsa omnis reiciendis
                  deleniti maiores dolore pariatur magni, beatae molestias quam
                  sint labore, nobis exercitationem dolorum. Dicta!
                </h4>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>
              </div>
            </div>
            <!-- Card -->
            <div
              class="flex items-center pl-3 py-5 hover:bg-gray-200 transition-all border-b border-gray-300"
            >
              <img
                class="w-14 h-14 object-cover object-center rounded-md"
                src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Image Description"
              />

              <div class="px-3">
                <h4
                  class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Enim, tenetur! At incidunt nostrum, ipsa omnis reiciendis
                  deleniti maiores dolore pariatur magni, beatae molestias quam
                  sint labore, nobis exercitationem dolorum. Dicta!
                </h4>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>
              </div>
            </div>
            <!-- Card -->
            <div
              class="flex items-center pl-3 py-3.5 hover:bg-gray-200 transition-all border-gray-300"
            >
              <img
                class="w-14 h-14 object-cover object-center rounded-md"
                src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Image Description"
              />

              <div class="px-3">
                <h4
                  class="line-clamp-2 text-sm font-semibold text-gray-700 mb-1"
                >
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Enim, tenetur! At incidunt nostrum, ipsa omnis reiciendis
                  deleniti maiores dolore pariatur magni, beatae molestias quam
                  sint labore, nobis exercitationem dolorum. Dicta!
                </h4>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-user"></i>
                    Super Admin
                  </span>
                  <span class="font-bold text-slate-500 text-[.7rem]">
                    <i class="fa-solid fa-clock"></i>
                    September 9, 2023
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full py-5 pl-5">
          <div class="border border-gray-300 shadow-lg rounded-md p-2">
            <img
              src="https://images.unsplash.com/photo-1634320494885-4e627328d883?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Njd8fGltYWdlfGVufDB8fDB8fHww"
              class="w-full max-h-[600px] object-cover"
            />
          </div>

          <h1 class="font-bold text-xl text-gray-700 mt-8 mb-2">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
            expedita optio tempora! Aspernatur amet consectetur dolore ratione
            quis aperiam, sunt explicabo provident dolor mollitia repellat
            nobis, accusamus corporis qui illo.
          </h1>

          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center space-x-4">
              <span
                class="text-xs font-bold bg-orange-500 text-white py-1 px-3 rounded-sm shadow"
              >
                Travel
              </span>

              <span class="font-bold text-slate-600 text-sm">
                <i class="fa-solid fa-user"></i>
                Super Admin
              </span>

              <span class="font-bold text-slate-600 text-sm">
                <i class="fa-solid fa-clock"></i>
                September 25, 2023
              </span>
            </div>

            <!-- Share Blog Social Icons Start -->
            <div class="flex items-center">
              <span class="font-bold text-slate-600 mr-3">
                <i class="fa-solid fa-share-nodes"></i> Share :
              </span>
              <a href="#" target="_blank">
                <i class="fa-brands fa-facebook mr-3 text-lg text-blue-600"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-twitter mr-3 text-lg text-sky-600"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-linkedin mr-3 text-lg text-blue-800"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-reddit mr-3 text-lg text-orange-500"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-telegram mr-3 text-lg text-blue-500"></i>
              </a>
              <a href="#" target="_blank">
                <i
                  class="fa-brands fa-whatsapp mr-3 text-lg text-emerald-600"
                ></i>
              </a>
            </div>
            <!-- Share Blog Social Icons End -->
          </div>

          <hr class="my-3" />

          <!-- Blog Description -->
          <p class="text-sm font-medium text-slate-600 mb-5">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Doloremque, ea architecto! Recusandae, ad eius harum laudantium
            beatae minima, praesentium id tenetur commodi earum, non ratione
            mollitia quis! Facilis placeat quos dignissimos neque eum esse natus
            consequuntur fugiat optio illum, itaque non? Cumque praesentium
            ullam molestias voluptatibus, qui quam consectetur quo possimus rem
            corporis nostrum illum quis, natus ipsam, ea facere libero ut
            incidunt dicta repudiandae id explicabo tempore. Sit, ipsa est
            architecto quia consectetur porro numquam rerum sequi dicta nostrum
            aliquam eveniet non sunt asperiores ratione perspiciatis vel
            facilis. Minus eum fugiat distinctio veritatis, eaque velit quisquam
            accusantium harum assumenda nihil rem voluptate eos quaerat quasi,
            architecto, quam quas id maiores dolor temporibus voluptatum sint
            voluptatem? Aliquid cum, alias autem excepturi ipsum exercitationem
            aut ratione? Similique aspernatur, neque asperiores qui ea explicabo
            eligendi, perspiciatis at fugit a fuga officia voluptatem optio
            dolor culpa. Corporis quasi dolor recusandae reiciendis iste
            accusamus ducimus praesentium necessitatibus dolore nulla, facilis
            pariatur id quos ratione ad placeat modi fuga non temporibus vero
            laboriosam accusantium beatae. Impedit dolor quasi ullam nihil
            temporibus harum doloribus suscipit et voluptatibus, quis itaque,
            id, error sunt blanditiis quas libero cum consequuntur quidem
            repellendus tenetur molestias repudiandae necessitatibus!
            Repellendus, minus deserunt!
          </p>

          <!-- Blog Tags Start -->
          <div class="flex items-center mb-5">
            <span class="font-bold text-gray-600 mr-3"
              >{{ __("Blog Tags") }} :</span
            >
            <div class="flex items-center space-x-2">
              <a
                href="#"
                class="px-3 py-1 bg-orange-600 rounded-full text-white text-xs capitalize font-bold hover:bg-orange-700 transition-all"
              >
                Sports
              </a>
              <a
                href="#"
                class="px-3 py-1 bg-orange-600 rounded-full text-white text-xs capitalize font-bold hover:bg-orange-700 transition-all"
              >
                Travel
              </a>
              <a
                href="#"
                class="px-3 py-1 bg-orange-600 rounded-full text-white text-xs capitalize font-bold hover:bg-orange-700 transition-all"
              >
                Soccer
              </a>
            </div>
          </div>
          <!-- Blog Tags End -->

          <div class="border border-gray-300 bg-white rounded-sm shadow">
            <div class="border-b p-5">
              <p class="text-md font-semibold text-gray-600 mb-5">
                Total Comments (0)
              </p>

              <!-- Comments -->

              <div class="py-3 rounded-md border border-gray-300">
                <p class="text-center font-medium text-orange-600 text-xs my-3">
                  <i class="fa-solid fa-spinner animate-spin"></i>
                  Your comment is awaiting moderation....
                </p>

                <!-- Comment Card -->
                <div class="p-4">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center mb-2">
                      <img
                        src="https://images.unsplash.com/photo-1579865346865-9223701ba92e?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTR8fGltYWdlfGVufDB8fDB8fHww"
                        alt=""
                        class="w-10 h-10 object-cover rounded-full ring-2 ring-orange-200 mr-2"
                      />

                      <div class="flex flex-col items-start">
                        <h3 class="font-bold text-gray-600">Aung Thu Zaw</h3>
                        <span class="text-xs font-medium text-gray-400">
                          Comment from user
                        </span>
                      </div>
                    </div>

                    <p class="text-gray-500 text-sm font-bold">
                      12/September/2023 12:30 PM
                    </p>
                  </div>

                  <div class="pl-12">
                    <p class="text-sm text-gray-600 font-medium">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit.
                      Quam dolore cumque nisi ipsum error in facere fugit
                      maiores dicta optio! Laborum totam fugit quia, incidunt
                      tempore beatae minima reiciendis eos.
                    </p>
                  </div>

                  <div class="flex items-center justify-end mt-3">
                    <button
                      v-if="!isReplyBoxOpened"
                      @click="isReplyBoxOpened = !isReplyBoxOpened"
                      class="font-medium text-xs text-gray-600 hover:text-orange-500"
                    >
                      <i class="fa-solid fa-comment-dots"></i>
                      Reply
                    </button>
                    <button
                      v-else
                      @click="isReplyBoxOpened = false"
                      class="font-medium text-xs text-red-600 hover:text-red-500"
                    >
                      <i class="fa-solid fa-circle-xmark"></i>
                      Cancel
                    </button>
                  </div>

                  <div v-show="isReplyBoxOpened" class="pl-12 mt-5">
                    <form action="#">
                      <div class="mb-3">
                        <TextAreaField
                          name="reply-blog"
                          :placeholder="__('Enter reply message ...')"
                          required
                        />
                      </div>

                      <div class="border w-[100px] ml-auto">
                        <FormButton type="submit" :processing="processing">
                          {{ __("Submit") }}
                        </FormButton>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- Reply Card -->
                <div class="p-4 pl-16">
                  <div class="flex items-center justify-between">
                    <div class="flex items-start mb-2">
                      <img
                        src="https://images.unsplash.com/photo-1579865346865-9223701ba92e?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTR8fGltYWdlfGVufDB8fDB8fHww"
                        alt=""
                        class="w-10 h-10 object-cover rounded-full ring-2 ring-orange-200 mr-2"
                      />

                      <div class="flex flex-col items-start">
                        <h3 class="font-bold text-gray-600">Aung Thu Zaw</h3>
                        <span class="text-xs font-medium text-orange-500"
                          >Reply from author
                        </span>
                      </div>
                    </div>

                    <p class="text-gray-500 text-sm font-bold">
                      12/September/2023 12:30 PM
                    </p>
                  </div>

                  <div class="pl-12">
                    <p class="text-sm text-gray-600 font-medium">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit.
                      Quam dolore cumque nisi ipsum error in facere fugit
                      maiores dicta optio! Laborum totam fugit quia, incidunt
                      tempore beatae minima reiciendis eos.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Comment Form -->
            <div class="p-5">
              <form action="#">
                <div class="mb-3">
                  <TextAreaField
                    name="comment-blog"
                    :placeholder="__('Enter comment...')"
                    required
                  />
                </div>

                <div class="border w-[150px] ml-auto">
                  <FormButton type="submit" :processing="processing">
                    <i class="fa-solid fa-paper-plane"></i>
                    {{ __("Submit") }}
                  </FormButton>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
