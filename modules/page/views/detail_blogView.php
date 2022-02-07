<?php get_header(); ?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="home.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="blog.html" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (!empty($page_detail)) { ?>
            <div class="main-content fl-right">
                <?php foreach ($page_detail as &$item) { ?>
                    <div class="section" id="detail-blog-wp">
                        <div class="section-head clearfix">
                            <h3 class="section-title"><?php echo $item['page_title']; ?></h3>
                        </div>
                        <div class="section-detail">
                            <span class="create-date"><?php echo get_date($item['create_date']); ?></span>
                            <div class="detail">
                                <?php echo $item['page_content']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="section" id="social-wp">
                        <div class="section-detail">
                            <div class="fb-like" data-href="http://localhost/unitop.vn/back-end/project/ismart.com/<?php echo $item['page_detail']; ?>" data-width="500" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                            <div class="fb-comments" data-href="http://localhost/unitop.vn/back-end/project/ismart.com/<?php echo $item['page_detail']; ?>" data-width="100%" data-numposts="5"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>