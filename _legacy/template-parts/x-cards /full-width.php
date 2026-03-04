<?php
// Button label based on video presence
$button_label = !empty($has_video_story) ? 'Watch More' : 'Read More';
?>
<?php if (!empty($has_mega_quote)): ?>
  <!-- Testimonial card: Full-width dark quote -->
  <article class="testimonial-card quote-testimonial col-span-full">
      <div class="card bg-neutral-800 text-white rounded-3xl p-10 md:p-16 shadow-card">
          <div class="max-w-4xl mx-auto text-center">
              <div class="text-5xl md:text-6xl text-gold mb-6">”</div>
              <h3 class="font-title text-3xl md:text-5xl lg:text-6xl leading-tight mb-6"><?php echo esc_html($expect_excerpt); ?></h3>
              <p class="text-gold tracking-wide font-semibold text-sm md:text-base mb-6"><?php the_title(); ?></p>
              <a href="#" class="btn bg-gold text-black border-0 rounded-full px-6 md:px-8 shadow-button open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
                  <?php if (!empty($has_video_story)): ?>
                      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                  <?php endif; ?>
                  <?php echo esc_html($button_label); ?>
              </a>
          </div>
      </div>
  </article>
<?php elseif (!empty($has_video_story)): ?>
  <!-- Testimonial card: Full-width, video left and quote right when tagged 'w-video' -->
  <article class="testimonial-card video-testimonial col-span-full">
      <div class="card rounded-3xl bg-white shadow-card p-6 md:p-10">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 items-center">
              <div class="w-full">
                  <?php echo do_shortcode('[inlinevideo]'); ?>
              </div>
              <div>
                  <div class="text-4xl text-gold mb-3">”</div>
                  <p class="font-title text-2xl md:text-3xl lg:text-4xl text-black leading-snug mb-6"><?php echo esc_html($expect_excerpt); ?></p>
                  <div class="flex flex-wrap items-center gap-4">
                      <span class="text-gold tracking-wide font-semibold"><?php the_title(); ?></span>
                      <a href="#" class="btn btn-outline rounded-full border-gold text-black open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
                          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                          <?php echo esc_html($button_label); ?>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </article>
<?php else: ?>
  <!-- Testimonial card: Light canvas quote -->
  <article class="testimonial-card quote-testimonial col-span-full">
      <div class="card rounded-3xl bg-white shadow-card p-8 md:p-12">
          <div class="max-w-5xl mx-auto">
              <div class="text-5xl text-gold mb-4">”</div>
              <p class="font-title text-2xl md:text-4xl lg:text-5xl text-black leading-snug mb-6"><?php echo esc_html($expect_excerpt); ?></p>
              <div class="flex flex-wrap items-center gap-4">
                  <span class="text-gold tracking-wide font-semibold"><?php the_title(); ?></span>
                  <a href="#" class="btn btn-outline rounded-full border-gold text-black open-post-modal inline-flex items-center gap-2" data-post-id="<?php the_ID(); ?>" data-post-type="testimonial">
                      <?php if (!empty($has_video_story)): ?>
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z"/></svg>
                      <?php endif; ?>
                      <?php echo esc_html($button_label); ?>
                  </a>
              </div>
          </div>
      </div>
  </article>
<?php endif; ?>
