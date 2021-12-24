<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<form class="searchform form" role="search" method="get" action="<?php echo home_url( '/' ); ?>"> 
	<input id="searchform-control" class="form-control" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e( 'Поиск по сайту', ALEXCODETH_TEXTDOMAIN ); ?>">
	<button class="searchsubmit" type="submit"><?php esc_html_e( 'Найти', ALEXCODETH_TEXTDOMAIN ); ?></button>
</form>