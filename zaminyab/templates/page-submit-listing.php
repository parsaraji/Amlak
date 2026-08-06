<?php
/**
 * Template Name: الگوی ثبت آگهی فروش زمین
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<main id="primary" class="site-main container">
    <div style="max-width: 800px; margin: 40px auto;">

        <h1 style="font-size:24px; font-weight:bold; text-align:center; margin-bottom:12px;">ثبت آگهی فروش زمین</h1>
        <p class="text-justify" style="text-align:center; color:var(--text-muted); font-size:14px; margin-bottom:32px;">آگهی زمین خود را در چند گام ساده و کاملاً رایگان ثبت کنید تا خریداران با شما تماس بگیرند.</p>

        <!-- Multi-step Wizard Navigation tabs -->
        <div class="submit-steps-nav">
            <div class="submit-step-nav-item active" id="step-nav-1">
                <span class="submit-step-number">۱</span>
                <span class="submit-step-label">اطلاعات اصلی</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-2">
                <span class="submit-step-number">۲</span>
                <span class="submit-step-label">موقعیت مکانی</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-3">
                <span class="submit-step-number">۳</span>
                <span class="submit-step-label">مشخصات زمین</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-4">
                <span class="submit-step-number">۴</span>
                <span class="submit-step-label">تصاویر و رسانه</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-5">
                <span class="submit-step-number">۵</span>
                <span class="submit-step-label">اطلاعات تماس</span>
            </div>
        </div>

        <form action="" method="post" enctype="multipart/form-data" id="submitListingForm">
            <?php wp_nonce_field( 'zaminyab_submit_listing_action', 'zaminyab_frontend_submit_nonce' ); ?>

            <!-- Step 1: Basic Info -->
            <div class="submit-form-panel submit-step-content active" id="step-panel-1">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۱: اطلاعات اصلی آگهی</h2>

                <div class="form-group">
                    <label for="title">عنوان آگهی زمین:</label>
                    <input type="text" id="title" name="title" placeholder="مانند: زمین باغچه ۵۰۰ متری سنددار در دماوند" required>
                    <p class="description" style="font-size:11px; color:var(--text-muted);">یک عنوان توصیفی کوتاه و جذاب بنویسید.</p>
                </div>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="land_type">نوع زمین:</label>
                        <select id="land_type" name="land_type" required>
                            <?php
                            $types = get_terms( array( 'taxonomy' => 'land_type', 'hide_empty' => false ) );
                            foreach ( $types as $type ) {
                                echo '<option value="' . esc_attr($type->term_id) . '">' . esc_html($type->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="land_usage">کاربری زمین:</label>
                        <select id="land_usage" name="land_usage">
                            <?php
                            $usages = get_terms( array( 'taxonomy' => 'land_usage', 'hide_empty' => false ) );
                            foreach ( $usages as $usage ) {
                                echo '<option value="' . esc_attr($usage->term_id) . '">' . esc_html($usage->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top:16px;">
                    <label for="description">توضیحات کامل آگهی:</label>
                    <textarea id="description" name="description" rows="6" placeholder="توضیحات کاملی درباره ویژگی‌ها، دسترسی‌ها و جزئیات زمین ارائه دهید..." required></textarea>
                </div>

                <div class="form-navigation">
                    <span></span>
                    <button type="button" class="btn-primary" onclick="nextFormStep(1)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 2: Location -->
            <div class="submit-form-panel submit-step-content" id="step-panel-2">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۲: موقعیت مکانی زمین</h2>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="land_location">استان و شهر:</label>
                        <select id="land_location" name="land_location" required>
                            <?php
                            $locations = get_terms( array( 'taxonomy' => 'land_location', 'hide_empty' => false ) );
                            foreach ( $locations as $loc ) {
                                echo '<option value="' . esc_attr($loc->term_id) . '">' . esc_html($loc->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="approx_address">آدرس تقریبی زمین:</label>
                        <input type="text" id="approx_address" name="approx_address" placeholder="جاده اصلی، فرعی دوم، نبش کوچه...">
                    </div>
                </div>

                <!-- Live Map Selection -->
                <div class="form-group" style="margin-top:20px;">
                    <label>موقعیت جغرافیایی روی نقشه:</label>
                    <p style="font-size:12px; color:var(--text-muted); margin-bottom:8px;">روی نقشه کلیک کنید تا مارکر قرمز رنگ جابجا شود.</p>
                    <?php zaminyab_render_map(); ?>

                    <input type="hidden" id="latitude" name="latitude" value="35.6892">
                    <input type="hidden" id="longitude" name="longitude" value="51.3890">
                    <input type="hidden" id="map_zoom" name="map_zoom" value="12">
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="approx_mode" value="1"> موقعیت مکانی به صورت تقریبی نمایش داده شود (حفظ حریم خصوصی)
                    </label>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(2)">گام قبلی</button>
                    <button type="button" class="btn-primary" onclick="nextFormStep(2)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 3: Land Specs -->
            <div class="submit-form-panel submit-step-content" id="step-panel-3">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۳: مشخصات و ابعاد زمین</h2>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="area_size">متراژ کل (متر مربع):</label>
                        <input type="number" id="area_size" name="area_size" placeholder="مثال: ۵۰۰" required>
                    </div>
                    <div class="form-group">
                        <label for="land_width">بر زمین (متر):</label>
                        <input type="number" id="land_width" name="land_width" placeholder="مثال: ۲۰">
                    </div>
                </div>

                <div class="form-group-grid" style="margin-top:16px;">
                    <div class="form-group">
                        <label for="land_length">طول زمین (متر):</label>
                        <input type="number" id="land_length" name="land_length" placeholder="مثال: ۲۵">
                    </div>
                    <div class="form-group">
                        <label for="land_passage">عرض گذر یا کوچه (متر):</label>
                        <input type="number" id="land_passage" name="land_passage" placeholder="مثال: ۸">
                    </div>
                </div>

                <div class="form-group" style="margin-top:20px;">
                    <label>انشعابات و امکانات موجود:</label>
                    <div class="listing-features-grid" style="background:#fafaf9; padding:16px; border-radius:8px;">
                        <label><input type="checkbox" name="has_water" value="1"> انشعاب آب</label>
                        <label><input type="checkbox" name="has_electricity" value="1"> انشعاب برق</label>
                        <label><input type="checkbox" name="has_gas" value="1"> انشعاب گاز</label>
                        <label><input type="checkbox" name="has_phone" value="1"> خط تلفن</label>
                        <label><input type="checkbox" name="has_wall" value="1"> دیوارکشی شده</label>
                        <label><input type="checkbox" name="has_building_permit" value="1"> پروانه ساخت</label>
                        <label><input type="checkbox" name="inside_plan" value="1"> داخل طرح هادی بافت</label>
                        <label><input type="checkbox" name="can_subdivide" value="1"> قابلیت قطعه‌بندی و تفکیک</label>
                    </div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(3)">گام قبلی</button>
                    <button type="button" class="btn-primary" onclick="nextFormStep(3)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 4: Media -->
            <div class="submit-form-panel submit-step-content" id="step-panel-4">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۴: آپلود تصاویر و مستندات</h2>

                <div class="form-group" style="border:2px dashed var(--border-color); border-radius:12px; padding:40px; text-align:center;">
                    <div class="empty-state-icon" style="color:var(--primary-color); width:48px; height:48px; margin: 0 auto 16px;">
                        <?php echo zaminyab_get_svg_icon('camera'); ?>
                    </div>
                    <label for="gallery_files" style="cursor:pointer; display:block; font-weight:bold; margin-bottom:8px;">انتخاب و آپلود تصاویر زمین</label>
                    <p style="font-size:12px; color:var(--text-muted); margin-bottom:16px;">تصاویری از نماهای مختلف زمین خود را انتخاب کنید (حداکثر ۸ تصویر)</p>
                    <input type="file" id="gallery_files" name="gallery_files[]" multiple accept="image/*" style="display:none;">
                    <button type="button" class="btn-outline" onclick="document.getElementById('gallery_files').click()">انتخاب فایل‌ها</button>
                </div>

                <!-- Preview list placeholder -->
                <div id="imagePreviewContainer" style="display:flex; flex-wrap:wrap; gap:8px; margin-top:16px;"></div>

                <div class="form-group" style="margin-top:20px;">
                    <label for="video_url">آدرس ویدیو آگهی (آپارات/یوتیوب):</label>
                    <input type="text" id="video_url" name="video_url" placeholder="https://aparat.com/v/XXXXX">
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(4)">گام قبلی</button>
                    <button type="button" class="btn-primary" onclick="nextFormStep(4)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 5: Contact -->
            <div class="submit-form-panel submit-step-content" id="step-panel-5">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۵: اطلاعات تماس فروشنده</h2>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="seller_name">نام کامل فروشنده:</label>
                        <input type="text" id="seller_name" name="seller_name" required>
                    </div>
                    <div class="form-group">
                        <label for="seller_phone">شماره همراه تماس مستقیم:</label>
                        <input type="text" id="seller_phone" name="seller_phone" required placeholder="۰۹۱۲۳۴۵۶۷۸۹">
                    </div>
                </div>

                <div class="form-group-grid" style="margin-top:16px;">
                    <div class="form-group">
                        <label for="seller_whatsapp">شماره واتس‌اپ فروشنده:</label>
                        <input type="text" id="seller_whatsapp" name="seller_whatsapp">
                    </div>
                    <div class="form-group">
                        <label for="seller_eitaa">شناسه یا لینک پیام‌رسان ایتا:</label>
                        <input type="text" id="seller_eitaa" name="seller_eitaa">
                    </div>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="click_to_reveal" value="1" checked> شماره تلفن به صورت کلیک‌کد پنهان باشد و بعد از کلیک نمایش داده شود.
                    </label>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(5)">گام قبلی</button>
                    <button type="submit" class="btn-primary" style="background-color:var(--secondary-color);">ثبت نهایی و ثبت آگهی زمین</button>
                </div>
            </div>

        </form>

    </div>
</main>

<script type="text/javascript">
function nextFormStep(currentStep) {
    // Basic browser checks
    var title = document.getElementById('title');
    if (currentStep === 1 && !title.value) {
        alert('لطفاً عنوان آگهی را پر کنید.');
        return;
    }

    document.getElementById('step-panel-' + currentStep).classList.remove('active');
    document.getElementById('step-nav-' + currentStep).classList.remove('active');
    document.getElementById('step-nav-' + currentStep).classList.add('completed');

    var nextStep = currentStep + 1;
    document.getElementById('step-panel-' + nextStep).classList.add('active');
    document.getElementById('step-nav-' + nextStep).classList.add('active');
}

function prevFormStep(currentStep) {
    document.getElementById('step-panel-' + currentStep).classList.remove('active');
    document.getElementById('step-nav-' + currentStep).classList.remove('active');

    var prevStep = currentStep - 1;
    document.getElementById('step-panel-' + prevStep).classList.add('active');
    document.getElementById('step-nav-' + prevStep).classList.add('active');
    document.getElementById('step-nav-' + prevStep).classList.remove('completed');
}

// Display uploaded files preview inside panel
document.getElementById('gallery_files').addEventListener('change', function(e) {
    var preview = document.getElementById('imagePreviewContainer');
    preview.innerHTML = '';
    for (var i = 0; i < e.target.files.length; i++) {
        var file = e.target.files[i];
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(event) {
                var div = document.createElement('div');
                div.style.width = '80px';
                div.style.height = '80px';
                div.style.borderRadius = '6px';
                div.style.overflow = 'hidden';
                div.innerHTML = '<img src="' + event.target.result + '" style="width:100%; height:100%; object-fit:cover;">';
                preview.appendChild(div);
            };
        })(file);
        reader.readAsDataURL(file);
    }
});
</script>

<?php get_footer(); ?>
