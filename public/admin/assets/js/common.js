<script type="text/javascript">
  $(document).ready(function() {
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
</script>

 <script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {  
        var type = input.files[0].type;
        if(type == 'image/jpeg' || type == 'image/png'){
            var reader = new FileReader();
   
            reader.onload = function (e) {
                $('#oldImg').attr('src', e.target.result);
            }
   
            reader.readAsDataURL(input.files[0]);
            $("#oldImg").addClass("profile_image")
            $('.test').hide();
            $('#imgInp-error').text('');
   
        } else {
            $('#imgInp').val("");
            $('#oldImg').attr('src',"{{url('public/admin/assets/img/user.png')}}");
            $("#oldImg").removeClass("profile_image")
            $('#imgInp-error').text('Only Jpeg and Png format allowed');
        }
    }
}
$("#imgInp").change(function(){
  readURL(this);
});

</script>