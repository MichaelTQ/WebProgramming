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
    arr_li = document.getElementsByTagName("li");
    for (var j = 0; j != arr_li.length; j++)
    {
        arr_li[j].className = "";
    }
    document.getElementById(id).className = "selected";
    
    if (id == "tab1")
    {
        document.getElementById("cus_form").style.display = "inline-block";
        document.getElementById("owners_form").style.display = "none";
        var signup_all = document.getElementById("signup_all");
        signup_all.style.height = "300px";
        signup_all.style.width = "350px";
        signup_all.style.marginLeft = "-180px";
    }
    else if (id == "tab2")
    {
        document.getElementById("cus_form").style.display = "none";
        document.getElementById("owners_form").style.display = "inline-block";
        document.getElementById("signup_all").style.height = "350px";
        document.getElementById("signup_all").style.width = "450px";
        document.getElementById("signup_all").style.marginLeft = "-230px";
    }
};
