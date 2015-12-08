@extends('layouts.master')
@section('content')
    <div class="container-fluid homeBanner">
      <section class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <figure class="bannerImg">{{ html()->image('public/site/assets/images/bannerHome.png') }}</figure>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h1 class="text-uppercase text-right txtDesktop">Join our <strong class="red">referral program</strong><br/>and <strong>earn UP TO S$800</strong></h1>
            <p>ITConcept is an IT Company base in Singapore. The referral program allow you to earn extra by simply referring people to us. Our solutions range from POS System, Appointment &amp; Booking System, E-Commerce and Corporate Website. Earn up to S$800 for every success referral that sign the deal with us. </p>
            @if ( count($testimonials->get()) > 0 )
            <div class="testimonials text-center">
              <div class="flexslider">
                <ul class="slides">
                @foreach( $testimonials->get() as $testimonial )
                  <li>
                    <figure class="imgClient"><img src="public/site/assets/images/imgClient1.png" alt="" class="img-circle" width="60" height="61" /></figure>
                    <div class="testimonial">
                      {{ $testimonial->description }}
                      <div class="clientName">- {{ $testimonial->title }}</div>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
            </div>
            @endif
          </div>
        </div>
      </section>
    </div>
@stop