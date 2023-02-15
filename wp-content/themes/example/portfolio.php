<?php

/**
* Template Name: portfolio
*
*/
get_header();

?>

 
  <div class="container">
        <div class="row">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">Portfolios</h1>
        </div>

        <div text-align="center">

            <div style="word-spacing: 30PX;">
                
<?php
   $args = array(
               'taxonomy' => 'portfolio_category',
               'orderby' => 'name',
               'order'   => 'ASC'
           );

   $cats = get_categories($args);?>
<ul class="cat-list">
  <li><a class="cat-list_item active" href="#!" data-slug="">All projects</a></li>

<?php
echo do_shortcode('[NEXForms id= "6"]');
foreach($cats as $cat) {
?>
<!-- <div style="text-align: center; "> -->
    <li>
    <a class="cat-list_item filter-button" href="#!" data-filter="<?php echo $cat->slug;?>">
        <?php echo $cat->name;?>
      </a>
  </li>
</ul>
     <!--  <button class="btn btn-default filter-button" data-filter="<?php echo $cat->slug;?>">
           <?php echo $cat->name;?>
           </button> -->
   </div>
</div>   
</div>
<?php

// echo do_shortcode('[lwCSForm]');
//     echo do_shortcode('[showpost]');


 }
 $args = array(
    'post_type' => 'portfolios',
    'post_status' => 'publish',
    'posts_per_page' => -1
);

 
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
   while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $terms = get_the_terms(get_the_ID(), 'portfolio_category' );
        $slug = [];

        foreach($terms as $k => $t){
            $slug[] = $t->slug;
        }
        $slug_name = implode( " ", $slug );
    ?>

<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter <?php echo $slug_name; ?> ">
               <a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail() ?></a>
            </div>
            
<?php
    }
} else {
    // no posts found
    echo "No Post Found";
}

wp_reset_postdata();

?>
 </div>
</div>
<?php
get_footer();
?>