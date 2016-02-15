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
          @if ( $faqs->count() > 0 )
            <ul>
            @foreach ( $faqs->orderBy('sort_order')->get() as $faq )
              <li>
                <strong class="text-uppercase"><span>Q : {{ $faq->title }}</span></strong>
                {{ $faq->description }}
              </li>
            @endforeach
            </ul>
          @endif
          <?php
          /*
            <ul>
              <li>
                <strong class="text-uppercase">Q : Why you give <span>high referral</span>?</strong>
                <p>
                  We just simply want people to refer more lead to close more sales. Both win win solutions.
                </p>
              </li>
              <li>
                <strong class="text-uppercase">Q : Your solutions are <span>easy to sell</span>?</strong>
                <p>
                  To answer you, yes. All our solutions are subsided by Government, 60% - 100% of solutions cost. And best of it, we don't ask you to sell. We just need you to introduce our company and solutions to the lead that might need. From there our sales person will take care everything from meeting, demo, and closing the deal. It's easy. You don't need to sell. You just need to tell people about us and if they need any of our solutions.
                </p>
              </li>
              <li>
                <strong class="text-uppercase">Q : How <span>fast</span> will I <span>received my referral fees</span>?</strong>
                <p>
                  Once deal is closed (you can check from your lead status), you just need to wait till the project completed and full payment received. Your referral fee will be mailed to you by cheque on every 1st of the month. It's just like extra pay cheque
                </p>
              </li>
              <li>
                <strong class="text-uppercase">Q : CAN I SUBMIT MORE THAN 1 SOLUTION PER LEAD?</strong>
                <p>
                  You are allowed to select more than 1 solution per lead contact. But as mentioned, you have to introduce our solutions so your lead is aware when we contact.
                </p>
              </li>
              <li>
                <strong class="text-uppercase">Q : CAN I ANY HOW SUBMIT CONTACT/LEAD THAT I HAVE?</strong>
                <p>
                  You're not allowed to submit contact/lead without the person concern. The proper way is to ask your contact if they need one of our solutions. Then recommend us and seek permission that you will ask us to arrange meeting or demo for more details.
                </p>
              </li>
              <li>
                <strong class="text-uppercase">Q : WHY MY ACCOUNT IS BANNED?</strong>
                <p>
                  There are several reasons why your account is banned. The most common reason is submitting leads without their concern.
                </p>
              </li>
              <li>
                <strong class="text-uppercase">Q : WHAT DO YOU MEAN BY LEAD?</strong>
                <p>
                  Lead is referring to prospect contact (Family/Friend/Business Contact) which interested in one of our solutions. Before submitting lead to us please make sure you have done short introduction of our solutions and your contact is interested to find out more.
                </p>
              </li>
              <li>
                <strong class="text-uppercase">Q : DO I NEED TO LEARN ABOUT YOUR SOLUTIONS/PRODUCTS?</strong>
                <p>
                  You don't require to learn, but it will be better if you understand so you can explain to your contact. Details about our solutions can be found when you login as member under Solutions menu. The detail of referral fee is also mentioned there.
                </p>
              </li>
            </ul>
          */
          ?>
          </div>
        </div>
      </section>
    </div>
    @if ( count($testimonials->get()) > 0 )
    <div class="container-fluid footerTestimonialFull">
      <section class="container text-center">
        <h2>TESTIMONIALS</h2>
        <div class="row">
        <?php $i = 1?>
        @foreach( $testimonials->take(6)->get() as $testimonial )
          <div class="col-lg-6 col-sm-6">
            @if ( ! empty($testimonial->image) )
            <figure class="imgClient"><img src="{{ '/public/uploads/' . $testimonial->image }}" alt="" class="img-circle" width="60" height="60" /></figure>
            @endif
            <div class="testimonial">
              {{ $testimonial->description }}
              <div class="clientName">- {{ $testimonial->title }}</div>
            </div>
          </div>
          @if ( $i % 2 == 0 )
          <div class="clearfix"></div>
          @endif
          <?php $i++ ?>
        @endforeach
        </div>
      </section>
    </div>
    @endif
@stop