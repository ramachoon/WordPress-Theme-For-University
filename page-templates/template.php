<?php /* Template Name: Template */ ?>
<?php 
    get_header();
?>

 
<main>
    <section class="page-banner position-relative">
        <div class="inner">
            <div class="container">
                <h1 class="fs36 blueLight bold wow fadeInUp" title="<?php the_title(); ?>"><?php the_title(); ?></h1>
                
            </div>
        </div>
        <div class="boximg"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="images"></div>
    </section>
    <div class="bread">
        <div class="container">
            <a href="<?= home_url() ?>" title="Home">
            <?php
            if (pll_current_language() == 'en') {
                echo "Home";
            } else {
                echo "首頁";
            }
            ?>

            </a>
            <span>/</span>
            <?php
            $categories = get_the_terms(get_the_ID(), 'category');
            if (!empty($categories)) {
                $category_hierarchy = array();
                foreach ($categories as $category) {
                    if ($category->parent != 0) {
                        $parent_category = get_term($category->parent, 'category');
                        echo '<a href="">' . esc_html($parent_category->name) . '</a><span>/</span>';
                    }
                    echo '<a href="">' . esc_html($category->name) . '</a><span>/</span>';
                }
            }
            ?>
            <a href="" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </div>
    </div>
  
    <section class="index-block wow fadeInUp" >
       <div class="container">
           <div class="row">
               <div class="col-md-2 col-sm-12 col-xs-12 left">
                   <div class="mt-5">
                    <?php
                        $categories = get_the_terms( get_the_ID(), 'category'); 
                        if ( ! empty( $categories ) ) {
                            foreach( $categories as $category ) {
                                echo '<h2 class="fs20 pc blueLight bold wow fadeInUp" title="' . esc_html( $category->name ) . '">' . esc_html( $category->name ) . '</h2>';
                                echo '<h2 class="fs20 mobile blueLight bold wow fadeInUp" title="' . esc_html( $category->name ) . '">' . esc_html( $category->name ) . '</h2>';
                            }
                        }
                    ?>

                    <div class="menu-box mt-3 wow fadeInUp">
                            <ul class="mtree bubba">
                                <?php
                                $categories = get_the_category();
                                $category = !empty($categories) ? $categories[0]->slug : '';
                                // Check the category and display specific content accordingly
                                /*if ($category === 'about-us') {
                                    if ( is_active_sidebar( 'about-sidebar' ) ) :
                                        dynamic_sidebar( 'about-sidebar' );
                                    endif; 
                                } elseif ($category === 'msc-gscm') {
                                    if ( is_active_sidebar( 'msc-gscm-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'msc-gscm-sidebar' ); ?>
                                    <?php endif;
                                } elseif ($category === 'bba-scm') {
                                    if ( is_active_sidebar( 'bba-scm-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'bba-scm-sidebar' ); ?>
                                    <?php endif; 
                                } elseif ($category === 'bmsim') {
                                    if ( is_active_sidebar( 'bmsim-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'bmsim-sidebar' ); ?>
                                    <?php endif; 
                                } elseif ($category === 'teaching-learning') {
                                    if ( is_active_sidebar( 'teaching-learning-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'teaching-learning-sidebar' ); ?>
                                    <?php endif;
                                } elseif ($category === 'research') {
                                    if ( is_active_sidebar( 'research-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'research-sidebar' ); ?>
                                    <?php endif; 
                                } elseif ($category === 'news-and-events') {
                                    if ( is_active_sidebar( 'news-events-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'news-events-sidebar' ); ?>
                                    <?php endif; 
                                } elseif (basename(get_permalink()) == 'admission') {
                                    if ( is_active_sidebar( 'admission-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'admission-sidebar' ); ?>
                                    <?php endif; 
                                }*/
                                if (strpos($category, 'about-us') !== FALSE ) {
                                    if ( is_active_sidebar( 'about-sidebar' ) ) :
                                        dynamic_sidebar( 'about-sidebar' );
                                    endif; 
                                } elseif (strpos($category,'msc-gscm')!==FALSE) {
                                    if ( is_active_sidebar( 'msc-gscm-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'msc-gscm-sidebar' ); ?>
                                    <?php endif;
                                } elseif (strpos($category, 'bba-scm') !== FALSE ) {
                                    if ( is_active_sidebar( 'bba-scm-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'bba-scm-sidebar' ); ?>
                                    <?php endif; 
                                } elseif (strpos($category, 'bmsim') !== FALSE ) {
                                    if ( is_active_sidebar( 'bmsim-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'bmsim-sidebar' ); ?>
                                    <?php endif; 
                                } elseif (strpos($category, 'teaching-learning') !== FALSE ) {
                                    if ( is_active_sidebar( 'teaching-learning-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'teaching-learning-sidebar' ); ?>
                                    <?php endif;
                                } elseif (strpos($category, 'research') !== FALSE ) {
                                    if ( is_active_sidebar( 'research-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'research-sidebar' ); ?>
                                    <?php endif; 
                                } elseif (strpos($category, 'news-and-events') !== FALSE ) {
                                    if ( is_active_sidebar( 'news-events-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'news-events-sidebar' ); ?>
                                    <?php endif; 
                                } elseif (strpos(basename(get_permalink()), 'admission') !== FALSE ) {
                                    if ( is_active_sidebar( 'admission-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'admission-sidebar' ); ?>
                                    <?php endif; 
                                }
                                ?>
                            </ul>
                    </div>
                  </div>
               </div>
               <div class="col-md-10 col-sm-12 col-xs-12 right template-hanhseng">
                    <div class="pl-3 mb-5">
                        <?php the_content(); ?>
                    </div>
               </div>
           </div>

       </div>
    </section>

</main>


<?php
    get_footer();
?>