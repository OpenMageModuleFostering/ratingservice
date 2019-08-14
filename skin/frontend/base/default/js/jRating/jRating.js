
jQuery(document).ready(function() {

    jQuery(".basic").jRating({
        step: true,
        length: 10,
        rateMax: 10,
        isDisabled: true

    });
    jQuery("#the_rating").jRating({
        step: true,
        length: 10, // nb of stars
        rateMax: 10,
        nbRates: 3,
        canRateAgain: true,
        phpPath: "/" + "companies/rate",
        onClick: function(element, rate) {

            jQuery("#ReviewRated").val("rated");
            jQuery("#ReviewRating").val(rate);

        }
    });
    jQuery("#rating_submit").click(function () {
      var email = jQuery('#ReviewEmail').val();
      var name = jQuery('#ReviewName').val();
      var rated = jQuery('#ReviewRated').val();

      //regulärt utryck för att validera e-postadressen
      var emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;

      var err_message = "";
      var validated = true;
      if (emailRegExp.test(email)) {

      } else {
          err_message += "Type your email";
          validated = false;
      }

      if (name === null || name === "") {
          err_message += "<br>Type your name";
          validated = false;
      }
      if (rated != "rated") {
          err_message += "<br>Select number of stars";
          validated = false;
      }


      var path = "/" + "companies/rate";
      document.getElementById("validate_rate").innerHTML = err_message;

      if (validated) {
          jQuery("#loading_rating").removeClass("no-display");
          jQuery.ajax({
              type: "POST",
              url: jQuery('#rating_url').val(),
              data: jQuery("#ReviewCompanyViewForm").serialize(), // serializes the form's elements.
              success: function(data) {
                jQuery("#loading_rating").addClass("no-display");
                var dataReturn =  jQuery.parseJSON(data);
                document.getElementById("success_rate").innerHTML = dataReturn.message;

              }
          });


      }

    });

});
