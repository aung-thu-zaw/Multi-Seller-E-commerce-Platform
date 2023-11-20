<template>
  <div class="border-t w-full p-5 bg-gray-50">
    <form action="#" class="">
      <div class="relative w-full">
        <input
          type="text"
          class="w-full focus:ring-0 border border-gray-400 rounded-full p-4 pl-[70px] pr-[60px] text-sm font-medium text-gray-600 focus:border-gray-400"
          placeholder="Type a message ..."
        />

        <div
          class="absolute top-1/3 left-4 text-sm flex items-center space-x-3 text-gray-500"
        >
          <!-- File Attachment -->
          <label for="input-file">
            <div class="hover:text-orange-500 cursor-pointer">
              <i class="fa-solid fa-image"></i>
            </div>
            <input id="input-file" type="file" class="hidden" multiple />
          </label>
          <span class="hover:text-orange-500 cursor-pointer">
            <i class="fa-solid fa-face-smile"></i>
          </span>
        </div>

        <button
          type="submit"
          class="absolute top-1/3 right-5 text-md flex items-center space-x-3 text-gray-300"
        >
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </div>
    </form>
  </div>
</template>
