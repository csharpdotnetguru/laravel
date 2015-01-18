@extends('layout.v2.home')

@section('title', ' | Press Reviews')

@section('content')

<div class="container main-content">
    <header>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 page-title page-header">
                <h1>Press Reviews
                    <small>what others are saying about us</small>
                    <p class="pull-right header-small-right">
                    <a href="mailto:pr@unovation.com" target="_top">Press Contact</a>

</p>
                </h1>
            </div>
        </div>
    </header>

    <section>

        <div class="row">

            <div class="col-sm-10 col-xs-offset-1 page-content">

                @foreach($reviews as $review)

                <div class="row">
                    <div class="col-sm-3">
                        <a href='{{ $review->url }}'>
                            <img src="http://www.unotelly.com/unodns/{{ $review->image }}" class="img-responsive" alt="Responsive image">
                        </a>
                    </div>

                    <div class="col-sm-9">
                        <a href='{{ $review->url }}'><h3>{{ $review->blog_name }}</h3></a>

                        <blockquote class="reviews">
                            <p>{{ $review->snippet }}</p>

                            <footer>{{ $review->author }}
                                <a href='{{ $review->url }}'>
                                    <cite title="Source Title">{{ $review->blog_name }}</cite>
                                </a>
                            </footer>
                        </blockquote>

                    </div>

                </div>

                <hr>

                @endforeach

            </div>
        </div>

</div>

@include('v2.frontend.partials._footer')

@stop