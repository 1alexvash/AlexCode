<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


$title = trim( get_theme_mod( 'sectionintrotitle' ) );
$description = trim( get_theme_mod( 'sectionintrodescription' ) );
$foto_src = get_theme_mod( 'sectionintrofotosrc' );
$foto_id = is_url( $foto_src ) ? attachment_url_to_postid( removing_image_size_from_url( $foto_src ) ) : 0;
$name = trim( get_theme_mod( 'sectionintroname' ) );
$job = trim( get_theme_mod( 'sectionintrojob' ) );


include get_theme_file_path( 'views/section-intro.php' );