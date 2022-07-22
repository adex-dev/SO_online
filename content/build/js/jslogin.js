$(document).ready(function () {
  $('.formlogin').submit(function (e) { 
    e.preventDefault();
    let formdata = $('.formlogin').serialize()
    $.ajax({
			type: "POST",
			url: hostname + "Auth/loginproses",
			data: formdata,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (response) {
				if (response.sukses) {
          $(".modallogin").modal("show");
				} else if (response.gagal) {
					Swal.fire({
						text: response.gagal,
						icon: "info",
						showCancelButton: false,
						confirmButton: true,
					}).then(function () {
            $('input[name=niklogin]').val("");
            $('input[name=passwordlogin]').val("");
					});
				}
			},
			error: function (jqXHR, error, errorThrown) {
				if (jqXHR.status && jqXHR.status == 500) {
					Swal.fire({
						text: "Mohon Maaf Server Sedang Down.",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					});
				} else {
					Swal.fire({
						text: "Terjadi konflik data.",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					});
				}
			},
		});
  });
  $('.btnlogintanggal').click(function (e) { 
    e.preventDefault();
    var tanggallogin = $('input[name=tanggallogin]').val()
    $.ajax({
      type: "POST",
      url: hostname+"auth/ambiltanggal",
      data: {tanggallogin:tanggallogin},
      dataType: "json",
      success: function (response) {
       if (response.sukses) {
        location.href = response.audit;
       }
      }
    });
  });
  
});