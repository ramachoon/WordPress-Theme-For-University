<?php

get_header();

$permalink =  get_permalink();

$page_name = basename($permalink);

if (pll_current_language() == 'en'):
    get_template_part( 'page-templates/'.$page_name );
elseif (pll_current_language() == 'zh'):
    get_template_part( 'page-templates/zh/'.str_replace('-zh', '', $page_name) );
endif;

get_footer();
