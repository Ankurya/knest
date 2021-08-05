// Image Preview

function readURL(input) {
    if (input.files && input.files[0]) {  
        var type = input.files[0].type;
        if(type == 'image/jpeg' || type == 'image/png'){
            var reader = new FileReader();
   
            reader.onload = function (e) {
                $('#oldImg').attr('src', e.target.result);
            }
   
            reader.readAsDataURL(input.files[0]);
            $('#msz').hide();
            $("#oldImg").addClass("profile_image")
            $('.test').hide();
   
        } else {
            $('#msz').show();
            $('#imgInp').val("");
            $("#oldImg").removeClass("profile_image")
            $('#msz').text('Only Jpeg and Png format allowed');
        }
    }
}
$("#imgInp").change(function(){
  readURL(this);
});


// Country Code 1 

$(document).ready(function() {
  alert()
  $('#country_code').hide();
   $("#phone_number").intlTelInput({
     initialCountry: "us",
     separateDialCode: true,
     nationalMode: false,
     formatOnDisplay: false,
     autoFormat: false,
     preferredCountries: ["fr", "us", "gb"],
     geoIpLookup: function (callback) {
         $.get('https://ipinfo.io', function () {
         }, "jsonp").always(function (resp) {
             var countryCode = (resp && resp.country) ? resp.country : "";
             callback(countryCode);
         });
     },
     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
     
   });
   
   $("#hiden").intlTelInput({
     initialCountry: "us",
     dropdownContainer: 'body',
     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
   });
   
      
   var country_code = $("#phone_number").intlTelInput();
   $("#phone_number").on("countrychange", function (e, countryData) {
     $("#phone_number").val('');
     var country_code = countryData['dialCode'];
     $('#country_code').val(country_code);
   });
   
   var number =  $('input[name="phone_number"]').val();
   var classf = $(".selected-flag > div").attr("class");
   var flag = classf.slice(-2);
   

   $('input.hide').parent().hide();

});


   function changeSelectColor(){
      if($("select.member option:selected").val() == ""){

         $("select.member").addClass("change-color")
      }else {

        $("select.member").removeClass("change-color")
      }
   }
   changeSelectColor();
   $("select.member").change(function(){
      changeSelectColor();
   });






function readUrl1(input){
    if (input.files && input.files[0]) {  
        let type = input.files[0].type;
        let name = input.files[0].name;
        console.log(name)
        if(type == 'application/pdf' || type == 'application/x-bzpdf' || type == 'application/x-pdf' || type == 'application/x-gzpdf'){
            var reader = new FileReader();
   
            reader.onload = function (e) {
                $('.pdf_upload').attr('title',name);
                $('.show_pdf_name').html(name);
                $('.pdf_upload-error').text('');
            }
            reader.readAsDataURL(input.files[0]);
   
        } else {
            $('#pdf_upload').val("");
            $('.pdf_view').hide();
            $('.show_pdf_name').html("");
            $('.pdf_upload-error').text('Please choose pdf format file only');
        }
    }
 }





 

