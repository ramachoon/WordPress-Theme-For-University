<?php /* Template Name: MSc-GSCM-Graduate-Sharing */ ?>
<?php 
    $year = date('Y');
    if(isset($_SESSION["year"])) {
        $year = intval($_SESSION["year"]);
    }
 ?>
<main>
    <section class="page-banner position-relative">
        <div class="inner">
            <div class="container">
                <h1 class="fs36 blueLight bold wow fadeInUp" title="Graduate Sharing">Graduate Sharing</h1>
              
                
            </div>
        </div>
        <div class="boximg"><img src="<?=get_template_directory_uri()?>/static/images/b6.jpg" alt="images"></div>
    </section>
    <div class="bread">
            <div class="container">
                     <a href="<?=home_url(); ?>" title="Home">Home</a>   
                     <span>/</span>
                     <a href="" title="Programmes">Programmes</a>
                     <span>/</span>
                     <a href="../MSc-GSCM-Cover/" title="Master of Science in Global Supply Chain Management (MSc-GSCM) ">Master of Science in Global Supply Chain Management (MSc-GSCM)</a>
                     <span>/</span>
                     <a href="" title="Graduate Sharing">Graduate Sharing</a>
            </div>
    </div>



    <section class="index-block wow fadeInUp" >
       <div class="container">
           <div class="row">
               <div class="col-md-2 col-sm-12 col-xs-12 left">
                   <div class="mt-5">
                    <h2 class="fs20 pc blueLight bold wow fadeInUp" title="Master of Science in Global Supply Chain Management (MSc-GSCM)">Master of Science in Global Supply Chain Management (MSc-GSCM)</h2>
                    <h2 class="fs20 mobile blueLight bold wow fadeInUp" title="Master of Science in Global Supply Chain Management (MSc-GSCM)">Master of Science in Global Supply Chain Management (MSc-GSCM)</h2>
                    <div class="menu-box mt-3 wow fadeInUp">
                    <ul>         	        
                            <li><a  href="../msc-gscm-programme-overview/"  title="Programme Overview ">Programme Overview </a> </li>        
                            <li><a  href="../MSc-GSCM-Academic-Structure/" title="Academic Structure">Academic Structure</a> </li>  
                            <li><a  href="../MSc-GSCM-Career-Prospects/"   title="Career Prospects" >Career Prospects</a> </li>  
                            <li><a  href="../MSc-GSCM-Scholarships-FinancialAid/" title="Scholarship & Financial Aids">Scholarship & Financial Aids</a> </li>        
                            <li><a  href="../MSc-GSCM-Graduate-Sharing/" class="active"   title="Graduate Sharing">Graduate Sharing</a> </li>  
                            <li><a  href="../MSc-GSCM-Admission/"  title="Admission" >Admission</a> </li>  
                                
                        </ul>
                    </div>
                  </div>
               </div>
               <div class="col-md-10 col-sm-12 col-xs-12 right">
                    <div class="pl-3 mt-5 mb-5">
                        <div class="title fs28 white  wow fadeInUp" title="Graduate Sharing">Graduate Sharing</div>
                        <div class="txt fs18  wow fadeInUp">
                            <form role="form">
                                <div class="form-group">
                                    <label for="name">YEAR</label>
                                    <div class="relative">
                                        <select class="form-control" id="graduate_year_selection" lang="en">
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="result">
                                <h2 class="fs28 bold blueLight mt-5">Class of <?php echo $year; ?></h2>
                                <div class="IOlist mt-3">
                                    <div class="row">
                                    <?php
                                    $args = array(
                                        'post_type' => 'post',
                                        'category_name' =>'msc-gscm-career',
                                        'posts_per_page' => 6,
                                        'meta_query' => array(
                                            array(
                                                'key' => 'graduate_year', // ACF meta key
                                                'value' => $year, // Value to filter by
                                                'compare' => '=', // Comparison operator (default is '=')
                                            ),
                                        ),
                                        'paged' => get_query_var('paged') // Add this line to update the page number
                                    );
                                    
                                    $query = new WP_Query($args);

                                    if ($query->have_posts()) {
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                ?>
                                    <div class="col-md-6  col-sm-12 col-xs-12 mb-3 wow fadeInUp">
                                        <a href="javascript:;">
                                            <div class="imgs"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="pic"></div>
                                            <div class="right">
                                                <h4 class="fs20 blueText bold"><?php the_title(); ?></h4>
                                                <p class="fs18">Class of <?php echo get_field( 'graduate_year' ); ?> <?php echo get_field( 'degree' ); ?> <?php echo get_field( 'expertise' ); ?></p>
                                            </div>
                                        </a>
                                        <div class="pup">
                                            <div class="pupback"></div>
                                            <div class="container">
                                                <div class="conbox">
                                                    <div class="close"></div> 
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                            <div class='pic'><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="pic"></div>
                                                        </div>
                                                        <div class="col-md-8 col-sm-12 col-xs-12 mb-3">
                                                            <div class="fs32 bold blueText"><?php the_title(); ?></div>
                                                            <div class="txt fs18 mt-2">
                                                                <p><?php echo get_field( 'expertise' ); ?><br/>Class of <?php echo get_field( 'graduate_year' ); ?><br/><?php echo get_field( 'degree' ); ?></p>
                                                                <?php the_content(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="pageinfo">
                                    <?php
                                        $big = 999999999; // Set a large number
                                        // Define the pagination arguments
                                        $args = array(
                                            'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                            'format'     => '?paged=%#%',
                                            'mid_size'   => 2,
                                            'prev_next'  => True,
                                            'prev_text'  => __('Previous Page'),
                                            'next_text'  => __('Next Page'),
                                            'current'    => max( 1, get_query_var('paged') ),
                                            'total'      => $query->max_num_pages,
                                            'type'       => 'list'
                                        );

                                        $pages = paginate_links($args);

                                        // Display the pagination
                                        echo paginate_links( $args );
                                    ?>
                                    </div>
                                    <?php
                                    wp_reset_postdata();
                                }
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