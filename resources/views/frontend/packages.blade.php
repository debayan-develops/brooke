@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - Subscription Packages';
@endphp
@include('frontend.includes.header')
  @include('frontend.includes.navbar')
  <section>
    <div class="contact-banner">
      <div class="banner-content">
        <h1 class="text-5xl text-white">Subscription Packages</h1>
      </div>
    </div>
  </section>

  <section class="my-10" data-aos="zoom-in">
    <div class="max-w-[1280px] mx-auto p-6 md:p-10 rounded-xl bg-gray-100 shadow-sm">
      
      <div class="text-center mb-12 max-w-3xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Unlock the Full Story</h2>
        <p class="text-lg text-gray-600">Choose the perfect plan to access exclusive stories, premium chapters, and behind-the-scenes content. Upgrade, downgrade, or cancel anytime.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
        
        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200 flex flex-col hover:shadow-lg transition-shadow duration-300">
          <h3 class="text-xl font-bold text-gray-700 mb-2">Free Reader</h3>
          <div class="text-4xl font-extrabold text-gray-900 mb-1">$0 <span class="text-base font-normal text-gray-500">/forever</span></div>
          <p class="text-sm text-gray-500 mb-6 pb-6 border-b border-gray-100">Perfect for getting started.</p>
          
          <ul class="space-y-4 mb-8 flex-1">
            <li class="flex items-start"><svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm">Access to Free Chapters</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm">Community Forums</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm">Standard Email Updates</span></li>
          </ul>

          <a href="/register" class="w-full mt-auto inline-block text-center border-2 border-gray-300 text-gray-700 font-bold py-3 rounded-full hover:bg-gray-50 transition duration-300">
            Create Free Account
          </a>
        </div>

        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200 flex flex-col hover:shadow-lg transition-shadow duration-300">
          <h3 class="text-xl font-bold text-blue-600 mb-2">Monthly</h3>
          <div class="text-4xl font-extrabold text-gray-900 mb-1">$X <span class="text-base font-normal text-gray-500">/mo</span></div>
          <p class="text-sm text-gray-500 mb-6 pb-6 border-b border-gray-100">Flexibility to read at your own pace.</p>
          
          <ul class="space-y-4 mb-8 flex-1">
            <li class="flex items-start"><svg class="w-5 h-5 text-blue-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm">All Free Features</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-blue-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm font-semibold">Unlimited Premium Chapters</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-blue-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm">Exclusive Short Stories</span></li>
          </ul>

          <a href="/register" class="w-full mt-auto inline-block">
            <div class="btn-2">
              <button class="btn-content-2 flex justify-center items-center gap-2 w-full py-3" type="button" style="cursor: pointer;">
                Subscribe <i class="fa-solid fa-arrow-right-long"></i>
              </button>
            </div>
          </a>
        </div>

        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200 flex flex-col hover:shadow-lg transition-shadow duration-300">
          <h3 class="text-xl font-bold text-blue-600 mb-2">Quarterly</h3>
          <div class="text-4xl font-extrabold text-gray-900 mb-1">$Y <span class="text-base font-normal text-gray-500">/3 mos</span></div>
          <p class="text-sm text-gray-500 mb-6 pb-6 border-b border-gray-100">Save 10% billed every 3 months.</p>
          
          <ul class="space-y-4 mb-8 flex-1">
            <li class="flex items-start"><svg class="w-5 h-5 text-blue-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm">All Monthly Features</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-blue-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm font-semibold">10% Discount vs Monthly</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-blue-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-gray-600 text-sm">Early Access to New Releases</span></li>
          </ul>

          <a href="/register" class="w-full mt-auto inline-block">
            <div class="btn-2">
              <button class="btn-content-2 flex justify-center items-center gap-2 w-full py-3" type="button" style="cursor: pointer;">
                Subscribe <i class="fa-solid fa-arrow-right-long"></i>
              </button>
            </div>
          </a>
        </div>

        <div class="bg-[#0ea5e9] rounded-xl shadow-xl p-8 border border-[#0284c7] flex flex-col transform lg:-translate-y-4 relative">
          <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-yellow-400 text-yellow-900 text-xs font-bold px-4 py-1 rounded-full uppercase tracking-wide shadow-md">
            Best Value
          </div>
          
          <h3 class="text-xl font-bold text-white mb-2 mt-2">Annual Access</h3>
          <div class="text-4xl font-extrabold text-white mb-1">$Z <span class="text-base font-normal text-blue-100">/yr</span></div>
          <p class="text-sm text-blue-100 mb-6 pb-6 border-b border-blue-400">Two months absolutely FREE.</p>
          
          <ul class="space-y-4 mb-8 flex-1">
            <li class="flex items-start"><svg class="w-5 h-5 text-yellow-300 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-white text-sm">All Quarterly Features</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-yellow-300 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-white text-sm font-semibold">2 Months Free! (Save ~16%)</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-yellow-300 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-white text-sm">Downloadable Content</span></li>
            <li class="flex items-start"><svg class="w-5 h-5 text-yellow-300 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="text-white text-sm">VIP Priority Support</span></li>
          </ul>

          <a href="/register" class="w-full mt-auto inline-block bg-white text-[#0ea5e9] font-bold text-center py-3 rounded-full hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-md">
            Get Annual Plan <i class="fa-solid fa-arrow-right-long ml-2"></i>
          </a>
        </div>

      </div>

      <div class="mt-12 pt-8 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-500 mb-2"><strong>Secure Processing:</strong> Payment details will be securely collected after account creation. You won't be charged until you confirm.</p>
        <p class="text-sm text-gray-500">Already have an account? <a href="/login" class="text-[#0ea5e9] hover:underline font-semibold">Sign In Here</a></p>
      </div>

    </div>
  </section>

@include('frontend.includes.footer')