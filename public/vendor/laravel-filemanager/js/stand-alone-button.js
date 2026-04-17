(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var target_input = $('#' + $(this).data('input'));
      var target_preview = $('#' + $(this).data('preview'));
      var multiple = options && options.multiple ? options.multiple : false;
      var base_url = window.location.origin;
      var input_value = target_input.val().split(',');
      window.open(route_prefix + '?type=' + type + (multiple ? '&multiple=true' : ''), 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          var url = item.url;
          if (base_url) {
              url = url.replace(new RegExp(`^${base_url}`), '');
          }
          if (input_value.includes(url)) {
              return null; // Skip duplicates
          }
          return url;
        }).filter(Boolean);

        if(multiple == true){
          if(input_value[input_value.length-1] !== ''){
            var merged_values = Array.from(new Set([...input_value, ...file_path])).join(',');
          }else{
            var merged_values = file_path.join(',');
          }
        }else{
          var merged_values = file_path.join(',');
        }
        

        // set the value of the desired input to image url
        target_input.val('').val(merged_values).trigger('change');

        // clear previous preview
        target_preview.html('');

        if(multiple === true){
          var items = merged_values.split(',');
          items.forEach(function (item) {
            if(item.thumb_url === undefined){
              var image_url = item;
            }else{
              var image_url = item.thumb_url;
            }
            var html = `
              <div class="image-item">
                <img src="${image_url}" />
                <button class="remove-btn file-remove" data-url="${image_url.replace(new RegExp(`^${base_url}`), '')}">✖</button>
              </div>
            `;
            target_preview.append(
              html
            );
          });
        }else{
          // set or change the preview image src
          items.forEach(function (item) {
            target_preview.append(
              $('<img>').css('height', '5rem').attr('src', item.thumb_url)
            );
          });
        }

        // trigger change event
        target_preview.trigger('change');
      };
      return false;
    });
  }

})(jQuery);
