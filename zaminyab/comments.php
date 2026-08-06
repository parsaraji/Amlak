<?php
/**
 * ZaminYab Comments Template
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area" style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:24px; margin-top:40px; margin-bottom:40px;">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title" style="font-size:16px; font-weight:bold; margin-bottom:20px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">
            نظرات ثبت شده درباره این آگهی
        </h2>

        <ul class="comment-list" style="list-style:none; padding:0; margin:0;">
            <?php
            wp_list_comments( array(
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size'=> 42,
            ) );
            ?>
        </ul>

        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php
    // Show standard comment form in Persian style
    comment_form( array(
        'title_reply'          => 'دیدگاه یا سوال خود را درباره این زمین مطرح کنید',
        'title_reply_to'       => 'پاسخ به %s',
        'cancel_reply_link'    => 'انصراف',
        'label_submit'         => 'ثبت نظر نهایی',
        'class_submit'         => 'btn-primary',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
    ) );
    ?>

</div>
