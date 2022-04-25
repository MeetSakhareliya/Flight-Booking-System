<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="header.css" />

  </head>

  <body>
    <div class="head">
      
      <?php 
        session_start();
        include_once('Header.php');
      ?>
      <p>Let the journey begin with us</p>
    </div>

    <div class="intro">
      <p class="heading">our services</p>
      <hr width="8%" size="3px" color="#ff7b59" align="center" />
      <p>
        Plan your perfect trip Search Flights and Book to our most popular
        destinations
      </p>
      <p></p>
    </div>

    <div class="cities">
      <div class="city">
        <img src="./images/london.webp" alt="London" />
        <div class="cityname">
          <span>London</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/newyork.webp" alt="New York" />
        <div class="cityname">
          <span>New York</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/delhi.webp" alt="New Delhi" />
        <div class="cityname">
          <span>Delhi</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/mumbai.webp" alt="Mumbai" />
        <div class="cityname">
          <span>Mumbai</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/sydney.webp" alt="Sydney" />
        <div class="cityname">
          <span>Sydney</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/toronto.webp" alt="Toronto" />
        <div class="cityname">
          <span>Toronto</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/sanfra.webp" alt="San Francisco" />
        <div class="cityname">
          <span>San Francisco</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/chicago.webp" alt="Chicago" />
        <div class="cityname">
          <span>Chicago</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
      <div class="city">
        <img src="./images/washington.webp" alt="Washington" />
        <div class="cityname">
          <span>Washington</span><br />
          <a href="flights.html">Flights</a>
        </div>
      </div>
    </div>

    <div class="footer">
      <div class="about">
        <h2>About Us</h2>
        <a href="/sign__up">How it works</a> <a href="/">Testimonials</a>
        <a href="/">Careers</a> <a href="/">Terms of Service</a>
      </div>
      <div class="contact">
        <h2>Contact Us</h2>
        <a href="/">Contact</a> <a href="/">Support</a>
        <a href="/">Destinations</a>
      </div>
      <div class="social">
        <h2>Social Media</h2>
        <a href="/">Instagram</a> <a href="/">Facebook</a>
        <a href="/">Youtube</a> <a href="/">Twitter</a>
      </div>
    </div>
  </body>
</html>
