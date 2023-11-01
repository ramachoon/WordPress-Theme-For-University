<footer>
    <div class="footer fs18">
        <div class="container">
            <div class="address">
                <?php
                    $categories = get_the_category();
                    $category = !empty($categories) ? $categories[0]->slug : '';
                    // Check the category and display specific content accordingly
                    $email = '';
                    $tel = '';
                    $isMGSc = false;
                    $wechat='';
                    $linkedin = '';
                    $facebook= '';
                    $linkedin = '';
                    if (strpos($category, 'msc-gscm') !== FALSE || strpos(basename(get_permalink()), 'msc-gscm-cover') !== FALSE) {
                        $isMGSc = true;

                        $args = array(
                            'post_type' => 'post',
                            'category_name' =>'footer',
                            'meta_query' => array(
                                array(
                                    'key' => 'footer_type', // ACF meta key
                                    'value' => 'MCs-GSCM', // Value to filter by
                                    'compare' => '=', // Comparison operator (default is '=')
                                ),
                            ),
                            'posts_per_page' => 1,
                        );
                        
                        $query = new WP_Query($args);
        
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();

                                $email = get_field( 'email' );
                                $tel = get_field( 'phone' );
                                $wechat = get_field( 'wechat' );
                                $linkedin = get_field( 'linkedin' );
                                $facebook = get_field( 'facebook' );
                                $instagram = get_field( 'instagram' );
                            }
                        }
                    } elseif (strpos($category, 'bba-scm') !== FALSE || strpos(basename(get_permalink()) , 'bba-scm-cover' !== FALSE)) {
                        $args = array(
                            'post_type' => 'post',
                            'category_name' =>'footer',
                            'meta_query' => array(
                                array(
                                    'key' => 'footer_type', // ACF meta key
                                    'value' => 'BBA-SCM', // Value to filter by
                                    'compare' => '=', // Comparison operator (default is '=')
                                ),
                            ),
                            'posts_per_page' => 1,
                        );
                        
                        $query = new WP_Query($args);
        
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $email = get_field( 'email' );
                                $tel = get_field( 'phone' );
                                $facebook = get_field( 'facebook' );
                                $instagram = get_field( 'instagram' );
                            }
                        }
                    } elseif (strpos($category, 'bmsim') !== FALSE || strpos(basename(get_permalink()), 'bmsim-cover') !== FALSE) {
                        $args = array(
                            'post_type' => 'post',
                            'category_name' =>'footer',
                            'meta_query' => array(
                                array(
                                    'key' => 'footer_type', // ACF meta key
                                    'value' => 'BMSIM', // Value to filter by
                                    'compare' => '=', // Comparison operator (default is '=')
                                ),
                            ),
                            'posts_per_page' => 1,
                        );
                        
                        $query = new WP_Query($args);
        
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $email = get_field( 'email' );
                                $tel = get_field( 'phone' );
                                $facebook = get_field( 'facebook' );
                                $instagram = get_field( 'instagram' );
                            }
                        }
                    } else {
                        $args = array(
                            'post_type' => 'post',
                            'category_name' =>'footer',
                            'meta_query' => array(
                                array(
                                    'key' => 'footer_type', // ACF meta key
                                    'value' => 'Normal', // Value to filter by
                                    'compare' => '=', // Comparison operator (default is '=')
                                ),
                            ),
                            'posts_per_page' => 1,
                        );
                        
                        $query = new WP_Query($args);
        
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $email = get_field( 'email' );
                                $tel = get_field( 'phone' );
                                $facebook = get_field( 'facebook' );
                                $instagram = get_field( 'instagram' );
                            }
                        }
                    }
                ?>

                <ul>
                    <li><i class="fa fa-phone" aria-hidden="true"></i><span><a href="tel:<?=$tel ?>" title="tel">Tel: <?=$tel ?> </a></span></a></li>
                    <li><i class="fa fa-envelope" aria-hidden="true"></i><span><a href="mailto:<?=$email ?>" title="email">Email: <?=$email ?> </a></span></li>
                    <li><i class="fa fa-facebook-square" aria-hidden="true"></i><span><a href="https://www.facebook.com/HSUHKSCMofficial" title="facebook">Facebook: <?=$facebook ?></a></span></li>
                    <li><i class="fa fa-instagram" aria-hidden="true"></i><span><a href="https://www.instagram.com/hsuhk.scm/" title="Instagram">Instagram: <?=$instagram ?></a></span></li>
                    <?php
                     if ($isMGSc) {
                    ?>
                    <li><i class="fa fa-wechat" aria-hidden="true"></i><span><a href="<?=wechat ?>" title="WeChat">WeChat</a></span></li>
                    <li><i class="fa fa-linkedin-square" aria-hidden="true"></i><span><a href="<?=$linkedin ?>" title="Linkedin">Linkedin</a></span></li>
                    <?php
                     }
                     ?>
                </ul>
             </div>
            <div class="copyright">
                <span>Copyright © Dept. of SCM. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>

<!--Scroll to top-->
<!--<button class="scroll-top" data-target="html">
    <span class="fa fa-sort-up"></span>
</button>-->
<button class="message scroll-top" data-target="html">
 
</button>
<!---mobile menu---->
<script src="<?=get_template_directory_uri()?>/static/menu/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?=get_template_directory_uri()?>/static/menu/script.js"></script>
<!---mobile menu---->
<script src="<?=get_template_directory_uri()?>/static/js/common.js"></script>
<script src="<?=get_template_directory_uri()?>/static/js/wow.js"></script>
<script>
    new WOW().init();
</script>


<?php wp_footer(); ?>



