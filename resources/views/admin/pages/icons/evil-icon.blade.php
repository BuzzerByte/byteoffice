@extends('admin.layouts.layout-basic')

@section('styles')
    <style>
        .icons{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        figure{
            flex: 1;
            min-width: 300px;
            display: flex;
        }
        .icon--m{
            width: 60px;
            height: 60px;
            padding: 10px;
            border: 2px solid #FFEB3B;
            border-radius: 3px;
            fill: #000000;
        }
        .icon--m:hover{
            background-color: #FFEB3B;
            cursor: pointer;
        }
        .normal{
            margin-left: 20px;
            padding-top: 10px;
     
        }
    </style>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Icons</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.icons.evilicon')}}">Evil Icons</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        Evil Icons
                    </div>
                    <div class="card-block">
                        <article class="icons">

                            <figure class="icons__plate">
                                <div class="icon icon--ei-archive icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-archive-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-archive-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-arrow-down icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-arrow-down-icon"></use>
                                    </svg>
                                </div>
                               <span class="normal">ei-arrow-down-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-arrow-left icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-arrow-left-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-arrow-left-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-arrow-right icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-arrow-right-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-arrow-right-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-arrow-up icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-arrow-up-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-arrow-up-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-bell icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-bell-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-bell-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-calendar icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-calendar-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-calendar-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-camera icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-camera-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-camera-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-cart icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-cart-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-cart-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-chart icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-chart-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-chart-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-check icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-check-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-check-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-chevron-down icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-chevron-down-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-chevron-down-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-chevron-left icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-chevron-left-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-chevron-left-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-chevron-right icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-chevron-right-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-chevron-right-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-chevron-up icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-chevron-up-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-chevron-up-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-clock icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-clock-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-clock-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-close-o icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-close-o-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-close-o-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-close icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-close-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-close-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-comment icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-comment-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-comment-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-credit-card icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-credit-card-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-credit-card-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-envelope icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-envelope-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-envelope-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-exclamation icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-exclamation-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-exclamation-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-external-link icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-external-link-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-external-link-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-eye icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ei-eye-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-eye-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-gear icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-gear-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-gear-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-heart icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-heart-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-heart-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-image icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-image-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-image-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-like icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-like-icon"></use>
                                    </svg>
                                </div>
                               <span class="normal">ei-like-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-link icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-link-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-link-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-location icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-location-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-location-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-lock icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-lock-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-lock-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-minus icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-minus-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-minus-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-navicon icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-navicon-icon"></use>
                                    </svg>
                                </div>
                               <span class="normal">ei-navicon-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-paperclip icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-paperclip-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-paperclip-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-pencil icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-pencil-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-pencil-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-play icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-play-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-play-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-plus icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-plus-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-plus-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-pointer icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-pointer-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-pointer-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-question icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-question-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-question-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-redo icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-redo-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-redo-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-refresh icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-refresh-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-refresh-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-retweet icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-retweet-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-retweet-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-facebook icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-facebook-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-facebook-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-github icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-github-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-github-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-google-plus icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-google-plus-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-google-plus-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-instagram icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-instagram-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-instagram-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-linkedin icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-linkedin-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-linkedin-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-odnoklassniki icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-odnoklassniki-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-odnoklassniki-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-pinterest icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-pinterest-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-pinterest-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-skype icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-skype-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-skype-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-soundcloud icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-soundcloud-icon"></use>
                                    </svg>
                                </div>
                               <span class="normal">ei-sc-soundcloud-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-telegram icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-telegram-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-telegram-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-tumblr icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-tumblr-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-tumblr-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-twitter icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-twitter-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-twitter-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-vimeo icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-vimeo-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-vimeo-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-vk icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-vk-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-sc-vk-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-sc-youtube icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-sc-youtube-icon"></use>
                                    </svg>
                                </div>
                               <span class="normal">ei-sc-youtube-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-search icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-search-icon"></use>
                                    </svg>
                                </div>
                               <span class="normal">ei-search-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-share-apple icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-share-apple-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-share-apple-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-share-google icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-share-google-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-share-google-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-spinner-2 icon--m">
                                    <div class="icon__spinner">
                                        <svg class="icon__cnt">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#ei-spinner-2-icon"></use>
                                        </svg>
                                    </div>
                                </div>
                                <span class="normal">ei-spinner-2-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-spinner-3 icon--m">
                                    <div class="icon__spinner">
                                        <svg class="icon__cnt">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#ei-spinner-3-icon"></use>
                                        </svg>
                                    </div>
                                </div>
                                <span class="normal">ei-spinner-3-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-spinner icon--m">
                                    <div class="icon__spinner">
                                        <svg class="icon__cnt">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#ei-spinner-icon"></use>
                                        </svg>
                                    </div>
                                </div>
                                <span class="normal">ei-spinner-icon</span>
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-star icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-star-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-star-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-tag icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ei-tag-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-tag-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-trash icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-trash-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-trash-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-trophy icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-trophy-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-trophy-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-undo icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-undo-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-undo-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-unlock icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-unlock-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-unlock-icon</span>
                                
                            </figure>
                            <figure class="icons__plate">
                                <div class="icon icon--ei-user icon--m">
                                    <svg class="icon__cnt">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#ei-user-icon"></use>
                                    </svg>
                                </div>
                                <span class="normal">ei-user-icon</span>
                                
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

