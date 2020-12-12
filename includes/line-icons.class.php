<?php
/*
 * APPSAZADMIN
 * @author   AcmeeDesign
 * @url     http://acmeedesign.com
*/

defined('ABSPATH') || die;

class WPSLNIICONS {

    public function wps_lni_icons()
        {
            /**
               * Defining all Line icon fonts
               * Created by LineIcons Team https://lineicons.com
               * @return  all line icons data
               * @since   6.0.0
               */

                $lineicons = array(
                  'lni-add-file' => '\e900',
                'lni-empty-file' => '\e916',
                'lni-remove-file' => '\e917',
                'lni-files' => '\ea6f',
                'lni-display-alt' => '\e901',
                'lni-laptop-phone' => '\e902',
                'lni-laptop' => '\e936',
                'lni-mobile' => '\e907',
                'lni-tab' => '\e922',
                'lni-timer' => '\e903',
                'lni-headphone' => '\e904',
                'lni-rocket' => '\e905',
                'lni-package' => '\e906',
                'lni-popup' => '\e909',
                'lni-scroll-down' => '\e90a',
                'lni-pagination' => '\e90b',
                'lni-unlock' => '\e90c',
                'lni-lock' => '\e946',
                'lni-reload' => '\e90d',
                'lni-map-marker' => '\e91e',
                'lni-map' => '\e90e',
                'lni-game' => '\e90f',
                'lni-search' => '\e910',
                'lni-alarm' => '\e911',
                'lni-code' => '\e91c',
                'lni-website' => '\e908',
                'lni-code-alt' => '\e912',
                'lni-display' => '\e913',
                'lni-shortcode' => '\e919',
                'lni-headphone-alt' => '\e915',
                'lni-alarm-clock' => '\e918',
                'lni-bookmark-alt' => '\e91a',
                'lni-bookmark' => '\e91b',
                'lni-layout' => '\e937',
                'lni-keyboard' => '\e91d',
                'lni-grid-alt' => '\e91f',
                'lni-grid' => '\e920',
                'lni-mic' => '\e921',
                'lni-signal' => '\e923',
                'lni-download' => '\e925',
                'lni-upload' => '\e926',
                'lni-zip' => '\e927',
                'lni-rss-feed' => '\e928',
                'lni-warning' => '\e929',
                'lni-cloud-sync' => '\e92a',
                'lni-cloud-upload' => '\e92b',
                'lni-cloud-check' => '\e92c',
                'lni-cloud-download' => '\e914',
                'lni-cog' => '\e92d',
                'lni-dashboard' => '\e92e',
                'lni-folder' => '\eaa0',
                'lni-database' => '\e92f',
                'lni-harddrive' => '\eaab',
                'lni-control-panel' => '\e930',
                'lni-plug' => '\e931',
                'lni-menu' => '\eab8',
                'lni-power-switch' => '\e932',
                'lni-printer' => '\e933',
                'lni-save' => '\eab9',
                'lni-layers' => '\e934',
                'lni-link' => '\e935',
                'lni-share' => '\eaba',
                'lni-inbox' => '\eabb',
                'lni-unlink' => '\e924',
                'lni-microphone' => '\e938',
                'lni-magnet' => '\e939',
                'lni-mouse' => '\e93a',
                'lni-share-alt' => '\e93b',
                'lni-bluetooth' => '\e93c',
                'lni-crop' => '\e93d',
                'lni-cut' => '\e93f',
                'lni-protection' => '\e940',
                'lni-shield' => '\eabc',
                'lni-bolt-alt' => '\e941',
                'lni-bolt' => '\e942',
                'lni-infinite' => '\e943',
                'lni-hand' => '\e944',
                'lni-flag' => '\e945',
                'lni-zoom-out' => '\e947',
                'lni-zoom-in' => '\e948',
                'lni-pin-alt' => '\e949',
                'lni-pin' => '\e9ba',
                'lni-more-alt' => '\e94a',
                'lni-more' => '\e958',
                'lni-check-box' => '\e94b',
                'lni-check-mark-circle' => '\e94c',
                'lni-cross-circle' => '\e94d',
                'lni-circle-minus' => '\e94e',
                'lni-close' => '\e951',
                'lni-star-filled' => '\e94f',
                'lni-star' => '\e950',
                'lni-star-empty' => '\e952',
                'lni-star-half' => '\e953',
                'lni-question-circle' => '\e954',
                'lni-thumbs-down' => '\e955',
                'lni-thumbs-up' => '\e956',
                'lni-minus' => '\e957',
                'lni-plus' => '\e959',
                'lni-ban' => '\e95a',
                'lni-hourglass' => '\eabd',
                'lni-trash' => '\e95b',
                'lni-key' => '\e95c',
                'lni-pulse' => '\e95d',
                'lni-heart' => '\e95e',
                'lni-heart-filled' => '\e93e',
                'lni-help' => '\e95f',
                'lni-paint-roller' => '\e960',
                'lni-ux' => '\e961',
                'lni-radio-button' => '\e962',
                'lni-brush-alt' => '\e963',
                'lni-select' => '\eabe',
                'lni-slice' => '\e964',
                'lni-move' => '\e965',
                'lni-wheelchair' => '\e966',
                'lni-vector' => '\e967',
                'lni-ruler-pencil' => '\e968',
                'lni-ruler' => '\e969',
                'lni-brush' => '\e96a',
                'lni-eraser' => '\e96b',
                'lni-ruler-alt' => '\e96c',
                'lni-color-pallet' => '\e96d',
                'lni-paint-bucket' => '\e96e',
                'lni-bulb' => '\e96f',
                'lni-highlight-alt' => '\e970',
                'lni-highlight' => '\e971',
                'lni-handshake' => '\e972',
                'lni-briefcase' => '\eabf',
                'lni-funnel' => '\eac0',
                'lni-world' => '\e973',
                'lni-calculator' => '\e974',
                'lni-target-revenue' => '\e975',
                'lni-revenue' => '\e976',
                'lni-invention' => '\e977',
                'lni-network' => '\e978',
                'lni-credit-cards' => '\e979',
                'lni-pie-chart' => '\e97a',
                'lni-archive' => '\e97b',
                'lni-magnifier' => '\e97c',
                'lni-agenda' => '\e97d',
                'lni-tag' => '\e97f',
                'lni-target' => '\e980',
                'lni-stamp' => '\e981',
                'lni-clipboard' => '\e982',
                'lni-licencse' => '\e983',
                'lni-paperclip' => '\e984',
                'lni-stats-up' => '\e97e',
                'lni-stats-down' => '\e985',
                'lni-bar-chart' => '\e986',
                'lni-bullhorn' => '\e987',
                'lni-calendar' => '\e988',
                'lni-quotation' => '\e989',
                'lni-bus' => '\e98a',
                'lni-car-alt' => '\e98b',
                'lni-car' => '\e98c',
                'lni-train' => '\e9a0',
                'lni-train-alt' => '\e991',
                'lni-helicopter' => '\e990',
                'lni-ship' => '\e992',
                'lni-bridge' => '\e993',
                'lni-scooter' => '\e98f',
                'lni-plane' => '\e994',
                'lni-bi-cycle' => '\e996',
                'lni-postcard' => '\e98d',
                'lni-road' => '\e98e',
                'lni-envelope' => '\e997',
                'lni-reply' => '\e998',
                'lni-bubble' => '\e995',
                'lni-support' => '\e999',
                'lni-comment-reply' => '\e99a',
                'lni-pointer' => '\e99b',
                'lni-phone' => '\e99c',
                'lni-phone-handset' => '\eac1',
                'lni-comment-alt' => '\e99e',
                'lni-comment' => '\e99f',
                'lni-coffee-cup' => '\e9a1',
                'lni-home' => '\e9a2',
                'lni-gift' => '\eac2',
                'lni-thought' => '\e9a3',
                'lni-eye' => '\eac3',
                'lni-user' => '\e9a4',
                'lni-users' => '\e9a5',
                'lni-wallet' => '\e9a6',
                'lni-tshirt' => '\e9a7',
                'lni-medall-alt' => '\e9a8',
                'lni-medall' => '\e9a9',
                'lni-notepad' => '\e9aa',
                'lni-crown' => '\e9ab',
                'lni-ticket' => '\e9ac',
                'lni-ticket-alt' => '\e9ad',
                'lni-certificate' => '\e9ae',
                'lni-cup' => '\e9af',
                'lni-library' => '\e9b0',
                'lni-school-bench-alt' => '\e9b1',
                'lni-school-bench' => '\e9b4',
                'lni-microscope' => '\e9b2',
                'lni-school-compass' => '\e9b3',
                'lni-information' => '\e9b5',
                'lni-graduation' => '\e9b6',
                'lni-write' => '\e9b7',
                'lni-pencil-alt' => '\e9b8',
                'lni-pencil' => '\e9b9',
                'lni-blackboard' => '\e9bb',
                'lni-book' => '\e9bc',
                'lni-shuffle' => '\e9bd',
                'lni-gallery' => '\eac4',
                'lni-image' => '\eac5',
                'lni-volume-mute' => '\e9be',
                'lni-backward' => '\e9bf',
                'lni-forward' => '\e9c0',
                'lni-stop' => '\e9c1',
                'lni-play' => '\e9c2',
                'lni-pause' => '\e9c3',
                'lni-music' => '\e9c4',
                'lni-frame-expand' => '\e9c5',
                'lni-full-screen' => '\eac6',
                'lni-video' => '\e9c6',
                'lni-volume-high' => '\e9c7',
                'lni-volume-low' => '\e9c8',
                'lni-volume-medium' => '\e9c9',
                'lni-volume' => '\e9ca',
                'lni-camera' => '\e9cb',
                'lni-invest-monitor' => '\e9cc',
                'lni-grow' => '\e9cd',
                'lni-money-location' => '\e9ce',
                'lni-cloudnetwork' => '\e9cf',
                'lni-diamond' => '\e9d0',
                'lni-customer' => '\e9d1',
                'lni-domain' => '\e9d2',
                'lni-target-audience' => '\e9d3',
                'lni-seo' => '\e9d4',
                'lni-keyword-research' => '\e9d5',
                'lni-seo-monitoring' => '\e9d6',
                'lni-seo-consulting' => '\e9d7',
                'lni-money-protection' => '\e9d8',
                'lni-offer' => '\e9d9',
                'lni-delivery' => '\e9da',
                'lni-investment' => '\e9db',
                'lni-shopping-basket' => '\e9dc',
                'lni-coin' => '\e9dd',
                'lni-cart-full' => '\e9de',
                'lni-cart' => '\e9df',
                'lni-burger' => '\e9e0',
                'lni-restaurant' => '\e9e1',
                'lni-service' => '\e9e2',
                'lni-chef-hat' => '\e9e3',
                'lni-cake' => '\e9e4',
                'lni-pizza' => '\e9e5',
                'lni-teabag' => '\e9e6',
                'lni-dinner' => '\e9e7',
                'lni-taxi' => '\e9e8',
                'lni-caravan' => '\e9e9',
                'lni-pyramids' => '\e9ea',
                'lni-surfboard' => '\e9eb',
                'lni-travel' => '\e9ec',
                'lni-island' => '\e9ed',
                'lni-mashroom' => '\e9ee',
                'lni-sprout' => '\e9ef',
                'lni-tree' => '\e9f0',
                'lni-trees' => '\e9f1',
                'lni-flower' => '\e9f2',
                'lni-bug' => '\e9f3',
                'lni-leaf' => '\e9f4',
                'lni-fresh-juice' => '\e9f5',
                'lni-heart-monitor' => '\e9f6',
                'lni-dumbbell' => '\e9f7',
                'lni-skipping-rope' => '\e9f8',
                'lni-slim' => '\e9f9',
                'lni-weight' => '\e9fa',
                'lni-basketball' => '\e9fb',
                'lni-first-aid' => '\e9fc',
                'lni-ambulance' => '\e9fd',
                'lni-hospital' => '\e9fe',
                'lni-syringe' => '\e9ff',
                'lni-capsule' => '\ea00',
                'lni-stethoscope' => '\ea01',
                'lni-wheelbarrow' => '\ea02',
                'lni-shovel' => '\ea03',
                'lni-construction-hammer' => '\ea04',
                'lni-brick' => '\ea05',
                'lni-hammer' => '\eac7',
                'lni-helmet' => '\ea06',
                'lni-trowel' => '\ea07',
                'lni-construction' => '\ea08',
                'lni-apartment' => '\ea09',
                'lni-juice' => '\ea0a',
                'lni-spray' => '\ea0b',
                'lni-candy-cane' => '\ea0c',
                'lni-candy' => '\ea0d',
                'lni-fireworks' => '\ea0e',
                'lni-flags' => '\ea0f',
                'lni-baloon' => '\ea10',
                'lni-cloud' => '\ea11',
                'lni-night' => '\ea12',
                'lni-cloudy-sun' => '\ea13',
                'lni-rain' => '\ea14',
                'lni-thunder' => '\ea15',
                'lni-drop' => '\ea16',
                'lni-thunder-alt' => '\ea18',
                'lni-sun' => '\ea17',
                'lni-spell-check' => '\ea1a',
                'lni-text-format' => '\ea1b',
                'lni-text-format-remove' => '\ea1c',
                'lni-italic' => '\ea1d',
                'lni-line-dotted' => '\ea1e',
                'lni-text-align-center' => '\ea19',
                'lni-text-align-left' => '\ea20',
                'lni-text-align-right' => '\ea21',
                'lni-text-align-justify' => '\ea22',
                'lni-bold' => '\ea23',
                'lni-page-break' => '\ea24',
                'lni-strikethrough' => '\ea25',
                'lni-text-size' => '\ea26',
                'lni-line-dashed' => '\ea27',
                'lni-line-double' => '\ea28',
                'lni-direction-ltr' => '\ea29',
                'lni-direction-rtl' => '\ea2a',
                'lni-list' => '\ea2b',
                'lni-line-spacing' => '\ea2f',
                'lni-sort-alpha-asc' => '\ea1f',
                'lni-sort-amount-asc' => '\ea2c',
                'lni-indent-decrease' => '\ea2d',
                'lni-indent-increase' => '\ea2e',
                'lni-pilcrow' => '\ea30',
                'lni-underline' => '\ea31',
                'lni-dollar' => '\ea32',
                'lni-rupee' => '\ea33',
                'lni-pound' => '\ea34',
                'lni-yen' => '\ea35',
                'lni-euro' => '\ea36',
                'lni-emoji-happy' => '\ea37',
                'lni-emoji-tounge' => '\ea38',
                'lni-emoji-cool' => '\ea39',
                'lni-emoji-friendly' => '\ea3a',
                'lni-emoji-neutral' => '\ea3b',
                'lni-emoji-sad' => '\ea3c',
                'lni-emoji-smile' => '\ea3d',
                'lni-emoji-suspect' => '\ea3e',
                'lni-direction-alt' => '\ea3f',
                'lni-enter' => '\ea40',
                'lni-exit-down' => '\ea41',
                'lni-exit-up' => '\ea5f',
                'lni-exit' => '\ea42',
                'lni-chevron-up' => '\ea43',
                'lni-chevron-left' => '\ea44',
                'lni-chevron-down' => '\ea45',
                'lni-chevron-right' => '\ea46',
                'lni-arrow-down' => '\ea47',
                'lni-arrows-horizontal' => '\ea48',
                'lni-arrows-vertical' => '\ea49',
                'lni-direction' => '\ea4a',
                'lni-arrow-left' => '\ea4b',
                'lni-arrow-right' => '\ea4c',
                'lni-arrow-up' => '\ea4d',
                'lni-arrow-down-circle' => '\ea4e',
                'lni-anchor' => '\ea4f',
                'lni-arrow-left-circle' => '\ea50',
                'lni-arrow-right-circle' => '\ea51',
                'lni-arrow-up-circle' => '\ea52',
                'lni-angle-double-down' => '\ea53',
                'lni-angle-double-left' => '\ea54',
                'lni-angle-double-right' => '\ea55',
                'lni-angle-double-up' => '\ea56',
                'lni-arrow-top-left' => '\ea57',
                'lni-arrow-top-right' => '\ea58',
                'lni-chevron-down-circle' => '\ea59',
                'lni-chevron-left-circle' => '\ea5a',
                'lni-chevron-right-circle' => '\ea5b',
                'lni-chevron-up-circle' => '\ea5c',
                'lni-shift-left' => '\ea5d',
                'lni-shift-right' => '\ea5e',
                'lni-pointer-down' => '\ea60',
                'lni-pointer-right' => '\ea62',
                'lni-pointer-left' => '\ea61',
                'lni-pointer-up' => '\ea63',
                'lni-spinner-arrow' => '\ea64',
                'lni-spinner-solid' => '\ea65',
                'lni-spinner' => '\ea66',
                'lni-google' => '\e99d',
                'lni-producthunt' => '\ea68',
                'lni-paypal' => '\eab3',
                'lni-paypal-original' => '\ea6c',
                'lni-java' => '\ea6d',
                'lni-microsoft' => '\ea6b',
                'lni-windows' => '\ea6e',
                'lni-flickr' => '\ea70',
                'lni-drupal' => '\ea9f',
                'lni-drupal-original' => '\ea71',
                'lni-android' => '\eab7',
                'lni-android-original' => '\ea72',
                'lni-playstore' => '\eab4',
                'lni-git' => '\ea9b',
                'lni-github-original' => '\ea73',
                'lni-github' => '\ea9c',
                'lni-steam' => '\ea75',
                'lni-shopify' => '\ea76',
                'lni-snapchat' => '\ea77',
                'lni-soundcloud' => '\eab5',
                'lni-souncloud-original' => '\ea78',
                'lni-telegram' => '\ea79',
                'lni-twitch' => '\ea7a',
                'lni-vimeo' => '\ea7c',
                'lni-vk' => '\ea7d',
                'lni-wechat' => '\ea7e',
                'lni-whatsapp' => '\ea7f',
                'lni-yahoo' => '\ea80',
                'lni-youtube' => '\ea81',
                'lni-stackoverflow' => '\ea82',
                'lni-slideshare' => '\ea84',
                'lni-slack' => '\ea85',
                'lni-lineicons-alt' => '\ea69',
                'lni-lineicons' => '\ea6a',
                'lni-skype' => '\ea86',
                'lni-pinterest' => '\ea87',
                'lni-reddit' => '\ea88',
                'lni-line' => '\ea89',
                'lni-megento' => '\ea8b',
                'lni-blogger' => '\ea8e',
                'lni-bootstrap' => '\ea8f',
                'lni-dribbble' => '\ea90',
                'lni-dropbox' => '\ea98',
                'lni-dropbox-original' => '\ea91',
                'lni-envato' => '\ea92',
                'lni-500px' => '\ea95',
                'lni-twitter-original' => '\ea7b',
                'lni-twitter' => '\ea97',
                'lni-twitter-filled' => '\eac8',
                'lni-facebook-messenger' => '\ea93',
                'lni-facebook-original' => '\ea94',
                'lni-facebook-filled' => '\ea99',
                'lni-facebook' => '\ea9a',
                'lni-joomla' => '\eac9',
                'lni-firefox' => '\ea9d',
                'lni-amazon-original' => '\ea74',
                'lni-amazon' => '\ea9e',
                'lni-linkedin-original' => '\ea8a',
                'lni-linkedin' => '\eaa1',
                'lni-linkedin-filled' => '\eaca',
                'lni-bitbucket' => '\eaa2',
                'lni-quora' => '\eaa3',
                'lni-medium' => '\eaa4',
                'lni-instagram-original' => '\ea8c',
                'lni-instagram-filled' => '\eaa6',
                'lni-instagram' => '\eaa7',
                'lni-bitcoin' => '\eaa8',
                'lni-stripe' => '\eaa9',
                'lni-wordpress-filled' => '\eaaa',
                'lni-wordpress' => '\ea96',
                'lni-google-plus' => '\eaac',
                'lni-mastercard' => '\eaae',
                'lni-visa' => '\eaaf',
                'lni-amex' => '\eacb',
                'lni-apple' => '\eab0',
                'lni-behance' => '\eab1',
                'lni-behance-original' => '\ea8d',
                'lni-chrome' => '\eab2',
                'lni-spotify-original' => '\ea83',
                'lni-spotify' => '\eab6',
                'lni-html' => '\eaad',
                'lni-css' => '\eaa5',
                'lni-ycombinator' => '\ea67',
                );

                return $lineicons;
            }
    }
