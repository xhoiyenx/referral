@extends('layouts.master')
@section('content')
    <div class="container-fluid topBanner">
      <section class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bannerWhyus">
            <h1 class="text-uppercase pull-right">Why <span class="red">US</span></h1>
          </div>
        </div>
      </section>
    </div>
    <div class="container-fluid contentSection">
      <section class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center whyusQuestion">
            <ul>
              <li><strong class="text-uppercase">Q : Why you give <span>high referral</span>?</strong><br/>We just simply want people to refer more lead to close more sales. Both win win solutions.</li>
              <li><strong class="text-uppercase">Q : Your solutions are <span>easy to sell</span>?</strong><br/>To answer you, yes. All our solutions are subsided by Government, 60% - 100% of solutions cost. And best of it, we don't ask you to sell. We just need you to introduce our company and solutions to the lead that might need. From there our sales person will take care everything from meeting, demo, and closing the deal. It's easy. You don't need to sell. You just need to tell people about us and if they need any of our solutions.</li>
              <li><strong class="text-uppercase">Q : How <span>fast</span> will I <span>received my referral fees</span>?</strong><br/>Once deal is closed (you can check from your lead status), you just need to wait till the project completed and full payment received. Your referral fee will be mailed to you by cheque on every 1st of the month. It's just like extra pay cheque </li>
            </ul>
          </div>
        </div>
      </section>
    </div>
    @if ( count($testimonials->get()) > 0 )
    <div class="container-fluid footerTestimonialFull">
      <section class="container text-center">
        <h2>TESTIMONIALS</h2>
        <div class="row">
        @foreach( $testimonials->take(6)->get() as $testimonial )
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <figure class="imgClient"><img src="images/imgClient1.png" alt="" class="img-circle" width="60" height="61" /></figure>
            <div class="testimonial">
              {{ $testimonial->description }}
              <div class="clientName">- {{ $testimonial->title }}</div>
            </div>
          </div>
        @endforeach
        </div>
      </section>
    </div>
    @endif
@stop