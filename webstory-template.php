<?php
/*
Template Name: Full-width page layout
Template Post Type: webstory
*/


$web_img = get_post_meta(get_the_ID(), 'web_img', true);
$web_title = get_post_meta(get_the_ID(), 'web_title', true);

$web_img_arr = explode("|", $web_img);
$web_title_arr = explode("|", $web_title);
$length = count($web_title_arr);

if ($web_img == '') {

    if (has_post_thumbnail($post->ID)) :
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
        $web_img_arr = array_fill(0, $length, $image[0]);
    endif;
}

$args = array(
    'numberposts' => 1,
    'post_type'   => 'webstory',
    'post__not_in' => array($post->ID)
);
$myposts2 = get_posts($args);
$link = $myposts2[0]->guid;
?>
<!DOCTYPE html>

<html ⚡>

<head>
    <meta charset="utf-8">
    <title><?php the_title(); ?></title>
    <link rel="canonical" href="<?php echo $link; ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>
    body {
        -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        animation: -amp-start 8s steps(1, end) 0s 1 normal both
    }

    @-webkit-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-moz-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-ms-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-o-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }
    </style><noscript>
        <style amp-boilerplate>
        body {
            -webkit-animation: none;
            -moz-animation: none;
            -ms-animation: none;
            animation: none
        }
        </style>
    </noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <style amp-custom>
    amp-story {
        font-family: 'Oswald', sans-serif;
        color: #fff;
    }

    amp-story-page {
        background-image: linear-gradient(0 turn, #fcfcfc .43%, #fd174e 100%);

    }

    h1 {
        font-weight: bold;
        font-size: 2.875em;
        font-weight: normal;
        line-height: 1.174;
    }

    p {
        font-weight: normal;
        font-size: 1.3em;
        line-height: 1.5em;
        color: #fff;
    }

    q {
        font-weight: 300;
        font-size: 1.1em;
    }

    amp-story-grid-layer.bottom {
        align-content: end;
    }


    amp-story-grid-layer.noedge {
        padding: 0px;
    }

    amp-story-grid-layer.center-text {
        align-content: center;
    }

    .wrapper {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 50% 50%;
    }

    .banner-text {
        text-align: center;
        background-color: #000;
        line-height: 2em;
        height: fit-content;
    }

    amp-img>img {
        object-fit: contain;
        animation: bg-zoom-in 9s linear forwards;
    }

    @keyframes bg-zoom-in {
        0% {
            transform: scale(1)
        }

        100% {
            transform: scale(1.2)
        }
    }

    @keyframes bg-zoom-out {
        0% {
            transform: scale(1.2)
        }

        100% {
            transform: scale(1)
        }
    </style>
</head>

<body>
    <!-- Cover page -->
    <amp-story standalone title="Joy of Pets" publisher="AMP tutorials"
        publisher-logo-src="<?php echo wp_get_attachment_url(get_option('media_selector_attachment_id')); ?>"
        poster-portrait-src="<?php echo $web_img_arr[0] ?>">



        <?php


        for ($i = 0; $i < $length; $i++) {

        ?>



        <amp-story-page id="page<?php echo $i; ?>">
            <amp-story-grid-layer template="fill">
                <amp-img src="<?php echo $web_img_arr[$i]; ?>" width="720" height="1280" layout="responsive">
                </amp-img>
            </amp-story-grid-layer>
            <amp-story-grid-layer template="thirds">
                <!-- <h1 grid-area="upper-third">Dogs</h1> -->
                <p class="banner-text" grid-area="lower-third"><?php echo $web_title_arr[$i]; ?></p>
            </amp-story-grid-layer>
            <?php if ($i == ($length - 1)) { ?>
            <amp-story-page-outlink layout="nodisplay" theme="light"><a href="<?php echo $link; ?>">Find Out
                    More</a></amp-story-page-outlink>
            <?php }
                ?>



        </amp-story-page>

        <?php
        }
        ?>


        <!-- Bookend -->
        <amp-story-bookend layout="nodisplay">


            <script type="application/json">
            {
                "bookendVersion": "v1.0",
                "components": [],
                "shareProviders": [{
                    "provider": "twitter",
                    "text": "",
                    "app_id": ""
                }, "pinterest", "tumblr", "whatsapp"]
            }
            </script>
        </amp-story-bookend>



    </amp-story>
</body>

</html>