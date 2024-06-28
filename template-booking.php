<?php
/*
Template Name: Booking Page
*/
get_header();
?>
 <div id="content" class="content" data-template="booking">
    <div class="booking" data-background="#edeee9" data-color="#111">
     <div class="booking__wrapper">
	
	 <div class="booking__intro">
       <span class="booking__intro--title" data-animation="translate" data-animation-direction="left" data-animation-target="span:last-child">BOOKING®</span>
       <span class="booking__intro--title" data-animation="translate" data-animation-direction="right">Unlock your way </span>
    </div>

	<div class="booking__description">
       <p class="booking__description__text">
	    A one-stop platform offering seamless 
		booking experiences across 
		a wide range of services with 
		exclusive deals and real-time availability.
       </p>
       <div class="booking__description__explore">
        	<span>Explore</span>
			<div class="circle-wrapper">
        	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" focusable="false" color="rgb(255, 255, 255)" style="width: 24px; height: 24px; fill: currentColor; flex-shrink: 0;">
            	<g color="rgb(255, 255, 255)">
                	<path d="M204.24,148.24l-72,72a6,6,0,0,1-8.48,0l-72-72a6,6,0,0,1,8.48-8.48L122,201.51V40a6,6,0,0,1,12,0V201.51l61.76-61.75a6,6,0,0,1,8.48,8.48Z"></path>
            	</g>
        	</svg>
			</div>
    	</div>
	</div>

	<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search products…', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" />
    <input type="hidden" name="post_type" value="product" />
</form>

	<!-- <form class="booking__search" role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <div>
        <label class="booking__search--label" for="destination">Destination:</label>
        <input class="booking__search--text" type="text" value="" name="destination" id="destination" />

        <label  for="arrival-date">Arrival Date:</label>
        <input type="date" value="" name="arrival-date" id="arrival-date" />

        <label for="departure-date">Departure Date:</label>
        <input type="date" value="" name="departure-date" id="departure-date" />

        <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form> -->

	 <div class="booking__slider">
			<div class="frame">
				<nav class="frame__nav">
					<button class="frame__nav-button unbutton">Olive Grove Retreat </button>
					<button class="frame__nav-button unbutton">Sea Breeze Villas</button>
					<button class="frame__nav-button unbutton">Sunset Siesta Residences</button>
					<button class="frame__nav-button unbutton">Cypress Coast Apartments</button>
					<button class="frame__nav-button unbutton">Les Jardins de la Tour </button>
				</nav>
				<button class="frame__back unbutton">
					<span data-splitting>&larr; Go back</span>
				</button>

				<span class="frame__info">&darr; Drag to discover more &darr;</span>
			</div>
			<div class="slides">

				<div class="slide" data-animation="translate">
					<div class="slide__inner">
						<div class="slide__img"><div class="slide__img-inner" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking.jpeg'); ?>')"></div></div>
						<div class="slide__content">
							<div class="slide__content-img" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/mlnk7.jpeg'); ?>')"></div>
							<h2>Olive Grove Retreat </h2>
							<p>Nestled amidst the lush, verdant olive groves that epitomize the Mediterranean's rustic charm, 
								Olive Grove Retreat is a sanctuary of peace and natural beauty. Each apartment here offers a s
								eamless blend of traditional architecture and modern comforts, 
								inviting guests to relax in a setting that whispers the ancient stories of the land. 
							</p>
						</div>
					</div>
				</div>

				<div class="slide">
					<div class="slide__inner">
						<div class="slide__content">
							<div class="slide__content-img" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking3.jpeg'); ?>')"></div>
							<h2>Sea Breeze Villas</h2>
							<p>At Sea Breeze Villas, every moment is infused with the revitalizing scent of the Mediterranean breeze. Strategically positioned to capture the essence of coastal living, 
								these villas are a haven for those seeking to immerse themselves in the vibrant energy of the sea. 
							</p>
						</div>
						<div class="slide__img"><div class="slide__img-inner" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking3.jpeg'); ?>')"></div></div>
					</div>
				</div>
				<div class="slide">
					<div class="slide__inner">
						<div class="slide__content">
							<div class="slide__content-img" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking4.jpeg'); ?>')"></div>
							<h2>Sunset Siesta Residences</h2>
							<p>Sunset Siesta Residences offer an unparalleled opportunity to experience the mesmerizing sunsets that paint the Mediterranean skies. With their west-facing balconies, 
								these residences are perfectly positioned for guests to unwind in the glow of the evening light. 
							</p>
						</div>
						<div class="slide__img"><div class="slide__img-inner" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking4.jpeg'); ?>')"></div></div>
					</div>
				</div>
				<div class="slide">
					<div class="slide__inner">
						<div class="slide__content">
							<div class="slide__content-img" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking5.jpeg'); ?>')"></div>
							<h2>Cypress Coast Apartments</h2>
							<p>Cypress Coast Apartments celebrate the iconic beauty of the Mediterranean landscape, where the silhouettes of cypress trees stand tall against the coastal backdrop. These apartments offer a unique blend of natural and architectural beauty, 
								with design elements inspired by the rugged coastline and the elegance of the cypress. 
							</p>
						</div>
						<div class="slide__img"><div class="slide__img-inner" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking5.jpeg'); ?>')"></div></div>
					</div>
				</div>
				<div class="slide">
					<div class="slide__inner">
						<div class="slide__content">
							<div class="slide__content-img" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking2.jpeg'); ?>')"></div>
							<h2>Les Jardins de la Tour </h2>
							<p>Les Jardins de la Tour embodies the romance and allure of Parisian life, situated just a stone's throw from the iconic Eiffel Tower. Each apartment is a testament to French elegance and art de vivre, 
								offering views that stretch to the iron lattice of the Tower itself.
							</p>
						</div>
						<div class="slide__img"><div class="slide__img-inner" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/images/booking2.jpeg'); ?>')"></div></div>
					</div>
				</div>
			</div>
   </div>

   <h2 class="booking__content--title" data-animation="heading">Top Destinations <br> at Great Prices</h2>

	<section class="booking__about">
       <div class="booking__about__label">
          <p>This Month's Top Picks</p>
        </div>
        <div class="booking__about__content">
	      <p class="booking__about__text">
		  From tranquil villages to undiscovered beaches, 
		  our curated selections bring you closer to the heart of each destination. 
		  Experience travel that’s not just about places, 
		  but about the stories, cultures, and connections that make your journey unforgettable.
          </p>
        </div>
    </section>

<div class="booking__content" data-animation="marquee">
       <span class="booking__content--title"> Hidden Gems - </span>
       <span class="booking__content--title"> Hidden Gems</span>
    </div>
	<h2 class="booking__content--title" data-animation="heading"><br>Discover Unique Experiences<br> Off the Beaten Path</h2>
	<section class="booking__featured">
    <div class="booking__featured__apartments">
        <figure class="booking__featured__apartment">
            <img data-src="<?php echo esc_url(get_template_directory_uri() . '/images/booking.jpeg'); ?>" alt="Featured Apartment 1" class="booking__featured__image">
            <figcaption>
                <p class="booking__featured__location">Country, City, Address</p>
                <p class="booking__featured__price">Price</p>
            </figcaption>
        </figure>
     
        <figure class="booking__featured__apartment">
            <img data-src="<?php echo esc_url(get_template_directory_uri() . '/images/booking2.jpeg'); ?>" alt="Featured Apartment 2" class="booking__featured__image">
            <figcaption>
                <p class="booking__featured__location">Country, City, Address</p>
                <p class="booking__featured__price">Price</p>
            </figcaption>
        </figure>

		<figure class="booking__featured__apartment">
            <img data-src="<?php echo esc_url(get_template_directory_uri() . '/images/booking.jpeg'); ?>" alt="Featured Apartment 1" class="booking__featured__image">
            <figcaption>
                <p class="booking__featured__location">Country, City, Address</p>
                <p class="booking__featured__price">Price</p>
            </figcaption>
        </figure>
     
        <figure class="booking__featured__apartment" >
            <img data-src="<?php echo esc_url(get_template_directory_uri() . '/images/booking2.jpeg'); ?>" alt="Featured Apartment 2" class="booking__featured__image">
            <figcaption>
                <p class="booking__featured__location">Country, City, Address</p>
                <p class="booking__featured__price">Price</p>
            </figcaption>
        </figure>
    
    </div>
</section>

<section class="booking__about">
      <div class="booking__about__label">
        <p>How It Works </p>
      </div>

    <div class="booking__about__content">
     
	  <p class="booking__about__text" data-animation="title">
	    A one-stop platform offering seamless 
		booking experiences across 
		a wide range of services with 
		exclusive deals and real-time availability.
       </p>
    
    </div>
</section>

		</div>
    </div>

		<?php get_footer(); ?>

<!-- 
		<div class="slider__arrow__icon">


<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="fill: #000; width: 50px; height: 50px; transform: scaleX(-1);">
	<path d="M220.24,132.24l-72,72a6,6,0,0,1-8.48-8.48L201.51,134H40a6,6,0,0,1,0-12H201.51L139.76,60.24a6,6,0,0,1,8.48-8.48l72,72A6,6,0,0,1,220.24,132.24Z"></path>
</svg>
	
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="fill: #000; width: 50px; height: 50px;">
	<path d="M220.24,132.24l-72,72a6,6,0,0,1-8.48-8.48L201.51,134H40a6,6,0,0,1,0-12H201.51L139.76,60.24a6,6,0,0,1,8.48-8.48l72,72A6,6,0,0,1,220.24,132.24Z"></path>
</svg>
</div> -->




