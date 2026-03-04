<?php
/**
 * Template Name: Card Preview
 * Template Post Type: page
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    // Load WordPress
    require_once('../../../wp-load.php');
}

// Create mock post objects for preview
function create_mock_post($id, $title, $excerpt, $image_url = '') {
    $post = new stdClass();
    $post->ID = $id;
    $post->post_title = $title;
    $post->post_excerpt = $excerpt;
    $post->post_author = 1;
    $post->post_date = date('Y-m-d H:i:s');
    $post->post_date_gmt = gmdate('Y-m-d H:i:s');
    
    // Mock featured image
    if (empty($image_url)) {
        $image_url = 'https://picsum.photos/400/300?random=' . $id;
    }
    
    // Override get_the_post_thumbnail_url function for preview
    add_filter('wp_get_attachment_image_src', function($image, $attachment_id, $size) use ($image_url) {
        if (is_numeric($attachment_id) && $attachment_id > 0) {
            return [$image_url, 400, 300, false];
        }
        return $image;
    }, 10, 3);
    
    return $post;
}

// Mock data
$mock_posts = [
    create_mock_post(1, 'Understanding English Pronunciation: A Complete Guide', 'Master the art of clear pronunciation with our comprehensive guide covering vowels, consonants, and common mistakes.', 'https://picsum.photos/400/300?random=1'),
    create_mock_post(2, 'Building Confidence in Public Speaking', 'Learn proven techniques to overcome anxiety and speak with authority in any situation.', 'https://picsum.photos/400/300?random=2'),
    create_mock_post(3, 'The Psychology of Language Learning', 'Discover how your mind processes new languages and optimize your learning strategy.', 'https://picsum.photos/400/300?random=3'),
    create_mock_post(4, 'Advanced Grammar Patterns for Fluent English', 'Master complex grammatical structures that native speakers use naturally.', 'https://picsum.photos/400/300?random=4'),
    create_mock_post(5, 'Cultural Context in Language Communication', 'Understand how culture shapes language use and avoid common cross-cultural miscommunications.', 'https://picsum.photos/400/300?random=5'),
    create_mock_post(6, 'Effective Vocabulary Building Strategies', 'Expand your word power with scientifically-proven methods for long-term retention.', 'https://picsum.photos/400/300?random=6')
];

// Preview data mimicking production testimonial card designs
$card_one_previews = [
    [
        'type'        => 'card-one',
        'name'        => 'Krystian Połomski',
        'excerpt'     => 'Now I can speak at work meetings and ask questions!',
        'image'       => 'https://picsum.photos/800/600?random=101',
        'has_video'   => true,
        'button_label'=> 'Watch More',
    ],
    [
        'type'        => 'card-one',
        'name'        => 'Felicia Lin',
        'excerpt'     => 'I finally sound like myself in English and feel confident leading presentations.',
        'image'       => 'https://picsum.photos/800/600?random=102',
        'has_video'   => false,
        'button_label'=> 'Read More',
    ],
    [
        'type'        => 'card-one',
        'name'        => 'Oscar Ramirez',
        'excerpt'     => 'You can see the results of this course in just three months.',
        'image'       => 'https://picsum.photos/800/600?random=103',
        'has_video'   => true,
        'button_label'=> 'Watch More',
    ],
];

$card_featured_previews = [
    [
        'type'        => 'featured',
        'name'        => 'Marta Mondéjar',
        'excerpt'     => 'Thanks to New Sound, I gained the confidence to speak up in meetings and share my ideas freely.',
        'image'       => 'https://picsum.photos/400/400?random=201',
        'has_video'   => true,
        'button_label'=> 'Watch More',
    ],
    [
        'type'        => 'featured',
        'name'        => 'Hiroko Neely',
        'excerpt'     => 'I can finally contribute to international calls without second-guessing my pronunciation.',
        'image'       => 'https://picsum.photos/400/400?random=202',
        'has_video'   => false,
        'button_label'=> 'Read More',
    ],
    [
        'type'        => 'featured',
        'name'        => 'Danilo J Lara',
        'excerpt'     => 'Practice and commitment paid off. Now I lead project updates with ease.',
        'image'       => 'https://picsum.photos/400/400?random=203',
        'has_video'   => true,
        'button_label'=> 'Watch More',
    ],
];

$card_full_width_previews = [
    [
        'type'        => 'full-width',
        'variant'     => 'mega',
        'name'        => 'Krystian Połomski',
        'excerpt'     => 'Now I can speak at work meetings and ask questions! This program changed everything for me.',
        'has_video'   => false,
        'button_label'=> 'Read More',
    ],
    [
        'type'        => 'full-width',
        'variant'     => 'video',
        'name'        => 'Marta Mondéjar',
        'excerpt'     => 'Video stories capture the real breakthroughs happening inside the program.',
        'has_video'   => true,
        'button_label'=> 'Watch More',
    ],
    [
        'type'        => 'full-width',
        'variant'     => 'light',
        'name'        => 'Hiroko Neely',
        'excerpt'     => 'I enjoyed this program so much and can’t wait to revisit the modules to keep building habits.',
        'has_video'   => false,
        'button_label'=> 'Read More',
    ],
];

$highlight_quote_previews = [
    [
        'type'        => 'highlight',
        'name'        => 'Oscar Ramirez',
        'excerpt'     => 'You can see the results of this course in just three months.',
        'has_video'   => false,
        'button_label'=> 'Read More',
    ],
    [
        'type'        => 'highlight',
        'name'        => 'Rina Patel',
        'excerpt'     => 'Speaking with clarity is no longer a dream—it’s part of my everyday conversations.',
        'has_video'   => false,
        'button_label'=> 'Read More',
    ],
];

$grid_featured_sequence = [
    $card_one_previews[0],
    $card_featured_previews[0],
    $card_one_previews[1],
    $card_featured_previews[1],
    $card_one_previews[2],
    $highlight_quote_previews[0],
    $card_full_width_previews[0],
];

$grid_pronunciation_sequence = [
    $card_featured_previews[2],
    $card_one_previews[0],
    $card_featured_previews[1],
    $highlight_quote_previews[1],
    $card_full_width_previews[2],
];

function render_preview_card_one(array $card): void
{
    $image         = esc_url($card['image']);
    $excerpt       = esc_html($card['excerpt']);
    $name          = esc_html($card['name']);
    $has_video     = !empty($card['has_video']);
    $button_label  = esc_html($card['button_label'] ?? ($has_video ? 'Watch More' : 'Read More'));
    ?>
    <article class="card-one col-span-1 transition-transform hover:-translate-y-1 relative overflow-hidden">
        <div class="card-one--bg-pic" style="background-image: url('<?php echo $image; ?>');"></div>
        <div class="absolute inset-0 z-10 w-full h-full" style="background: linear-gradient(180deg, rgba(0,0,0,0) 30%, rgba(0,0,0,0.8) 100%);"></div>
        <div class="card-one content">
            <p class="card-one desc"><?php echo $excerpt; ?></p>
            <div class="flex items-center justify-between">
                <span class="card-name"><?php echo $name; ?></span>
                <a href="#" class="card-button open-post-modal inline-flex items-center gap-2">
                    <?php if ($has_video): ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z" />
                        </svg>
                    <?php endif; ?>
                    <?php echo $button_label; ?>
                </a>
            </div>
        </div>
    </article>
    <?php
}

function render_preview_card_featured(array $card): void
{
    $image         = esc_url($card['image']);
    $excerpt       = esc_html($card['excerpt']);
    $name          = esc_html($card['name']);
    $has_video     = !empty($card['has_video']);
    $button_label  = esc_html($card['button_label'] ?? ($has_video ? 'Watch More' : 'Read More'));
    ?>
    <article class="card-two col-span-1 bg-white rounded-xl shadow-card p-6 transition-transform hover:-translate-y-1 cursor-pointer group flex flex-col">
        <img class="card-avatar" src="<?php echo $image; ?>" alt="<?php echo esc_attr($name); ?> portrait">
        <p class="card-name"><?php echo $name; ?></p>
        <p class="desc"><?php echo $excerpt; ?></p>
        <div class="text-right mt-auto">
            <a href="#" class="card-button open-post-modal inline-flex items-center gap-2">
                <?php if ($has_video): ?>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M14.752 11.168l-4.796-2.7A1 1 0 008 9.2v5.6a1 1 0 001.5.866l4.796-2.7a1 1 0 000-1.732z" />
                    </svg>
                <?php endif; ?>
                <?php echo $button_label; ?>
            </a>
        </div>
    </article>
    <?php
}

function render_preview_card_full_width(array $card): void
{
    $variant      = $card['variant'] ?? 'light';
    $excerpt      = esc_html($card['excerpt']);
    $name         = esc_html($card['name']);
    $has_video    = !empty($card['has_video']);
    $button_label = esc_html($card['button_label'] ?? ($has_video ? 'Watch More' : 'Read More'));

    if ($variant === 'video'): ?>
        <article class="testimonial-card video-testimonial col-span-full">
            <div class="card rounded-3xl bg-white shadow-card p-6 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 items-center">
                    <div class="w-full">
                        <div class="aspect-video rounded-3xl bg-neutral-900 flex items-center justify-center text-white font-semibold tracking-wide">
                            Video Placeholder
                        </div>
                    </div>
                    <div>
                        <div class="text-4xl text-gold mb-3">”</div>
                        <p class="font-title text-2xl md:text-3xl lg:text-4xl text-black leading-snug mb-6"><?php echo $excerpt; ?></p>
                        <div class="flex flex-wrap items-center gap-4">
                            <span class="text-gold tracking-wide font-semibold"><?php echo $name; ?></span>
                            <a href="#" class="btn btn-outline rounded-full border-gold text-black inline-flex items-center gap-2 open-post-modal">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                <?php echo $button_label; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php elseif ($variant === 'mega'): ?>
        <article class="testimonial-card quote-testimonial col-span-full">
            <div class="card bg-neutral-800 text-white rounded-3xl p-10 md:p-16 shadow-card text-center">
                <div class="max-w-4xl mx-auto">
                    <div class="text-5xl md:text-6xl text-gold mb-6">”</div>
                    <h3 class="font-title text-3xl md:text-5xl lg:text-6xl leading-tight mb-6"><?php echo $excerpt; ?></h3>
                    <a href="#" class="btn bg-gold text-black border-0 rounded-full px-6 md:px-8 inline-flex items-center gap-2 open-post-modal">
                        <?php echo $button_label; ?>
                    </a>
                    <p class="mt-4 text-gold tracking-wide font-semibold text-sm md:text-base"><?php echo $name; ?></p>
                </div>
            </div>
        </article>
    <?php else: ?>
        <article class="testimonial-card quote-testimonial col-span-full">
            <div class="card rounded-3xl bg-white shadow-card p-8 md:p-12">
                <div class="max-w-5xl mx-auto">
                    <div class="text-5xl text-gold mb-4">”</div>
                    <p class="font-title text-2xl md:text-4xl lg:text-5xl text-black leading-snug mb-6"><?php echo $excerpt; ?></p>
                    <div class="flex flex-wrap items-center gap-4">
                        <span class="text-gold tracking-wide font-semibold"><?php echo $name; ?></span>
                        <a href="#" class="btn btn-outline rounded-full border-gold text-black inline-flex items-center gap-2 open-post-modal">
                            <?php echo $button_label; ?>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    <?php endif;
}

function render_preview_highlight_quote(array $card): void
{
    $excerpt      = esc_html($card['excerpt']);
    $name         = esc_html($card['name']);
    $button_label = esc_html($card['button_label'] ?? 'Read More');
    ?>
    <article class="testimonial-card quote-small bg-white rounded-3xl shadow-card p-6 flex flex-col justify-between">
        <h4 class="font-title text-2xl md:text-3xl text-black leading-snug mb-6"><?php echo $excerpt; ?></h4>
        <div class="flex items-center justify-between">
            <span class="text-gold tracking-wide font-semibold"><?php echo $name; ?></span>
            <a href="#" class="btn btn-outline rounded-full border-gold text-black inline-flex items-center gap-2 open-post-modal"><?php echo $button_label; ?></a>
        </div>
    </article>
    <?php
}

function render_preview_card(array $card): void
{
    $type = $card['type'] ?? 'card-one';

    switch ($type) {
        case 'featured':
            render_preview_card_featured($card);
            break;
        case 'full-width':
            render_preview_card_full_width($card);
            break;
        case 'highlight':
            render_preview_highlight_quote($card);
            break;
        case 'card-one':
        default:
            render_preview_card_one($card);
            break;
    }
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Card Preview - <?php bloginfo('name'); ?></title>
    
    <?php wp_head(); ?>
    
    <style>
        .preview-section {
            margin: 3rem 0;
            padding: 2rem 0;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .preview-section h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #d1d5db;
        }
        
        .preview-section h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }
        
        .preview-grid {
            display: grid;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .preview-grid--three {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .preview-grid--two {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }

        .preview-grid--full {
            grid-template-columns: 1fr;
        }

        .grid-item {
            width: 100%;
        }
        
        .preview-info {
            background: #f9fafb;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .preview-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .preview-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 1rem;
        }
        
        .preview-header h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .preview-header p {
            font-size: 1.25rem;
            opacity: 0.9;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <div class="preview-container">
        <header class="preview-header">
            <h1>Card Template Preview</h1>
            <p>Visual testing for all card layouts in the modular grid system</p>
        </header>

        <!-- Card One (Hero) Preview -->
        <section class="preview-section">
            <h2>Card One · Hero Background</h2>
            <div class="preview-info">
                <strong>Use case:</strong> Featured success stories that need a cinematic, full-image treatment.<br>
                <strong>Features:</strong> Edge-to-edge background, gradient overlay, punchy quote, name, and CTA that swaps to watch when video stories are available.
            </div>
            <div class="preview-grid preview-grid--three">
                <?php foreach ($card_one_previews as $card): ?>
                    <?php render_preview_card_one($card); ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Card Featured (Compact) Preview -->
        <section class="preview-section">
            <h2>Card Featured · Compact Profile</h2>
            <div class="preview-info">
                <strong>Use case:</strong> Dense testimonial walls or supporting stories within long-form pages.<br>
                <strong>Features:</strong> Avatar, short quote, flexible CTA text, video icon when relevant.
            </div>
            <div class="preview-grid preview-grid--three">
                <?php foreach ($card_featured_previews as $card): ?>
                    <?php render_preview_card_featured($card); ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Card Full Width Preview -->
        <section class="preview-section">
            <h2>Card Full Width · Highlight Quotes</h2>
            <div class="preview-info">
                <strong>Use case:</strong> Spotlight quotes, mega testimonials, and video case studies that deserve an entire row.<br>
                <strong>Features:</strong> Dark hero mode, video split layout, and light canvas variant with outline CTA.
            </div>
            <div class="preview-grid preview-grid--full">
                <?php foreach ($card_full_width_previews as $card): ?>
                    <?php render_preview_card_full_width($card); ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Highlight Quote Preview -->
        <section class="preview-section">
            <h2>Highlight Quote Cards</h2>
            <div class="preview-info">
                <strong>Use case:</strong> Quick hits that break up grids with a bold serif pull-quote.<br>
                <strong>Features:</strong> Standalone serif quote, gold name tag, rounded outline CTA.
            </div>
            <div class="preview-grid preview-grid--two">
                <?php foreach ($highlight_quote_previews as $card): ?>
                    <?php render_preview_highlight_quote($card); ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Grid Layouts Preview -->
        <section class="preview-section">
            <h2>Grid Layout Examples</h2>
            <div class="preview-info">
                <strong>Purpose:</strong> Demonstrate how the new card styles mix within automated grid presets.
            </div>
            
            <h3>Featured Grid (3-column with hero every 7th)</h3>
            <div class="preview-info">
                Cycle: hero → compact → hero → compact → hero → highlight → full width.
            </div>
            <div class="preview-grid preview-grid--three">
                <?php foreach ($grid_featured_sequence as $card): ?>
                    <?php $is_full_width = ($card['type'] ?? '') === 'full-width'; ?>
                    <div class="grid-item<?php echo $is_full_width ? ' col-span-full' : ''; ?>"<?php echo $is_full_width ? ' style="grid-column: 1 / -1;"' : ''; ?>>
                        <?php render_preview_card($card); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3>Pronunciation Grid (2-column with full-width closer)</h3>
            <div class="preview-info">
                Cycle: compact → hero → compact → highlight → full width.
            </div>
            <div class="preview-grid preview-grid--two">
                <?php foreach ($grid_pronunciation_sequence as $card): ?>
                    <?php $is_full_width = ($card['type'] ?? '') === 'full-width'; ?>
                    <div class="grid-item<?php echo $is_full_width ? ' col-span-full' : ''; ?>"<?php echo $is_full_width ? ' style="grid-column: 1 / -1;"' : ''; ?>>
                        <?php render_preview_card($card); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Usage Examples -->
        <section class="preview-section">
            <h2>Shortcode Usage Examples</h2>
            <div class="preview-info">
                <strong>Copy these shortcodes to use in your WordPress content:</strong>
            </div>
            
            <div style="background: #f3f4f6; padding: 1.5rem; border-radius: 0.5rem; font-family: monospace; font-size: 0.875rem;">
                <div style="margin-bottom: 1rem;">
                    <strong>Featured Grid:</strong><br>
                    <code>[dynamic_grid preset="featured" per_page="12" card="auto"]</code>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <strong>Pronunciation Grid:</strong><br>
                    <code>[dynamic_grid preset="pronunciation" per_page="10" card="auto"]</code>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <strong>Confidence Grid:</strong><br>
                    <code>[dynamic_grid preset="confidence" per_page="8" card="auto"]</code>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <strong>Podcast Grid:</strong><br>
                    <code>[dynamic_grid preset="podcast" per_page="6" card="auto"]</code>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <strong>Custom Card Type:</strong><br>
                    <code>[dynamic_grid preset="featured" per_page="6" card="card-full"]</code>
                </div>
                
                <div>
                    <strong>With Category Filter:</strong><br>
                    <code>[dynamic_grid preset="featured" per_page="8" category="123" orderby="date" order="DESC"]</code>
                </div>
            </div>
        </section>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
