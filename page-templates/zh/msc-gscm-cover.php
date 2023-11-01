 
<main>

    <?php the_content(); ?>

  
    <section class="first-block py-5 wow fadeInUp" >
       <div class="container">
            <div class="mneubar">
                <div class="row justify-content-between">
                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3 wow fadeInUp">
                        <a href="../msc-gscm-programme-overview-zh/">
                            <img src="<?=get_template_directory_uri()?>/static/images/i7.svg" alt="Programme Overview">
                            <h3 class="fs20 text-center bold blueText">課程概述</h3>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3 wow fadeInUp">
                        <a href="../MSc-GSCM-Academic-Structure-zh/">
                            <img src="<?=get_template_directory_uri()?>/static/images/i8.svg" alt="Academic Structure"> 
                            <h3 class="fs20 text-center bold blueText">學術結構</h3>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3 wow fadeInUp">
                        <a href="../MSc-GSCM-Career-Prospects-zh/">
                            <img src="<?=get_template_directory_uri()?>/static/images/i9.svg" alt="Career Prospects">
                            <h3 class="fs20 text-center bold blueText">職業前景</h3>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3 wow fadeInUp">
                        <a href="../MSc-GSCM-Scholarships-FinancialAid-zh/">
                            <img src="<?=get_template_directory_uri()?>/static/images/i10.svg" alt="Scholarship & Financial Aids">
                            <h3 class="fs20 text-center bold blueText">獎學金和經濟援助</h3>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3 wow fadeInUp">
                        <a href="../MSc-GSCM-Graduate-Sharing-zh/">
                            <img src="<?=get_template_directory_uri()?>/static/images/i11.svg" alt="Graduate Sharing">
                            <h3 class="fs20 text-center bold blueText">畢業生分享</h3>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3 wow fadeInUp">
                        <a href="../MSc-GSCM-Admission-zh/">
                            <img src="<?=get_template_directory_uri()?>/static/images/i12.svg" alt="Admission">
                            <h3 class="fs20 text-center bold blueText">入場</h3>
                        </a>
                    </div>
                </div>
            </div>
           <div class="row mt-4">
                <div class='col-md-7 col-sm-12 col-xs-12 mt-4 wow fadeInUp'>
                   <div class="title fs36 bold mb-3">影片</div> 
                   <div class="video">
                    <?php if(get_field("video_url") !== null) { ?>
                        <video playsinline="" autoplay="" loop="" muted=""><source src="<?php echo get_field("video_url"); ?>" type="video/mp4"></video>
                        <?php } else { ?>
                            <img src="<?=get_template_directory_uri()?>/static/images/video.jpg" alt="video">
                        <?php } ?>
                    </div>
               </div>
               <div class='col-md-5 col-sm-12 col-xs-12 mt-4 wow fadeInUp'>
                    <div class="title fs36 bold mb-3">最新消息</div> 
                    <?php
                        $args = array(
                            'post_type' => 'post',
                            'category_name' =>'news',
                            'posts_per_page' => 1
                        );
                        
                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                    ?>

                            <a href="<?php the_permalink(); ?>">
                                <div class="date">
                                    <strong class="day fs42"><?php echo get_the_date('d'); ?></strong>
                                    <em class="year"><?php echo get_the_date('M, Y'); ?></em>
                                </div>
                                <div class="boximg">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="pic">
                                
                                </div>
                                <div class="con fs20">
                                    <p><?php the_title(); ?></p>
                                </div>
                            </a>
                        <?php
                        }
                        wp_reset_postdata();
                    }
                ?>
               </div>
              
           </div>

       </div>
          


            
    </section>

 



 
</main>


