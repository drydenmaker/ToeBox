<?php get_header(); ?>
<!-- START INDEX CONTENT -->
<div class="col-sm-8 tb-main">
<?php
<?php if (!empty($posts)) 
{
    foreach ($posts as $post)
    {
        get_template_part('content', $post->post_mime_type);
    }
} 
else 
{
    print '<p>No content found</p>';
}
?>
</div>
<div class="col-sm-3 col-sm-offset-1 tb-sidebar">
    <?php get_sidebar() ?>
</div>
<!-- END INDEX CONTENT -->
<?php get_footer(); ?>