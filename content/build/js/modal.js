$(document).ready(function () {
  $(document).on("click", ".btnmodal", function (e) {
		var isimodal = $(this).data("popupmodal");
    var periode = $(this).data("tanggal");
    var kodestore = $(this).data("store");
    var uid = $(this).data("nikaryawan");
		$.ajax({
			url: hostname + "home/viewmodalweb",
			dataType: "json",
			data: {
				store: kodestore,
				isimodal: isimodal,
				periode: periode,
				uid: uid,
			},
			cache: false,
			async: true,
			success: function (response) {
				if (response.sukses) {
					$(".viewModal").html(response.sukses).show();
					if (isimodal == "tndatangan") {
            if (periode=='') {
              Swal.fire({
                text: "Mohon Untuk Melengkapi Tanggal Periode terlebih dahulu",
                icon: "info",
                showCancelButton: false,
                confirmButton: true,
              });
            }else{
              $("#tndatangan").modal("show");
            }
					} else if (isimodal == "buatuser") {
						$("#buatuser").modal("show");
					} else if (isimodal == "edituser") {
						$("#edituser").modal("show");
					} else if (isimodal == "uploadmanual") {
						$("#uploadmanual").modal("show");
					} else if (isimodal == "addarticle") {
						$("#addarticle").modal("show");
					} else if (isimodal == "gantipassword") {
						$("#gantipassword").modal("show");
					}
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
  $(document).on("click", ".btnmodal2", function (e) {
		var isimodal = $(this).data("popupmodal");
    var ean = $(this).data("ean");
    var kodestore = $(this).data("kodestore");
    var periode = $(this).data("periode");
    var onhand = $(this).data("onhand");
		$.ajax({
			url: hostname + "home/viewmodalweb",
			dataType: "json",
			data: {
				store: kodestore,
				isimodal: isimodal,
				ean: ean,
				periode: periode,
				onhand: onhand,
			},
			cache: false,
			async: true,
			success: function (response) {
				if (response.sukses) {
					$(".viewModal").html(response.sukses).show();
				  if (isimodal == "editmanual") {
						$("#editmanual").modal("show");
					}
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
});