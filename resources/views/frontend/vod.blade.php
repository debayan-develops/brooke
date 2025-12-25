@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - VOD';
@endphp
@include('frontend.includes.header')
    <!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
    @include('frontend.includes.navbar')
    <!-------------------------------  BANNER SECTION ------------------------------>
    
    <section>
        <div class="work-banner">
            <div class="banner-content">
                <h1 class="text-5xl text-white">VOD</h1>
                <!-- <p class="text-2xl py-5 text-white">Connect your family with resources related to health and social services</p> -->
            </div>
        </div>
    </section>

    <!-- OUR WORKS SECTION START -->

    <section class="home-ourwork my-10" >
        <div class="container mx-auto relative item" data-aos="zoom-in">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-8 text-center px-8 sm:px-0 py-6">

                <div class="bg-gray-400 work work-bg1 relative" onclick="playVideo('www.youtube.com/embed/Ve-a-dBehs8?autoplay=1&controls=0&loop=1')">
                    <!-- <img src="{{ '/images/play.png' }}" alt="" srcset="" >  -->
                    <div class="work-info">
                        <h4>Sin City Review</h4>
                        <!-- <p>Ut sagittis velit nisi, vestibulum scelerisque libero maximus nec. Aenean fermentum nisi et urna ultricies, vitae pulvinar eros congue.</p> -->
                    </div>
                </div>
                <div class="bg-gray-400 work work-bg2 relative" onclick="playVideo('www.youtube.com/embed/w8VoHSGB7xE?autoplay=1&controls=0&loop=1')">
                    <!-- <img src="{{ '/images/play.png' }}" alt="" srcset="" >  -->
                    <div class="work-info">
                        <h4>Syncing Scrivener Desktop to Mobile </h4>
                        <!-- <p>Ut sagittis velit nisi, vestibulum scelerisque libero maximus nec. Aenean fermentum nisi et urna ultricies, vitae pulvinar eros congue.</p> -->
                    </div>
                </div>
                <div class="bg-gray-400 work work-bg3 relative" onclick="playVideo('www.youtube.com/embed/duyg_5K0MJI?autoplay=1&controls=0&loop=1')">
                    <!-- <img src="{{ '/images/play.png' }}" alt="" srcset="" >  -->
                    <div class="work-info">
                        <h4> Breaking Down "Good Readers and Good Writers" by Vladimir Nabokov </h4>
                        <!-- <p>Ut sagittis velit nisi, vestibulum scelerisque libero maximus nec. Aenean fermentum nisi et urna ultricies, vitae pulvinar eros congue.</p> -->
                    </div>
                </div>

            </div>

        </div>
            
    </section>

    <!-- Popup Video Player Function  -->

    <div class="modal" id="videoPlayer">
        <div class="modal-content">
            <iframe width="100%" id="myVideo" src="" title="YouTube video player" frameborder="0"  referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <img src="{{ '/images/close.png' }}" class="close-btn" alt="" srcset="" onclick="stopVideo()">

    </div>

    <!------------------------------- NEW FOOTER SECTION ---------------------------- -->
    
    <script>
        // onclick popup video open-close function 
        var videoPlayer = document.getElementById('videoPlayer');
            var myVideo = document.getElementById('myVideo');

            function stopVideo() {
                myVideo.src = "";
                videoPlayer.style.display = "none";
            }

            function playVideo(file) {
                myVideo.src = "https://" + file;
                
                videoPlayer.style.display = "block"
            }
    </script>

@include('frontend.includes.footer')