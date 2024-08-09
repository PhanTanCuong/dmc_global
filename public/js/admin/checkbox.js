function toggleCheckbox(box, url) {
  var id = $(box).attr("value");

  if ($(box).prop("checked") === true) {
    var visible = 1;
  } else {
    var visible = 0;
  }
  var data = {
    "search_data": 1,
    "id": id,
    "visible": visible
  };

  $.ajax({
    type: "post", //method
    url: url, //URL to your controller
    data: data,
    success: function (response) {
      // alert("Data Checked");
    },
    success: function (response) {
      console.log(response);
      alert('Visibility updated successfully.');
    },
    error: function () {
      alert('Failed to update visibility.');
    }
  });

}