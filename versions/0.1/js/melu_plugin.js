jQuery("#cb2").on("change", function(){
    jQuery("#deactivate_form").submit()
});

if(document.body.contains(document.getElementById("refresh"))){
    //alert("here");
    location.reload();
}
jQuery(".form-horizontal").attr("action", 'https://meluchat.com/login');