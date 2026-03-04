<?php
/**
 * Fallback template when Elementor is disabled via meta.
 * Clean layout with proper body structure for Tailwind CSS.
 */

// Signal to disable Elementor assets for this template
if ( function_exists( 'hs2026_disable_elementor_assets' ) ) {
	hs2026_disable_elementor_assets();
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body class="bg-white text-gray-800 font-body">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<!-- Latest Offers Section -->
			<section class="bg-light-blue">
				<div class="max-w-7xl mx-auto py-20 px-6" aria-label="Latest Offers Section">
					<h2 class="text-3xl md:text-5xl font-title font-bold text-black text-center mb-4">Yes, we have a new course!</h2>
					<h2 class="text-3xl md:text-5xl font-title font-bold text-black text-center mb-4">Check our latest offers</h2>
					<p class="text-base md:text-lg text-gold font-body text-center mb-12 max-w-3xl mx-auto">
						Meet the community, watch some lessons or explore our freebies to improve<br />
						Your English, either way you are most welcome! No strings attached
					</p>
					<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
						<!-- Card 1 -->
						<div class="card bg-white rounded-xl shadow-card overflow-visible transition-transform hover:-translate-y-1">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Photo with feet on yellow dot, representing the start of a journey" class="w-[90%] -mt-10 rounded-xl mx-auto object-cover aspect-[4/3]" />
							<div class="p-6 relative text-left">
								<div class="card-arrow absolute bottom-6 right-6 w-10 h-10 flex items-center justify-center rounded-full shadow-button transition hover:scale-110 bg-gold text-white">
									→
								</div>
								<span class="text-sm text-gold text-caps block mb-2">Free course</span>
								<h3 class="text-xl font-semibold font-body mb-2">Your first lesson<br />starts here</h3>
							</div>
						</div>
						<!-- Card 2 -->
						<div class="card bg-white shadow-card overflow-visible transition-transform hover:-translate-y-1">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Image of a polka dot bag with a card labeled 'Free'" class="w-[90%] -mt-10 mx-auto object-cover aspect-[4/3]" />
							<div class="p-6 relative text-left">
								<span class="text-sm text-gold font-body block mb-1">Download</span>
								<h3 class="text-xl font-bold font-title mb-4">Get the new course<br />free edition</h3>
								<div class="card-arrow absolute bottom-6 right-6 w-10 h-10 flex items-center justify-center rounded-full shadow-button transition hover:right-5 bg-gold text-white">
									→
								</div>
							</div>
						</div>
						<!-- Card 3 -->
						<div class="card bg-white rounded-xl shadow-card overflow-visible transition-transform hover:-translate-y-1">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Three young people smiling and working together on laptops" class="w-[90%] -mt-10 rounded-xl mx-auto object-cover aspect-[4/3]" />
							<div class="p-6 relative text-left">
								<span class="text-sm text-gold font-body block mb-1">Community</span>
								<h3 class="text-xl font-bold font-title mb-4">Meet everyone</h3>
								<div class="card-arrow absolute bottom-6 right-6 w-10 h-10 flex items-center justify-center rounded-full shadow-button transition hover:scale-110 bg-gold text-white">
									→
								</div>
							</div>
						</div>
					</div>
					<div class="mt-12">
						<a href="#" class="inline-block bg-soft-blue text-black font-bold rounded-full px-6 py-3 shadow-button hover:shadow-lg transition">
							SEE MORE
						</a>
					</div>
				</div>
			</section>

			<!-- "Your English is amazing!" Section -->
			<section class="max-w-full mx-auto px-6 py-24 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
				<div class="max-w-xl w-full mx-auto">
					<h2 class="text-5xl font-title font-bold text-black mb-6 leading-tight text-center md:text-left">
						Your<br />English<br />is amazing!
					</h2>
					<p class="text-lg text-gold font-body mb-8 max-w-md">
						You don't have to be a native speaker to have great English. All you need is right here, with us.
					</p>
					<a href="#" class="inline-block px-6 py-3 bg-soft-blue text-black font-bold rounded-xl shadow-button hover:shadow-lg transition">
						EXPLORE
					</a>
				</div>
				<div class="relative">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Smiling woman" class="rounded-full w-full max-w-md mx-auto object-cover aspect-square" />
				</div>
			</section>

			<!-- "Free 14-day Pronunciation Plan" Section -->
			<section class="relative grid grid-cols-1 md:grid-cols-2 items-center px-6 py-24 overflow-hidden">
				<div class="relative z-0">
					<img src="https://hadarshemesh.com/wp-content/uploads/Hadar_ColorfulSkirt__MP_2094-4.jpg" alt="Smiling woman" class="w-full h-full object-cover rounded-lg" />
					<div class="absolute inset-y-0 right-0 w-1/5 bg-gradient-to-l from-white via-white/70 to-transparent"></div>
				</div>
				<div class="z-10 relative max-w-7xl mx-auto px-6">
					<h2 class="text-5xl font-title font-bold mb-6 leading-tight">
						<span class="underline">Free</span> 14-day<br />Pronunciation Plan
					</h2>
					<p class="text-lg text-gray-700 font-body mb-8 max-w-lg">
						Daily lessons, practice drills and audio recordings to achieve confident, clear speech in just 14 days – without any overwhelm, confusion, or too much time!
					</p>
					<form class="flex flex-wrap gap-4 bg-white p-4 rounded-xl shadow-md max-w-xl">
						<input type="text" placeholder="Name" class="flex-1 border border-gray-300 px-4 py-2 rounded-md" />
						<input type="email" placeholder="Email" class="flex-1 border border-gray-300 px-4 py-2 rounded-md" />
						<button class="bg-green-900 text-white font-bold px-6 py-2 rounded-md hover:bg-green-800 transition">Get it</button>
					</form>
				</div>
			</section>

			<!-- "Exciting New Course" Section -->
			<section class="relative bg-white py-24 px-6">
				<div class="max-w-7xl mx-auto relative z-10 grid grid-cols-1 md:grid-cols-2 items-center gap-12">
					<!-- Right side bubble CTA -->
					<div class="relative z-10 bg-pink rounded-l-[999px] py-12 px-8 md:pl-24 shadow-xl">
						<h2 class="text-4xl md:text-5xl font-title font-bold text-black mb-6 leading-tight">
							It's So exciting,<br />A new free course!
						</h2>
						<p class="text-gray-600 font-body text-lg leading-relaxed mb-8 max-w-xl">
							We made some of our library accessible<br />
							So you can easily take your first step<br />
							And start speaking English freely.
						</p>
						<a href="#" class="inline-block bg-gold text-white font-bold px-6 py-3 rounded-full shadow-button hover:bg-opacity-90 transition">
							START NOW
						</a>
					</div>

					<!-- Floating image on right -->
					<div class="relative z-20 flex justify-center md:justify-start">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/css/placeholder.webp" alt="Excited woman with hands up" class="w-[300px] md:w-[360px] lg:w-[420px] -mt-16 md:-mt-24 relative z-30" />
					</div>
				</div>
			</section>
			<?php
		endwhile;
	endif;
	?>
	<?php wp_footer(); ?>
</body>
</html>

