<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = THEME_OPT;

if ( !function_exists( "redux_add_metaboxes" ) ):
	function redux_add_metaboxes($metaboxes) {

        $homepage_options = array();

        
        $homepage_fields2 = array(
            'title' => 'Другий розділ сторінки',
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-list-alt',
            'fields' => array(
                array(
                    'id'     => 'link-department',
                    'type'   => 'text',
                    'description'  => __( 'посилання на сторінку органи самоврядування'),
                    'default' => '/'
                ),
                array(
                    'id'     => 'link-conditions',
                    'type'   => 'text',
                    'description'  => __( 'посилання на сторінку умови вступу до школи'),
                    'default' => '/'
                ),
                array(
                    'id'     => 'link-rewards',
                    'type'   => 'text',
                    'description'  => __( 'посилання на сторінку бібліотека'),
                    'default' => '/'
                ),
                array(
                    'id'     => 'link-video',
                    'type'   => 'text',
                    'description'  => __( 'посилання на сторінку відеотека школи'),
                    'default' => '/'
                ),
                array(
                    'id'     => 'link-for-parent',
                    'type'   => 'text',
                    'description'  => __( 'посилання на сторінку рекомендації батькам'),
                    'default' => '/'
                ),

            )
        );
        $homepage_fields3 = array(
            'title' => 'Третій розділ сторінки',
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-list-alt',
            'fields' => array(
                array(
                    'id'     => 'front-secont-string-head',
                    'type'   => 'text',
                    'description'  => __( 'Залоговок')
                ),
                array(
                    'id'     => 'front-image',
                    'type'   => 'media',
                    'title'  => __( 'Зображення',THEME_OPT)
                ),
                array(
                    'id'     => 'front-content',
                    'type'   => 'editor',
                    'title'  => __( 'Зміст')
                ),
                array(
                    'id'     => 'link-front',
                    'type'   => 'text',
                    'title'  => __( 'посилання')
                ),

            )
        );



	//$homepage_options[] = $homepage_fields1;

     $contactpage_options = array();

        $contactpage_fields = array(
            'title' => 'Зображення',
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-list-alt',
            'fields' => array(

                array(
                    'id'     => 'contact-map',
                    'type'   => 'media',
                    'title'  => __( 'Мапа, зображення',THEME_OPT)
                ),
                array(
                    'id'     => 'contact-img1',
                    'type'   => 'media',
                    'title'  => __( 'Зображення1 ліве',THEME_OPT)
                ),
                array(
                    'id'     => 'contact-img2',
                    'type'   => 'media',
                    'title'  => __( 'Зображення2 праве',THEME_OPT)
                ),
                )

        );

        $contactpage_options[] = $contactpage_fields;





        // $metaboxes[] = array(
        //     'id'            => 'home-page-options',
        //     'title'         => __( 'Главная страница блога', THEME_OPT ),
        //     'post_types'    => array( 'page' ),
        //     'page_template' => array('front-page.php'),
        //     'position'      => 'normal', // normal, advanced, side
        //     'priority'      => 'high', // high, core, default, low
        //     'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
        //     'sections'      => $homepage_options,
        //     );

	    $metaboxes[] = array(
                'id'            => 'contact-page-options',
                'title'         => __( 'Сторінка батькам', THEME_OPT ),
                'post_types'    => array( 'page' ),
                'page_template' => array('contact-page.php'),
                'position'      => 'normal', // normal, advanced, side
                'priority'      => 'high', // high, core, default, low
                'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
                'sections'      => $contactpage_options,
                );

	return $metaboxes;
  }
  add_action("redux/metaboxes/{$redux_opt_name}/boxes", 'redux_add_metaboxes');
endif;

