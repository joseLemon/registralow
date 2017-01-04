<?php get_header(); ?>
<div class="wrapper blog-single">
    <div class="banner"></div>
    <div class="container spacing">
        <h1 class="blue header text-center">Blog</h1>
        <div class="col-sm-8">
            <div class="center-block">
                <img class="img-responsive" src="<?php echo CFS()->get('img'); ?>" alt="">
            </div>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="entrada">
                <h3 class="blue text-center"><?php the_title(); ?></h3>
                <div class="text text-justify">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4 blog-sidebar text-center">
            <h3 class="blue text-left">Post Recientes</h3>
            <?php $the_query = new WP_Query( 'posts_per_page=5' ); ?>

            <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

            <div class="center-block row no-margin" href="">
                <div class="col-xs-5 light-padding">
                    <img class="center-block img-responsive" src="<?php echo CFS()->get('img'); ?>" alt="<?php the_title(); ?>">
                </div>
                <div class="col-xs-7 light-padding">
                    <a class="center-block text" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </div>
            </div>
            <hr>

            <?php 
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <div class="col-xs-12">
            <?php comment_form(
    array(
        'label_submit' => "Comentar", 
        'author' =>
        '<p class="comment-form-author"><label for="author">' . __( 'Nombre', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' /></p>',

        'email' =>
        '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' /></p>',

        'url' =>
        '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
        '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" /></p>', 
        'title_reply'       => __( 'Responder' ),
        'title_reply_to'    => __( 'Responder a %s' ),
        'cancel_reply_link' => __( 'Cancelar Respuesta' ),
    )); ?>
        </div>
        <?php endwhile; ?>
        <?php else : ?>
        <h2>pagina no encontrada</h2>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>