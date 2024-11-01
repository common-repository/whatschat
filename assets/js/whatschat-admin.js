(function ($) {

  $('#wachat-custom-chat-enabled').change(function(){
    if (this.checked) {
      $('#wachat-upload-chat-button').show();
    } else {
      $('#wachat-upload-chat-button').hide();
      $('#wachat-chat-buttom-preview').attr('src', '');
      $('#wachat-chat-button-field').val('');
    }
  });

  var chat_button_frame  = wp.media({
    title   : 'Select or Upload a Custom Chat Button',
    button  : {
      text  : 'Use this image'
    },
    multiple : false
  });

  $('#wachat-upload-chat-button').on('click', function(e){
    e.preventDefault();
    chat_button_frame.open();
  });

  chat_button_frame.on ('select', function(){
    var attachment = chat_button_frame.state().get('selection').first().toJSON();
    $('#wachat-chat-buttom-preview').attr('src', attachment.url);
    $('#wachat-chat-button-field').val(attachment.url);
  });

}(jQuery));
