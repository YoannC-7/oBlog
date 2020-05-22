<?php 

//notre fonction qui configure certains trucs dans notre thème 
function oblog_setup(){
    //on demande à wordpress d'afficher la balise <title> dans notre head à notre place
    add_theme_support('title-tag');

    //notre thème utilise les menus gérés dans le back-office
    add_theme_support('menus');

    //crée un emplacement de menu, s'appelant navbar-menu
    register_nav_menus([
        'navbar-menu' => 'Menu de liens vers les pages',
        'footer-menu' => 'Menu de liens vers les conditions générales'
    ]);
}

//on demande à wordpress d'appeler notre fonction oblog_setup lorsque 
//l'événement after_setup_theme sera déclenché
//les événements de ce type dans Wordpress s'appelle des Hook ! 
add_action('after_setup_theme', 'oblog_setup');


//ajoute les classes nécessaire aux li de notre menu
//on reçoit les classes de wordpress en argument
function oblog_nav_li_css($classes){
    $classes[] = 'nav-item';
    return $classes;
}
//filtre ! on utilise les filtres quand on veut modifier des données avant affichage ! 
//on demande à wp d'appeler notre fonction déclarée ci-haut
add_filter('nav_menu_css_class', 'oblog_nav_li_css');

//dans la même logique, on ajoute ici l'attribut class à nos <a> du menu
function oblog_nav_a_css($attributes){
    $attributes['class'] = 'nav-link';
    return $attributes;
}
add_filter('nav_menu_link_attributes', 'oblog_nav_a_css');


//ajoute les classes nécessaire aux li de notre menu
//on reçoit les classes de wordpress en argument
function oblog_footer_li_css($classes){
    $classes[] = 'list-inline-item';
    return $classes;
}
//filtre ! on utilise les filtres quand on veut modifier des données avant affichage ! 
//on demande à wp d'appeler notre fonction déclarée ci-haut
add_filter('nav_menu_css_class', 'oblog_footer_li_css');




//fonction permettant d'ajouter dynamiquement des script ou des css ! 
function oblog_scripts(){
    //ajoute un css, en spécifiant qu'on doit charger le reset d'abord 
    wp_enqueue_style('blog-css', get_template_directory_uri() . "/assets/css/blog.css");
}

//on demande à wp d'appeler notre fonction ! 
add_action('wp_enqueue_scripts', 'oblog_scripts');

/* Query page auteur */
function my_post_queries( $query ) {
    // vérifier qu'on n'est pas sur une page admin
    if ( !is_admin() && $query->is_main_query() ) {

        if ( is_author() ) {

            // montrer tous les articles
            $query->set( 'posts_per_page', -1 );
            $query->set( 'post_type', array( 'post' ) );
        }

    }
}
add_action( 'pre_get_posts', 'my_post_queries' );