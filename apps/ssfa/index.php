<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Homepage</title>
    <link
      rel="stylesheet"
      href="https://code.s3.yandex.net/web-code/normalize.css"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
   <header class="header root__item">
      <nav class="nav">
        <div class="header__logo-container">
          <img class="header__logo" src="images/ttfa-logo.png" alt="Logo" />
        </div>
        <ul class="nav__links">
          <li>Home</li>
          <li>Matches</li>
          <li>Tables</li>
          <li>Teams</li>
          <li>Shop</li>
        </ul>
        <ul class="nav__icon-list">
          <li><img class="nav__icons" src="https://cdn-icons-png.flaticon.com/128/149/149852.png" alt="Search" /></li>
          <li><img class="nav__icons" src="https://cdn-icons-png.flaticon.com/128/1077/1077063.png" alt="Profile" /></li>
          <li><img class="nav__icons" src="https://cdn-icons-png.flaticon.com/128/5259/5259008.png" alt="Menu" /></li>
        </ul>
        <!-- Hamburger Icon -->
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
    </header>
    <div class="root">
      
      <main class="main root__item">
        <img class="main__image" src="images/sadio-mane.png" />
      </main>
      <aside class="social root__item">
        <img class="social__icon" src="https://cdn-icons-png.flaticon.com/128/20/20837.png" alt="Facebook" />
        <img class="social__icon" src="https://cdn-icons-png.flaticon.com/128/1384/1384031.png" alt="Instagram" />
        <img class="social__icon" src="https://cdn-icons-png.flaticon.com/128/733/733635.png" alt="Twitter" />
        <img class="social__icon" src="https://cdn-icons-png.flaticon.com/128/1384/1384086.png" alt="Youtube" />
        <div class="social__line"></div>
        <span class="social__follow" >Follow</span>
      </aside>
      <aside class="sidebar-top root__item">
        ---
      </aside>
     <aside class="sidebar-middle root__item">
  <h1 class="player__name">Owen Adebayo</h1>
  <p class="player__position">Trinindad & Tobago Forward</p>
  <p class="player__highlight">
    This player has scored 11 goals in 19 matches so far in the Concacaf League
    2022/2023 season. 6 of the 11 goals were scored at home while he scored 5
    goals at away games.
  </p>
  <p class="player__highlight">
    Overall, his goals scored per 90 minutes is 0.6. Moreover,his total
    goal-contribution (goals + assists) is 12. His goal involvement equates to
    0.66 per 90 minutes.
  </p>
  <p class="player__highlight">
    His Non-Penalty xG per 90 minutes is 0.25. This puts his npxG output at 4.59
    which puts him in the top 89 percentile of Concacaf League players.
  </p>
</aside>

<aside class="sidebar-bottom root__item">
  <div class="player__arrows">
    <span
      ><img
        class="player__left-arrow"
        src="images/right-arrow.png"
        alt="left"
    /></span>
    <span
      ><img
        class="player__right-arrow"
        src="images/right-arrow.png"
        alt="right"
    /></span>
    
  </div>
</aside>

      <article class="widget root__item widget_red widget_position_top">
        <div class="card">
          <h4 class="title">Next Match</h4>
          <p class="league__title">CONCACAF LEAGUE</p>
          <p class="league__date">2023 / 05 / 23</p>
          <div class="league__match">
          <img class="league__team" src="images/team1.png" alt="" />
          <span class="league__vs">VS</span>
          <img class="league__team" src="images/team2.png" alt="" />
          </div>
        </div>
      </article>
      <article class="widget root__item widget_red widget_position_middle">
        <div class="card">
          <h4 class="title">INFO</h4>
          <ul class="info">
          <li class="info__item"><span>● Nationality</span><span class="info__details">Trinidadian</span></li>
          <li class="info__item"><span class="info__title">● Position</span><span class="info__details">Forward</span></li>
          <li class="info__item"><span class="info__title">● Height</span><span class="info__details">1.71 m</span></li>
          <li class="info__item"><span class="info__title">● Weight</span><span class="info__details">65 kg</span></li>
          <li class="info__item"><span class="info__title">● Current Team</span><span class="info__details">Eagles</span></li>
          <li class="info__item"><span class="info__title">● Birthday</span><span class="info__details">Sept 28, 2000</span></li>
          <li class="info__item"><span class="info__title">● Age</span><span class="info__details">23</span></li>
          </ul>
        </div>
      </article>
      <article class="widget root__item widget_red widget_position_bottom">
        <div class="card">
          <h4 class="title">LEAGUE STATS</h4>
          <ul class="stats">
          <li class="stats__item"><img class="stats__icon" src="https://cdn-icons-png.flaticon.com/128/1071/1071234.png" alt="" /><span class="stats__category">Appearances</span><span class="stats__number">20</span></li>
          <li class="stats__item"><img class="stats__icon" src="https://cdn-icons-png.flaticon.com/128/7458/7458846.png" alt="https://cdn-icons-png.flaticon.com/128/1071/1071234.png" /><span class="stats__category">Goals</span><span class="stats__number">19</span></li>
          <li class="stats__item"><img class="stats__icon" src="https://cdn-icons-png.flaticon.com/128/4050/4050240.png" alt="" /><span class="stats__category">Assists</span><span class="stats__number">82</span></li>
          </ul>
        </div>
      </article>
     
    </div>
     <footer class="footer root__item">
        <h2 class="title">Secondary School Football Association</h2>
      </footer>
      
      
      <script>
$(document).ready(function() {
  // Hide all player__highlight elements except the first one
  $('.player__highlight:not(:first)').hide();
  var counter = $('<span class="player__counter">1 / ' + total + '</span>');
  // Append the counter to the root__item element
  $('.player__arrows').append(counter);
  
  // Initialize counter
  var total = $('.player__highlight').length;
  var current = 1;
  $('.player__counter').text(current + '/' + total);

  // When the right arrow is clicked
  $('.player__right-arrow').click(function() {
    // Get the current highlighted element
    var currentEl = $('.player__highlight:visible');
    // Get the next element with the class name 'player__highlight'
    var nextEl = currentEl.next('.player__highlight');
    // If there is no next element, go back to the first one
    if (nextEl.length === 0) {
      nextEl = $('.player__highlight:first');
    }
    // Hide the current element and show the next one
    currentEl.hide();
    nextEl.fadeIn(500);
    // Update the counter
    current++;
    if (current > total) {
      current = 1;
    }
    $('.player__counter').text(current + '/' + total);
  });
  
  // When the left arrow is clicked
  $('.player__left-arrow').click(function() {
    // Get the current highlighted element
    var currentEl = $('.player__highlight:visible');
    // Get the previous element with the class name 'player__highlight'
    var prevEl = currentEl.prev('.player__highlight');
    // If there is no previous element, go back to the last one
    if (prevEl.length === 0) {
      prevEl = $('.player__highlight:last');
    }
    // Hide the current element and show the previous one
    currentEl.hide();
    prevEl.fadeIn(500);
    // Update the counter
    current--;
    if (current < 1) {
      current = total;
    }
    $('.player__counter').text(current + '/' + total);
  });
});
$(document).ready(function () {
  $('.hamburger').click(function () {
    $('.nav__links').toggleClass('nav__links--active');
  });
});
      </script>
  </body>
</html>