<?php
// Accept args passed via get_template_part($slug, $name, $args) or via set_query_var
// Optional vars: bg_url, desc, name, post_id
$bg_url  = isset($args['bg_url']) ? $args['bg_url'] : get_query_var('bg_url');
$desc    = isset($args['desc']) ? $args['desc'] : get_query_var('desc');
$name    = isset($args['name']) ? $args['name'] : get_query_var('name');
$post_id = isset($args['post_id']) ? $args['post_id'] : get_query_var('post_id');

if (empty($bg_url))  { $bg_url = 'https://picsum.photos/800/600?random=101'; }
if (empty($desc))    { $desc   = 'Now I can speak at work meetings and ask questions!'; }
if (empty($name))    { $name   = 'Krystian Połomski'; }
if (empty($post_id)) { $post_id = get_the_ID(); }
?>
<article class="card-one col-span-1 transition-transform hover:-translate-y-1 relative overflow-hidden">
	<div class="card-one--bg-pic" style="background-image: url('<?php echo esc_url($bg_url); ?>');"></div>
	<div class="absolute inset-0 z-10 w-full h-full" style="background: linear-gradient(180deg, rgba(0,0,0,0) 30%, rgba(0,0,0,0.8) 100%);"></div>
	<div class="card-one content">
		<p class="card-one desc"><?php echo esc_html($desc); ?></p>
		<div class="flex items-center justify-between">
			<span class="card-name"><?php echo esc_html($name); ?></span>
			<a href="#" class="card-button open-post-modal inline-flex items-center gap-2" data-post-id="<?php echo esc_attr($post_id); ?>" data-post-type="testimonial">
				<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
					<path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z"></path>
				</svg>
				Watch More
			</a>
		</div>
	</div>
</article>


