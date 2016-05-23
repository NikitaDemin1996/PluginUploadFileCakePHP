/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var percentMax = 80;

var passingWidth;
var passingDuration;
var passingPercent;

var currentPercentage = 0;

var easing = "linear"; //easeOutBounce

function progress(percent, duration) {
    if (percent > percentMax) {
        if (currentPercentage >= percentMax)
        {
            passingDuration = duration;
            duration = 0;
        }
        else 
            passingDuration = duration * (percent - percentMax) / 100;
        passingPercent = percent ;
        var progressBar1Width = percentMax * $('#progressBar1').width() / percentMax;
        var progressBar2Width = (percent - percentMax) * $('#progressBar2').width() / (100 - percentMax);
        passingWidth = progressBar2Width;
        $('#progressBar1').find('div').animate({
            width: progressBar1Width
        }, duration * percentMax / 100, easing, function () {
            callback2();
        }).html(percentMax + "%&nbsp;");
    } else {
        var progressBar1Width = percent * $('#progressBar1').width() / percentMax;
        var progressBar2Width = 0 * $('#progressBar2').width() / (100 - percentMax);

        $('#progressBar1').find('div').animate({
            width: progressBar1Width
        }, duration, easing, function () {
            // nocallback cause no reverse progress implemented
        }).html(percent + "%&nbsp;");
    }
}

function callback1() {
    $('#progressBar1').find('div').animate({
        width: passingWidth
    }, passingDuration, easing).html(passingPercent + "%&nbsp;");
}

// for reverse implementation
function callback2() {
    $('#progressBar2').find('div').animate({
        width: passingWidth
    }, passingDuration, easing).html(passingPercent + "%&nbsp;");
}


setInterval(function () {
    if (currentPercentage < 100) {
        currentPercentage = currentPercentage + 10;
        progress(currentPercentage, 500);
    }
}, 1000);
