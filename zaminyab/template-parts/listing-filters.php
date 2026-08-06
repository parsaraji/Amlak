<?php
/**
 * Advanced Filters & Search Sidebar component
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="filters-wrapper">
    <form action="<?php echo esc_url( home_url( '/land/' ) ); ?>" method="get">

        <!-- Keyword Search -->
        <div class="filter-group">
            <label class="filter-group-title" for="s_keyword">جستجوی کلمه‌ای</label>
            <input type="text" id="s_keyword" name="s_keyword" value="<?php echo isset($_GET['s_keyword']) ? esc_attr($_GET['s_keyword']) : ''; ?>" placeholder="باغچه، ویلایی، جاده..." class="filter-control">
        </div>

        <!-- Province / Location -->
        <div class="filter-group">
            <label class="filter-group-title" for="s_location">استان و شهرها</label>
            <select id="s_location" name="s_location" class="filter-control">
                <option value="">همه مکان‌ها</option>
                <?php
                $locations = get_terms( array( 'taxonomy' => 'land_location', 'hide_empty' => false ) );
                $current_loc = isset($_GET['s_location']) ? intval($_GET['s_location']) : 0;
                foreach ( $locations as $loc ) {
                    echo '<option value="' . esc_attr($loc->term_id) . '" ' . selected($current_loc, $loc->term_id, false) . '>' . esc_html($loc->name) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Land Type -->
        <div class="filter-group">
            <label class="filter-group-title" for="s_type">نوع زمین</label>
            <select id="s_type" name="s_type" class="filter-control">
                <option value="">همه انواع زمین</option>
                <?php
                $types = get_terms( array( 'taxonomy' => 'land_type', 'hide_empty' => false ) );
                $current_type = isset($_GET['s_type']) ? intval($_GET['s_type']) : 0;
                foreach ( $types as $type ) {
                    echo '<option value="' . esc_attr($type->term_id) . '" ' . selected($current_type, $type->term_id, false) . '>' . esc_html($type->name) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Document Type -->
        <div class="filter-group">
            <label class="filter-group-title" for="s_document">نوع سند</label>
            <select id="s_document" name="s_document" class="filter-control">
                <option value="">همه انواع سند</option>
                <?php
                $docs = get_terms( array( 'taxonomy' => 'land_document_type', 'hide_empty' => false ) );
                $current_doc = isset($_GET['s_document']) ? intval($_GET['s_document']) : 0;
                foreach ( $docs as $doc ) {
                    echo '<option value="' . esc_attr($doc->term_id) . '" ' . selected($current_doc, $doc->term_id, false) . '>' . esc_html($doc->name) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Sort By -->
        <div class="filter-group">
            <label class="filter-group-title" for="sort">مرتب‌سازی براساس</label>
            <select id="sort" name="sort" class="filter-control">
                <option value="newest" <?php selected( isset($_GET['sort']) ? $_GET['sort'] : 'newest', 'newest' ); ?>>جدیدترین آگهی‌ها</option>
                <option value="cheapest" <?php selected( isset($_GET['sort']) ? $_GET['sort'] : '', 'cheapest' ); ?>>ارزان‌ترین‌ها</option>
                <option value="expensive" <?php selected( isset($_GET['sort']) ? $_GET['sort'] : '', 'expensive' ); ?>>گران‌ترین‌ها</option>
                <option value="largest" <?php selected( isset($_GET['sort']) ? $_GET['sort'] : '', 'largest' ); ?>>بیشترین متراژ</option>
                <option value="smallest" <?php selected( isset($_GET['sort']) ? $_GET['sort'] : '', 'smallest' ); ?>>کمترین متراژ</option>
            </select>
        </div>

        <!-- Area sizing filter range -->
        <div class="filter-group">
            <label class="filter-group-title">متراژ زمین (متر مربع)</label>
            <div style="display: flex; gap: 8px;">
                <input type="number" name="area_min" value="<?php echo isset($_GET['area_min']) ? esc_attr($_GET['area_min']) : ''; ?>" placeholder="حداقل" class="filter-control" style="width: 50%;">
                <input type="number" name="area_max" value="<?php echo isset($_GET['area_max']) ? esc_attr($_GET['area_max']) : ''; ?>" placeholder="حداکثر" class="filter-control" style="width: 50%;">
            </div>
        </div>

        <!-- Infrastructure checkbox filters -->
        <div class="filter-group">
            <label class="filter-group-title">امکانات و انشعابات</label>
            <div class="filter-checkbox-list">
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="has_water" value="1" <?php checked( isset($_GET['has_water']), '1' ); ?>> دارای آب
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="has_electricity" value="1" <?php checked( isset($_GET['has_electricity']), '1' ); ?>> دارای برق
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="has_gas" value="1" <?php checked( isset($_GET['has_gas']), '1' ); ?>> دارای گاز
                </label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="has_building_permit" value="1" <?php checked( isset($_GET['has_building_permit']), '1' ); ?>> دارای مجوز ساخت
                </label>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; border-radius: var(--border-radius);">
            اعمال فیلترهای جستجو
        </button>

        <?php if ( ! empty($_GET) ) : ?>
            <a href="<?php echo esc_url( home_url( '/land/' ) ); ?>" class="btn-muted" style="width: 100%; margin-top: 12px; display: inline-flex; align-items: center; justify-content: center; height: 44px; border-radius: var(--border-radius);">
                پاک کردن فیلترها
            </a>
        <?php endif; ?>

    </form>
</div>
