@extends('layouts.master')
@section('content')
    <div class="container-fluid topBanner">
      <section class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bannerContact">
            <h1 class="text-uppercase pull-right">Contact <span class="red">US</span></h1>
          </div>
        </div>
      </section>
    </div>
    <div class="container-fluid contentSection">
      <section class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8108099071037!2d103.83825271426548!3d1.2876415621320345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da1975c7538229%3A0x3309392787e83511!2sITConcept+Pte+Ltd!5e0!3m2!1sen!2sin!4v1448816028091" width="100%" height="320" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 addressBlock">
            <p><strong>ITCONCEPT PTE LTD</strong></p>
            <p>50 Chin Swee Rd, #09-04<br/>
              Thong Chai Building<br/>
              Singapore 169874
            </p>
            <p>Tel : +65 6850 5001<br/>
              Ext : 888#
            </p>
          </div>
        </div>
      </section>
    </div>
    @include('layouts.testimonials')
@stop