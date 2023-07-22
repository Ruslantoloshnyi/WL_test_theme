<?php get_header(); ?>

<?php
$args = array(
    'post_type'      => 'car',
    'posts_per_page' => 10,
    'order'          => 'DESC',
    'orderby'        => 'date',
);
$query = new WP_Query($args);
?>

<section id="front-content">
    <div class="container">

        <?php
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                $car_color = sanitize_hex_color(get_post_meta(get_the_ID(), 'car_color', true));
                $car_fuel = get_post_meta(get_the_ID(), 'car_fuel', true);
                $car_power = get_post_meta(get_the_ID(), 'car_power', true);
                $car_price = get_post_meta(get_the_ID(), 'car_price', true);

                $country_terms = get_the_terms(get_the_ID(), 'country');
                $mark_terms = get_the_terms(get_the_ID(), 'mark');
        ?>
                <div class="card">
                    <div class="card__image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="card__heading">
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
                    <div class="card__discription">
                        <div>
                            <div>Цена</div>
                            <div class="card__discription__value"><span><?php echo $car_price; ?></span></div>
                        </div>
                        <div>
                            <div>Цвет</div>
                            <div class="card__discription__value car_color" style="background-color: <?php echo $car_color; ?>;"></div>
                        </div>
                    </div>
                    <div class="card__discription">
                        <div>
                            <div>Топливо</div>
                            <div class="card__discription__value"><?php echo $car_fuel; ?></div>
                        </div>
                        <div>
                            <div>Мощность</div>
                            <div class="card__discription__value"><?php echo $car_power; ?> л.с.</div>
                        </div>
                    </div>

                    <a href="<?php echo get_permalink(); ?>">Просмотр</a>
                </div>


        <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </div>
</section>

<?php get_footer(); ?>