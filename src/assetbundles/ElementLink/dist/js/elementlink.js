$(function () { // for namespacing if nothing else...
  var g_lastRequest = null;

  // called every second to look for new elements to add the cp link to
  var addLinks = function() {
    // find the elements not yet tagged w/ class .elementLink
    var $elements = $('.field .input .element:not(.elementLink)');

    $elements.each(function() {
      var $thisElement = $(this);
      var $label = $thisElement.find('.label');
      $thisElement.addClass('elementLink');
      // phone home to get the cpEditUrl for the element
      g_lastRequest = Craft.postActionRequest(
        'element-link/default/element-edit-url',
        {
          elementType: $thisElement.data('type'),
          elementId: $thisElement.data('id'),
          siteId: $thisElement.data('site-id')
        },
        function(response, textStatus) {
          if (textStatus == 'success' && response && response['editUrl']) {
            // add the link to the dom
            $thisElement.addClass('elementLinkYes');
            var $a = $('<a>', {
              class: 'elementLink',
              target: '_blank',
              href: response['editUrl']
            });
            $a.insertBefore($label);
          }
        }
      );
    });
  };

  addLinks();
  window.setInterval(addLinks, 1000);
});