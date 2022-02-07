<?php get_header(); ?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trangchu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="tintuc.html" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (!empty($list_blog)) { ?>
            <div class="main-content fl-right">
                <div class="section" id="list-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Blog</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($list_blog as &$item) { ?>
                                <li class="clearfix">
                                    <a href="<?php echo $item['friendly_detail'] ?>" title="" class="thumb fl-left">
                                        <img src="<?php echo $item['thumbnail'] ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo $item['friendly_detail']; ?>" title="" class="title"><?php echo $item['page_title'] ?></a>
                                        <span class="create-date"><?php echo get_date($item['create_date']); ?></span>
                                        <p class="desc"><?php echo $item['page_desc']; ?></p>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php echo pagging_ajax($num_page, $page, "?mod=page&action=detail", ""); ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>