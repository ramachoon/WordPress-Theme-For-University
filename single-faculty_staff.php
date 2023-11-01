<?php get_header();  ?>
<main>
<?php
    if (pll_current_language() == 'en') {
        $pageTitle = "Faculty";
        $categoryTitle = "About Us";
        $EmailText = "Email";
        $TelText = "Tel";
        $OfficeText = "Office";
        $BooksText = "Books";
        $SelectedPubText = "Selected Publications";
    } else {
        $categoryTitle = "學術人員";
        $pageTitle = " 關於我們";
        $EmailText = "電子郵件";
        $TelText = "電話";
        $OfficeText = "辦公室";
        $BooksText = "圖書";
        $SelectedPubText = "精選出版品";
    }
while ( have_posts() ) :
    the_post();
?>
    <section class="page-banner position-relative wow fadeInUp">
        <div class="inner">
            <div class="container">
                <h1 class="fs36 blueText bold wow fadeInUp" title="Faculty"><?php echo $pageTitle; ?></h1>

            </div>
        </div>
        <div class="boximg"><img src="<?=get_template_directory_uri()?>/static/images/b1.jpg" alt="images"></div>
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
            <a href="" title="<?php the_title(); ?>"><?=get_field( 'name' ); ?></a>
        </div>
    </div>
    </section>

  
    <section class="index-block py-5 wow fadeInUp" >
       <div class="container">
           <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 left">
                    <h2 class="fs20 pc blueText bold wow fadeInUp" title="About Us"><?php echo $categoryTitle; ?></h2>
                    <h2 class="fs20 mobile blueText bold wow fadeInUp" title="About Us"><?php echo $categoryTitle; ?></h2>
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
                
                    <div class="pl-3 mt-3">
                        <div class="txt">
                            

                            <div class="Academic mb-3 wow fadeInUp">
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-12 col-xs-12 mt-3">
                                            <div class="ten">
                                                <div class="imgs"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="images"></div>
                                                <div class="right fs18">
                                                    <h4 class="fs20 blueLight bold"><?php echo get_field( 'name' ); ?><br/><?php echo get_field( 'chinese_name' ); ?></h4>
                                                    <dl>
                                                        <dd><img src="<?=get_template_directory_uri()?>/static/images/mail.svg" alt="icos"><span><?php echo $EmailText; ?>: <?php echo get_field( 'email' ); ?></span></dd>
                                                        <dd><img src="<?=get_template_directory_uri()?>/static/images/tel.svg" alt="icos"><span><?php echo $TelText; ?>: <?php echo get_field( 'phone' ); ?></span></dd>
                                                        <dd><img src="<?=get_template_directory_uri()?>/static/images/door.svg" alt="icos"><span><?php echo $OfficeText; ?>: <?php echo get_field( 'office' ); ?></span></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <p><?php echo get_field( 'certification' ); ?></p>
                                            <p><?php echo get_field( 'position' ); ?></p>
                                                        

                                        </div>
                                        <div class="col-md-7 col-sm-12 col-xs-12 mt-3">
                                            <div class="txt fs18">
                                                <p>&nbsp;&nbsp;&nbsp;</p>
                                                <p>&nbsp;&nbsp;&nbsp;</p>
                                                <p><?php echo get_field( 'bio' ); ?></p>
                                                <p>&nbsp;&nbsp;&nbsp;</p>
                                                <p>&nbsp;&nbsp;&nbsp;</p>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>
                                <?=the_content(); ?>
                        
                            </div>

                        </div>

                    </div>
               </div>
           </div>

       </div>
          


            
    </section>

   
 


<?php
endwhile; 
?>

</main>
<?php get_footer();  ?>


</body>
</html>