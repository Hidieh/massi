<?php
/* Lisää tapahtuma -sivun layout */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

            <main class="site-main" id="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'loop-templates/content', 'page' ); ?>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tulo" data-toggle="tab">Tulo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#meno" data-toggle="tab">Meno</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#saasto" data-toggle="tab">Säästöön</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tulo" role="tabpanel">
                            <h2>Lisää tulo</h2>
                            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tulo_nimi">Tulon nimi</label>
                                        <input type="text" class="form-control" id="tulo_nimi" aria-describedby="tuloNimi" placeholder="Tulon nimi">
                                    </div>
                                    <div class="tulo_pvm">
                                        <label for="exampleInputEmail1">Tulon päivämäärä</label>
                                        <input type="date" class="form-control" id="tulo_pvm" aria-describedby="tuloPvm" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tulo_maara">Tulon määrä</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="tulo_maara" aria-describedby="tuloMaara" placeholder="0.00" step="0.01" min="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="tuloMaara">€</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tulo_kategoria">Tulon kategoria</label>
                                    <select class="form-control" id="tulo_kategoria">
                                        <option>Palkka</option>
                                        <option>Tuki</option>
                                        <option>Muu tulo</option>
                                    </select>
                                </div>

                                <input type="hidden" name="action" value="lisaa_tulo">
                                <button class="btn btn-secondary" type="reset">Keskeytä</button>
                                <button class="btn btn-primary" type="submit">Lisää tulo</button>
                            </form>

                        </div>
                        <div class="tab-pane" id="meno" role="tabpanel">
                            <h2>Lisää meno</h2>
                            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="meno_nimi">Menon nimi</label>
                                        <input type="text" class="form-control" id="meno_nimi" aria-describedby="menoNimi" placeholder="Menon nimi">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meno_pvm">Menon päivämäärä</label>
                                        <input type="date" class="form-control" id="meno_pvm" aria-describedby="menoPvm" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="meno_maara">Menon määrä</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="meno_maara" aria-describedby="menoMaara" placeholder="0.00" step="0.01" min="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="tuloMaara">€</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="meno_kategoria">Menon kategoria</label>
                                    <select class="form-control" id="meno_kategoria">
                                        <option>Asuminen</option>
                                        <option>Ruoka</option>
                                        <option>Vakuutukset</option>
                                    </select>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="onko_lasku">
                                    <label class="form-check-label" for="onko_lasku">
                                        Onko lasku?
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="onko_lasku_maksettu">
                                    <label class="form-check-label" for="onko_lasku_maksettu">
                                        Onko jo maksettu?
                                    </label>
                                </div>

                                <input type="hidden" name="action" value="lisaa_tulo">
                                <button class="btn btn-secondary" type="reset">Keskeytä</button>
                                <button class="btn btn-primary" type="submit">Lisää meno</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="saasto" role="tabpanel">

                        </div>
                    </div>



                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check -->
            <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
