jQuery.noConflict();
(function($) {

$(document).ready(function() {
 $('form#contactf').submit(function() {
  $('form#contactf .contactError').remove();
  var hasError = false;
  $('.requiredField').each(function() {
   if(jQuery.trim($(this).val()) == '') {
    var labelText = $(this).prev('label').text();
    $(this).parent().append('<span class="contactError">You forgot to enter your '+labelText+'.</span>');
    hasError = true;
   } else if($(this).hasClass('email')) {
    var emailReg = /^([w-.]+@([w-]+.)+[w-]{2,4})?$/;
    if(!emailReg.test(jQuery.trim($(this).val()))) {
     var labelText = $(this).prev('label').text();
     $(this).parent().append('<span class="contactError">You entered an invalid '+labelText+'.</span>');
     hasError = true;
    }
   }
  });
  if(!hasError) {
   $('form#contactf li.buttons button').fadeOut('normal', function() {
    $(this).parent().append('<img src="/wp-content/themes/td-v3/images/template/loading.gif" alt="Loading…" height="31" width="31" />');
   });
   var formInput = $(this).serialize();
   $.post($(this).attr('action'),formInput, function(data){
    $('form#contactf').slideUp("fast", function() {       
     $(this).before('<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent. I check my email all the time, so I should be in touch soon.</p>');
    });
   });
  }
  
  return false;
  
 });
});

})(jQuery);