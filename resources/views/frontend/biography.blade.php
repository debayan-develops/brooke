@include('frontend.includes.navbar')

@php
    $pageTitle = 'Brooke Hennen - Biography';
@endphp
@include('frontend.includes.header')
    <!-- ------------------------------ HEADER SECTION ------------------------------ -->
    
    @include('frontend.includes.navbar')
    <!-------------------------------  BANNER SECTION ------------------------------>
    
    <section>
        <div class="biograthy" >
            <div class="content cont">
                <h1 data-aos="zoom-in">Hay, I'm Brooke Hennen</h1>          
            </div>               
        </div>
    </section>

    <section>
        <div class="container mx-auto my-10">
            <div class="grid grid-cols-10 gap-4 px-5 xl:px-0">
                <div class="col-span-10 lg:col-span-6">
                    <h2 class="text-2xl lg:text-3xl font-bold">
                    While I was born just over the IN/MI state line in South Bend, IN, I spent the first twenty years of my life in Michigan.  
                    </h2>
                    <p class="  text-base lg:text-xl  tracking-wide pt-10">
                        There’s something entrancing about Lake Michigan.  It doesn’t matter which side of the lake I’m seeing it from – the Michigan side where I grew up, or the Chicago side I live a mile from.  Both sides of the lake are generally the same with a mild spring and fall, marvelous summers, while Michigan gets lake effect snow through most of the winter.  Chicago doesn’t get enough snow.  It’s just windy and cold.
                    </p>
                    <p class="py-10  text-base lg:text-xl  tracking-wide">
                        In third or fourth grade I read as many illustrated classics as I could get my hands on.  As soon as I was introduced to comic books, I dropped straight prose altogether until I was in college.  Life was X-Men all the time.  Although, by the time I was graduating high school I was reading at least twenty comic book titles a month.                    </p>
                    <p class="  text-base lg:text-xl  tracking-wide">
                        In high school I got hit by the “whammy” as my family called it – a good old mental health disorder (there’s an extensive history across the family bloodlines – just no one else diagnosed as I am). For myself, it’s a good old Schrodinger’s box of either bipolar disorder or cyclothymia. They’d need to open my brain up to be sure which – although with doctors retiring, moving to Unite Arab Emirates or myself changing states and therefore doctors, I’ve been diagnosed with major depression and ADHD (which formal testing recently said, nah, ya aren’t.).  Medication has been a daily part of life since high school with only a few breaks in the last twenty years.  This would be the inspiration behind two of my characters claiming the title “Moodswing”.  I don’t think it’s something that comes across when I first meet people.  It’s just something that people notice once they’ve had contact with me over longer periods of time.  The biggest symptom, or at least symptom of something, is my inability to keep a sleep schedule since junior high.  It leaves a good window of doubt as to whether my inability to get things done is simply slothfulness or a brain chemistry issue…or if those two things are simply intertwined in a way that’s out of line with what’s expected out of “normal” people.
                    </p>
                </div>
                <div class="bio-img-section col-span-10 lg:col-span-4">
                    <div class="">
                    </div>
                </div>
                
            </div>
            <div class="mt-5 px-5 xl:px-0">
                <div class="col-span-10">

                    <p class="  text-base lg:text-xl  tracking-wide pt-0 xl:pt-10">
                        Can’t say I was too interested in college.  I’d wanted to become a comic book artist, but going to the Joe Kubert School in Jersey was a bit much as I was graduating.  I’d been very much into art and drawing from middle school through my sophomore year in high school, but as soon as I was put on Prozac and whatever the insomnia drug was, drawing fell off the map.  Really, my whole personality changed according to some life-long friends.  It was just like I couldn’t picture things in my head the same way, nor did I have the same stamina to remain focused.  I could get some art projects done in the later years of high school, but it wasn’t until my meds changed my second year of college where I had a bit of a renaissance for drawing, painting and sculpting.  It was from those years that I decided to write the first comic script since my senior year of high school.
                    </p>
                    <p class="py-10  text-base lg:text-xl  tracking-wide">
                        Before I decided to specifically change college programs to a type of writing or English major, I moved down to Kentucky for a year.  It was there that I spent a year taking courses from Dr. Charlie Starr.  He was a C.S. Lewis scholar and also a comic book fan.  While we connected over Chris Claremont, Frank Millar, Watchmen and plenty of other comics, his humanities and C.S. Lewis seminar classes laid the Christian groundwork for the fiction I’ve come to write.
                    </p>
                    <p class="  text-base lg:text-xl  tracking-wide">
                        I didn’t return to Kentucky.  I remained in Michigan the following fall and researched the English programs at Western, Central, State and U of M as well as the Fiction program at Columbia College Chicago – where I decided to finish my undergrad.  I also completed my combined degree there: MFA in Creative Writing – Fiction and MA in Teaching of Writing.
                    </p>
                </div>
            </div>

            <div class="my-10 px-5 xl:px-0">
                <div class="">
                    <div class="inline">
                        <p class="text-2xl text-gray-400" style="display: ruby;">Our Expertise <img src="{{ '/images/right-arrow.png' }}" class="w-[80px]" alt="" srcset=""></p>
                    </div>  
                </div>
                <div class="max-w-[900px] mx-auto">
                    
                    <div class="grid grid-cols-10 gap-8 mt-10 pl-5">
                        
                        <div class="col-span-10 md:col-span-5" data-aos="zoom-in-right">
                            <a href="teaching-background.php" class="">
                                <div class="flex items-center mt-0">
                                    <div class="relative" style="rotate: -10deg;">
                                        <img src="{{ '/images/How I Organize My Writing 21st J.jpeg' }}" alt="UX/Wireframing" class="w-52 h-52 object-cover object-center rounded-lg shadow-lg ">
                                    </div>
                                    <h2 class="mt-4 ml-8 text-lg font-semibold">Teaching Background</h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-span-10 md:col-span-5 " data-aos="zoom-in-left">
                            <a href="non-profit-activity.php" class="">
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-8 justify-center items-center">
                                    <div class="flex items-center my-">
                                        <h2 class="mt-4 mr-8 text-lg font-semibold">Non-Profit Activity</h2>
                                        <div class="relative" style="rotate: 10deg;">
                                            <img src="{{ '/images/published-work.jpeg' }}" alt="UX/Wireframing" class="w-52 h-52 object-cover object-center rounded-lg shadow-lg ">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-span-10 md:col-span-5" data-aos="zoom-in-right">
                            <a href="organize-my-writing.php" class="">
                                <div class="flex items-center mt-16">
                                    <div class="relative" style="rotate: -10deg;">
                                        <img src="{{ '/images/How I Organize My Writing Notebooks.jpeg' }}" alt="UX/Wireframing" class="w-60 h-52 object-cover object-center rounded-lg shadow-lg ">
                                    </div>
                                    <h2 class="mt-4 ml-8 text-lg font-semibold">How do I organize my writing?</h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-span-10 md:col-span-5 " data-aos="zoom-in-left">
                            <a href="bible-stories.php" class="">
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-8 justify-center items-center">
                                    <div class="flex items-center my-16">
                                        <h2 class="mt-4 mr-8 text-lg font-semibold">Favorite Bible stories</h2>
                                        <div class="relative" style="rotate: 10deg;">
                                            <img src="{{ '/images/How I Organize My Writing PD Folder.jpeg' }}" alt="UX/Wireframing" class="w-52 h-52 object-cover object-center rounded-lg shadow-lg ">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-span-5" data-aos="zoom-in-right">
                            <div class="flex items-center mt-">
                                <div class="relative" style="rotate: -10deg;">
                                  <img src="{{ '/images/book-reading-1.jpg' }}" alt="UX/Wireframing" class="w-52 h-52 object-cover object-center rounded-lg shadow-lg ">
                                </div>
                                <h2 class="mt-4 ml-8  text-base lg:text-xl  font-semibold">Your Title Here</h2>
                            </div>
                        </div>
                        <div class="col-span-5 " data-aos="zoom-in-left">
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-8 justify-center items-center">
                                <div class="flex items-center my-">
                                  <h2 class="mt-4 mr-8  text-base lg:text-xl  font-semibold">Your Title Here</h2>
                                  <div class="relative" style="rotate: 10deg;">
                                    <img src="{{ '/images/book-reading-3.jpg' }}" alt="UX/Wireframing" class="w-52 h-52 object-cover object-center rounded-lg shadow-lg ">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                
            </div>
            <div class="container mx-auto">
                <div class="grid grid-cols-1">
                    <div class="">
                        <p class="pt-10  text-base lg:text-xl  tracking-wide">
                            It was there in Chicago where I began attending Park Community Church, and where I met my wife, Richelle.  For Easter in 2009 I wrote monologues to be performed for the children’s Easter service (which you can find here).  I ended up playing Judas, model of integrity and honesty, as we know, and Richelle was making the costumes.  So at the Wednesday night dress rehearsal, she was sizing me up for my costume (and possibly more!).  We began dating a month or so later and were married before the next Easter.
                        </p>
                        <p class="py-10  text-base lg:text-xl  tracking-wide">
                            Over the last decade, I’ve had a mix of odd jobs.  I went from simply operations to janitor.  I was an assistant DJ for a while.  Worked for a tutoring agency that had me commuting over two hours each way.  I had the privilege of teaching some college courses all the while continuing work on multiple novels.  There was a around ten years where Richelle and I were heavily engaged as volunteers in a grassroot anti-human trafficking non-profit, Traffick Free.  It’s how I preferred to get my vigilantism on for that near decade.  I even hosted a booth at C2E2 for Traffick Free for a few years to share that opportunity with other fans of superheroes and vigilantes.                        
                        </p>
                        <p class="  text-base lg:text-xl  tracking-wide">
                            The last year was spent editing three novels, and I’ve tired of waiting to get through rewrites and decided now’s the time to restructure and launch.  While I began a Substack and mirrored my work in a few different places while publishing my work a few years back, I longed to start something that I could call my own: a place where I could more freely publish my work with a simpler way to navigate than endless scrolling on Substack or Locals.  This site is designed to be a place where I can separate out the types of material I’m writing so blogs aren’t making it more difficult to find new or older fiction readers may be looking for.  I’m planning to release early drafts along with current drafts for those interested in examining my progress and trying to do something like that on current social media sites sounded like a nightmare to me or for readers to easily navigate.                        </p>
                        <p class="pt-10  text-base lg:text-xl  tracking-wide">
                            So here we are, launching something new.  My own little boat in the sea of fictional stories.  
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


  <script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {
      dropdownMenu.classList.toggle('hidden');
    });
  </script>

    <!------------------------------- NEW FOOTER SECTION ---------------------------- -->
    
@include('frontend.includes.footer')