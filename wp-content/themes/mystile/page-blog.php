<?php
/*
Template Name: Archives
*/
get_header(); ?>
<div class="wrapper blog">
    <div class="banner"></div>
    <div class="container text-center spacing">
        <h1 class="blue header">Blog</h1>

<?php global $post; // required
$args = array(); // exclude category 9
$custom_posts = get_posts($args);
$array_length = count($custom_posts);
$row_counter = 0;
foreach($custom_posts as $post) : setup_postdata($post);
if( $row_counter == 0 ) {
?>
<div class="row">
<?php } else if ( $row_counter == $array_length ) {
?>
</div>
<?php } else if ( $row_counter % 3 == 0 ) {
?>
</div>
<div class="row">
<?php
}
?>
<div class="col-sm-4">
    <div class="blog-img center-block">
        <img class="img-responsive" src="<?php echo CFS()->get('img'); ?>" alt="">
    </div>
    <h3 class="blue"><?php the_title(); ?></h3>
    <p class="text"><?php echo substr(get_the_excerpt(), 0, 180).' [...]'; ?></p>
    <a class="center-block blue-btn white" href="<?php the_permalink(); ?>">Ver más</a>
</div>
<?php
$row_counter++;
endforeach;
?>

        </div>
    </div>
</div>
<?php get_footer(); ?>