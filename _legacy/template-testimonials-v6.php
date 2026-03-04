<?php
/**
 * Template Name: Testimonials Page v6
 * Description: Testimonials page template with video and text testimonials sections.
 */

// Signal to disable Elementor assets for this template
//hs2026_disable_elementor_assets();

get_header(); ?>

<main class="bg-white">
    <!-- Hero Section -->
    <section class="bg-light-blue py-20 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-title font-bold text-black mb-6 leading-tight">
                This is possible<br />for you, too :)
            </h1>
            <h2 class="text-2xl md:text-4xl font-title font-bold text-black mb-8">
                student success stories
            </h2>
            <p class="text-lg text-gold font-body max-w-3xl mx-auto">
                Real stories from real students who transformed their English speaking confidence and achieved their goals.
            </p>
        </div>
    </section>  

    <!-- Testimonials Section -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-title font-bold text-black text-center mb-12">
                Testimonials
            </h2>
            <?php
            // Reuse the new grid component with a taxonomy filter
            $grid_args = array(
                'post_type'      => 'testimonial',
                'posts_per_page' => 28,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'testimonials-group',
                        'field'    => 'slug',
                        'terms'    => 'featured',
                    ),
                ),
            );
            set_query_var('testimonials_query_args', $grid_args);
            get_template_part('testimonials-grid');
            ?>
        </div>
    </section>

    <!-- Recreated Testimonial Components (DaisyUI + Tailwind) -->
    <!-- Matches brand fonts, colors, spacing, and grid rules -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-title font-bold text-black text-center mb-12">Component Library – Testimonials</h2>

            <!-- Grid wrapper: 1 / 2 / 3 columns at breakpoints -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Testimonial card: Full-width dark quote -->
                <!-- Quote, large serif, centered, gold name + button -->
                <article class="testimonial-card quote-testimonial col-span-full">
                    <div class="card bg-neutral-800 text-white rounded-3xl p-10 md:p-16 shadow-card">
                        <div class="max-w-4xl mx-auto text-center">
                            <div class="text-5xl md:text-6xl text-gold mb-6">”</div>
                            <h3 class="font-title text-3xl md:text-5xl lg:text-6xl leading-tight mb-6">Now I can speak at work meetings and ask questions!</h3>
                            <p class="text-gold tracking-wide font-semibold text-sm md:text-base mb-6">KRYSTIAN POŁOMSKI</p>
                            <button class="btn bg-gold text-black border-0 rounded-full px-6 md:px-8 shadow-button">Read More</button>
                        </div>
                    </div>
                </article>

                <!-- Testimonial card: Light canvas quote -->
                <!-- Large serif, gold name, outline button -->
                <article class="testimonial-card quote-testimonial col-span-full">
                    <div class="card rounded-3xl bg-white shadow-card p-8 md:p-12">
                        <div class="max-w-5xl mx-auto">
                            <div class="text-5xl text-gold mb-4">”</div>
                            <p class="font-title text-2xl md:text-4xl lg:text-5xl text-black leading-snug mb-6">I really enjoyed this program very much and can't wait to rearrange my schedule to take a few modules again and keep improving! Practice and commitment pay off, so I'm excited to keep building habits.</p>
                            <div class="flex flex-wrap items-center gap-4">
                                <span class="text-gold tracking-wide font-semibold">DANILO J LARA</span>
                                <button class="btn btn-outline rounded-full border-gold text-black">Read More</button>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Testimonial card: Video left, quote right -->
                <!-- 2-col at md+, framed video, watch button -->
                <article class="testimonial-card video-testimonial col-span-full">
                    <div class="card rounded-3xl bg-white shadow-card p-6 md:p-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 items-center">
                            <!-- Video placeholder -->
                            <div class="w-full">
                                <div class="aspect-video rounded-xl bg-gray-200 overflow-hidden border border-gray-300">
                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/css/placeholder.webp'); ?>" alt="Video thumbnail" class="w-full h-full object-cover" />
                                </div>
                            </div>
                            <!-- Quote content -->
                            <div>
                                <div class="text-4xl text-gold mb-3">”</div>
                                <p class="font-title text-2xl md:text-3xl lg:text-4xl text-black leading-snug mb-6">New Sound was the best decision that I made in my English journey. I am in control of my message. Native speakers are saying that I'm clear now and they see me as much more confident!</p>
                                <div class="flex flex-wrap items-center gap-4">
                                    <span class="text-gold tracking-wide font-semibold">PAULA PERES</span>
                                    <button class="btn btn-outline rounded-full border-gold text-black inline-flex items-center gap-2">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                        Watch More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Testimonial card: Avatar left, quote right -->
                <article class="testimonial-card avatar-quote col-span-full">
                    <div class="card rounded-3xl bg-white shadow-card p-8 md:p-12">
                        <div class="grid grid-cols-1 md:grid-cols-[200px_1fr] items-center gap-6 md:gap-10">
                            <div class="flex justify-center md:justify-start">
                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/css/placeholder.webp'); ?>" alt="Avatar" class="w-40 h-40 md:w-48 md:h-48 rounded-full object-cover" />
                            </div>
                            <div>
                                <div class="text-4xl text-gold mb-3">”</div>
                                <p class="font-title text-2xl md:text-3xl lg:text-4xl text-black leading-snug mb-6">Recently, I had an interview for a program with 120 applicants, but only 15 were accepted, and I was one of them! In the interview, I was able to confidently introduce myself first in front of everyone. Joining New Sound was one of the best decisions I've ever made.</p>
                                <div class="flex flex-wrap items-center gap-4">
                                    <span class="text-gold tracking-wide font-semibold">HIROKO NEELY</span>
                                    <button class="btn btn-outline rounded-full border-gold text-black">Read More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Testimonial card: Compact quote (1 column) -->
                <article class="testimonial-card quote-small bg-white rounded-3xl shadow-card p-6 flex flex-col justify-between">
                    <!-- Quote -->
                    <h4 class="font-title text-2xl md:text-3xl text-black leading-snug mb-6">You can see the results of this course in 3 months.</h4>
                    <div class="flex items-center justify-between">
                        <span class="text-gold tracking-wide font-semibold">OSCAR RAMIREZ</span>
                        <button class="btn btn-outline rounded-full border-gold text-black">Read More</button>
                    </div>
                </article>

                <!-- Testimonial card: Compact with avatar (mobile-first) -->
                <article class="testimonial-card avatar-compact bg-white rounded-3xl shadow-card p-6 flex flex-col gap-4">
                    <!-- Avatar + name -->
                    <div class="flex items-center gap-4">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/css/placeholder.webp'); ?>" alt="Avatar" class="w-20 h-20 rounded-full object-cover" />
                        <div>
                            <p class="text-gold tracking-wide font-semibold">MARTA MONDÉJAR</p>
                        </div>
                    </div>
                    <!-- Quote -->
                    <p class="font-title text-xl md:text-2xl text-black leading-snug">Thanks to New Sound, I gained more confidence and am able to speak up in meetings and share my opinions. It used to feel scary to speak up in front of VPs, but not anymore!</p>
                    <!-- CTA -->
                    <div>
                        <button class="btn btn-outline rounded-full border-gold text-black inline-flex items-center gap-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                            Watch More
                        </button>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-gold py-20 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-5xl font-title font-bold text-black mb-6">
                Ready to transform your English?
            </h2>
            <p class="text-lg text-black font-body mb-8 max-w-2xl mx-auto">
                Join thousands of students who have already improved their pronunciation, confidence, and communication skills with our proven system.
            </p>
            <a href="#" class="inline-block bg-black text-white font-bold rounded-full px-8 py-4 shadow-button hover:shadow-lg transition text-lg">
                Join New Sound
            </a>
            
            <!-- Example: Vimeo Lightbox Trigger -->
            <div class="mt-6">
                <a href="#" class="open-video-lightbox inline-flex items-center text-black font-semibold" data-vimeo-id="76979871">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                    Watch Intro Video
                </a>
            </div>
        </div>
    </section>

    
    <!-- Modal Wrapper -->
    <div class="custom-modal" aria-modal="true" role="dialog" aria-hidden="true">
        <div class="custom-modal-box" data-modal-box>
            <button type="button" class="custom-modal-close" aria-label="Close">&#x2715;</button>
            <div class="custom-modal-content" data-modal-content></div>
        </div>
    </div>

</main>

<?php get_footer(); ?>

