@php
    $pageTitle = 'Brooke Hennen - Fiction';
@endphp
@include('frontend.includes.header')
@include('frontend.includes.navbar')
  <!-------------------------------  BANNER SECTION ------------------------------>
  
  <section>
    <div class="fiction-banner">
      <div class="banner-content">
        <h1 class="text-5xl text-white">Fiction</h1>
        <!-- <p class="text-2xl py-5 text-white">Connect your family with resources related to health and social services</p> -->
      </div>
    </div>
  </section>

    <section class="py-16 " id="newsletter">
        <div class="container mx-auto">
            <div class="grid grid-cols-10  gap-8">
                <div class="col-span-10 xl:col-span-7">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-6 xl:col-span-5 h-[365px] px-5">
                            <div class="">
                                <div class="img-box">
                                <img src="{{ '/images/bg-1.jpg' }}" alt="Person using laptop" class="image">
                                <div class="text-box-2">
                                    <!-- <div >
                                        <p class="date">2 weeks ago</p>
                                    </div> -->
                                    <div class="fiction-blog">A Rainy Day in King Solomon’s Court</div>
                                    <a href="a-rainy-day.php" class="read-more">READ MORE</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 xl:col-span-5 h-[365px] px-5">
                            <div class="">
                                <div class="img-box">
                                    <img src="{{ '/images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg' }}" alt="Person using laptop" class="image">
                                    <div class="text-box-2">
                                        <!-- <div >
                                            <p class="date">1 weeks ago</p>
                                        </div> -->
                                        <div class="fiction-blog">Indiana Everglades Pt.1</div>
                                        <a href="indiana-everglades-pt-1.php" class="read-more">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 xl:col-span-5 pt-5 h-[365px] px-5">
                            <div class="">
                                <div class="img-box">
                                    <img src="{{ '/images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg' }}" alt="Person using laptop" class="image">
                                    <div class="text-box-2">
                                        <!-- <div >
                                            <p class="date">3 weeks ago</p>
                                        </div> -->
                                        <div class="fiction-blog">Indiana Everglades Pt.2</div>
                                        <a href="indiana-everglades-pt-2.php" class="read-more">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 xl:col-span-5 pt-5 h-[365px] px-5 ">
                            <div class="">
                                <div class="img-box">
                                    <img src="{{ '/images/Mozart-Letter-Thumbnail-Image.jpg' }}" alt="Person using laptop" class="image">
                                    <div class="text-box-2">
                                        <!-- <div >
                                            <p class="date">1 weeks ago</p>
                                        </div> -->
                                        <div class="fiction-blog">A Mozart Letter Story: I Met A Girl</div>
                                        <a href="a-mozart-letter.php" class="read-more">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- <div class="col-span-10 mt-8">
                            <div class="flex justify-center">
                                <a target="_top" id="button" class="bg-[#00bef0] px-5 py-3 text-white uppercase mt-5 flex justify-center w-[200px] hover:scale-105 shadow hover:shadow-black hover:shadow-2xl transition duration-500 ease-in-out" href="#" rel="nofollow">view all posts</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                

                <div class="col-span-10 xl:col-span-3 px-5">
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

  <!------------------------------- NEW FOOTER SECTION ---------------------------- -->
    
@include('frontend.includes.footer')