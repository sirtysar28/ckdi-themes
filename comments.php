<?php
/**
 * Comments template
 *
 * @package CKDI
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="ckdi-comments" style="margin-top:4rem;">

	<?php if ( have_comments() ) : ?>
		<h3 class="section-title" style="text-align:left;font-size:1.3rem;margin-bottom:1.5rem;">
			<?php
			printf(
				/* translators: %s = jumlah komentar */
				esc_html( _n( '%s Komentar', '%s Komentar', get_comments_number(), 'ckdi' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h3>

		<ol class="comment-list" style="list-style:none;">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 42,
			) );
			?>
		</ol>

		<?php
		the_comments_pagination( array(
			'prev_text' => '←',
			'next_text' => '→',
		) );
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="section-subtitle"><?php esc_html_e( 'Komentar ditutup.', 'ckdi' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'         => __( 'Tinggalkan Komentar', 'ckdi' ),
		'label_submit'        => __( 'Kirim Komentar', 'ckdi' ),
		'class_submit'        => 'btn-primary',
		'comment_notes_before'=> '',
	) );
	?>
</div>
