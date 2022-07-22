$(document).ready(function () {
      $(document).on("submit", ".gantipassword", function (e) {
		e.preventDefault();
		let formgrouping = $(".gantipassword").serialize();
		$.ajax({
			type: "POST",
			url: hostname + "homeproses/gantipassword",
			data: formgrouping,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (response) {
				if (response.sukses) {
					Swal.fire({
						text: response.sukses,
						icon: "success",
						showCancelButton: false,
						confirmButton: false,
						timer: 2000,
					}).then(function(){
            $("#gantipassword").modal("hide");
            $(".tableuser").DataTable().ajax.reload(null, false);
          })
				} else if (response.gagal) {
					Swal.fire({
						text: response.gagal,
						icon: "info",
						showCancelButton: false,
						confirmButton: true,
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
  $(document).on('click','.btnreset',function(e){
    e.preventDefault();
    const a = $(this).data('nikaryawan')
    Swal.fire({
      title: 'Reset Password.?',
      text: 'Apakah Kamu ingin mereset Password Ke Default..?',
      showCancelButton: true,
      confirmButtonText: 'Yess..',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: hostname + "homeproses/resetpassword",
          data: {nikaryawan:a},
          cache: false,
          async: true,
          dataType: "json",
          success: function (response) {
            if (response.sukses) {
              Swal.fire({
                text: "Berhasil Di Reset",
                icon: "success",
                showCancelButton: false,
                confirmButton: true,
              }).then(function(){
                Swal.close()
                $(".tableuser").DataTable().ajax.reload(null, false);
              })
            }else if(response.gagal){
              Swal.fire({
                text:response.gagal,
                icon: "error",
                showCancelButton: false,
                confirmButton: true,
              }).then(function(){
                Swal.close()
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
      } 
    })
  });
  $('.btnlogout').click(function (e) { 
    e.preventDefault();
    Swal.fire({
      text: 'Apakah kamu ingin meninggalkan halaman ini..?',
      showCancelButton: true,
      confirmButtonText: 'Yess..',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
       location.href=hostname+'logout'
      } 
    })
  });
  $('[data-bs-toggle="tooltip"]').tooltip();
	$('[data-bs-toggle="popover"]').popover();
  $('.visitor').select2({
    placeholder: "Choose"
  });
  $(".clock").datetimepicker({
		lang: "en",
		timepicker: false,
		format: "Y-m-d",
		formatDate: "Y-m-d",
		scrollMonth: false,
	});
  $('.btn-close').click(function (e) { 
    e.preventDefault();
    $(".modal").remove();
		$(".modal-backdrop").remove();
		$("body").removeClass("modal-open");
  });
});