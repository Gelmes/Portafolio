
var xmlhttp = new XMLHttpRequest();
var url = "https://maps.googleapis.com/maps/api/geocode/json?address=Hemet&key=AIzaSyCbHmmyKh6dpGSAS9lb5HoLAqbau6fI-s0";

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
        parseData(myArr);
    }
};

xmlhttp.open("GET", url, true);
xmlhttp.send();
