<?php
/**
 * Academy Awards Table - Entity Page Template
 * Renders internal Film / Person / Company pages (destination pages for Lunara Film)
 */

if (!defined('ABSPATH')) {
    exit;
}

$aat = Academy_Awards_Table::get_instance();

$entity = sanitize_text_field(get_query_var('aat_entity'));
$id = sanitize_text_field(get_query_var('aat_entity_id'));

$rows = $aat->get_entity_rows($entity, $id);
$label = $aat->get_entity_display_name($entity, $id);
$label = trim((string) $label);

// If no data, mark 404 but still render a friendly page.
if (empty($rows)) {
    global $wp_query;
    if (is_object($wp_query)) {
        $wp_query->set_404();
    }
    status_header(404);
    nocache_headers();
}

// Helpers
$ordinal = function($n) {
    $n = intval($n);
    if ($n <= 0) return '';
    $s = array('th', 'st', 'nd', 'rd');
    $v = $n % 100;
    return $n . ($s[($v - 20) % 10] ?? $s[$v] ?? $s[0]);
};

$format_category = function($cat) {
    $cat = (string) $cat;
    if ($cat === '') return '';
    $map = array(
        'ACTOR IN A LEADING ROLE' => 'Best Actor',
        'ACTRESS IN A LEADING ROLE' => 'Best Actress',
        'ACTOR IN A SUPPORTING ROLE' => 'Best Supporting Actor',
        'ACTRESS IN A SUPPORTING ROLE' => 'Best Supporting Actress',
        'BEST PICTURE' => 'Best Picture',
        'DIRECTING' => 'Best Director',
    );
    foreach ($map as $from => $to) {
        $cat = str_replace($from, $to, $cat);
    }
    return $cat;
};

$build_entity_url = function($id) use ($aat) {
    $id = trim((string) $id);
    if ($id === '') return '';
    $base = $aat->get_entity_base_url();
    if (preg_match('/^tt\d+$/', $id)) return esc_url($base . 'title/' . $id . '/');
    if (preg_match('/^nm\d+$/', $id)) return esc_url($base . 'name/' . $id . '/');
    if (preg_match('/^co\d+$/', $id)) return esc_url($base . 'company/' . $id . '/');
    return '';
};

$build_imdb_url = function($id) {
    $id = trim((string) $id);
    if ($id === '') return '';
    if (preg_match('/^tt\d+$/', $id)) return 'https://www.imdb.com/title/' . $id . '/';
    if (preg_match('/^nm\d+$/', $id)) return 'https://www.imdb.com/name/' . $id . '/';
    if (preg_match('/^co\d+$/', $id)) return 'https://www.imdb.com/company/' . $id . '/';
    return '';
};

$render_linked_pipe = function($value_list, $id_list) use ($aat, $build_entity_url) {
    $values = array_filter(array_map('trim', explode('|', (string) $value_list)), 'strlen');
    $ids = array_filter(array_map('trim', explode('|', (string) $id_list)), 'strlen');

    if (empty($values)) {
        return '<span class="aat-no-film">—</span>';
    }

    // If IDs line up, link each value to its internal profile.
    if (!empty($ids) && count($ids) === count($values)) {
        $out = array();
        foreach ($values as $i => $val) {
            $val = (string) $val;
            $id = $ids[$i] ?? '';
            $url = $build_entity_url($id);
            if ($url) {
                $out[] = '<a class="aat-entity-link" href="' . esc_url($url) . '">' . esc_html($val) . '</a>';
            } else {
                $out[] = '<span class="aat-entity-text">' . esc_html($val) . '</span>';
            }
        }
        return implode('<span class="aat-sep"> · </span>', $out);
    }

    // Fallback: plain values.
    $out = array_map(function($v) {
        return '<span class="aat-entity-text">' . esc_html((string) $v) . '</span>';
    }, $values);
    return implode('<span class="aat-sep"> · </span>', $out);
};

// Stats
$total_nominations = is_array($rows) ? count($rows) : 0;
$total_wins = 0;
$categories_set = array();
$ceremonies_set = array();
$min_ceremony = null;
$max_ceremony = null;
$ceremony_year_map = array();
$distinct_films = array();

if (is_array($rows)) {
    foreach ($rows as $r) {
        $winner = (!empty($r['winner']) && (int) $r['winner'] === 1);
        if ($winner) $total_wins++;

        $cat = (string) ($r['canonical_category'] ?? $r['category'] ?? '');
        if ($cat !== '') {
            $categories_set[$cat] = true;
        }

        $cer = intval($r['ceremony'] ?? 0);
        if ($cer > 0) {
            $ceremonies_set[$cer] = true;
            $ceremony_year_map[$cer] = (string) ($r['year'] ?? '');
            if ($min_ceremony === null || $cer < $min_ceremony) $min_ceremony = $cer;
            if ($max_ceremony === null || $cer > $max_ceremony) $max_ceremony = $cer;
        }

        // Only meaningful for Person/Company pages.
        if ($entity !== 'title') {
            $film_ids = array_filter(array_map('trim', explode('|', (string) ($r['film_id'] ?? ''))), 'strlen');
            foreach ($film_ids as $fid) {
                $distinct_films[$fid] = true;
            }
        }
    }
}

$total_categories = count($categories_set);
$total_ceremonies = count($ceremonies_set);
$span = '';
if ($min_ceremony !== null && $max_ceremony !== null) {
    $first_year = $ceremony_year_map[$min_ceremony] ?? '';
    $last_year = $ceremony_year_map[$max_ceremony] ?? '';
    if ($first_year && $last_year) {
        $span = $first_year . '–' . $last_year;
    }
}

$imdb_url = $build_imdb_url($id);
$search_url = home_url('/?s=' . rawurlencode($label ? $label : $id));
$ref = wp_get_referer();
$back_url = $ref ? $ref : home_url('/');

get_header();
?>

<div class="aat-container aat-entity-page">
    <div class="aat-entity-header">
        <?php if ($entity === 'title') : ?>
            <?php $aat_poster_html = $aat->get_poster_img_html_for_title($id, 'large', array('class' => 'aat-entity-poster')); ?>
            <?php if (!empty($aat_poster_html)) : ?>
                <div class="aat-entity-poster-wrap">
                    <?php echo $aat_poster_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="aat-entity-heading">
            <h1 class="aat-entity-title">
                <?php
                if ($label) {
                    echo esc_html($label);
                } else {
                    echo esc_html(strtoupper($id));
                }
                ?>
            </h1>
            <p class="aat-entity-subtitle">
                <?php if ($entity === 'title') : ?>
                    <?php echo esc_html__('Film profile — Academy Awards Database', 'academy-awards-table'); ?>
                <?php elseif ($entity === 'company') : ?>
                    <?php echo esc_html__('Company profile — Academy Awards Database', 'academy-awards-table'); ?>
                <?php else : ?>
                    <?php echo esc_html__('Person profile — Academy Awards Database', 'academy-awards-table'); ?>
                <?php endif; ?>
            </p>
        </div>

        <div class="aat-entity-actions">
            <?php if (!empty($imdb_url)) : ?>
                <a class="aat-btn aat-btn-primary" href="<?php echo esc_url($imdb_url); ?>" target="_blank" rel="noopener noreferrer">
                    <?php echo esc_html__('IMDb Reference', 'academy-awards-table'); ?>
                </a>
            <?php endif; ?>

            <a class="aat-btn aat-btn-secondary" href="<?php echo esc_url($search_url); ?>">
                <?php echo esc_html__('Search Lunara', 'academy-awards-table'); ?>
            </a>

            <a class="aat-btn aat-btn-secondary" href="<?php echo esc_url($back_url); ?>">
                <?php echo esc_html__('Back', 'academy-awards-table'); ?>
            </a>
        </div>
    <?php
    // Lunara Reviews integration: show a direct path into your editorial work.
    $aat_review_ids = array();
    if ($entity === 'title') {
        $aat_review_ids = $aat->get_review_ids_for_title_id($id, 3);
    }
    ?>

    <?php if ($entity === 'title' && !empty($aat_review_ids)) : ?>
        <?php
        $aat_primary_review_id = (int) $aat_review_ids[0];
        $aat_review_url = get_permalink($aat_primary_review_id);
        $aat_review_title = get_the_title($aat_primary_review_id);
        $aat_review_excerpt = get_the_excerpt($aat_primary_review_id);
        $aat_review_thumb = get_the_post_thumbnail_url($aat_primary_review_id, 'medium');
        ?>
        <section class="aat-lunara-review-module" aria-label="Lunara Film review">
            <div class="aat-lunara-review-inner">
                <?php if (!empty($aat_review_thumb)) : ?>
                    <a class="aat-lunara-review-poster" href="<?php echo esc_url($aat_review_url); ?>">
                        <img src="<?php echo esc_url($aat_review_thumb); ?>" alt="<?php echo esc_attr($aat_review_title); ?>" loading="lazy" decoding="async" />
                    </a>
                <?php endif; ?>

                <div class="aat-lunara-review-content">
                    <div class="aat-lunara-review-kicker">LUNARA FILM REVIEW</div>
                    <h2 class="aat-lunara-review-title">
                        <a href="<?php echo esc_url($aat_review_url); ?>"><?php echo esc_html($aat_review_title); ?></a>
                    </h2>

                    <?php if (!empty($aat_review_excerpt)) : ?>
                        <p class="aat-lunara-review-excerpt"><?php echo esc_html($aat_review_excerpt); ?></p>
                    <?php endif; ?>

                    <div class="aat-lunara-review-actions">
                        <a class="aat-btn aat-btn-primary" href="<?php echo esc_url($aat_review_url); ?>">Read the Review</a>
                        <a class="aat-btn aat-btn-secondary" href="<?php echo esc_url(home_url('/reviews/')); ?>">All Reviews</a>
                    </div>

                    <?php if (count($aat_review_ids) > 1) : ?>
                        <div class="aat-lunara-review-more">
                            <span class="aat-lunara-review-more-label">Also on Lunara:</span>
                            <?php
                            $more_links = array();
                            foreach (array_slice($aat_review_ids, 1) as $rid) {
                                $rid = (int) $rid;
                                $more_links[] = '<a href="' . esc_url(get_permalink($rid)) . '">' . esc_html(get_the_title($rid)) . '</a>';
                            }
                            echo implode('<span class="aat-sep"> · </span>', $more_links);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    </div>

    <div class="aat-stats-bar aat-entity-stats">
        <div class="aat-stat">
            <span class="aat-stat-number"><?php echo esc_html(number_format_i18n($total_nominations)); ?></span>
            <span class="aat-stat-label"><?php echo esc_html__('Nominations', 'academy-awards-table'); ?></span>
        </div>
        <div class="aat-stat">
            <span class="aat-stat-number"><?php echo esc_html(number_format_i18n($total_wins)); ?></span>
            <span class="aat-stat-label"><?php echo esc_html__('Wins', 'academy-awards-table'); ?></span>
        </div>
        <div class="aat-stat">
            <span class="aat-stat-number"><?php echo esc_html(number_format_i18n($total_categories)); ?></span>
            <span class="aat-stat-label"><?php echo esc_html__('Categories', 'academy-awards-table'); ?></span>
        </div>
        <div class="aat-stat">
            <span class="aat-stat-number"><?php echo esc_html(number_format_i18n($total_ceremonies)); ?></span>
            <span class="aat-stat-label"><?php echo esc_html__('Ceremonies', 'academy-awards-table'); ?></span>
        </div>
        <?php if ($entity !== 'title') : ?>
            <div class="aat-stat">
                <span class="aat-stat-number"><?php echo esc_html(number_format_i18n(count($distinct_films))); ?></span>
                <span class="aat-stat-label"><?php echo esc_html__('Films', 'academy-awards-table'); ?></span>
            </div>
        <?php endif; ?>
        <?php if ($span) : ?>
            <div class="aat-stat">
                <span class="aat-stat-number"><?php echo esc_html($span); ?></span>
                <span class="aat-stat-label"><?php echo esc_html__('Span', 'academy-awards-table'); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="aat-entity-section">
        <h2 class="aat-section-title"><?php echo esc_html__('Oscar History', 'academy-awards-table'); ?></h2>

        <?php if (empty($rows)) : ?>
            <div class="aat-no-results">
                <div class="aat-no-results-icon">🎬</div>
                <h3><?php echo esc_html__('No records found', 'academy-awards-table'); ?></h3>
                <p><?php echo esc_html__('This profile doesn’t yet have Oscar records in the database.', 'academy-awards-table'); ?></p>
            </div>
        <?php else : ?>
            <div class="aat-entity-table-wrap">
                <table class="aat-entity-table">
                    <thead>
                        <tr>
                            <th><?php echo esc_html__('Ceremony', 'academy-awards-table'); ?></th>
                            <th><?php echo esc_html__('Year', 'academy-awards-table'); ?></th>
                            <th><?php echo esc_html__('Category', 'academy-awards-table'); ?></th>
                            <?php if ($entity === 'title') : ?>
                                <th><?php echo esc_html__('Nominee', 'academy-awards-table'); ?></th>
                            <?php else : ?>
                                <th><?php echo esc_html__('Film', 'academy-awards-table'); ?></th>
                            <?php endif; ?>
                            <th><?php echo esc_html__('Status', 'academy-awards-table'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) :
                            $cer = intval($r['ceremony'] ?? 0);
                            $year = (string) ($r['year'] ?? '');
                            $cat = (string) ($r['canonical_category'] ?? $r['category'] ?? '');
                            $is_winner = (!empty($r['winner']) && (int) $r['winner'] === 1);
                            $row_class = $is_winner ? 'winner-row' : '';
                        ?>
                            <tr class="<?php echo esc_attr($row_class); ?>">
                                <td>
                                    <?php
                                        $cer_url = $aat->get_ceremony_url($cer);
                                        if ($cer_url) {
                                            echo '<a class="aat-hub-link aat-ceremony" href="' . esc_url($cer_url) . '">' . esc_html($ordinal($cer)) . '</a>';
                                        } else {
                                            echo esc_html($ordinal($cer));
                                        }
                                    ?>
                                </td>
                                <td><?php echo esc_html($year); ?></td>
                                <td>
                                    <?php
                                        $cat_url = $aat->get_category_url($cat);
                                        $cat_label = $format_category($cat);
                                        $pill = '<span class="aat-category-pill">' . esc_html($cat_label) . '</span>';
                                        if ($cat_url) {
                                            echo '<a class="aat-hub-link" href="' . esc_url($cat_url) . '">' . $pill . '</a>';
                                        } else {
                                            echo $pill;
                                        }
                                    ?>
                                </td>
                                <?php if ($entity === 'title') : ?>
                                    <td>
                                        <?php
                                        // Nominees within this nomination.
                                        echo $render_linked_pipe($r['nominees'] ?? ($r['name'] ?? ''), $r['nominee_ids'] ?? '');
                                        ?>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <?php echo $render_linked_pipe($r['film'] ?? '', $r['film_id'] ?? ''); ?>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <?php if ($is_winner) : ?>
                                        <span class="aat-winner-badge"><?php echo esc_html__('Winner', 'academy-awards-table'); ?></span>
                                    <?php else : ?>
                                        <span class="aat-nominee-badge"><?php echo esc_html__('Nominee', 'academy-awards-table'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <div class="aat-footer">
        <p>
            <?php esc_html_e('Data sourced from the Academy of Motion Picture Arts and Sciences. Structured dataset compiled and maintained by Lunara Film.', 'academy-awards-table'); ?>
        </p>
        <p>
            <?php esc_html_e('Profiles are generated directly from the Lunara Film Oscars dataset. New nominations and winners appear automatically after each annual import.', 'academy-awards-table'); ?>
        </p>
    </div>
</div>

<?php
get_footer();
