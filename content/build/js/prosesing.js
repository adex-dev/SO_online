$(document).ready(function () {
  	$(document).on("change", ".statuscheked", function (e) {
		var a = $(this).data("nikaryawan");
		var pesan = $(this).data("pesan");
		var status = "tidak_aktif";
		if (this.checked) {
			status = "aktif";
		}
    $.ajax({
      type: "POST",
      url: hostname + "homeproses/userstatus",
      data: {status:status,nikaryawan:a,pesan:pesan},
      cache: false,
      async: true,
      dataType: "json",
      success: function (response) {
        if (response.sukses) {
         $(".tableuser").DataTable().ajax.reload(null, false);
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
  $(document).on('keyup','input[name=scanartikel]',function(e){
    e.preventDefault()
    var a = $(this).val();
    if ($(this).val().length >= 13) {
     if (e.keyCode==13) {
      var scanaudit = $(this).val();
    if ($(this).val().length >= 13) {
     if (e.keyCode==13) {
      $.ajax({
        type: "POST",
        url: hostname + "homeproses/scanproduk",
        data: {scanaudit:scanaudit},
        cache: false,
        async:false,
        dataType: "json",
        success: function (response) {
          if (response.sukses) {
            $('.ean').text(response.ean);
            $('.itemid').text(response.itemid);
            $('.item_description').text(response.item_description);
            $('.waist').text(response.waist);
           $('.onhand_qty').text(response.onhand_qty);
           $('.inseam').text(response.inseam);
           $('.category').text(response.category);
           $('.onhand_scan').text(response.onhand_scan); 
           $('.nikscan').text(response.nikscan);
           $('.totalscanglobal').text(response.totalscanglobal);
           $('.scanindividu').text(response.scanindividu);
           $('input[name=scanartikel]').val(response.artikel)
          } else if (response.gagal) {
            Swal.fire({
              text: response.gagal,
              icon: "info",
              showCancelButton: false,
              confirmButton: true,
            }).then(function(){
              $('input[name=scanartikel]').val(response.artikel)
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
    }else{
      Swal.fire({
        text: "Mohon Untuk melengkapi semua",
        icon: "error",
        showCancelButton: false,
        confirmButton: true,
      }).then(function(){
        $('input[name=scanartikel]').val('');
      })
    }
     }
    }
     }
  })
  $(document).on('keyup','input[name=searchaudit]',function(e){
    e.preventDefault()
    var a = $(this).val();
    if ($(this).val().length >= 13) {
     if (e.keyCode==13) {
      var scanaudit = $(this).val();
    if ($(this).val().length >= 13) {
     if (e.keyCode==13) {
      $.ajax({
        type: "POST",
        url: hostname + "homeproses/cariproduk",
        data: {searchaudit:scanaudit},
        cache: false,
        async:false,
        dataType: "json",
        success: function (response) {
          if (response.sukses) {
            $('.ean').text(response.ean);
            $('.itemid').text(response.itemid);
            $('.item_description').text(response.item_description);
            $('.waist').text(response.waist);
           $('.onhand_qty').text(response.onhand_qty);
           $('.inseam').text(response.inseam);
           $('.category').text(response.category);
           $('.onhand_scan').text(response.onhand_scan); 
           $('.nikscan').text(response.nikscan);
           $('.totalscanglobal').text(response.totalscanglobal);
           $('.scanindividu').text(response.scanindividu);
           $('input[name=searchaudit]').val(response.artikel)
          } else if (response.gagal) {
            Swal.fire({
              text: response.gagal,
              icon: "info",
              showCancelButton: false,
              confirmButton: true,
            }).then(function(){
              $('input[name=searchaudit]').val(response.artikel)
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
    }else{
      Swal.fire({
        text: "Mohon Untuk melengkapi semua",
        icon: "error",
        showCancelButton: false,
        confirmButton: true,
      }).then(function(){
        $('input[name=searchaudit]').val('');
      })
    }
     }
    }
     }
  })
  $(document).on("submit", ".formauditcomplete", function (e) {
		e.preventDefault();
		let formgrouping = $(".formauditcomplete").serialize();
		$.ajax({
			type: "POST",
			url: hostname + "homeproses/prosessignature",
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
					}).then(function () {
						location.reload(true);
					});
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
  $(document).on("submit", ".edituser", function (e) {
		e.preventDefault();
		let formgrouping = $(".edituser").serialize();
		$.ajax({
			type: "POST",
			url: hostname + "homeproses/cangename",
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
            $("#edituser").modal("hide");
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
  $(document).on("submit", ".buatuser", function (e) {
		e.preventDefault();
		let formgrouping = $(".buatuser").serialize();
		$.ajax({
			type: "POST",
			url: hostname + "homeproses/prosesregister",
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
            $("#buatuser").modal("hide");
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
    $(document).on('submit', '.uploadmaster', function (e)  {
    e.preventDefault();
    Swal.fire({
      backdrop:true,
      position: 'center',
      icon: 'info',
      title: 'Proses Upload Data...',
      text: 'mohon bersabar.., proses ini membutuhkan waktu yang lama.',
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false
    })
    var uploadDataStok = $('input[type=file]')[0].files[0];
    var formdata = new FormData();
    formdata.append('namafile', uploadDataStok);
    $.ajax({
      type: "POST",
      url: hostname+'homeproses/insertcsvtoko',
      data: formdata,
      cache: false,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.sukses) {
          Swal.fire({
						text: response.sukses,
						icon: "success",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
            location.reload()
          })
        }else if(response.gagal){
          Swal.fire({
						text: response.gagal,
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
            Swal.close()
            $.ajax({
              type: "POST",
              url: hostname+'homeproses/hapusfile',
              data: formdata,
              cache: false,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                location.reload()
              }
            });
          });
        }
      },
			error: function (jqXHR, error, errorThrown) {
				if (jqXHR.status && jqXHR.status == 500) {
					Swal.fire({
						text: "Periksa Kembali isi file anda,pastikan tidak ada spesial character.",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
            Swal.close()
            $.ajax({
              type: "POST",
              url: hostname+'homeproses/hapusfile',
              data: formdata,
              cache: false,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                 location.reload()
              }
            });
          });
				} else {
					Swal.fire({
						text: "Periksa Kembali isi file anda,pastikan tidak ada spesial character",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
            Swal.close()
            $.ajax({
              type: "POST",
              url: hostname+'homeproses/hapusfile',
              data: formdata,
              cache: false,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                 location.reload()
              }
            });
          });
				}
			},
		});
  })
  $(document).on('submit', '.uploadmasteraudit', function (e)  {
    e.preventDefault();
    Swal.fire({
      backdrop:true,
      position: 'center',
      icon: 'info',
      title: 'Proses Checkin...',
      text: 'mohon bersabar.., proses ini membutuhkan waktu yang lama.',
      showConfirmButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false
    })
    var uploadDataStok = $('input[name=zx30]')[0].files[0];
    var formdata = new FormData();
    formdata.append('namafile', uploadDataStok);
    $.ajax({
      type: "POST",
      url: hostname+'homeproses/insertcsvaudit',
      data: formdata,
      cache: false,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.sukses) {
          Swal.fire({
						text: response.sukses,
						icon: "success",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
              $.ajax({
              type: "POST",
              url: hostname+'homeproses/hapusfile',
              data: formdata,
              cache: false,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                location.reload()
              }
            });
            
          })
        }else if(response.gagal){
          Swal.fire({
						text: response.gagal,
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
           $.ajax({
              type: "POST",
              url: hostname+'homeproses/hapusfile',
              data: formdata,
              cache: false,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                location.reload()
              }
            });
          });
        }
      },
			error: function (jqXHR, error, errorThrown) {
				if (jqXHR.status && jqXHR.status == 500) {
					Swal.fire({
						text: "Periksa Kembali isi file anda,pastikan tidak ada spesial character",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
            Swal.close()
            $.ajax({
              type: "POST",
              url: hostname+'homeproses/hapusfile',
              data: formdata,
              cache: false,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                 location.reload()
              }
            });
          });
				} else {
					Swal.fire({
						text: "Periksa Kembali isi file anda,pastikan tidak ada spesial character",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function(){
            Swal.close()
            $.ajax({
              type: "POST",
              url: hostname+'homeproses/hapusfile',
              data: formdata,
              cache: false,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                 location.reload()
              }
            });
          });
				}
			},
		});
  })
  $(document).on("submit", ".editmanual", function (e) {
		e.preventDefault();
		let formgrouping = $(".editmanual").serialize();
		$.ajax({
			type: "POST",
			url: hostname + "homeproses/proseseditmanual",
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
            $("#editmanual").modal("hide");
            $(".tablehasilscan").DataTable().ajax.reload(null, false);
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
  $(document).on("submit", ".addarticle", function (e) {
		e.preventDefault();
		let formgrouping = $(".addarticle").serialize();
		$.ajax({
			type: "POST",
			url: hostname + "homeproses/prosesaddarticle",
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
            $("#addarticle").modal("hide");
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
});