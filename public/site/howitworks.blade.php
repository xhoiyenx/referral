@extends('layouts.master')
@section('content')
    <div class="container-fluid topBanner">
      <section class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bannerHIW">
            <h1 class="text-uppercase pull-right">
              <div>How</div>
              It <span class="red">Works?</span>
            </h1>
          </div>
        </div>
      </section>
    </div>
    <div class="container-fluid contentSection">
      <section class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center howitworksSteps">
            {{ settings('howitworks') }}
            <?php /*
            <ul class="row">
              <li class="step1 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="step1Area text-left">
                  <div class="step1Icon"><img src="/public/site/assets/images/icoStep1.png" alt="" /></div>
                  <div class="step1Number">1</div>
                  <div class="step1Txt"><span>Register referral account</span> with us. <br/><a href="/register" title="">Click Here</a></div>
                </div>
              </li>
              <li class="step2 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="step2Area text-right">
                  <div class="step2Icon"><img src="/public/site/assets/images/icoStep2.png" alt="" /></div>
                  <div class="step2Number">2</div>
                  <div class="step2Txt">Once registered,<br/>
                    you can <span class="purple">enter your lead to us</span><br/>
                    You will be assigned <strong>sales person</strong> for this
                  </div>
                </div>
              </li>
              <li class="step3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="step3Area text-center row">
                  <div class="step3Number">3</div>
                  <div class="step3Txt"> 
                    Ask your <span>prospect lead</span> (business partner/friend/family)<br/>
                    if they need one of <strong>OUR SOLUTIONS</strong> :
                  </div>
                  <div class="step3steps">
                    <div>
                      <figure><img src="/public/site/assets/images/icoPOS.png" alt="" /></figure>
                      POS System
                    </div>
                    <div>
                      <figure><img src="/public/site/assets/images/icoCalendar.png" alt="" /></figure>
                      Appointment &amp; <br/>Booking System
                    </div>
                    <div>
                      <figure><img src="/public/site/assets/images/icoCart.png" alt="" /></figure>
                      E-Commerce
                    </div>
                    <div>
                      <figure><img src="/public/site/assets/images/icoWWW.png" alt="" /></figure>
                      Corporate Website <br/>(Fully CMS)
                    </div>
                  </div>
                  <div class="step3more">And <strong>more</strong> to come!</div>
                </div>
              </li>
              <li class="step4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="step4Area text-left">
                  <div class="step4Icon"><img src="/public/site/assets/images/icoStep4.png" alt="" /></div>
                  <div class="step4Number">4</div>
                  <div class="step4Txt"><span>YOU CAN HELP TO PUSH THE DEAL CLOSE</span><br/>&nbsp;</div>
                </div>
              </li>
              <li class="step5 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="step5Area text-right">
                  <div class="step5Icon"><img src="/public/site/assets/images/icoStep5.png" alt="" /></div>
                  <div class="step5Number">5</div>
                  <div class="step5Txt"><br/><br/><span>DEAL IS CLOSED (SIGNED)</span></div>
                </div>
              </li>
              <li class="step6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="step6Area text-left">
                  <div class="step6Icon"><img src="/public/site/assets/images/icoStep6.png" alt="" /></div>
                  <div class="step6Number">6</div>
                  <div class="step6Txt"><span>PROJECT IS COMPLETED / DELIVERED</span><br/> &nbsp;</div>
                </div>
              </li>
              <li class="step7 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="step7Area text-right">
                  <div class="step7Icon"><img src="/public/site/assets/images/icoStep7.png" alt="" /></div>
                  <div class="step7Number">7</div>
                  <div class="step7Txt"><br/><span>FULL PAYMENT IS RECEIVED FROM CLIENT</span></div>
                </div>
              </li>
              <li class="step8 col-lg-10 col-md-10 col-sm-10 col-xs-12 col-sm-offset-1">
                <div class="step8Area text-center">
                  <div class="step8Number">8</div>
                  <div class="step8Icon"><img src="/public/site/assets/images/icoStep8.png" alt="" /></div>
                  <div class="step8Txt">
                    <div class="step8Title"><span>FINALY !</span> Your <span>referral fee</span> is <span>cash out to yoU !</span></div>
                    Our Referral fee range from S$300 - S$800, depending on the solutions.<br/>
                    You will need to Register to find out more detailon each solutions. It's free, no payment required.
                    <p>&nbsp;</p>
                  </div>
                </div>
              </li>
            </ul>
            */ ?>
          </div>
        </div>
      </section>
    </div>
    @include('layouts.testimonials')
@stop