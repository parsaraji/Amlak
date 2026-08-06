<?php
/**
 * Template part for rendering user dashboard content.
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_user_logged_in() ) {
    return;
}

$user_id = get_current_user_id();
?>
<div class="dashboard-container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid var(--border-color); padding-bottom:16px;">
        <h2 style="font-size:16px; font-weight:bold; margin:0;">لیست زمین‌های واگذار شده و آگهی شده توسط شما</h2>
        <a href="<?php echo esc_url( home_url( '/submit-listing/' ) ); ?>" class="btn-primary" style="padding:6px 12px; font-size:13px;">+ ثبت آگهی جدید</a>
    </div>

    <?php
    // Fetch current user posts
    $query = new WP_Query( array(
        'post_type'   => 'land_listing',
        'post_status' => array( 'publish', 'pending', 'draft' ),
        'author'      => $user_id,
        'posts_per_page' => -1,
    ) );

    if ( $query->have_posts() ) : ?>
        <div class="dashboard-table-wrapper">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>عنوان آگهی</th>
                        <th>نوع زمین</th>
                        <th>قیمت کل</th>
                        <th>وضعیت انتشار</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ( $query->have_posts() ) : $query->the_post();
                        $post_id = get_the_ID();
                        $price = get_post_meta( $post_id, '_price_total', true );
                        $status = get_post_status( $post_id );

                        $status_label = 'پیش‌نویس';
                        $status_class = 'badge-secondary';
                        if ( $status === 'publish' ) {
                            $status_label = 'منتشر شده';
                            $status_class = 'badge-primary';
                        } elseif ( $status === 'pending' ) {
                            $status_label = 'در انتظار بررسی';
                            $status_class = 'badge-accent';
                        }

                        // Create secure delete link
                        $delete_url = wp_nonce_url(
                            add_query_arg( array( 'action' => 'delete', 'id' => $post_id ) ),
                            'delete_listing_' . $post_id
                        );

                        // Create frontend edit link (pointing to the submit-listing template with an edit_id parameter)
                        $edit_url = add_query_arg( array( 'edit_id' => $post_id ), home_url( '/submit-listing/' ) );
                        ?>
                        <tr>
                            <td>
                                <div style="width:60px; height:40px; border-radius:4px; overflow:hidden;">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail('thumbnail', array('style'=>'width:100%;height:100%;object-fit:cover;')); ?>
                                    <?php else: ?>
                                        <div style="background:#eee; width:100%; height:100%; display:flex; align-items:center; justify-content:center;">-</div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></td>
                            <td>
                                <?php
                                $terms = get_the_terms( $post_id, 'land_type' );
                                echo ( ! empty($terms) ) ? esc_html($terms[0]->name) : 'زمین مسکونی';
                                ?>
                            </td>
                            <td><?php echo zaminyab_format_price( $price ); ?></td>
                            <td>
                                <span class="listing-badge <?php echo esc_attr($status_class); ?>" style="position:static; padding:2px 8px; font-size:11px;">
                                    <?php echo esc_html($status_label); ?>
                                </span>
                            </td>
                            <td>
                                <div style="display:flex; gap:8px;">
                                    <a href="<?php echo esc_url( $edit_url ); ?>" class="btn-outline" style="padding:4px 8px; font-size:12px; border-radius:4px;">ویرایش</a>
                                    <a href="<?php echo esc_url( $delete_url ); ?>" class="btn-muted" onclick="return confirm('آیا از حذف این آگهی اطمینان کامل دارید؟')" style="padding:4px 8px; font-size:12px; border-radius:4px; color:#ef4444;">حذف</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <div style="text-align:center; padding:40px;">
            <p style="color:var(--text-muted); margin-bottom:16px;">شما هنوز هیچ آگهی زمین ثبت نکرده‌اید.</p>
            <a href="<?php echo esc_url( home_url( '/submit-listing/' ) ); ?>" class="btn-primary">ثبت اولین آگهی زمین</a>
        </div>
    <?php endif; ?>
</div>
