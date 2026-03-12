@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - Sign In';
@endphp
@include('frontend.includes.header')
  @include('frontend.includes.navbar')
  <section>
    <div class="contact-banner">
      <div class="banner-content">
        <h1 class="text-5xl text-white">Sign In</h1>
      </div>
    </div>
  </section>

  <section class="my-10" data-aos="zoom-in">
    <div class="max-w-[1020px] mx-auto p-4 rounded-xl bg-gray-100">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
        
        <div class="flex flex-col justify-center items-center text-center text-white p-10 rounded-lg shadow-inner" style="background-color: #0ea5e9; min-height: 550px;">
          <h2 class="text-4xl sm:text-5xl font-bold mb-4">New Here?</h2>
          <p class="text-lg sm:text-xl mb-10 text-blue-50">Join our community to access exclusive stories, premium chapters, and personalized content!</p>
          
          <a href="/register" class="inline-block">
            <div class="btn-2">
              <button class="btn-content-2 flex justify-center items-center gap-2" type="button" style="cursor: pointer;">
                Register <i class="fa-solid fa-arrow-right-long"></i>
              </button>
            </div>
          </a>
        </div>
        
        <div class="flex justify-center items-center bg-white rounded-lg shadow-md overflow-hidden">
          <form class="p-8 w-full max-w-lg h-full flex flex-col justify-center" id="loginForm" action="#" method="POST">
            
            <h2 class="text-2xl font-bold mb-8 text-gray-800">Welcome Back</h2>
    
            <div class="mb-5">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="email">E-mail Address</label>
              <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" id="email" type="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-6">
              <div class="flex justify-between items-end mb-2">
                <label class="block text-gray-700 text-sm font-bold" for="password">Password</label>
                <a href="#forgot-password" class="text-sm text-blue-600 hover:text-blue-800 hover:underline font-medium">Forgot Password?</a>
              </div>
              <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" id="password" type="password" placeholder="Enter your password" required>
            </div>
    
            <div class="mt-2">
              <button id="loginSubmitBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200" type="submit">
                Sign In securely
              </button>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 text-center">
              <p class="text-sm text-gray-600">
                Ready to unlock premium content? <br>
                <a href="/register" class="text-[#0ea5e9] font-bold hover:text-blue-700 hover:underline text-base mt-1 inline-block">Start your reading journey here! </a>
              </p>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

@include('frontend.includes.footer')