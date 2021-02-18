(function($){

  $(document).ready(function(){
    $(document).on('change','.js-form-filter',function(e){
      e.preventDefault();
      var category = $(this).find('option:selected').val();
      console.log(category);  

      $.ajax({
        url: wpAjax.ajaxUrl,
        data: { action: 'filter', category: category },
        type: 'post',
        success: function(result){
          $('.js-filter main').html(result);

        },
        error: function(result){
          console.warn(result);
          console.log(" error");
        }
      })
    });

  });

})(jQuery);