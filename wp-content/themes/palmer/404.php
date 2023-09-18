<?php
get_header(); ?>

<div class="section-top">
    <div class="container">
        <h1>404 Page Not Found</h1>
        <ul id="breadcrumbs" class="breadcrumbs">
            <li class="item-home">
                <a href="<?php echo home_url(); ?>" title="Home">Home </a>
            </li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="container">
        <div class="inner-content">
            <h2>Whoops!</h2>
            <p class="mb-3">
                It looks like this was the result of:
            </p>
            <ul>
                <li>the wrong url</li>
                <li>an old bookmark</li>
                <li>a broken link</li>
            </ul>
            <p class="mb-3 mt-3">
                Try one of these to find what you were looking for:
            </p>
            <ul>
                <li>Search box at top-right of this page</li>
                <li><a href="/" title="Homepage">Homepage</a></li>
            </ul>
            <div class="mt-5">
                <a class="button wireframe" href="/forms/marketing/site-feedback/" title="Tell us about the error">
                    Tell us about the error
                </a>
            </div>

        </div>
    </div>
</div>

<?php
get_footer();
?>
