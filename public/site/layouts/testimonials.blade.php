  @if ( count($testimonials->get()) > 0 )
    <div class="container-fluid footerTestimonial">
      <section class="container">
        <div class="row">
          <div class="flexslider">
            <ul class="slides">
            @foreach( $testimonials->get() as $testimonial )
              <li>
                @if ( ! empty($testimonial->image) )
                <figure class="imgClient"><img src="{{ '/public/uploads/' . $testimonial->image }}" alt="" class="img-circle" width="60" height="60" /></figure>
                @endif
                <div class="testimonial">
                  {{ $testimonial->description }}
                  <div class="clientName">- {{ $testimonial->title }}</div>
                </div>
              </li>
            @endforeach
            </ul>
          </div>
        </div>
      </section>
    </div>
  @endif