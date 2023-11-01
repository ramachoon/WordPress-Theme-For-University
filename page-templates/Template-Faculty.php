<?php /* Template Name: Template Faculty */ ?>
<?php 
    get_header();

    if (pll_current_language() == 'en') {
        $pageTitle = "Faculty";
        $Home = "Home";
        $categoryTitle = "About Us";
        $EmailText = "Email";
        $TelText = "Tel";
        $OfficeText = "Office";
    } else {
        $Home = "首頁";
        $categoryTitle = "關於我們";
        $pageTitle = "學院";
        $EmailText = "電子郵件";
        $TelText = "電話";
        $OfficeText = "辦公室";
    }
?>
<main>
    <section class="page-banner position-relative wow fadeInUp">
        <div class="inner">
            <div class="container">
                <h1 class="fs36 blueLight bold wow fadeInUp" title="Faculty"><?php echo $pageTitle; ?></h1>
            </div>
        </div>
        <div class="boximg"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="images"></div>
        <div class="bread">
            <div class="container">
                <a href="<?=home_url()?>" title="Home">
                <?php echo $Home; ?>
                </a>   
                <span>/</span>
                <?php
                   $categories = get_the_terms( get_the_ID(), 'category'); 
                   if ( ! empty( $categories ) ) {
                       foreach( $categories as $category ) {
                           echo '<a href="">' . esc_html( $category->name ) . '</a><span>/</span>';
                       }
                   }
                ?>
                <a href="" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            </div>
        </div>
    </section>
      
    <section class="index-block py-5 wow fadeInUp" >
       <div class="container">
           <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 left">
                    <h2 class="fs20 pc blueLight bold wow fadeInUp" title="About Us">
                    <?php echo $categoryTitle; ?>
                    </h2>
                    <h2 class="fs20 mobile blueLight bold wow fadeInUp" title="About Us">
                    <?php echo $categoryTitle; ?>
                    </h2>
                    <div class='htmleaf-container wow fadeInUp'>
                        <div class="menu-box htmleaf-content bgcolor-3  ">
                            <ul class="mtree bubba">         	        
                                <?php
                                if ( is_active_sidebar( 'about-sidebar' ) ) : ?>
                                    <?php dynamic_sidebar( 'about-sidebar' ); ?>
                                <?php endif; ?>
                            </ul>
                            
                        </div>
                    </div>
               </div>
               <div class="col-md-10 col-sm-12 col-xs-12 right">
                    <div class="pl-3">
                        <div class="Staff wow fadeInUp">
                            <div class="navs">
                                <div class="nav nav-tabs fs18  bold">
                                    <button role="button"  data-bs-toggle="tab" data-bs-target="#tab1" type="button" class="active">
                                       <a title="Academic STAFF">
                                       <?php
                                        if (pll_current_language() == 'en') {
                                            echo "Academic STAFF";
                                        } else {
                                            echo "學術人員";
                                        }
                                        ?>
                                       </a>
                                    </button>
                                    <button role="button"  data-bs-toggle="tab" data-bs-target="#tab2" type="button" >
                                      <a title="RESEARCH PROFESSOR/ ADJUNCT / HONORARY">
                                        
                                        <?php
                                        if (pll_current_language() == 'en') {
                                            echo "RESEARCH PROFESSOR/ ADJUNCT / HONORARY";
                                        } else {
                                            echo "研究教授 / 兼任 / 榮譽";
                                        }
                                        ?>
                                    </a>
                                    </button>
                                    <button role="button" data-bs-toggle="tab" data-bs-target="#tab3" type="button">
                                        <a >
                                        <?php
                                        if (pll_current_language() == 'en') {
                                            echo "Part-time Academic Staff";
                                        } else {
                                            echo "兼職學術人員";
                                        }
                                        ?>
                                        </a>
                                    </button>
                                </div>
                            </div> 
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="tab1">
                                    <div class="row">
                                        <?php
                                        $args = array(
                                            'post_type' => 'faculty_staff',
                                            // 'lang' => 'eh', // Include all languages
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'category',
                                                    'field'    => 'slug',
                                                    'terms'    => 'academic',
                                                ),
                                            ),
                                            'posts_per_page' => -1,  // To display all posts of this type and category
                                        );
                                        $query = new WP_Query( $args );
                                        
                                        if ( $query->have_posts() ) :
                                            while ( $query->have_posts() ) : $query->the_post();
                                        ?>
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <a href="<?php the_permalink(); ?>" class="border">
                                                <div class="left">
                                                    <h4 class="fs20 blueLight"><?php echo get_field( 'name' ); ?><br/><?php echo get_field( 'chinese_name' ); ?></h4>
                                                    <p><?php echo get_field( 'position' ); ?></p>
                                                    <div class="con fs18">
                                                        <ul>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/mail.svg" alt="icos"><span><?php echo $EmailText; ?>: <?php echo get_field( 'email' ); ?></span></li>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/tel.svg" alt="icos"><span><?php echo $TelText; ?>: <?php echo get_field( 'phone' ); ?></span></li>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/door.svg" alt="icos"><span><?php echo $OfficeText; ?>: <?php echo get_field( 'office' ); ?></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="boximg"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>"></div>
                                            </a>
                                        </div>
                                        <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                        ?>


                                     
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                <div class="row">
                                        <?php
                                        $args = array(
                                            'post_type' => 'faculty_staff',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'category',
                                                    'field'    => 'slug',
                                                    'terms'    => 'professor',
                                                ),
                                            ),
                                            'posts_per_page' => -1,  // To display all posts of this type and category
                                        );
                                        $query = new WP_Query( $args );
                                        
                                        if ( $query->have_posts() ) :
                                            while ( $query->have_posts() ) : $query->the_post();
                                        ?>
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <a href="<?php the_permalink(); ?>" class="border">
                                                <div class="left">
                                                    <h4 class="fs20 blueLight"><?php echo get_field( 'name' ); ?><br/><?php echo get_field( 'chinese_name' ); ?></h4>
                                                    <p><?php echo get_field( 'position' ); ?></p>
                                                    <div class="con fs18">
                                                        <ul>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/mail.svg" alt="icos"><span><?php echo $EmailText; ?>: <?php echo get_field( 'email' ); ?></span></li>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/tel.svg" alt="icos"><span><?php echo $TelText; ?>: <?php echo get_field( 'phone' ); ?></span></li>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/door.svg" alt="icos"><span><?php echo $OfficeText; ?>: <?php echo get_field( 'office' ); ?></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="boximg"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>"></div>
                                            </a>
                                        </div>
                                        <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                <div class="row">
                                        <?php
                                        $args = array(
                                            'post_type' => 'faculty_staff',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'category',
                                                    'field'    => 'slug',
                                                    'terms'    => 'part-time-academic',
                                                ),
                                            ),
                                            'posts_per_page' => -1,  // To display all posts of this type and category
                                        );
                                        $query = new WP_Query( $args );
                                        
                                        if ( $query->have_posts() ) :
                                            while ( $query->have_posts() ) : $query->the_post();
                                        ?>
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <a href="<?php the_permalink(); ?>" class="border">
                                                <div class="left">
                                                    <h4 class="fs20 blueLight"><?php echo get_field( 'name' ); ?><br/><?php echo get_field( 'chinese_name' ); ?></h4>
                                                    <p><?php echo get_field( 'position' ); ?></p>
                                                    <div class="con fs18">
                                                        <ul>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/mail.svg" alt="icos"><span><?php echo $EmailText; ?>: <?php echo get_field( 'email' ); ?></span></li>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/tel.svg" alt="icos"><span><?php echo $TelText; ?>: <?php echo get_field( 'phone' ); ?></span></li>
                                                            <li><img src="<?=get_template_directory_uri()?>/static/images/door.svg" alt="icos"><span><?php echo $OfficeText; ?>: <?php echo get_field( 'office' ); ?></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="boximg"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>"></div>
                                            </a>
                                        </div>
                                        <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
    </section>
</main>

<?php
    get_footer();
?>