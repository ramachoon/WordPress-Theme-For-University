<?php /* Template Name: Home */ ?>
<?php get_header(); ?>
<style>
    body::before{display:none;}
</style>
<main>
    <section class="banner index-banner position-relative wow fadeInUp">
        <div class="container">
                         <div class="row">
                            <?php
                            while ( have_posts() ) {
                                the_post();
                                the_content();
                            }
                            ?>
                         </div>
        </div>
  
        

        <div class="slideHeader__scrolldown">
            <p class="slideHeader__scrolldown__text">SCROLL</p>
            <span class="slideHeader__scrolldown__line"></span>
        </div>
    </section>


  
    <section class="second-block py-5 wow fadeInUp" >
       <div class="container">
           <div class="big-title d-flex align-items-center justify-content-between">
               <div class="title fs40 wow bounceInLeft" title="NEWS">Programmes</div>
               <b class="fs100 bold wow bounceInRight">Programmes</b>
            </div>
           <div class="row mt-5">
               <div class='col-md-3 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="<?=home_url()?>/bmsim-cover">
                        <div class="boximg">
                           <img src="<?=get_template_directory_uri()?>/static/images/p1.jpg" alt="pic">
                        </div>
                        <div class="con fs20">
                            <p>Bachelor of Science (Honours) in Actuarial Studies and Insurance </p>
                        </div>
                    </a>
               </div>
               <div class='col-md-3 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="<?=home_url()?>/bba-scm-cover/">
                        <div class="boximg">
                           <img src="<?=get_template_directory_uri()?>/static/images/p2.jpg" alt="pic">
                        </div>
                        <div class="con fs20">
                            <p>Bachelor of Science (Honours) in Data Science and Business Intelligence </p>
                        </div>
                    </a>
               </div>
               <div class='col-md-3 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="<?=home_url()?>/msc-gscm-cover/">
                        <div class="boximg">
                           <img src="<?=get_template_directory_uri()?>/static/images/p3.jpg" alt="pic">
                        </div>
                        <div class="con fs20">
                            <p>Executive Master of Science in Insurance</p>
                        </div>
                    </a>
               </div>
               <div class='col-md-3 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="">
                        <div class="boximg">
                           <img src="<?=get_template_directory_uri()?>/static/images/p4.jpg" alt="pic">
                        </div>
                        <div class="con fs20">
                            <p>"One more programme"</p>
                        </div>
                    </a>
               </div>
              
           </div>

       </div>
          


            
    </section>
    <section class="third-block  mt-lg-4 py-5 wow fadeInUp" >
       <div class="container">
           <div class="big-title d-flex align-items-center justify-content-between">
               <div class="title fs40 wow bounceInLeft" title="NEWS">NEWS</div>
               <b class="fs100 bold wow bounceInRight">NEWS</b>
            </div>
           <div class="row mt-5">

            <?php
                $args = array(
                    'post_type' => 'post',
                    'category_name' =>'news',
                    'posts_per_page' => 3,
                );
                
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
            ?>
                <div class='col-md-4 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="<?php the_permalink(); ?>">
                        <!-- <div class="date">
                               <strong class="day fs42">12</strong>
                               <em class="year">Jan, 2023</em>
                        </div> -->
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
               </div>
            <?php
                }
                }
            ?>
           </div>
           <a href="<?=home_url()?>/news" class="more-n mt-5 mb-4 fs20 wow fadeInUp">More News</a>

       </div>
          


            
    </section>
    <section class="four-block  mt-lg-4 py-5 wow fadeInUp" >
       <div class="container">
           <div class="big-title d-flex align-items-center justify-content-between">
               <div class="title fs40 wow bounceInLeft" title="Department Highlights">Department Highlights</div>
               <b class="fs100 bold wow bounceInRight">Highlights</b>
            </div>
    
           <div class="row mt-5">
               <div class='col-md-4 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="<?=home_url()?>/why-choose-our-programmes/">
                        <div class="boximg">
                           <img src="<?=get_template_directory_uri()?>/static/images/f1.jpg" alt="pic">
                       
                        </div>
                        <h3 class="fs28">Teaching & Learning</h3>
                    </a>
               </div>
               <div class='col-md-4 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="<?=home_url()?>/admission">
                        <div class="boximg">
                           <img src="<?=get_template_directory_uri()?>/static/images/f2.jpg" alt="pic">
                       
                        </div>
                        <h3 class="fs28">Admission Information</h3>
                    </a>
               </div>
               <div class='col-md-4 col-sm-12 col-xs-12 mt-3 wow fadeInUp'>
                   <a href="<?=home_url()?>/research-profile/">
                        <div class="boximg">
                           <img src="<?=get_template_directory_uri()?>/static/images/f3.jpg" alt="pic">
                       
                        </div>
                        <h3 class="fs28">Research</h3>
                    </a>
               </div>
              
           </div>

       </div>
            
    </section>
 
</main>
<?php get_footer(); ?>


</body>
</html>