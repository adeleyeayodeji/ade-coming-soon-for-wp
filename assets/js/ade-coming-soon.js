/**
 * On Click ade_coming_soon_disable()
 */
function ade_coming_soon_disable(elem, e) {
  //prevent default form submit
  e.preventDefault();
  var data = {
    action: "ade_coming_soon_ajax",
    type: "disable",
    nonce: ade_coming_soon.nonce
  };
  jQuery.post(ade_coming_soon.ajax_url, data, function (response) {
    // alert("Got this from the server: " + response);
    location.reload();
  });
}

/**
 * On Click ade_coming_soon_enable()
 *
 *
 */
function ade_coming_soon_enable(elem, e) {
  //prevent default form submit
  e.preventDefault();
  var data = {
    action: "ade_coming_soon_ajax",
    type: "enable",
    nonce: ade_coming_soon.nonce
  };
  console.log(data);

  jQuery.ajax({
    type: "POST",
    url: ade_coming_soon.ajax_url,
    data,
    dataType: "json",
    success: function (response) {
      //   console.log(response);
      //   alert("Got this from the server: " + response);
      location.reload();
    }
  });
}

jQuery(function ($) {
  let initEachAdeButton = function () {
    $(".ade-post-coming-soon").each(function (index, element) {
      $(this).click(function (e) {
        e.preventDefault();
        //var button
        var button = $(this);
        //get type
        var type = $(this).data("type");
        //get post id
        var post_id = $(this).data("post-id");
        //ajax
        var data = {
          action: "ade_coming_soon_page_ajax",
          type,
          post_id,
          nonce: ade_coming_soon.nonce
        };

        jQuery.ajax({
          type: "POST",
          url: ade_coming_soon.ajax_url,
          data,
          dataType: "json",
          beforeSend: function () {
            // change text to loading...
            button.text("Updating...");
            //reduce opacity
            button.css("opacity", 0.5);
          },
          success: function (response) {
            //check response code is 200
            if (response.code == 200) {
              //change html of closest td
              button.closest("td").html(response.data);
              //trigger initEachAdeButton
              initEachAdeButton();
            } else {
              //change text to error
              button.text("Error");
              //change opacity
              button.css("opacity", 1);
            }
          },
          error: function (error) {
            //change text to error
            button.text("Error");
            //change opacity
            button.css("opacity", 1);
          }
        });
      });
    });
  };

  //trigger initEachAdeButton
  initEachAdeButton();
});
