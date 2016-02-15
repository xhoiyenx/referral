@extends('layouts.master')
@section('content')
    <div class="container-fluid homeBanner">
      <section class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <figure class="bannerImg">{{ html()->image('public/site/assets/images/bannerHome.png') }}</figure>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            {{ settings('homepage') }}
            <!--
            <h1 class="text-uppercase text-right txtDesktop" style="font-size:36px">Join our <strong class="red">referral program</strong><br/>and <strong>EARN UP TO S$800 PER LEAD CLOSED</strong></h1>
            <p>Referral SG is a new campaign that run by ITConcept Pte Ltd. The program allows you to earn extra cash by simply referring people to us. No MLM, No Selling, No Payment. Simply earn up to S$800 for every success lead that sign the deal with us. <a href="/howitworks">Learn how it works >></a></p>
            -->
            @if ( count($testimonials->get()) > 0 )
            <div class="testimonials text-center">
              <div class="flexslider">
                <ul class="slides">
                @foreach( $testimonials->get() as $testimonial )
                  <li>
                    @if ( ! empty($testimonial->image) )
                    <figure class="imgClient"><img src="{{ '/public/uploads/' . $testimonial->image }}" alt="" class="img-circle" width="60" height="60" /></figure>
                    @endif
                    <div class="testimonial">
                      {{ Str::words($testimonial->description, 30) }}
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