<?php get_header(); ?>

<?php
while (have_posts()) :
    the_post();

    $car_color = '';
    $car_fuel = '';
    $car_power = '';
    $car_price = '';

    // Check if metafields exist and getting their values
    if (get_post_meta(get_the_ID(), 'car_color', true)) {
        $car_color = sanitize_hex_color(get_post_meta(get_the_ID(), 'car_color', true));
    }

    if (get_post_meta(get_the_ID(), 'car_fuel', true)) {
        $car_fuel = get_post_meta(get_the_ID(), 'car_fuel', true);
    }

    if (get_post_meta(get_the_ID(), 'car_power', true)) {
        $car_power = get_post_meta(get_the_ID(), 'car_power', true);
    }

    if (get_post_meta(get_the_ID(), 'car_price', true)) {
        $car_price = get_post_meta(get_the_ID(), 'car_price', true);
    }

    $country_terms = get_the_terms(get_the_ID(), 'country');
    $mark_terms = get_the_terms(get_the_ID(), 'mark');
?>
    <article id="<?php the_ID(); ?>">
        <section id="single-content">
            <div class="container">
                <div class="single-card">
                    <div class="single-card__image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="single-card__heading">
                        <h5><?php the_title(); ?></h5>
                        <?php if ($mark_terms && !is_wp_error($mark_terms)) :
                            foreach ($mark_terms as $term) :
                        ?>
                                <h5><?php echo $term->name; ?></h5>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($country_terms && !is_wp_error($country_terms)) :
                            foreach ($country_terms as $term) :
                        ?>
                                <h5><?php echo $term->name; ?></h5>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="single-card-discription">
                        <div class="single-card-discription__content">
                            <div><?php the_content(); ?></div>
                        </div>
                        <div class="single-card-discription__meta">
                            <div>
                                <div>Цена</div>
                                <div class="single-card-discription__value"><span><?php echo $car_price ?> $</span></div>
                            </div>
                            <div>
                                <div>Цвет</div>
                                <div class="single-card-discription__value car_color" style="background-color: <?php echo $car_color; ?>;"></div>
                            </div>
                        </div>
                        <div class="single-card-discription__meta">
                            <div>
                                <div>Топливо</div>
                                <div class="single-card-discription__value"><?php echo $car_fuel; ?></div>
                            </div>
                            <div>
                                <div>Мощность</div>
                                <div class="single-card-discription__value"><?php echo $car_power; ?> л.с.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
<?php
endwhile;
?>

<?php get_footer(); ?>