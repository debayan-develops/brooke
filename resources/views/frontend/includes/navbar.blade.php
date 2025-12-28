<header>

  <!------------------------------- NAVIGATION SECTION ------------------------------>

  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="{{ route('frontend.home') }}">brooke hennen</a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name">brooke hennen</span>
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">
          <li><a href="{{ route('frontend.home') }}">HOME</a></li>
          <li>
            <span class=" text-white uppercase font-semibold">Read</span>
            <i class='bx bxs-chevron-down  arrow  htmlcss-arrow'></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="{{ route('frontend.blog.freshest') }}">Freshest</a></li>
              <li><a href="{{ route('frontend.novel.index') }}">Novels</a></li>
              <li><a href="{{ route('frontend.short-story.index') }}">Short Stories</a></li>
              <li><a href="{{ route('frontend.blog.index') }}">Blog</a></li>

            </ul>
          </li>
          <li><a href="#">Newcomers</a></li>
          <li><a href="{{ route('frontend.page.vod') }}">vod</a></li>
          <li><a href="{{ route('frontend.page.contact') }}">CONTACT US</a></li>
          <li><a href="{{ route('frontend.page.biography') }}">Biography</a></li>
          <li><a href="#">Misc</a></li>
          <li> 
            <div class="">
              <div class="btn-2">
                <button class="btn-content-2 flex justify-center items-center gap-2" id="subscribe-btn">Subscribe Now <i class="fa-solid fa-arrow-right-long"></i></button>
              </div> 
            </div>
          </li>
          

        </ul>
      </div>
    </div>
  </nav>
  <div id="popup-overlay">
    <div id="popup-content" class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
      <div>
        <h4 class="text-3xl font-bold mb-4 text-gray-700 font-semibold">Newsletter</h4>
        <p class="mb-4">Make sure to subscribe to our newsletter and be the first to know the news.</p>
        <form>
          <input type="email" placeholder="Your email address" class="w-full p-2 border border-gray-300 rounded mb-4">
          <button type="submit" class="w-full bg-[#00bef0] hover:bg-[#8b6e4e] text-white p-2 rounded">Subscribe</button>
        </form>
      </div>
    </div>
    <img src="{{ '/images/close.png' }}" class="close-btn-2" alt="" srcset="" id="close-popup">
  </div>
</header>

<script>
  // Open popup
  const subscribeBtn = document.getElementById("subscribe-btn");
  const popupOverlay = document.getElementById("popup-overlay");
  const closePopup = document.getElementById("close-popup");

  if (subscribeBtn && popupOverlay && closePopup) {
    subscribeBtn.addEventListener("click", () => {
    popupOverlay.style.display = "flex";
    });

    // Close popup
    closePopup.addEventListener("click", () => {
    popupOverlay.style.display = "none";
    });
  }
</script>

