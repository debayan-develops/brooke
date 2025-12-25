@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - Published Work';
@endphp
@include('frontend.includes.header')
  <!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
  @include('frontend.includes.navbar')
  <!-------------------------------  BANNER SECTION ------------------------------>
  
  <section>
        <div class="published-banner">
            <div class="banner-content">
                <h1 class="text-5xl text-white">Published Work</h1>
                <!-- <p class="text-2xl py-5 text-white">Connect your family with resources related to health and social services</p> -->
            </div>
        </div>
  </section>

  <section>
        <div class="container mx-auto pt-5 my-10">
            <!-- <h2 class="text-5xl py-10 text-center text-[#333] tracking-wider">
                Fiction And Non-fiction Posts
            </h2> -->
            <div class="grid grid-cols-10 gap-8">
                <div class="col-span-10">
                    
                </div>
                
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-6  xl:col-span-4 h-[365px] px-4">
                    <div class="">
                        <div class="img-box">
                            <img src="{{ asset('images/bg-1.jpg') }}" alt="Person using laptop" class="image">
                            <div class="text-box">
                                <!-- <div >
                                <p class="date">2 weeks ago</p>
                                </div> -->
                                <div class="title">A Rainy Day in King Solomon’s Court</div>
                                <a href="a-rainy-day.php" class="read-more">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6  xl:col-span-4 h-[365px] px-4">
                    <div class="">
                        <div class="img-box">
                            <img src="{{ asset('images/The-Journey-from-Hardcopy-to-Semi-Digital-Icon.jpg') }}" alt="Person using laptop" class="image">
                            <div class="text-box">
                                <!-- <div >
                                <p class="date">1 weeks ago</p>
                                </div> -->
                                <div class="title">The Journey from Hardcopy to Semi-Digital Pt. 1</div>
                                <a href="the-journey.php" class="read-more">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6  xl:col-span-4 h-[365px] px-4">
                    <div class="">
                        <div class="img-box">
                            <img src="{{ asset('images/Apocalypse-and-Archangel-First-Appearance.jpg') }}" alt="Person using laptop" class="image">
                            <div class="text-box">
                                
                                <div class="title">Maintaining the Collection Pt. 1</div>
                                <a href="maintaing-the-collection-pt-1.php" class="read-more">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6  xl:col-span-4 h-[365px] px-4">
                    <div class="">
                        <div class="img-box">
                            <img src="{{ asset('images/Falling-Into-Love-With-Comics-Again.jpg') }}" alt="Person using laptop" class="image">
                            <div class="text-box">
                                
                                <div class="title">Falling in Love with (American) Comics Again Pt.1</div>
                                <a href="falling-in-love.php" class="read-more">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6  xl:col-span-4 h-[365px] px-4">
                    <div class="">
                        <div class="img-box">
                            <img src="{{ asset('images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg') }}" alt="Person using laptop" class="image">
                            <div class="text-box">
                                <!-- <div >
                                    <p class="date">1 weeks ago</p>
                                </div> -->
                                <div class="title">Indiana Everglades Pt.1</div>
                                <a href="indiana-everglades-pt-1.php" class="read-more">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6  xl:col-span-4 h-[365px] px-4">
                    <div class="">
                        <div class="img-box">
                            <img src="{{ asset('images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg') }}" alt="Person using laptop" class="image">
                            <div class="text-box">
                                <!-- <div >
                                    <p class="date">3 weeks ago</p>
                                </div> -->
                                <div class="title">Indiana Everglades Pt.2</div>
                                <a href="indiana-everglades-pt-2.php" class="read-more">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-4  md:col-span-6 md:col-start-4 xl:col-start-5 h-[365px] px-4">
                    <div class="">
                        <div class="img-box">
                            <img src="{{ asset('images/Mozart-Letter-Thumbnail-Image.jpg') }}" alt="Person using laptop" class="image">
                            <div class="text-box">
                                <!-- <div >
                                    <p class="date">1 weeks ago</p>
                                </div> -->
                                <div class="title">A Mozart Letter Story: I Met A Girl</div>
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
  </section>
        
</body>
  
  
  <!------------------------------- NEW FOOTER SECTION ---------------------------- -->
    
@include('frontend.includes.footer')