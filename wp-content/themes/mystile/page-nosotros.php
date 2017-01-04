<?php get_header(); ?>
<div class="wrapper nosotros">
    <div class="banner"></div>
    <div class="container text-center spacing">
        <h1 class="blue header"><?php echo CFS() -> get( 'nosotros_title' ); ?></h1>
        <p class="text">
            <?php echo CFS() -> get( 'nosotros_text' ); ?>
        </p>
        <?php
        $competencesArray = CFS() -> get( 'competence_array' );
        $arrayLength = count( $competencesArray );
        $array_counter = 0;
        $row_counter = 1;
        foreach( $competencesArray as $competence ) {
        
            if( $row_counter % 3 == 0 ) {
        ?>
        </div>
        <?php
            }
        
            if( $array_counter == 0 || $row_counter % 3 == 0 ) {
        ?>
        <div class="row">
        <?php
            }
        ?>
            <div class="col-sm-4">
                <img src="<?php echo $competence['competence_img']; ?>" alt="Barato">
                <h3 class="blue"><?php echo $competence['competence_title']; ?></h3>
                <p class="text"><?php echo $competence['competence_desc']; ?></p>
            </div>
        <?php
            $array_counter++;
            
            if( $array_counter == $arrayLength ) {
        ?>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php get_footer(); ?>