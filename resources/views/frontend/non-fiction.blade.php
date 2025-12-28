@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - Non-Fiction';
@endphp
@include('frontend.includes.header')
  <!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
  @include('frontend.includes.navbar')
  <!-------------------------------  BANNER SECTION ------------------------------>
  
  <section>
    <div class="non-fiction-banner">
      <div class="banner-content">
        <h1 class="text-5xl text-white">Non-Fiction</h1>
        <!-- <p class="text-2xl py-5 text-white">Connect your family with resources related to health and social services</p> -->
      </div>
    </div>
  </section>

  <section>
    <div class="container mx-auto my-10">
      <div class="grid grid-cols-1  gap-8">
        <div class="max-w-md  bg-white  overflow-hidden md:max-w-full p-5 shadow-xl ">
          <div class="md:flex">
            <div class="md:flex-shrink-0 book-list">
              <div class=" book-item">
                <a href="the-journey.php" id="" class="">
                  <div class="book-link text-center bg-gray-500">
                    <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="" class="book-img hover:scale-1.5" srcset="">
                    
                  </div>
                </a>
                </div>
            </div>
            <div class="px-8 flex flex-col justify-center">
              <!-- <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Hot Sale</div> -->
              <a href="the-journey.php">
                <h1 class="block mt-1 text-3xl leading-tight font-bold text-black hover:text-[#8b6e4e]">The Journey from Hardcopy to Semi-Digital Pt. 1</h1>
              </a>
              <!-- <p class="mt-2 text-gray-500 text-xl">By Brooke Hennen</p> -->
              <p class="mt-2 text-gray-500">I downloaded the Marvel app and got a subscription for the first time last night (Feb 28, 2025). There’s a level of adultery I feel that I’ve committed. It took me years to get this far, but ultimately, going digital started small. It started with reading pirated chapters of Berserk online. </p>
              <div class="mt-2">
                <a href="the-journey.php" class="read-more text-lg ">READ MORE</a>

              </div>
              <!-- <p class="mt-2 text-red-500 font-bold">$22.00 <span class="line-through text-gray-500">$24.00</span></p>
              <div class="mt-4 flex space-x-2">
                <button class="bg-[#00bef0] text-white px-4 py-2 rounded-sm hover:bg-[#0296bd]">ADD TO CART</button>
                <button class="border border-gray-300 text-gray-500 px-4 py-2 rounded-sm hover:bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                  </svg>
                </button>
              </div> -->
            </div>
          </div>
        </div>
        <div class="max-w-md  bg-white  overflow-hidden md:max-w-full p-5 shadow-xl ">
          <div class="md:flex">
            <div class="md:flex-shrink-0 book-list">
              <div class=" book-item">
                <a href="falling-in-love.php" id="" class="">
                  <div class="book-link text-center bg-gray-500">
                    <img src="{{ '/images/Falling-Into-Love-With-Comics-Again.jpg' }}" alt="" class="book-img hover:scale-1.5" srcset="">
                    
                  </div>
                </a>
                </div>
            </div>
            <div class="px-8 flex flex-col justify-center">
              <!-- <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Hot Sale</div> -->
              <a href="falling-in-love.php">
                <h1 class="block mt-1 text-3xl leading-tight font-bold text-black hover:text-[#8b6e4e]">Falling in Love with (American) Comics Again Pt.1</h1>
              </a>
              <!-- <p class="mt-2 text-gray-500 text-xl">By Brooke Hennen</p> -->
              <p class="mt-2 text-gray-500">Editor’s Note: 3/13/2025 – I was going to edit this into two or three shorter blogs to land around the typical word count of four to six hundred, but in this attempt to do so, it would disrupt the flow too much.  Gonna just let it rip this time.  Also, this was my first blog.</p>
              <div class="mt-2">
                <a href="falling-in-love.php" class="read-more text-lg ">READ MORE</a>

              </div>
              <!-- <p class="mt-2 text-red-500 font-bold">$22.00 <span class="line-through text-gray-500">$24.00</span></p>
              <div class="mt-4 flex space-x-2">
                <button class="bg-[#00bef0] text-white px-4 py-2 rounded-sm hover:bg-[#0296bd]">ADD TO CART</button>
                <button class="border border-gray-300 text-gray-500 px-4 py-2 rounded-sm hover:bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                  </svg>
                </button>
              </div> -->
            </div>
          </div>
        </div>
        <div class="max-w-md  bg-white  overflow-hidden md:max-w-full p-5 shadow-xl ">
          <div class="md:flex">
            <div class="md:flex-shrink-0 book-list">
              <div class=" book-item">
                <a href="maintaing-the-collection-pt-1.php" id="" class="">
                  <div class="book-link text-center bg-gray-500">
                    <img src="{{ '/images/Apocalypse-and-Archangel-First-Appearance.jpg' }}" alt="" class="book-img hover:scale-1.5" srcset="">
                    
                  </div>
                </a>
                </div>
            </div>
            <div class="px-8 flex flex-col justify-center">
              <!-- <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Hot Sale</div> -->
              <a href="maintaing-the-collection-pt-1.php">
                <h1 class="block mt-1 text-3xl leading-tight font-bold text-black hover:text-[#8b6e4e]">Maintaining the Collection Pt. 1</h1>
              </a>
              <!-- <p class="mt-2 text-gray-500 text-xl">By Brooke Hennen</p> -->
              <p class="mt-2 text-gray-500">I’m still at my parent’s today, where the bulk of my collection resides (since R&I moved in 2017).  My father has been having medical treatments, and I’ve been here quite a bit to help my family out.  It’s nice to slip into the basement, put on a podcast and just sort the thousands of comics.  Or in this case, swap out old bags and boards for new ones.</p>
              <div class="mt-2">
                <a href="maintaing-the-collection-pt-1.php" class="read-more text-lg ">READ MORE</a>

              </div>
              <!-- <p class="mt-2 text-red-500 font-bold">$22.00 <span class="line-through text-gray-500">$24.00</span></p>
              <div class="mt-4 flex space-x-2">
                <button class="bg-[#00bef0] text-white px-4 py-2 rounded-sm hover:bg-[#0296bd]">ADD TO CART</button>
                <button class="border border-gray-300 text-gray-500 px-4 py-2 rounded-sm hover:bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                  </svg>
                </button>
              </div> -->
            </div>
          </div>
        </div>
        
      </div>

      <!-- <div class="pagination flex justify-center mt-10">
        <div class="page-number active" onclick="goToPage(1, this)">1</div>
        <div class="page-number inactive" onclick="goToPage(2, this)">2</div>
        <div class="page-number inactive" onclick="goToPage(3, this)">3</div>
        <div class="page-number inactive" onclick="goToPage(4, this)">4</div>
        <div class="page-number inactive" onclick="goToNextPage()">NEXT</div>
      </div> -->
    </div>
  </section>

  <!------------------------------- NEW FOOTER SECTION ---------------------------- -->
    
@include('frontend.includes.footer')