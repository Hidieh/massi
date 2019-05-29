<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

acf_form_head();
get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

            <ma class="site-main" id="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'loop-templates/content', 'page' ); ?>

                        <h2>Tuloslaskelman rivit</h2>
                        <?php

                        $query = new WP_Query(array(
                            'post_type' => 'suunnitelma',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        ));
                        ?>
                        <table width="100%">
                            <thead>
                            <tr>
                                <th>Kategoria</th>
                                <th>Nimi</th>
                                <th>Summa</th>
                                <th>Päivämäärä</th>
                                <th>Toistuvuus</th>
                            </tr>
                            </thead>
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            $post_id = get_the_ID();

                            if (class_exists('ACFAllObj')) {
                                $kategoria = ACFAllObj::get('kategoria', $post_id);
                                $nimi = ACFAllObj::get('nimi', $post_id);
                                $summa = number_format(ACFAllObj::get('summa', $post_id), 2, '.', '');
                                $paivamaara_raaka = DateTime::createFromFormat('d/m/Y', ACFAllObj::get('paivamaara', $post_id));
                                $paivamaara = $paivamaara_raaka->format('d.m.Y');
                                $toistuvuus = ACFAllObj::get('toistuvuus', $post_id);
                            } else {
                                $kategoria = get_field('kategoria', $post_id);
                                $nimi = get_field('nimi', $post_id);
                                $summa = number_format(get_field('summa', $post_id), 2, '.', '');
                                $paivamaara_raaka = DateTime::createFromFormat('d/m/Y', get_field('paivamaara', $post_id));
                                $paivamaara = $paivamaara_raaka->format('d.m.Y');
                                $toistuvuus = get_field('toistuvuus', $post_id);
                            }

                            echo '<tr>';
                            echo '<td>' . $kategoria . '</td>';
                            echo '<td>' . $nimi . '</td>';
                            echo '<td>' . $summa . '€</td>';
                            echo '<td>' . $paivamaara . '</td>';
                            echo '<td>' . $toistuvuus . '</td>';
                            echo '</tr>';
                        }

                        wp_reset_query();
                        ?>
                        </table>

                        <h2 class="pt-3">Tapahtumarivit</h2>
                        <?php

                        $query = new WP_Query(array(
                            'post_type' => 'tapahtuma',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        ));
                        ?>


                        <table width="100%">
                            <thead>
                            <tr>
                                <th>Kategoria</th>
                                <th>Nimi</th>
                                <th>Summa</th>
                                <th>Päivämäärä</th>
                            </tr>
                            </thead>
                            <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                $post_id = get_the_ID();

                                if (class_exists('ACFAllObj')) {
                                    $kategoria = ACFAllObj::get('kategoria', $post_id);
                                    $nimi = ACFAllObj::get('nimi', $post_id);
                                    $summa = number_format(ACFAllObj::get('summa', $post_id), 2, '.', '');
                                    $paivamaara_raaka = DateTime::createFromFormat('d/m/Y', ACFAllObj::get('paivamaara', $post_id));
                                    $paivamaara = $paivamaara_raaka->format('d.m.Y');
                                } else {
                                    $kategoria = get_field('kategoria', $post_id);
                                    $nimi = get_field('nimi', $post_id);
                                    $summa = number_format(get_field('summa', $post_id), 2, '.', '');
                                    $paivamaara_raaka = DateTime::createFromFormat('d/m/Y', get_field('paivamaara', $post_id));
                                    $paivamaara = $paivamaara_raaka->format('d.m.Y');
                                }

                                echo '<tr>';
                                echo '<td>' . $kategoria . '</td>';
                                echo '<td>' . $nimi . '</td>';
                                echo '<td>' . $summa . '€</td>';
                                echo '<td>' . $paivamaara . '</td>';
                                echo '</tr>';
                            }

                            wp_reset_query();
                            ?>
                        </table>

                    <hr>

                    <h2>Lisää suunnitelmarivi tuloslaskelmaan</h2>

                    <?php acf_form(array(
                        'post_id'		=> 'new_post',
                        'new_post'		=> array(
                            'post_type'		=> 'suunnitelma',
                            'post_status'		=> 'publish'
                        ),
                        'submit_value'		=> 'Lisää rivi tuloslaskelmaan'
                    )); ?>


                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check -->
            <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
