<main>
    <section class="page-banner position-relative">
        <div class="inner">
            <div class="container">
                <h1 class="fs36 blueLight bold wow fadeInUp" title="News">最新消息</h1>
            </div>
        </div>
        <div class="boximg"><img src="<?php echo wp_upload_dir()['baseurl']; ?>/2023/09/b10.png" alt="images"></div>
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
                    <h2 class="fs20 pc blueLight bold wow fadeInUp" title="新聞與事件">新聞與事件</h2>
                    <h2 class="fs20 mobile blueLight bold wow fadeInUp" title="新聞與事件">新聞與事件</h2>
                    <div class="menu-box mt-3 wow fadeInUp">
                        <ul>         	        
                        <?php
                            if ( is_active_sidebar( 'news-events-sidebar' ) ) : ?>
                                <?php dynamic_sidebar( 'news-events-sidebar' ); ?>
                            <?php endif; 
                        ?>
                        </ul>
                    </div>
                </div>
               </div>
               <div class="col-md-10 col-sm-12 col-xs-12 right">
                    <div class="pl-3 mt-5 mb-5" style="border-radius:0">

                        <div class="article fs18">
                            <div class="arc-tit">
                                <div class="date">
                                    <strong class="day fs42"><?php echo get_the_date('d'); ?></strong>
                                    <em class="year"><?php echo get_the_date('M, Y'); ?></em>
                                </div>
                                <h2 class="fs40 bold"><?php the_title(); ?></h2>
                            </div>
                            <div class="con">
                                <?php echo the_content(); 
                                    // comment_form();
                                ?>
                            </div>
                            
                        </div>

                    </div>
               </div>
           </div>

       </div>
    
          


            
    </section>

 



 
</main>