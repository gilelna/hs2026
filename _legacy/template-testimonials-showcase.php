<?php
/**
 * Template Name: Testimonials Cards Showcase
 * Description: Visual playground with all testimonial card styles and grid rhythms.
 */

get_header(); ?>

<main class="bg-white">
	<section class="py-16 px-6">
		<div class="max-w-7xl mx-auto">
			<h1 class="text-3xl md:text-5xl font-title font-bold text-black mb-10">Testimonials – Card Showcase</h1>

			<!-- 3-column grid: 6 items, then a full-width card -->
			<h2 class="text-xl font-semibold mb-4">Three-column rhythm (6 up → full-width → repeat)</h2>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
				<!-- Row 1 (3 items) -->
				<div class="col-span-1">
					<article class="bg-white rounded-3xl shadow-card p-6 flex flex-col gap-4">
						<div class="flex items-center gap-4">
							<img class="w-20 h-20 rounded-full object-cover" src="<?php echo esc_url( get_stylesheet_directory_uri().'/css/placeholder.webp'); ?>" alt="Avatar">
							<p class="text-gold tracking-wide font-semibold">ADRIANA PHANEUF</p>
						</div>
						<p class="font-title text-xl md:text-2xl text-black leading-snug">Now I speak up at work. My co-workers say I sound more confident.</p>
						<div class="mt-2">
							<a href="#" class="btn btn-outline rounded-full border-gold text-black">Read More</a>
						</div>
					</article>
				</div>

<article class="card-one transition-transform hover:-translate-y-1">
    <!-- רקע התמונה -->
    <div class="card-one--bg-pic"
        style="background-image: url('https://placehold.co/600x400');">
    </div>

    <!-- גרדיאנט -->
    <div class="absolute inset-0 z-10 w-full h-full"
        style="background: linear-gradient(180deg, rgba(0,0,0,0) 30%, rgba(0,0,0,0.8) 100%);">
    </div>

    <!-- תוכן -->
    <div class="col-span-1">

    <div class="card-one-content">
        <p class="card-one--desc">
        In WP Admin, create a new page and select “Testimonials Cards Showcase”. </p>
        <div class="flex items-center justify-between">
            <span class="card-name">ADRIANA PHANEUF</span>
            <a href="#" class="card-button">
                <span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z" />
                    </svg>
                </span>
                Watch More
            </a>
        </div>
    </div>
</article>
            </div>
				<div class="col-span-1">
					<article class="card rounded-3xl bg-white shadow-card p-6 md:p-8">
						<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
							<div><?php echo do_shortcode('[videoinline video="https://vimeo.com/76979871" img="thumbnail"]'); ?></div>
							<div>
								<div class="text-4xl text-gold mb-3">”</div>
								<p class="font-title text-2xl md:text-3xl text-black leading-snug mb-6">New Sound was the best decision that I made in my English journey.</p>
								<div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
									<span class="text-gold tracking-wide font-semibold">PAULA PERES</span>
									<a href="#" class="btn btn-outline rounded-full border-gold text-black">Watch More</a>
								</div>
							</div>
						</div>
					</article>
				</div>
				<div class="col-span-1">
					<article class="bg-white rounded-3xl shadow-card p-6 flex flex-col gap-4">
						<img class="w-full h-60 object-cover rounded-2xl" src="<?php echo esc_url( get_stylesheet_directory_uri().'/css/placeholder.webp'); ?>" alt="Large">
						<p class="font-title text-xl md:text-2xl text-black leading-snug">I launched my own podcast and YouTube channel where I make daily content in English.</p>
						<div class="text-right">
							<a href="#" class="btn btn-outline rounded-full border-gold text-black">Read More</a>
						</div>
					</article>
				</div>

				<!-- Row 2 (3 items) -->
				<div class="col-span-1">
					<article class="card rounded-3xl bg-white shadow-card p-8">
						<div class="text-5xl text-gold mb-4">”</div>
						<p class="font-title text-2xl md:text-4xl text-black leading-snug mb-6">With this course I've solved nearly 80% of my pronunciation problems.</p>
						<div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
							<span class="text-gold tracking-wide font-semibold">JUAN CARLOS</span>
							<a href="#" class="btn btn-outline rounded-full border-gold text-black">Read More</a>
						</div>
					</article>
				</div>
				<div class="col-span-1">
					<article class="bg-white rounded-3xl shadow-card p-6 flex flex-col gap-4">
						<div class="flex items-center gap-4">
							<img class="w-20 h-20 rounded-full object-cover" src="<?php echo esc_url( get_stylesheet_directory_uri().'/css/placeholder.webp'); ?>" alt="Avatar">
							<p class="text-gold tracking-wide font-semibold">MARTA MONDÉJAR</p>
						</div>
						<p class="font-title text-xl md:text-2xl text-black leading-snug">Thanks to New Sound, I gained more confidence and speak up in meetings.</p>
						<div class="mt-2">
							<a href="#" class="btn btn-outline rounded-full border-gold text-black">Watch More</a>
						</div>
					</article>
				</div>
				<div class="col-span-1">
					<article class="card rounded-3xl bg-white shadow-card p-8">
						<div class="text-5xl text-gold mb-4">”</div>
						<p class="font-title text-2xl md:text-4xl text-black leading-snug mb-6">When I started Hadar’s course, I was a beginner. Now I’m an intermediate speaker.</p>
						<div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
							<span class="text-gold tracking-wide font-semibold">ABDON RIBAS</span>
							<a href="#" class="btn btn-outline rounded-full border-gold text-black">Read More</a>
						</div>
					</article>
				</div>

				<!-- Full width item (7th) -->
				<div class="col-span-1 md:col-span-3">
					<article class="testimonial-card quote-testimonial col-span-full">
						<div class="card bg-neutral-800 text-white rounded-3xl p-10 md:p-16 shadow-card">
							<div class="max-w-4xl mx-auto text-center">
								<div class="text-5xl md:text-6xl text-gold mb-6">”</div>
								<h3 class="font-title text-3xl md:text-5xl lg:text-6xl leading-tight mb-6">This course gave me back my superpower: To communicate with confidence.</h3>
								<p class="text-gold tracking-wide font-semibold text-sm md:text-base mb-6">FRANCIS KODAMA</p>
								<a href="#" class="btn bg-gold text-black border-0 rounded-full px-6 md:px-8">Watch More</a>
							</div>
						</div>
					</article>
				</div>
			</div>

			<!-- 2-column grid examples -->
			<h2 class="text-xl font-semibold mt-16 mb-4">Two-column grid examples</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
				<div class="col-span-1">
					<article class="card rounded-3xl bg-white shadow-card p-6 md:p-10">
						<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
							<div><?php echo do_shortcode('[videoinline video="https://www.youtube.com/watch?v=dQw4w9WgXcQ" img="thumbnail"]'); ?></div>
							<div>
								<div class="text-4xl text-gold mb-3">”</div>
								<p class="font-title text-2xl md:text-3xl text-black leading-snug mb-6">I am in control of my message. People say I seem more confident!</p>
								<div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
									<span class="text-gold tracking-wide font-semibold">PAULA PERES</span>
									<a href="#" class="btn btn-outline rounded-full border-gold text-black">Watch More</a>
								</div>
							</div>
						</div>
					</article>
				</div>
				<div class="col-span-1">
					<article class="card rounded-3xl bg-white shadow-card p-8">
						<div class="text-5xl text-gold mb-4">”</div>
						<p class="font-title text-2xl md:text-4xl text-black leading-snug mb-6">Recently, I had an interview with 120 applicants and I got in.</p>
						<div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
							<span class="text-gold tracking-wide font-semibold">HIROKO NEELY</span>
							<a href="#" class="btn btn-outline rounded-full border-gold text-black">Read More</a>
						</div>
					</article>
				</div>
			</div>

			<!-- Full-width light quote -->
			<h2 class="text-xl font-semibold mt-16 mb-4">Full-width light quote</h2>
			<div class="grid grid-cols-1">
				<div class="col-span-1">
					<article class="testimonial-card quote-testimonial col-span-full">
						<div class="card rounded-3xl bg-white shadow-card p-8 md:p-12">
							<div class="max-w-5xl mx-auto">
								<div class="text-5xl text-gold mb-4">”</div>
								<p class="font-title text-2xl md:text-4xl lg:text-5xl text-black leading-snug mb-6">I really enjoyed this program very much and I'm excited to keep building habits.</p>
								<div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4">
									<span class="text-gold tracking-wide font-semibold">DANILO J LARA</span>
									<a href="#" class="btn btn-outline rounded-full border-gold text-black">Read More</a>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>


