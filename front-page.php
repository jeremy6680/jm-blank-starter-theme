<?php
get_header();
?>

    <?php
    while(have_posts()) : the_post();
        ?>

            <?php the_title('<h1>', '</h1>'); ?>

            <?php
            the_content();
            ?>

        <?php
    endwhile; // End of the loop.
    ?>

<?php
get_footer();