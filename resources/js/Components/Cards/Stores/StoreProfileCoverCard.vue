<script setup>
</script>

<template>
  <div
    class="w-full h-[300px] mb-10 shadow-md rounded-md overflow-hidden flex items-end p-10 seller-background"
  >
    <div class="flex items-center justify-between w-full">
      <div class="flex items-center space-x-5">
        <img
          src="https://img.freepik.com/free-vector/shop-with-we-are-open-sign_23-2148557016.jpg"
          alt=""
          class="w-36 h-36 rounded-md"
        />
        <div class="font-semibold text-white space-y-3">
          <div
            class="badge-gradient shadow px-3 rounded-sm py-1 font-bold uppercase text-[0.6rem] text-white bg-orange-600 inline-block border border-orange-400 space-x-2"
          >
            <span>
              <i class="fas fa-crown"></i>
              Official
            </span>
            <span class="font-bold text-orange-500"> Flagship </span>
          </div>
          <h3 class="text-2xl">K Mobile Shop</h3>

          <p class="text-sm text-white mt-2">523 Followers</p>

          <div>
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
          </div>
        </div>
      </div>

      <div class="space-x-5 self-end">
        <button
          class="font-bold bg-white text-gray-700 hover:bg-gray-200 duration-200 px-5 py-2.5 rounded-md text-sm"
        >
          <i class="fa-solid fa-message"></i>
          Chat Now
        </button>
        <button
          class="font-bold text-white bg-orange-600 hover:bg-orange-700 duration-200 px-5 py-2.5 rounded-md text-sm"
        >
          <i class="fa-solid fa-store"></i>
          Follow Store
        </button>
      </div>
    </div>
  </div>
</template>


<style>
.seller-background {
  background-image: url('https://media.licdn.com/dms/image/C4E12AQGlzsYoKqxHkA/article-cover_image-shrink_600_2000/0/1634130038864?e=2147483647&v=beta&t=cmCQHpCHmQQfxEya-gVJGNUQe7E6ruQ3xxs-841Jd6c');
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-color: rgba(0, 0, 0, 0.4);
  background-blend-mode: overlay;
}

.badge-gradient {
  background: rgb(234, 88, 11);
  background: linear-gradient(
    100deg,
    rgba(234, 88, 11, 1) 0%,
    rgba(234, 88, 11, 0.9430365896358543) 53%,
    rgba(255, 255, 255, 1) 53%
  );
}
</style>
