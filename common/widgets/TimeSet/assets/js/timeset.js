function recountTime(name, daySet, hourSet, minuteSet) {
    var day, hour, minute;
    if(document.getElementById(daySet)!=null)
        day = parseInt(document.getElementById(daySet).value, 10);
    else
        day=0;
    hour = parseInt(document.getElementById(hourSet).value, 10);
    minute = parseInt(document.getElementById(minuteSet).value, 10);

    if (isNaN(day))
        day = 0;
    if (isNaN(hour))
        hour = 0;
    if (isNaN(minute))
        minute = 0;
    document.getElementById(name).value = day + ' ' + hour + ':' + minute;

}
