$(document).ready(function() {
  // Initially set About Me as active
  $('#about-me').click();

  // When About Me is clicked
  $('#about-me').click(function(e) {
    e.preventDefault();

    // Make About Me active and Edit inactive
    $(this).addClass('active');
    $('a:contains("Edit")').removeClass('active');

    // Ensure .display-control is hidden
    $('.display-control').slideUp('fast');
  });

  // When Edit is clicked
  $('a:contains("Edit")').click(function(e) {
    e.preventDefault();

    // Make Edit active and About Me inactive
    $(this).addClass('active');
    $('#about-me').removeClass('active');
    
    // Slide down the .display-control to show it
    $('.display-control').slideDown('fast');
  });

  // Toggle visibility based on checkbox state
  $('input[type="checkbox"]').change(function() {
    var targetSelector = $(this).data('target'); // Get the selector from data-target attribute
    if ($(this).is(':checked')) {
      $(targetSelector).slideDown('fast'); // Show the container
    } else {
      $(targetSelector).slideUp('fast'); // Hide the container
    }
  });
});