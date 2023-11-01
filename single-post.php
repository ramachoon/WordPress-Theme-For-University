<?php get_header();  ?>

<?php
while(have_posts()) {
    the_post();
    $categories = get_the_category();

    if ( ! empty( $categories ) ) {
        $category_slug = $categories[0]->slug;
        if ($category_slug === 'news') {
            require_once('single/news.php'); 
        } else if($category_slug === 'news-zh') {
            require_once('single/news-zh.php'); 
        }
    }
}
?>
<?php get_footer();  ?>


</body>
</html>