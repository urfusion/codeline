<?php

/**
 * @package Latest Films
 * @version 1.0
 */
/*
  Plugin Name: Latest Films
  Plugin URI: http://wordpress.org/plugins/latest_films/
  Description: This plugin will display latest films entries.
  Author: AZinkey
  Version: 1.0
  Author URI: http://kadams.in/
 */


function latest_films() {
    $args = array(
        'posts_per_page' => 5,
        'offset' => 0,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'films',
        'post_status' => 'publish',
        'suppress_filters' => true,
    );
    $posts = get_posts($args);

    echo '<ul class="latest-films-list">';
    foreach ($posts as $post) {
        echo '<li>';
        echo get_the_post_thumbnail($post->ID);
        echo '<h6><a href="'.get_post_permalink($post->ID).'">'.$post->post_title.'</a></h6>';
        echo '<strong>Ticket Price: </strong>'.get_field( "ticket_price", $post->ID );
        echo '<br /><strong>Release Date: </strong>'.get_field( "release_date", $post->ID );
        $genres = get_the_terms($post->ID,'genre');
        echo '<br /> <strong>Genres: </strong>';
        
        foreach ($genres as $genre) {
            echo $genre->name.' ';
        }
        
        $countries = get_the_terms($post->ID,'country');
        echo '<br /> <strong>Country: </strong>';
        
        foreach ($countries as $country) {
            echo $country->name.' ';
        }
        
        
        
        echo '</li>';
    }
    echo '<div class="clear"></div></ul>';
}

add_shortcode('latest-films', 'latest_films');
?>
