var geocoder;
var map;
function initialize() {
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
      center: new google.maps.LatLng(-34.397, 150.644),
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    
    var arr_locations = [];
    $('.rest_address_list').each(function () {
            arr_locations.push($(this).text());
        });
    
    var rest_page_address = $('#rest_address_id').text();
    
if(arr_locations.length != 0)
{
    geocoder.geocode( { 'address': arr_locations[0]}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
        } else {
        }
      });
    for (var i = 0; i != arr_locations.length; i++)
    {
        geocoder.geocode({'address': arr_locations[i]}, function(results, status){
            if(status == google.maps.GeocoderStatus.OK) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            }
        });
    }
}
    
    if(rest_page_address != null)
    {
        geocoder.geocode( { 'address': rest_page_address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
        } else {
        }
      });
    }
    var menu_num = $('#my_menu_num').text();
    $('.rest_menu').load("./menus/menu"+menu_num+".html");

}
google.maps.event.addDomListener(window, 'load', initialize);

$(document).ready(function() {
    $("#content div").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div:first").fadeIn(); // Show first tab content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return       
        }
        else{             
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('name')).fadeIn(); // Show content for current tab
        }
        if(document.getElementById('order_content_table').innerHTML.indexOf('onclick="click_addlinks()">Here</a> ') != -1)
        {
            var menu_num = $('#my_menu_num').text();
            $('.rest_menu').load("./menus/menu"+menu_num+".html");
        }
        else
        {
            cancel_order();
            var menu_num = $('#my_menu_num').text();
            $('.rest_menu').load("./menus/menu"+menu_num+".html");
        }
    });
});

function click_addlinks(){
    var i = 0;
    $('.name').each(function (){
        i++;
        $(this).wrap('<a href = \'#!\' onclick = \'add_dish(this.id)\' id = \'dish_link_'+i.toString()+'\'></a>');
    });
    i = 0
    $('#order_content_table').html('Click any dish to start.');
    $('#order_table_id').css('display', 'table');
    $('.order_buttons').css('display', 'inline-block');
}

var global_total_price = 0;

function add_dish(id) {
    var order_content = $('#order_content_table');
    var order_content_html = $('#order_content_table').html();
    if (order_content_html.indexOf("Click any dish to start.") != -1)
    {
        order_content.html('');
    }
    var selected_dish = document.getElementById(id);
    var selected_dish_text = selected_dish.textContent;
    var selected_price_text = selected_dish.parentNode.getElementsByClassName('price')[0].textContent
    var selected_price = parseFloat(selected_price_text.replace('$', ''));
    $('#order_table_id tr:last').before('<tr><td>'+selected_dish_text+'</td><td>'+selected_price_text+'</td></tr>');
    global_total_price += selected_price;
    $('#order_table_id td:last').html('<strong>$'+global_total_price.toString()+'</strong>');
}

function cancel_order()
{
    var menu_num = $('#my_menu_num').text();
    $('.rest_menu').load("./menus/menu"+menu_num+".html");
    var default_order_content_html = "Click <a href = \"#!\" onclick = \"click_addlinks()\">Here</a> to start.<br><br>";
    $('#order_content_table').html(default_order_content_html);
    $('#order_table_id').css('display', 'none');
    var default_table_html = "<thead><tr><th>Dish Name</th><th>Price</th></tr></thead><tbody><tr><td><strong>Totol Price:</strong></td><td><strong>$</strong></td></tr></tbody>";
    $('#order_table_id').html(default_table_html);
    $('.order_buttons').css('display', 'none');
    global_total_price = 0;
}

$('.thumbnail').click(function() {
    var img_src = $(this).attr('src');
    $('#preview_picture').attr('src', img_src);
    $('#pic_preview').attr('style', 'display: inline-block;');
    $('#fade').attr('style', 'display: inline-block;');
    var myimg = document.getElementById('preview_picture');
    var theImg = new Image();
    theImg.src = $(myimg).attr("src");
    var img_width = theImg.width;
    var img_height = theImg.height;
    var half_width = img_width/2;
    var half_height = img_height/2;
    var width_string = '-'+half_width.toString()+'px';
    var height_string = '-'+half_height.toString()+'px';
    $('#pic_preview').css({"margin-left": width_string, "margin-top": height_string});
    $('#pic_preview').css({"-webkit-margin-before": "-200px", "-webkit-margin-start": "-270px"});
});

//states in the options...
var arr_states = ["AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY"];
var states_selet = document.getElementById("states_sel");
for (var i = 0; i != arr_states.length; i++)
{
    var tmp_option = document.createElement("option");
    tmp_option.text = arr_states[i];
    tmp_option.value = arr_states[i];
    states_selet.add(tmp_option, null);
}

//tab switch function
var tab_switch = function(id)
{
    var arr_li = [document.getElementById("signup_tab1"), document.getElementById("signup_tab2")];
    for (var j = 0; j != arr_li.length; j++)
    {
        arr_li[j].className = "";
    }
    document.getElementById(id).className = "selected";
    
    if (id == "signup_tab1")
    {
        document.getElementById("cus_form").style.display = "inline-block";
        document.getElementById("owners_form").style.display = "none";
        var signup_all = document.getElementById("signup_all");
        signup_all.style.height = "300px";
        signup_all.style.width = "350px";
        signup_all.style.marginLeft = "-180px";
    }
    else if (id == "signup_tab2")
    {
        document.getElementById("cus_form").style.display = "none";
        document.getElementById("owners_form").style.display = "inline-block";
        document.getElementById("signup_all").style.height = "350px";
        document.getElementById("signup_all").style.width = "450px";
        document.getElementById("signup_all").style.marginLeft = "-230px";
    }
};