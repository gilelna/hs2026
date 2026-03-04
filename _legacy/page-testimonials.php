<?php
/**
 * Template Name: Testimonials Page
 * Description: Testimonials page template with video and text testimonials sections.
 */

// Signal to disable Elementor assets for this template
if ( function_exists( 'hs2026_disable_elementor_assets' ) ) {
    hs2026_disable_elementor_assets();
}

get_header(); ?>

<main class="bg-white">
    <!-- Hero Section -->
    <section class="bg-light-blue py-20 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-title font-bold text-black mb-6 leading-tight">
                This is possible<br />for you, too
            </h1>
            <h2 class="text-2xl md:text-4xl font-title font-bold text-black mb-8">
                student success stories
            </h2>
            <p class="text-lg text-gold font-body max-w-3xl mx-auto">
                Real stories from real students who transformed their English speaking confidence and achieved their goals.
            </p>
        </div>
    </section>

    <!-- Video Testimonials Section -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-title font-bold text-black text-center mb-12">
                Video Testimonials
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Video Testimonial Card 1 -->
                <div class="bg-white rounded-xl shadow-card overflow-hidden transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="relative">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Francis Kodama testimonial" class="w-full h-48 object-cover" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-black ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 font-body mb-4 line-clamp-3">
                            "This course gave me back my superpower: To communicate with confidence."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gold rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                FK
                            </div>
                            <div>
                                <p class="font-semibold text-black">Francis Kodama</p>
                                <p class="text-sm text-gold">Brazil</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Testimonial Card 2 -->
                <div class="bg-white rounded-xl shadow-card overflow-hidden transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="relative">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Adriana Phaneuf testimonial" class="w-full h-48 object-cover" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-black ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 font-body mb-4 line-clamp-3">
                            "Now I speak up at work. My co-workers say I sound more confident."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-soft-blue rounded-full flex items-center justify-center text-black font-bold text-sm mr-3">
                                AP
                            </div>
                            <div>
                                <p class="font-semibold text-black">Adriana Phaneuf</p>
                                <p class="text-sm text-gold">Canada</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Testimonial Card 3 -->
                <div class="bg-white rounded-xl shadow-card overflow-hidden transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="relative">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Muxiang Liu testimonial" class="w-full h-48 object-cover" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-black ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 font-body mb-4 line-clamp-3">
                            "I launched my own podcast and YouTube channel where I make daily content in English."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-peach rounded-full flex items-center justify-center text-black font-bold text-sm mr-3">
                                ML
                            </div>
                            <div>
                                <p class="font-semibold text-black">Muxiang Liu Pajerski</p>
                                <p class="text-sm text-gold">United States</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Testimonial Card 4 -->
                <div class="bg-white rounded-xl shadow-card overflow-hidden transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="relative">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Juan Carlos testimonial" class="w-full h-48 object-cover" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-black ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 font-body mb-4 line-clamp-3">
                            "With this course I've solved nearly 80% of my pronunciation problems."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-teal rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                JC
                            </div>
                            <div>
                                <p class="font-semibold text-black">Juan Carlos Cilleruelo</p>
                                <p class="text-sm text-gold">Spain</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Testimonial Card 5 -->
                <div class="bg-white rounded-xl shadow-card overflow-hidden transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="relative">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Kyunghee Ko testimonial" class="w-full h-48 object-cover" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-black ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 font-body mb-4 line-clamp-3">
                            "Before, I was very insecure about how I was communicating with my child in English."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-light-purple rounded-full flex items-center justify-center text-black font-bold text-sm mr-3">
                                KK
                            </div>
                            <div>
                                <p class="font-semibold text-black">Kyunghee Ko</p>
                                <p class="text-sm text-gold">South Korea</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Testimonial Card 6 -->
                <div class="bg-white rounded-xl shadow-card overflow-hidden transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="relative">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Filippo Pardossi testimonial" class="w-full h-48 object-cover" />
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-black ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 font-body mb-4 line-clamp-3">
                            "Before New Sound my English was a B1 and now it is a C1."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-pink rounded-full flex items-center justify-center text-black font-bold text-sm mr-3">
                                FP
                            </div>
                            <div>
                                <p class="font-semibold text-black">Filippo Pardossi</p>
                                <p class="text-sm text-gold">Italy</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Text Testimonials Section -->
    <section class="bg-light-blue py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-title font-bold text-black text-center mb-12">
                Read 250+ success stories from students like you
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Text Testimonial Card 1 -->
                <div class="bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-gold rounded-full flex items-center justify-center text-white font-bold text-sm mr-3 flex-shrink-0">
                            HK
                        </div>
                        <div>
                            <p class="font-semibold text-black">Hiroko Neely</p>
                            <p class="text-sm text-gold">Japan</p>
                        </div>
                    </div>
                    <p class="text-gray-700 font-body mb-4 line-clamp-4">
                        "Recently, I had an interview for a program with 120 applicants, but only 15 were accepted, and I was one of them! In the interview, I was able to confidently introduce myself first in front of everyone."
                    </p>
                    <div class="text-right">
                        <span class="text-sm text-gold font-semibold">Read More</span>
                    </div>
                </div>

                <!-- Text Testimonial Card 2 -->
                <div class="bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-soft-blue rounded-full flex items-center justify-center text-black font-bold text-sm mr-3 flex-shrink-0">
                            AD
                        </div>
                        <div>
                            <p class="font-semibold text-black">Armella Demeter</p>
                            <p class="text-sm text-gold">Germany</p>
                        </div>
                    </div>
                    <p class="text-gray-700 font-body mb-4 line-clamp-4">
                        "After just three months, I can easily have conversations in English with people from all around the world. The community support was incredible."
                    </p>
                    <div class="text-right">
                        <span class="text-sm text-gold font-semibold">Read More</span>
                    </div>
                </div>

                <!-- Text Testimonial Card 3 -->
                <div class="bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-peach rounded-full flex items-center justify-center text-black font-bold text-sm mr-3 flex-shrink-0">
                            JC
                        </div>
                        <div>
                            <p class="font-semibold text-black">Jacqueline Conde</p>
                            <p class="text-sm text-gold">Mexico</p>
                        </div>
                    </div>
                    <p class="text-gray-700 font-body mb-4 line-clamp-4">
                        "I've seen people spend thousands on English programs and still not get the results I got with New Sound. This program is worth every penny."
                    </p>
                    <div class="text-right">
                        <span class="text-sm text-gold font-semibold">Read More</span>
                    </div>
                </div>

                <!-- Text Testimonial Card 4 -->
                <div class="bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-teal rounded-full flex items-center justify-center text-white font-bold text-sm mr-3 flex-shrink-0">
                            IC
                        </div>
                        <div>
                            <p class="font-semibold text-black">Ilana Charat</p>
                            <p class="text-sm text-gold">Brazil</p>
                        </div>
                    </div>
                    <p class="text-gray-700 font-body mb-4 line-clamp-4">
                        "Before, I had to prepare a lot for meetings with American customers. I would work on a script to speak with them. Now, I understand almost everything!"
                    </p>
                    <div class="text-right">
                        <span class="text-sm text-gold font-semibold">Read More</span>
                    </div>
                </div>

                <!-- Text Testimonial Card 5 -->
                <div class="bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-light-purple rounded-full flex items-center justify-center text-black font-bold text-sm mr-3 flex-shrink-0">
                            DA
                        </div>
                        <div>
                            <p class="font-semibold text-black">Dia Adorjan</p>
                            <p class="text-sm text-gold">Hungary</p>
                        </div>
                    </div>
                    <p class="text-gray-700 font-body mb-4 line-clamp-4">
                        "I can now speak with more clarity, confidence, and joy—without worrying about making mistakes or being judged. This program is so much more than a path to improving pronunciation."
                    </p>
                    <div class="text-right">
                        <span class="text-sm text-gold font-semibold">Read More</span>
                    </div>
                </div>

                <!-- Text Testimonial Card 6 -->
                <div class="bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-pink rounded-full flex items-center justify-center text-black font-bold text-sm mr-3 flex-shrink-0">
                            FH
                        </div>
                        <div>
                            <p class="font-semibold text-black">Françoise Hari</p>
                            <p class="text-sm text-gold">Switzerland</p>
                        </div>
                    </div>
                    <p class="text-gray-700 font-body mb-4 line-clamp-4">
                        "This summer, I spent three weeks in England, where both old friends and strangers complimented my speaking skills. That was an incredible moment for me."
                    </p>
                    <div class="text-right">
                        <span class="text-sm text-gold font-semibold">Read More</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Featured Testimonials Section -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-title font-bold text-black text-center mb-12">
                Featured Success Stories
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Featured Testimonial 1 -->
                <div class="bg-white rounded-xl shadow-card p-8 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gold rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            GC
                        </div>
                        <div>
                            <p class="font-semibold text-black text-lg">Galina Cherneva</p>
                            <p class="text-gold">Bulgaria</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 font-body text-lg mb-6 italic">
                        "I now have my own health and wellness business that serves clients all over the world! I used to be afraid of speaking, and now I'm a business owner and a content creator, creating videos on YouTube, Instagram, and TikTok. This course changed my personal and professional life."
                    </blockquote>
                    <div class="text-right">
                        <span class="text-gold font-semibold">Watch Video</span>
                    </div>
                </div>

                <!-- Featured Testimonial 2 -->
                <div class="bg-white rounded-xl shadow-card p-8 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-soft-blue rounded-full flex items-center justify-center text-black font-bold text-lg mr-4">
                            DB
                        </div>
                        <div>
                            <p class="font-semibold text-black text-lg">Dorota Burnos</p>
                            <p class="text-gold">Poland</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 font-body text-lg mb-6 italic">
                        "I don't worry anymore about what words to use - I just speak freely and with confidence. I can express my thoughts and speak automatically. All of the coaches are so supportive and warm, I felt like I was with my family."
                    </blockquote>
                    <div class="text-right">
                        <span class="text-gold font-semibold">Watch Video</span>
                    </div>
                </div>

                <!-- Featured Testimonial 3 -->
                <div class="bg-white rounded-xl shadow-card p-8 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-peach rounded-full flex items-center justify-center text-black font-bold text-lg mr-4">
                            AC
                        </div>
                        <div>
                            <p class="font-semibold text-black text-lg">Alejandra Constante</p>
                            <p class="text-gold">Ecuador</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 font-body text-lg mb-6 italic">
                        "Before New Sound, I barely spoke because I was always afraid to talk and make mistakes. Now, I'm making jokes in meetings at work and I enjoy talking more with people!"
                    </blockquote>
                    <div class="text-right">
                        <span class="text-gold font-semibold">Watch Video</span>
                    </div>
                </div>

                <!-- Featured Testimonial 4 -->
                <div class="bg-white rounded-xl shadow-card p-8 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-teal rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            OR
                        </div>
                        <div>
                            <p class="font-semibold text-black text-lg">Oscar Ramirez</p>
                            <p class="text-gold">Colombia</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 font-body text-lg mb-6 italic">
                        "I am happy because this is a complete course. I recommend this program to everyone at an intermediate level or higher. You can see the results of this course in 3 months."
                    </blockquote>
                    <div class="text-right">
                        <span class="text-gold font-semibold">Watch Video</span>
                    </div>
                </div>

                <!-- Featured Testimonial 5 -->
                <div class="bg-white rounded-xl shadow-card p-8 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-light-purple rounded-full flex items-center justify-center text-black font-bold text-lg mr-4">
                            LV
                        </div>
                        <div>
                            <p class="font-semibold text-black text-lg">Lucia Villota Vidal</p>
                            <p class="text-gold">Ecuador</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 font-body text-lg mb-6 italic">
                        "I no longer struggle with motivation! After I enrolled in the New Sound program, I found the foundations and the motivation I needed to reach my goals."
                    </blockquote>
                    <div class="text-right">
                        <span class="text-gold font-semibold">Watch Video</span>
                    </div>
                </div>

                <!-- Featured Testimonial 6 -->
                <div class="bg-white rounded-xl shadow-card p-8 transition-transform hover:-translate-y-1 cursor-pointer group">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-pink rounded-full flex items-center justify-center text-black font-bold text-lg mr-4">
                            IL
                        </div>
                        <div>
                            <p class="font-semibold text-black text-lg">Iris Lima</p>
                            <p class="text-gold">Brazil</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 font-body text-lg mb-6 italic">
                        "I live in a place where everyone speaks English, and I needed to talk with my kid's teacher, or a doctor, and this was very frustrating. Today I feel free. That fear of making mistakes was keeping me stuck not only in English but in my life."
                    </blockquote>
                    <div class="text-right">
                        <span class="text-gold font-semibold">Watch Video</span>
                    </div>
                </div>

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
        </div>
    </section>

</main>

<?php get_footer(); ?>
