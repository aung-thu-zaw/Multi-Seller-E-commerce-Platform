<script setup>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head :title="__('Address Book')" />

  <UserDashboardLayout>
    <div class="p-10 border border-gray-200 bg-white rounded-md">
      <div class="mb-5 flex items-center justify-end">
        <button
          class="font-bold text-xs text-orange-500 px-3 py-2 rounded-sm border border-orange-600 hover:bg-orange-600 hover:text-white duration-200"
        >
          <i class="fa-solid fa-plus"></i>
          Add New Address
        </button>
      </div>
      <div class="grid grid-cols-2 gap-5 overflow-auto h-[770px] py-1">
        <!-- Card -->
        <div
          class="border border-gray-200 rounded-sm flex flex-col items-start p-5 hover:shadow-md duration-150"
        >
          <ul class="text-xs text-gray-700 space-y-3 w-full mb-5">
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Name : </span>
              <span class="font-medium w-full flex items-center justify-between">
                Aung Thu Zaw

                <div class="space-x-3">
                  <button class="font-bold text-xs text-blue-600 hover:text-blue-500 duration-200">
                    <i class="fa-solid fa-edit"></i>
                  </button>
                  <button class="font-bold text-xs text-red-600 hover:text-red-500 duration-200">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </div>
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Phone : </span>
              <span class="bblock font-medium w-full"> 09835634334 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Email : </span>
              <span class="bblock font-medium w-full"> aungthuzaw@gmail.com </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Country : </span>
              <span class="bblock font-medium w-full"> Myanmar </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Province : </span>
              <span class="bblock font-medium w-full"> Tanintharyi </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> City : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Area : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Zip Code : </span>
              <span class="bblock font-medium w-full"> 2034 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Address : </span>
              <span class="bblock font-medium w-full">
                Tanintharyi,Myeik,Myeik,House No-2044, Parami( 2 ) Ward , Khatta Road
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Landmark : </span>
              <span class="bblock font-medium w-full"> Beside Aung Myat Zaw Photo </span>
            </li>
          </ul>

          <div class="space-x-2">
            <span
              class="font-medium border border-orange-500 bg-orange-500 text-white text-xs px-3 py-1 rounded-full"
            >
              Office
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Delivery Address
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Billing Address
            </span>
          </div>
        </div>
        <!-- Card -->
        <div
          class="border border-gray-200 rounded-sm flex flex-col items-start p-5 hover:shadow-md duration-150"
        >
          <ul class="text-xs text-gray-700 space-y-3 w-full mb-5">
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Name : </span>
              <span class="font-medium w-full flex items-center justify-between">
                Aung Thu Zaw

                <div class="space-x-3">
                  <button class="font-bold text-xs text-blue-600 hover:text-blue-500 duration-200">
                    <i class="fa-solid fa-edit"></i>
                  </button>
                  <button class="font-bold text-xs text-red-600 hover:text-red-500 duration-200">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </div>
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Phone : </span>
              <span class="bblock font-medium w-full"> 09835634334 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Email : </span>
              <span class="bblock font-medium w-full"> aungthuzaw@gmail.com </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Country : </span>
              <span class="bblock font-medium w-full"> Myanmar </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Province : </span>
              <span class="bblock font-medium w-full"> Tanintharyi </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> City : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Area : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Zip Code : </span>
              <span class="bblock font-medium w-full"> 2034 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Address : </span>
              <span class="bblock font-medium w-full">
                Tanintharyi,Myeik,Myeik,House No-2044, Parami( 2 ) Ward , Khatta Road
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Landmark : </span>
              <span class="bblock font-medium w-full"> Beside Aung Myat Zaw Photo </span>
            </li>
          </ul>

          <div class="space-x-2">
            <span
              class="font-medium border border-orange-500 bg-orange-500 text-white text-xs px-3 py-1 rounded-full"
            >
              Office
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Delivery Address
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Billing Address
            </span>
          </div>
        </div>
        <!-- Card -->
        <div
          class="border border-gray-200 rounded-sm flex flex-col items-start p-5 hover:shadow-md duration-150"
        >
          <ul class="text-xs text-gray-700 space-y-3 w-full mb-5">
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Name : </span>
              <span class="font-medium w-full flex items-center justify-between">
                Aung Thu Zaw

                <div class="space-x-3">
                  <button class="font-bold text-xs text-blue-600 hover:text-blue-500 duration-200">
                    <i class="fa-solid fa-edit"></i>
                  </button>
                  <button class="font-bold text-xs text-red-600 hover:text-red-500 duration-200">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </div>
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Phone : </span>
              <span class="bblock font-medium w-full"> 09835634334 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Email : </span>
              <span class="bblock font-medium w-full"> aungthuzaw@gmail.com </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Country : </span>
              <span class="bblock font-medium w-full"> Myanmar </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Province : </span>
              <span class="bblock font-medium w-full"> Tanintharyi </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> City : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Area : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Zip Code : </span>
              <span class="bblock font-medium w-full"> 2034 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Address : </span>
              <span class="bblock font-medium w-full">
                Tanintharyi,Myeik,Myeik,House No-2044, Parami( 2 ) Ward , Khatta Road
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Landmark : </span>
              <span class="bblock font-medium w-full"> Beside Aung Myat Zaw Photo </span>
            </li>
          </ul>

          <div class="space-x-2">
            <span
              class="font-medium border border-orange-500 bg-orange-500 text-white text-xs px-3 py-1 rounded-full"
            >
              Office
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Delivery Address
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Billing Address
            </span>
          </div>
        </div>
        <!-- Card -->
        <div
          class="border border-gray-200 rounded-sm flex flex-col items-start p-5 hover:shadow-md duration-150"
        >
          <ul class="text-xs text-gray-700 space-y-3 w-full mb-5">
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Name : </span>
              <span class="font-medium w-full flex items-center justify-between">
                Aung Thu Zaw

                <div class="space-x-3">
                  <button class="font-bold text-xs text-blue-600 hover:text-blue-500 duration-200">
                    <i class="fa-solid fa-edit"></i>
                  </button>
                  <button class="font-bold text-xs text-red-600 hover:text-red-500 duration-200">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </div>
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Phone : </span>
              <span class="bblock font-medium w-full"> 09835634334 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Email : </span>
              <span class="bblock font-medium w-full"> aungthuzaw@gmail.com </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Country : </span>
              <span class="bblock font-medium w-full"> Myanmar </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Province : </span>
              <span class="bblock font-medium w-full"> Tanintharyi </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> City : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Area : </span>
              <span class="bblock font-medium w-full"> Myeik </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Zip Code : </span>
              <span class="bblock font-medium w-full"> 2034 </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Address : </span>
              <span class="bblock font-medium w-full">
                Tanintharyi,Myeik,Myeik,House No-2044, Parami( 2 ) Ward , Khatta Road
              </span>
            </li>
            <li class="flex items-start space-x-5">
              <span class="block font-bold w-1/4"> Landmark : </span>
              <span class="bblock font-medium w-full"> Beside Aung Myat Zaw Photo </span>
            </li>
          </ul>

          <div class="space-x-2">
            <span
              class="font-medium border border-orange-500 bg-orange-500 text-white text-xs px-3 py-1 rounded-full"
            >
              Office
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Delivery Address
            </span>
            <span
              class="font-medium border border-orange-500 text-orange-500 text-xs px-3 py-1 rounded-full"
            >
              Default Billing Address
            </span>
          </div>
        </div>
      </div>
    </div>
  </UserDashboardLayout>
</template>
