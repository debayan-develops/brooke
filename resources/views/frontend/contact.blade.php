@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - Contact Us';
@endphp
@include('frontend.includes.header')
  <!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
  @include('frontend.includes.navbar')
  <!-------------------------------  BANNER SECTION ------------------------------>
  
  <section>
    <div class="contact-banner">
      <div class="banner-content">
        <h1 class="text-5xl text-white">Contact Us</h1>
        <!-- <p class="text-2xl py-5 text-white">Connect your family with resources related to health and social services</p> -->
      </div>
    </div>
  </section>

  <section class="my-10" data-aos="zoom-in">
    <div class="max-w-[1020px] mx-auto p-4 rounded-xl bg-gray-100">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
        <!-- Left Section -->
        <div class=" text-white ">
          <img src="{{ '/images/demo-pic-2.jpg' }}" class="w-full h-[650px] object-cover rounded-lg" alt="" srcset="">
        </div>
        <!-- Right Section -->
        <div class="flex justify-center items-center bg-white  rounded-lg shadow-md">
          <form class="p-8  w-full max-w-lg">
            <!-- <h2 class="text-2xl font-bold mb-6">Contact Us</h2> -->
            <!-- <p class="mb-4 font-semibold">Complete the information below and we'll get back to you soon</p> -->
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name (First and Last)</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Your name">
            </div>
    
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="email">E-mail</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Your email">
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="city">City</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="city" type="city" placeholder="Enter Your City">
            </div>
    
            <div class="select-container mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="hear-about">How did you hear about Brooke Hennen?</label>
              <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline custom-select" id="hear-about" onchange="toggleOtherField()">
                <option selected="selected" disabled="true">--- Please Select ---</option>
                <option value="Social Media">Social Media</option>
                <option value="Convention">Convention</option>
                <option value="Word of Mouth">Word of Mouth</option>
                <option value="Online Search Engine">Online Search Engine</option>
                <option value="Rival">Rival</option>
                <option value="Other">Other</option>
              </select>
            </div>
    
            <div class="mb-4" id="other-field" style="display: none;">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="other">If Other, Please Specify</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="other" type="text" placeholder="Specify here">
            </div>
    
            <div class="relative mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="other">Suggestions or Topics for Brooke?</label>
              <button id="dropdownButton" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Choose Interests
              </button>
              <div id="dropdownMenu" class="absolute z-10 bg-white border border-gray-300 rounded-md mt-2 w-full shadow-lg hidden">
                <div class="p-4 space-y-2">
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="christians-and-art">
                    <span class="ml-2 text-gray-700">Christians and Art</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="american-comics">
                    <span class="ml-2 text-gray-700">American Comics</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="manga">
                    <span class="ml-2 text-gray-700">Manga</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="anime">
                    <span class="ml-2 text-gray-700">Anime</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="cartoons">
                    <span class="ml-2 text-gray-700">Cartoons</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="comics">
                    <span class="ml-2 text-gray-700">Comics</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="prose">
                    <span class="ml-2 text-gray-700">Prose</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="non-fiction">
                    <span class="ml-2 text-gray-700">Non-fiction</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="fiction">
                    <span class="ml-2 text-gray-700">Fiction</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="novels">
                    <span class="ml-2 text-gray-700">Novels</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="short-stories">
                    <span class="ml-2 text-gray-700">Short Stories</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="television">
                    <span class="ml-2 text-gray-700">Television</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="reviews-highlights">
                    <span class="ml-2 text-gray-700">Reviews / Highlights</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="video-games">
                    <span class="ml-2 text-gray-700">Video Games</span>
                  </label>
                  <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-600" name="interests" value="biblical-topics">
                    <span class="ml-2 text-gray-700">Biblical Topics</span>
                  </label>
                  <!-- Add more checkboxes as needed -->
                </div>
              </div>
            </div>
    
            <div class="flex items-center justify-between">
              <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <!------------------------------- NEW FOOTER SECTION ---------------------------- -->
    
@include('frontend.includes.footer')
<script>
  const dropdownButton = document.getElementById('dropdownButton');
  const dropdownMenu = document.getElementById('dropdownMenu');

  // Toggle dropdown on button click
  dropdownButton.addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default action (in case button is within a form or has another default behavior)
    event.stopPropagation(); // Prevents the body click listener from closing it immediately
    dropdownMenu.classList.toggle('hidden');
  });

  // Close dropdown when clicking anywhere else on the document
  // document.addEventListener('click', function () {
  //   if (!dropdownMenu.classList.contains('hidden')) {
  //     dropdownMenu.classList.add('hidden');
  //   }
  // });
</script>