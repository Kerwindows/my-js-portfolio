$(document).ready(function () {
    // Continuing from the previous example, assuming uid is already fetched
    $.ajax({
        url: `${base_url}/ajax/fetch_calendar_events`,
        type: 'GET',
        data: { uid: uid }, // Sending the uid as part of the request
        dataType: 'json',
        success: function(data) {
            $("#calendar-doctor").simpleCalendar({
                fixedStartDay: 0, // begin weeks by sunday
                disableEmptyDetails: true,
                events: data, // Use the fetched array of events
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred fetching the calendar events: ", error);
        }
    });
});