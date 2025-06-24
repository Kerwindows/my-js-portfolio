$(document).ready(function () {
    $("#calendar-doctor").simpleCalendar({
        fixedStartDay: 0, // begin weeks by sunday
        disableEmptyDetails: true,
        events: calendarEventArray, // Use the new array of events populated from PHP
    });
});