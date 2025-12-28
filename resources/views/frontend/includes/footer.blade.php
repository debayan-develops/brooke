        <!-- ⬆️ Scroll-to-Top Button -->
        <button id="scrollToTopBtn"
        class="fixed bottom-5 right-5 z-50 p-3 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 hover:scale-110 transition-all duration-300 opacity-0 invisible">
            <svg class="w-5 h-5 arrow-icon transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </button>
        
        <footer class="footer-section ">
            <div class="container mx-auto px-5">
                <div class="footer-cta pt-5 pb-5">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class=" mb-30 ml-20">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Find us</h4>
                                <span><a href="#" target="_blank" class="hover:text-[#2c446c]"> Chicago</a></span>
                            </div>
                        </div>
                    </div>
                    <div class=" mb-30 ml-20">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Call us</h4>
                                <span><a class=" hover:text-[#2c446c]" href="tel:872-261-2813"> 872-261-2813 </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class=" mb-30 ml-20">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Mail us</h4>
                                <span><a href="mailto:contact@brookehennen.com" class=" hover:text-[#2c446c]" target="_blank" rel="noopener noreferrer">contact@brookehennen.com</a></span>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
                <div class=" py-9">
                <div class="grid md:grid-cols-1 xl:grid-cols-1">
                    <div class="flex items-center justify-center col-span-full xl:col-span-1">
                        <div class="footer-widget">
                            <div class="footer-logo text-white text-6xl">
                            <p class=" 2xl:text-6xl text-center lg:text-5xl tracking-wide italic uppercase">
                                <a href="{{ route('frontend.home') }}" class="logo-font">brooke hennen</a>
                            </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center md:text-start">
                        <div class="text-center">
                        <!-- <h4>Follow us</h4> -->
                        
                        <a href="https://www.facebook.com/brookehennen" target="_blank" class="inline-block"> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/facebook.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        <a href="https://x.com/congatsulations" target="_blank" class="inline-block"> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/twitter.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        <a href="https://www.linkedin.com/in/brooke-hennen-81972598/" target="_blank" class="inline-block"> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/linkedin.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        <a href="https://breakingdownthepage.substack.com/" target="_blank" class="inline-block"> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/substack.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        <a href="https://www.youtube.com/channel/UCeQnKRnBf0deyg6vMRpnJZQ" target="_blank" class="inline-block"> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/youtube.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        <a href="https://rumble.com/c/c-1368502" target="_blank" class="inline-block "> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/rumble.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        <a href="https://breakingdownthepage.locals.com" target="_blank" class="inline-block "> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/locals.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        <a href="https://discord.gg/3v7nEja5fK" target="_blank" class="inline-block "> 
                            <div class="bg-[#14a9ce] p-3 rounded-full">
                            <img src="{{ '/images/discord.png' }}" class="w-4" alt="" srcset="">
                            </div>
                        </a>
                        </div>
                    </div>
                    
                </div>
                </div>
            </div>
            <div class="copyright-area px-5">
                <div class="container mx-auto">
                    <div class="">
                        <div class="text-center text-lg-left">
                            <div class="copyright-text">
                                <p>Copyright &copy; 2025, All Right Reserved |</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            
            AOS.init({
            duration: 1000
            });

            // Scroll to Top Button Functionality
            const scrollBtn = document.getElementById('scrollToTopBtn');
            let isVisible = false;

            if (scrollBtn) {
                window.addEventListener('scroll', () => {
                    const scrolled = window.scrollY > 150;

                    if (scrolled && !isVisible) {
                    scrollBtn.classList.add('opacity-80', 'visible', 'bounce-in');
                    scrollBtn.classList.remove('opacity-0', 'invisible');
                    isVisible = true;
                    } else if (!scrolled && isVisible) {
                    scrollBtn.classList.remove('opacity-80', 'visible', 'bounce-in');
                    scrollBtn.classList.add('opacity-0', 'invisible');
                    isVisible = false;
                    }
                });

                scrollBtn.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // sidebar open close js code
            let navLinks = document.querySelector(".nav-links");
            let menuOpenBtn = document.querySelector(".navbar .bx-menu");
            let menuCloseBtn = document.querySelector(".nav-links .bx-x");
            
            if (navLinks && menuOpenBtn && menuCloseBtn) {
                menuOpenBtn.onclick = function() {
                navLinks.style.left = "0";
                }
                menuCloseBtn.onclick = function() {
                navLinks.style.left = "-100%";
                }
            }

            // sidebar submenu open close js code
            let htmlcssArrow = document.querySelector(".htmlcss-arrow");
            if (navLinks && htmlcssArrow) {
                htmlcssArrow.onclick = function() {
                navLinks.classList.toggle("show1");
                }
            }
            let moreArrow = document.querySelector(".more-arrow");
            if (navLinks && moreArrow) {
                moreArrow.onclick = function() {
                navLinks.classList.toggle("show2");
                }
            }
            let jsArrow = document.querySelector(".js-arrow");
            if (navLinks && jsArrow) {
                jsArrow.onclick = function() {
                navLinks.classList.toggle("show3");
                };
            }

            function toggleOtherField() {
                const hearAbout = document.getElementById('hear-about');
                const otherField = document.getElementById('other-field');
                if (hearAbout && otherField) {
                    otherField.style.display = hearAbout.value === 'Other' ? 'block' : 'none';
                }
            }

        </script>
        @stack('scripts')
    </body>
</html>

