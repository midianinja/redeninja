<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'divi', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script( 'divi', plugin_dir_url( __FILE__ ) . 'js/scripts.js', array( 'jquery', 'divi-custom-script' ), '0.1.2', true );
}

function modify_user_contact_methods( $user_contact ) {
	$user_contact['avatar']   = __( 'Avatar Image Link'   );
	$user_contact['facebook']   = __( 'Facebook Link'   );
	$user_contact['twitter'] = __( 'Twitter Link' );
	$user_contact['video'] = __( 'Video Link' );

	return $user_contact;
}
add_filter( 'user_contactmethods', 'modify_user_contact_methods' );

function custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
	$user = false;

	if ( is_numeric( $id_or_email ) ) {

		$id = (int) $id_or_email;
		$user = get_user_by( 'id' , $id );

	} elseif ( is_object( $id_or_email ) ) {

		if ( ! empty( $id_or_email->user_id ) ) {
			$id = (int) $id_or_email->user_id;
			$user = get_user_by( 'id' , $id );
		}

	} else {
		$user = get_user_by( 'email', $id_or_email );
	}

	if ( $user && is_object( $user ) ) {

		$avatar = get_the_author_meta('avatar',$user->ID);
		$avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

	}

	return $avatar;
}
add_filter( 'get_avatar' , 'custom_avatar' , 1 , 5 );
?>
