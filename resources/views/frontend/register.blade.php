@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - Register';
@endphp
@include('frontend.includes.header')
  @include('frontend.includes.navbar')
  <section>
    <div class="contact-banner">
      <div class="banner-content">
        <h1 class="text-5xl text-white">Register</h1>
      </div>
    </div>
  </section>

  <section class="my-10" data-aos="zoom-in">
    <div class="max-w-[1020px] mx-auto p-4 rounded-xl bg-gray-100">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
        <div class="flex flex-col justify-center items-center text-center text-white p-10 rounded-lg shadow-inner" style="background-color: #0ea5e9; min-height: 650px;">
          <h2 class="text-4xl sm:text-5xl font-bold mb-4">Welcome Back!</h2>
          <p class="text-lg sm:text-xl mb-10 text-blue-50">Already a member? Dive right back into the stories and exclusive content you love.</p>
          
         <a href="/login" class="inline-block">
            <div class="btn-2">
              <button class="btn-content-2 flex justify-center items-center gap-2" type="button" style="cursor: pointer;">
                Sign In <i class="fa-solid fa-arrow-right-long"></i>
              </button>
            </div>
          </a>
        </div>
        
        <div class="flex justify-center items-center bg-white rounded-lg shadow-md overflow-hidden">
          <form class="p-8 w-full max-w-lg h-full overflow-y-auto" id="registerForm" action="#" method="POST">
            
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Create an Account</h2>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name (First and Last)</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Your name" required>
            </div>
    
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="email">E-mail</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Your email" required>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Create a password" required>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Repeat Password</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" type="password" placeholder="Repeat your password" required>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">Mobile Number</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mobile" type="tel" placeholder="Enter your mobile number" required>
            </div>
    
            <div class="mb-4 mt-6 border-t pt-4">
              <label class="block text-gray-700 text-sm font-bold mb-3">Choose Your Plan</label>
              <div class="flex items-center gap-6">
                <label class="inline-flex items-center cursor-pointer">
                  <input type="radio" name="subscription_type" value="free" class="form-radio text-blue-600 h-5 w-5" checked onchange="toggleSubscriptionOptions()">
                  <span class="ml-2 text-gray-800 font-medium">Free User</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="radio" name="subscription_type" value="paid" class="form-radio text-blue-600 h-5 w-5" onchange="toggleSubscriptionOptions()">
                  <span class="ml-2 text-gray-800 font-medium">Paid Subscriber</span>
                </label>
              </div>
            </div>

            <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-100 hidden transition-all duration-300" id="paid-options">
              <label class="block text-blue-800 text-sm font-bold mb-2" for="billing_cycle">Select Billing Cycle</label>
              <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="billing_cycle" name="billing_cycle">
                <option value="" disabled selected>--- Choose a Package ---</option>
                <option value="weekly">Quarterly Access</option>
                <option value="monthly">Monthly Access</option>
                <option value="annually">Annual Access (Best Value)</option>
              </select>
              <p class="text-xs text-blue-600 mt-2 italic">* Payment details will be collected on the next screen.</p>
            </div>
    
            <div class="mt-6 mb-4 bg-blue-50 py-3 px-4 rounded-lg border border-blue-100 text-center transition-all duration-300 hover:shadow-sm">
              <p class="text-sm text-blue-800 font-medium">
                Wondering what you get? <a href="/packages" class="text-[#0ea5e9] font-bold hover:text-blue-700 hover:underline">Explore our Subscription Packages </a>
              </p>
            </div>
            <div class="mb-6">
              <label class="flex items-start cursor-pointer">
                <input type="checkbox" id="tnc" class="form-checkbox h-4 w-4 text-blue-600 mt-1" onchange="toggleSubmitBtn()">
                <span class="ml-2 text-sm text-gray-700 leading-snug">
                  I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a> and acknowledge the privacy policy.
                </span>
              </label>
            </div>
    
            <div class="mb-5 mt-6 p-4 bg-gray-50 border-l-4 border-gray-400 text-sm text-gray-600 rounded-r">
              <strong>Privacy Disclaimer:</strong> No user information will be given or sold to 3rd party websites. All information collected is used to make the website a better experience.
            </div>

            <div class="flex items-center justify-between pt-2 border-t">
              <button id="registerSubmitBtn" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200 opacity-50 cursor-not-allowed" type="submit" disabled>
                Complete Registration
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

@include('frontend.includes.footer')

<script>
  // Logic to show/hide the Paid Subscription dropdown
  function toggleSubscriptionOptions() {
    const isPaid = document.querySelector('input[name="subscription_type"]:checked').value === 'paid';
    const paidOptionsDiv = document.getElementById('paid-options');
    
    if (isPaid) {
      paidOptionsDiv.classList.remove('hidden');
    } else {
      paidOptionsDiv.classList.add('hidden');
      document.getElementById('billing_cycle').value = ""; // Reset dropdown if they switch back to free
    }
  }

  // Logic to Enable/Disable Submit Button based on Checkbox
  function toggleSubmitBtn() {
    const isChecked = document.getElementById('tnc').checked;
    const submitBtn = document.getElementById('registerSubmitBtn');

    if (isChecked) {
      submitBtn.disabled = false;
      submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
      submitBtn.disabled = true;
      submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }
  }
</script>