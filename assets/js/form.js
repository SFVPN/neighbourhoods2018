function saveSettings() {
    localStorage.exists = $('#acf-field_5b7a84759428f-field_5b7a870087e0e').val();
}

var submit = document.getElementById('survey_submit');

document.getElementById("survey").onkeypress = function(e) {

    var key = e.charCode || e.keyCode || 0;
    if (key == 13) {
      e.preventDefault();
      //console.log('This will not work');

  }
}

$(function() {
    $("form").rememberState({
      objName: "survey_ocn",
      noticeDialog: $("<p id='restore' class='' />").html("<a class='btn grey darken-2 white-text' href='#'><i class='material-icons left'>autorenew</i>Restore saved data</a>"),
      noticeConfirmSelector: "a:first",
      noticeCancelSelector: "a:last"
    }).submit(false).on("click", "p.remember_state a", function() {
      $("input[type=range]").change();
    });

    $("input[type=range]").change(function() {
      $(this).closest("dd").find("span").text($(this).val());
    }).change();
  });

  $(document).ready(function() {
    //  $(window).unload(saveSettings);
      var saved = localStorage.getItem("survey_saved");
      if(saved === "yes") {

       localStorage.removeItem('survey_cleared');
      }
  });

  $( "#clear" ).click(function() {
    localStorage.removeItem('survey_saved');
    localStorage.setItem('survey_cleared', 'yes');

    //$("#restore").css("display", "none");
  });

  $( "#save" ).click(function() {
    localStorage.setItem('survey_saved', 'yes');

    //$("#restore").css("display", "block");
  });
