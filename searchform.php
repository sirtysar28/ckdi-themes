<?php
/**
 * Search form
 *
 * @package CKDI
 */
?>
<form role="search" method="get" class="ckdi-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Cari sesuatu...', 'ckdi' ); ?>" aria-label="<?php esc_attr_e( 'Cari', 'ckdi' ); ?>">
	</div>
	<button type="submit" class="btn-primary" style="width:100%;justify-content:center;"><?php esc_html_e( 'Cari', 'ckdi' ); ?></button>
</form>
