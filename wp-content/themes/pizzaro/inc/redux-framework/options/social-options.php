<?php
/**
 * Options available for Social Media sub menu of Theme Options
 * 
 */

$social_options 	= apply_filters( 'pizzaro_social_media_options_args', array(
	'title'     => esc_html__('Social Media', 'pizzaro'),
	'icon'      => 'fa fa-share-square-o',
	'desc'      => esc_html__('Please type in your complete social network URL', 'pizzaro' ),
	'fields'    => array(
		array(
			'title'     => esc_html__('Facebook', 'pizzaro'),
			'id'        => 'facebook',
			'type'      => 'text',
			'icon'      => 'fab fa-facebook-f',
		),

		array(
			'title'     => esc_html__('Twitter', 'pizzaro'),
			'id'        => 'twitter',
			'type'      => 'text',
			'icon'      => 'fab fa-twitter',
		),

		array(
			'title'     => esc_html__('Google+', 'pizzaro'),
			'id'        => 'googleplus',
			'type'      => 'text',
			'icon'      => 'fab fa-google-plus',
		),

		array(
			'title'     => esc_html__('Pinterest', 'pizzaro'),
			'id'        => 'pinterest',
			'type'      => 'text',
			'icon'      => 'fab fa-pinterest',
		),

		array(
			'title'     => esc_html__('LinkedIn', 'pizzaro'),
			'id'        => 'linkedin',
			'type'      => 'text',
			'icon'      => 'fab fa-linkedin',
		),

		array(
			'title'     => esc_html__('Tumblr', 'pizzaro'),
			'id'        => 'tumblr',
			'type'      => 'text',
			'icon'      => 'fab fa-tumblr',
		),

		array(
			'title'     => esc_html__('Instagram', 'pizzaro'),
			'id'        => 'instagram',
			'type'      => 'text',
			'icon'      => 'fab fa-instagram',
		),

		array(
			'title'     => esc_html__('Youtube', 'pizzaro'),
			'id'        => 'youtube',
			'type'      => 'text',
			'icon'      => 'fab fa-youtube',
		),

		array(
			'title'     => esc_html__('Vimeo', 'pizzaro'),
			'id'        => 'vimeo',
			'type'      => 'text',
			'icon'      => 'fab fa-vimeo-square',
		),

		array(
			'title'     => esc_html__('Dribbble', 'pizzaro'),
			'id'        => 'dribbble',
			'type'      => 'text',
			'icon'      => 'fab fa-dribbble',
		),

		array(
			'title'     => esc_html__('Stumble Upon', 'pizzaro'),
			'id'        => 'stumbleupon',
			'type'      => 'text',
			'icon'      => 'fab fa-stumpleupon',
		),

		array(
			'title'     => esc_html__('Sound Cloud', 'pizzaro'),
			'id'        => 'soundcloud',
			'type'      => 'text',
			'icon'      => 'fab fa-soundcloud',
		),

		array(
			'title'     => esc_html__('Vine', 'pizzaro'),
			'id'        => 'vine',
			'type'      => 'text',
			'icon'      => 'fab fa-vine',
		),

		array(
			'title'     => esc_html__('VKontakte', 'pizzaro'),
			'id'        => 'vk',
			'type'      => 'text',
			'icon'      => 'fab fa-vk',
		),
		array(
			'id'		=> 'show_footer_rss_icon',
			'type'		=> 'switch',
			'title'		=> esc_html__( 'RSS', 'pizzaro' ),
			'desc'		=> esc_html__( 'On enabling footer rss icon.', 'pizzaro' ),
			'default'	=> 1,
		),
	),
) );