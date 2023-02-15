<?php
   /*
   Plugin Name: Awesomeness Creator
   Plugin URI: https://my-awesomeness-emporium.com
   description: Enables the WordPress classic editor and the old-style Edit Post screen with TinyMCE, Meta Boxes, etc. Supports the older plugins that extend this screen.
  a plugin to create awesomeness and spread joy
   Version: 1.2
   Author: Mr. Awesome
   Author URI: https://mrtotallyawesome.com
   License: GPL2
   */
  function DisplayCustomSettingsForm_shortcode()
{

  if (isset($_POST['FormSubmit'])) {

       $post_id = wp_insert_post(array(
       'post_status' => 'publish',
       'post_type' => 'teams',
       'post_title' => $_REQUEST["last_name"],
       'post_content' => $_REQUEST["description"]
 ));
 }
?>

  <!-- // Advertisement code pasted inside a variable -->

  <div class="container">
    <section id="lwCSForm-wrapper">
      <form name="lwCSForm" id="lwCSForm" method="post" action="" autocomplete="on">
        <label for="Name">Title</label>
        <input type="text" id="last_name" name="last_name" required placeholder="Book title.." ><br><br>


        <label for="subject">Subject</label>
        <textarea id="description" name="description" required  placeholder="About book.."></textarea><br><br>

        <input type="submit" name="FormSubmit">
      </form>
    </section>

  </div>

  <!-- END LwCSForm Plugin-->

<?php
}
add_shortcode('lwCSForm', 'DisplayCustomSettingsForm_shortcode');
add_action('init', 'activate_myplugin');

function activate_myplugin()
{

  $args = array(
    'label' => 'Teams',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array(
      'slug' => 'myteams',
      'with_front' => false
    ),
    'query_var' => true,
    'supports' => array(
      'title',
      'editor',
      'excerpt',
      'trackbacks',
      'custom-fields',
      'revisions',
      'thumbnail',
      'author',
      'page-attributes'
    )
  );
  register_post_type('teams', $args);
}


function myplugin_flush_rewrites()
{
  activate_myplugin();
  flush_rewrite_rules();
}


function my_plugin_uninstall()
{
  // Uninstallation stuff here
  unregister_post_type('teams');
}

add_action('wp_enqueue_scripts', 'initial_admin_links_hide_stylesheet');

function initial_admin_links_hide_stylesheet()
{
  wp_enqueue_style('style1', plugins_url('/css/style1.css', __FILE__));
  wp_enqueue_style('style2', plugins_url('/css/style2.css', __FILE__));

  wp_enqueue_style('bootstrap.min', plugins_url('/css/bootstrap.min.css', __FILE__));
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script('bootstrap', plugins_url('/js/bootstrap.min.js', __FILE__));
  wp_enqueue_script('jquery', plugins_url('/js/jquery.min.js', __FILE__));
  wp_enqueue_script('jquery1', plugins_url('/js/custom.js', __FILE__));
}

function showallpost()
{

  $args = array(  
        'post_type' => 'teams',
        'post_status' => 'publish',
        'posts_per_page' => 8, 
    );
//print_r($args);exit;
    $loop = new WP_Query( $args ); 
        
    while ( $loop->have_posts() ) : $loop->the_post(); 
        ?>
        <table border="1px solid black" class="hcf_field" width="1500px" >
        <tr>
            <th width="300px"><strong>Title: <br> <br>  <?php the_title(); ?></strong></th>
            <th></th>
            <th width="500px"><strong>Subject: <br> <?php the_excerpt(); ?> </strong></th>
            <th></th><br><br>

        </tr>
        <tr>
            <th><strong>Author: </strong></th>
            <th><strong>Published Date: </strong></th>
            <th><strong>Price: </strong></th>
            <th align="center" width="400px"  id="<?php echo get_the_ID(); ?>" class="pp" data-toggle="modal" data-target="#myModal"
              data-id="<?php echo get_the_ID(); ?>"><strong>Edit: </strong></th>
        </tr>
            <td align="center"><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?></td>
            <td align="center"><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?></td>
            <td align="center"><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?></td>
            <td>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content update data-->
     <form method="post">
    <div class="modal-content">
      <input type="hidden" class="post_id" value="">
      <div class="form-group" align="center">
            <label for="recipient-name" class="col-form-label">Author:</label>
            <input type="text" class="form-control" name="authorname" id="recipient-name" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?>">
          </div>
          <div class="form-group" align="center">
            <label for="message-text" class="col-form-label">Published Date:</label>
            <input type="date" class="form-control" name="date" id="recipient-name" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?>">
          </div>
          <div class="form-group" align="center">
            <label for="recipient-name" class="col-form-label">Price:</label>
            <input type="text" class="form-control" name="price" id="recipient-name"  value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?>">
          </div>
      <div class="modal-footer" align="center">
      <input type="submit" name="update">
      </div>
    </div>

  </div>
</div>
</form>
</td>
</table>

      <?php
  
    endwhile;

    wp_reset_postdata();
 
}
add_shortcode('showpost', 'showallpost');


/** * Register meta boxes. */

function hcf_register_meta_boxes() {
   add_meta_box( 'hcf-1', __( 'Teams', 'hcf' ), 'hcf_display_callback', 'teams' );
   function hcf_display_callback( $teams ) {
      ?>
   <div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_field{
            display: contents;
        }
    </style>
    <p class="meta-options hcf_field">
        <label for="hcf_author">Author</label>
        <input id="hcf_author"
            type="text"
            name="hcf_author"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_published_date">Published Date</label>
        <input id="hcf_published_date"
            type="date"
            name="hcf_published_date"
           value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_price">Price</label>
        <input id="hcf_price"
            type="number"
            name="hcf_price"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?>">
    </p>
</div>
   <?php
   }
   include plugin_dir_path( __FILE__ ) . './metaboxform.php';
   ?>
  
  <?php
}

add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );

// save metabox

function hcf_save_meta_box( $post_id ) {
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
   if ( $parent_id = wp_is_post_revision( $post_id ) ) {
       $post_id = $parent_id;
   }
   $fields = [
       'hcf_author',
       'hcf_published_date',
       'hcf_price',
   ];
   foreach ( $fields as $field ) {
       if ( array_key_exists( $field, $_POST ) ) {
           update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
           
       }
    }
    
}
add_action( 'save_post', 'hcf_save_meta_box' );


?>