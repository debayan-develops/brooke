@php

    $pageTitle = 'Brooke Hennen - HOME';

@endphp

@include('frontend.includes.header')

@include('frontend.includes.navbar')



<!-------------------------------  BANNER SECTION ------------------------------>



<section>

  <div class="home-banner-1">

    <div class="content cont">

    </div>



    <div  class="img-wrap-1" data-aos="fade-up-right" id="bio">

      <a href="{{ route('frontend.page.published-work') }}">

        <img src="{{ '/images/published-work.jpeg' }}" alt="4" class="">

        <h3 class="py-3 text-center text-base xl:text-xl font-semibold">Published Work</h3>

      </a>

    </div>



    <div class="img-wrap-2" data-aos="fade-down-right">

      <a href="{{ route('frontend.page.fiction') }}">

        <img src="{{ '/images/Fall.jpg' }}" alt="4" class="">

        <h3 class="py-3 text-center text-base xl:text-xl font-semibold">Fictional Works</h3>

      </a>

    </div>



    <div class="img-wrap-3" data-aos="zoom-in-down">

      <a href="#bio">

        <img src="{{ '/images/photo.JPG' }}" alt="4" class="">

        <h3 class="py-3 text-center text-base xl:text-xl font-semibold">About Brooke</h3>

      </a>

    </div>



    <div class="img-wrap-4" data-aos="fade-down-left">

      <a href="{{ route('frontend.page.non-fiction') }}">

        <img src="{{ '/images/IMG_0978.JPG' }}" alt="4" class="">

        <h3 class="py-3 text-center text-base xl:text-xl font-semibold">Non-Fictional Works</h3>

      </a>

    </div>



    <div class="img-wrap-5" data-aos="fade-up-left">

      <a href="{{ route('frontend.page.biography') }}">

        <img src="{{ '/images/IMG_1245.JPG' }}" alt="4" class="">

        <h3 class="py-3 text-center text-base xl:text-xl font-semibold">More About Brooke </h3>

      </a>

    </div>

  </div>

</section>

<!------------------------------- Biography  SECTION ------------------------------>



<section >

  <div class="container mx-auto">

    <div class="grid grid-cols-10 gap-8">

      <div class="col-span-10 md:col-span-4">

        <div class=" md:hidden block text-5xl text-center font-semibold my-5 tracking-wider">

          <h3 class="text-[#333]">Brooke Hennen</h3>

        </div>

        <div class="px-5 xl:px-8 rounded-br-lg">

          <img src="{{ '/images/cape-2.jpg' }}" class="border-right-buttom" alt="" srcset="">

        </div>

      </div>

      <div class="col-span-10 md:col-span-6 px-5 md:px-0">

        <div class="hidden md:block text-6xl font-semibold mt-12 tracking-wider">

          <h3 class="text-[#333]">Brooke Hennen</h3>

        </div>

        <div class="py-5 text-sm lg:text-base xl:text-xl tracking-wide">

          <p>

          While I was born just over the IN/MI state line in South Bend, IN, I spent the first twenty years of my life in Michigan.  There's something entrancing about Lake Michigan.  It doesn't matter which side of the lake I'm seeing it from – the Michigan side where I grew up, or the Chicago side I live a mile from.  Both sides of the lake are generally the same with a mild spring and fall, marvelous summers, while Michigan gets lake effect snow through most of the winter.  Chicago doesn't get enough snow.  It's just windy and cold.

          </p>

        </div>



        <div class="">

          <a href="{{ route('frontend.page.biography') }}" class="">

            <div class="btn">

              <div class="btn-content">Read More <i class="fa-solid fa-arrow-right-long"></i></div>

            </div>

          </a>

        </div>

        <div class="text-5xl  hidden xl:block  py-8">

          <h3 class="text-[#333]">Recent Fiction</h3>

        </div>

      </div>

      <div class="col-span-10 md:col-span-4 px-0 xl:px-8">

        <div class="px-5 py-5">

          <p class="text-xl text-gray-600 py-2">BORN</p>

          <h3 class="text-4xl uppercase text-[#027b9a]">01 june 1983</h3>

          <p class="text-xl text-gray-600 py-2">South Bend, Indiana</p>

        </div>

      </div>

      <div class="md:col-start-5 col-span-10 md:col-span-6">

        <div class="text-5xl block xl:hidden px-5 py-8">

          <h3 class="text-[#333]">Recent Fiction</h3>

        </div>

        <div class="swiper mySwiper">

          <div class="swiper-wrapper book-list h-[390px]">

            <div class="swiper-slide book-item">

              <a href="#" id="" class="">

                <div class="book-link text-center bg-gray-500 mx-20 md:mx-0">

                  <img src="{{ '/images/demo-book.png' }}" alt="" class="book-img" srcset="">

                </div>

                <h4 class="pt-2 pb-3 text-lg capitalize hover:text-[#027b9a] font-semibold text-center text-gray-800">

                  A Rainy Day in King Solomon's Court

                </h4>

              </a>

            </div>

            <div class="swiper-slide book-item">

              <a href="#" id="" class="">

                <div class="book-link text-center bg-gray-500 mx-20 md:mx-0">

                  <img src="{{ '/images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg' }}" alt="" class="book-img" srcset="">

                </div>

                <h4 class="pt-2 pb-3 text-lg capitalize hover:text-[#027b9a] font-semibold text-center text-gray-800">

                  Indiana Everglades Pt.1

                </h4>

              </a>

            </div>

            <div class="swiper-slide book-item">

              <a href="#" id="" class="">

                <div class="book-link text-center bg-gray-500 mx-20 md:mx-0">

                  <img src="{{ '/images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg' }}" alt="" class="book-img" srcset="">

                </div>

                <h4 class="pt-2 pb-3 text-lg capitalize hover:text-[#027b9a] font-semibold text-center text-gray-800">

                  Indiana Everglades Pt.2

                </h4>

              </a>

            </div>

            <div class="swiper-slide book-item">

              <a href="#" id="" class="">

                <div class="book-link text-center bg-gray-500 mx-20 md:mx-0">

                  <img src="{{ '/images/Mozart-Letter-Thumbnail-Image.jpg' }}" alt="" class="book-img" srcset="">

                </div>

                <h4 class="pt-2 pb-3 text-lg capitalize hover:text-[#027b9a] font-semibold text-center text-gray-800">

                  A Mozart Letter Story: I Met A Girl

                </h4>

              </a>

            </div>

          </div>

          <div class="swiper-scrollbar"></div>

        </div>

      </div>

    </div>

  </div>

</section>



<!------------------------------- OUR BLOGS SECTION ------------------------------>



<section class="bg-[#FFF8E5] py-16 " id="newsletter">

  <div class="container mx-auto mb-20">

    <h2 class="text-5xl pb-10 text-center text-[#333] tracking-wider">

      Latest Blogs And Posts

    </h2>

    <div class="grid grid-cols-10  gap-8">

      <div class="col-span-10 xl:col-span-7">

        <div class="grid grid-cols-12 gap-4">

          <div class="col-span-12 md:col-span-6 xl:col-span-6 pt-5 h-[365px] px-5">

            <div class="">

              <div class="img-box">

                <img src="{{ '/images/bg-1.jpg' }}" alt="Person using laptop" class="image">

                <div class="text-box">

                  <div class="title">A Rainy Day in King Solomon's Court</div>

                  <a href="#" class="read-more">READ MORE</a>

                </div>

              </div>

            </div>

          </div>

          <div class="col-span-12 md:col-span-6 xl:col-span-6 pt-5 h-[365px] px-5">

            <div class="">

              <div class="img-box">

                <img src="{{ '/images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg' }}" alt="Person using laptop" class="image">

                <div class="text-box">

                  <div class="title">The Journey from Hardcopy to Semi-Digital Pt. 1</div>

                  <a href="#" class="read-more">READ MORE</a>

                </div>

              </div>

            </div>

          </div>

          <div class="col-span-12 md:col-span-6 xl:col-span-6 pt-5 h-[365px] px-5">

            <div class="">

              <div class="img-box">

                <img src="{{ '/images/Apocalypse-and-Archangel-First-Appearance.jpg' }}" alt="Person using laptop" class="image">

                <div class="text-box">

                  <div class="title">Maintaining the Collection Pt. 1</div>

                  <a href="#" class="read-more">READ MORE</a>

                </div>

              </div>

            </div>

          </div>

          <div class="col-span-12 md:col-span-6 xl:col-span-6 pt-5 h-[365px] px-5">

            <div class="">

              <div class="img-box">

                <img src="{{ '/images/Falling-Into-Love-With-Comics-Again.jpg' }}" alt="Person using laptop" class="image">

                <div class="text-box">

                  <div class="title">Falling in Love with (American) Comics Again Pt.1</div>

                  <a href="#" class="read-more">READ MORE</a>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="col-span-10 xl:col-span-3 px-5" >

        <div class="bg-gray-100 flex ">

          <div class="bg-white p-6 rounded-lg w-full  shadow-lg">

            <h4 class="text-3xl py-3 mb-3 text-gray-700 font-semibold border-b-2 border-slate-500 border-dashed  ">Topics</h4>

            <ul class="space-y-4">

                <li class="flex justify-between">

                  <a href="{{ route('frontend.page.fiction') }}"><span class="text-lg text-gray-900 hover:text-[#027b9a]">Fiction</span></a>

                  <span class="text-lg font-bold text-gray-500">4</span>

                </li>

                <li class="flex justify-between">

                  <a href="{{ route('frontend.page.non-fiction') }}"><span class="text-lg text-gray-900 hover:text-[#027b9a]">Non-Fiction</span></a>

                  <span class="text-lg font-bold text-gray-500">3</span>

                </li>

            </ul>

          </div>

        </div>

      </div>

    </div>

  </div>

</section>



@include('frontend.includes.footer')



@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

    const swiper = new Swiper(".mySwiper", {

        slidesPerView: 1,

        spaceBetween: 20,

        loop: true,

        grabCursor: true,

        scrollbar: {

            el: ".swiper-scrollbar",

            draggable: true,

        },

        breakpoints: {

            640: {

                slidesPerView: 2,

                spaceBetween: 20,

            },

            768: {

                slidesPerView: 3,

                spaceBetween: 30,

            },

            1024: {

                slidesPerView: 4,

                spaceBetween: 40,

            },

        },

    });

</script>

@endpush