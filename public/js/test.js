jQuery(document).ready(function () {
      jQuery(document).on('click','#chart2_draw',function (e) {
         e.preventDefault();
         var chart2 = jQuery('#chart2');
         jQuery('#chart2_area').html('<img src="'+chart2.attr('action')+'?'+chart2.serialize()+'" alt="wykres" />');
      });
   }) ;