$(document).ready(function () {
  $('.judul').text(judul);
  $(".tablestore").DataTable({
    dom: '<"col-sm-12"B><"col-sm-12 mt-2 float-start"f><"col-sm-12"p>t',
    dom: "Bpfrti",
    dom: "Blpfrt",
    scrollY: 450,
    lengthMenu: [
      [100, -1],
      [100, "All"],
    ],
    paging: true,
    ordering: false,
    scrollX: true,
    fixedColumns: {
      leftColumns: 1,
    },
    "drawCallback": function (settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    },
    buttons: [
      {
        extend: "collection",
        text: "Export Data",
        className: "btn btn-sm btn-primary",
        buttons: [
          '<h3 style="color:black">Export Data</h3>',
          {
            extend: "copy",
            title: judul,
            className: "btn btn-sm btn-primary",
          },
          {
            extend: "excel",
            title: judul,
            tag: "button",
            className: "btn btn-sm btn-success",
            'targets': [1], visible: true
          },
        ],
      },
      {
        text: "<i class='fa fa-user'></i> Upload Master Store",
        className: " mx-2  btn btn-sm btn-success rounded btnclicktable",
        attr: {
          "data-locationtujuan": hostname + "uploadmasterstore",
          "data-bs-toggle": "tooltip",
          "data-bs-placement": "bottom",
          "title": "mengupload" + judul,
        },
      },
    ],
    fixedHeader: true,
    fixedHeader: {
      header: true,
    },
    language: {
      emptyTable: "Tidak terdapat data di tabel",
      info: "",
      infoEmpty: "",
      infoFiltered: "",
      search: "<i class='fa fa-search'></i>",
      searchPlaceholder: "Search..",
      paginate: {
        next: ">",
        previous: "<<",
      },
      zeroRecords: "Tidak ditemukan data yang sesuai",
    },
  });
  $(".tableuser").DataTable({
    dom: '<"col-sm-12"B><"col-sm-12 mt-2 float-start"f><"col-sm-12"p>t',
    dom: "Bpfrti",
    dom: "Blpfrt",
    scrollY: 450,
    processing: true,
    serverSide: true,
    ajax: {
      url: hostname + "homeproses/getdatauser",
      type: "POST",
    },
    lengthMenu: [
      [100, -1],
      [100, "All"],
    ],
    paging: true,
    ordering: false,
    scrollX: true,
    fixedColumns: {
      leftColumns: 1,
    },
    "drawCallback": function (settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    },
    buttons: [
      {
        extend: "collection",
        text: "Export Data",
        className: "btn btn-sm btn-primary",
        buttons: [
          '<h3 style="color:black">Export Data</h3>',
          {
            extend: "copy",
            title: judul,
            className: "btn btn-sm btn-primary",
          },
          {
            extend: "excel",
            title: judul,
            tag: "button",
            className: "btn btn-sm btn-success",
            'targets': [1], visible: true
          },
        ],
      },
      {
        text: "<i class='fa fa-user'></i> Tambah User",
        className: " mx-2  btn btn-sm btn-success rounded btnmodal",
        attr: {
          "data-popupmodal": "buatuser",
          "data-bs-toggle": "tooltip",
          "data-bs-placement": "bottom",
          "title": "Menambah" + judul,
        },
      },
    ],
    fixedHeader: true,
    fixedHeader: {
      header: true,
    },
    language: {
      emptyTable: "Tidak terdapat data di tabel",
      info: "",
      infoEmpty: "",
      infoFiltered: "",
      search: "<i class='fa fa-search'></i>",
      searchPlaceholder: "Search..",
      paginate: {
        next: ">",
        previous: "<<",
      },
      zeroRecords: "Tidak ditemukan data yang sesuai",
    },
  });
  $(".tablehasilscan").DataTable({
    dom: '<"col-sm-12"B><"col-sm-12 mt-2 float-start"f><"col-sm-12"p>t',
    dom: "Bpfrti", 
    dom: "Blpfrt",
    scrollY: 450,
    processing: true,
    serverSide: true,
    ajax: {
      url: hostname + "homeproses/getdatahasilaudit",
      type: "POST",
    },
    lengthMenu: [
      [6000, -1],
      [6000, "All"],
    ],
    paging: true,
    ordering: false,
    scrollX: true,
    fixedColumns: {
      leftColumns: 1,
    },
    "drawCallback": function (settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    },
    buttons: [
      {
        extend: "collection",
        text: "Export Data",
        className: "btn btn-sm btn-primary",
        buttons: [
          '<h3 style="color:black">Export Data</h3>',
          {
            extend: "copy",
            title: judul,
            className: "btn btn-sm btn-primary",
          },
          {
            extend: "excel",
            title: judul,
            multiSheet: true,
            tag: 'button',
            footer: true,
            header: true,
            className: "btn btn-sm btn-success",
            'targets': [1], visible: true,
             exportOptions: {
              columns: ':visible',
            }
          },
          {
            extend: 'print',
            text: 'Print',
            title: judul,
            autoPrint: true,
            footer: true,
            exportOptions: {
              columns: ':visible',
            },
            customize: function (win) {
              $(win.document.body).find('table').addClass('display').css('font-size', '9px');
              $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                $(this).css('background-color', '#D0D0D0');
              });
              $(win.document.body).find('h1').css('text-align', 'center');
            },
          }
        ],
      },
    ],
    'columnDefs': [
      //hide the second & fourth column
      { 'visible': false, 'targets': [3,4] }
    ],
    fixedHeader: true,
    fixedHeader: {
      header: true,
    },
    order: [[3, 'asc']],
    rowGroup: {
      dataSrc: [3, 4]
    },
    language: {
      emptyTable: "Tidak terdapat data di tabel",
      info: "",
      infoEmpty: "",
      infoFiltered: "",
      search: "<i class='fa fa-search'></i>",
      searchPlaceholder: "Search..",
      paginate: {
        next: ">",
        previous: "<<",
      },
      zeroRecords: "Tidak ditemukan data yang sesuai",
    },
    "footerCallback": function (row, data, start, end, display) {
      var api = this.api(), data;

      // converting to interger to find total
      var intVal = function (i) {
        return typeof i === 'string' ?
          i.replace(/[\$,]/g, '') * 1 :
          typeof i === 'number' ?
            i : 0;
      };

      // computing column Total of the complete result 
      var monTotal = api
        .column(7)
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      var tueTotal = api
        .column(8)
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      var wedTotal = api
        .column(9)
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);



      // Update footer by showing the total with the reference of the column index 
      $(api.column(0).footer()).html('Total');
      $(api.column(7).footer()).html(monTotal);
      $(api.column(8).footer()).html(tueTotal);
      $(api.column(9).footer()).html(wedTotal);
    },
  });
  $(".reportaudit").DataTable({
    dom: '<"col-sm-12"B><"col-sm-12 mt-2 float-start"f><"col-sm-12"p>t',
    dom: "Bpfrti",
    dom: "Blpfrt",
    scrollY: 450,
    processing: true,
    serverSide: true,
    ajax: {
      url: hostname + "homeproses/getdatahasilscan",
      type: "POST",
    },
    lengthMenu: [
      [6000, -1],
      [6000, "All"],
    ],
    paging: true,
    ordering: false,
    scrollX: true,
    fixedColumns: {
      leftColumns: 1,
    },
    "drawCallback": function (settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    },
    buttons: [
      {
        extend: "collection",
        text: "Export Data",
        className: "btn btn-sm btn-primary",
        buttons: [
          '<h3 style="color:black">Export Data</h3>',
          {
            extend: "copy",
            title: judul,
            className: "btn btn-sm btn-primary",
          },
          {
            extend: "excel",
            title: judul,
            multiSheet: true,
            tag: 'button',
            footer: true,
            header: true,
            className: "btn btn-sm btn-success",
            'targets': [1], visible: true,
             exportOptions: {
              columns: ':visible',
            },
          },
          {
            extend: 'print',
            text: 'Print',
            title: judul,
            autoPrint: true,
            footer: true,
            exportOptions: {
              columns: ':visible',
            },
            customize: function (win) {
              $(win.document.body).find('table').addClass('display').css('font-size', '9px');
              $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                $(this).css('background-color', '#D0D0D0');
              });
              $(win.document.body).find('h1').css('text-align', 'center');
            },
          }
        ],
      },
    ],
    'columnDefs': [
      //hide the second & fourth column
      { 'visible': false, 'targets': [3,4] }
    ],
    fixedHeader: true,
    fixedHeader: {
      header: true,
    },
    order: [[3, 'asc']],
    rowGroup: {
      dataSrc: [3, 4]
    },
    language: {
      emptyTable: "Tidak terdapat data di tabel",
      info: "",
      infoEmpty: "",
      infoFiltered: "",
      search: "<i class='fa fa-search'></i>",
      searchPlaceholder: "Search..",
      paginate: {
        next: ">",
        previous: "<<",
      },
      zeroRecords: "Tidak ditemukan data yang sesuai",
    },
    "footerCallback": function (row, data, start, end, display) {
      var api = this.api(), data;

      // converting to interger to find total
      var intVal = function (i) {
        return typeof i === 'string' ?
          i.replace(/[\$,]/g, '') * 1 :
          typeof i === 'number' ?
            i : 0;
      };

      // computing column Total of the complete result 
      var monTotal = api
        .column(7)
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      var tueTotal = api
        .column(8)
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      var wedTotal = api
        .column(9)
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);



      // Update footer by showing the total with the reference of the column index 
      $(api.column(0).footer()).html('Total');
      $(api.column(7).footer()).html(monTotal);
      $(api.column(8).footer()).html(tueTotal);
      $(api.column(9).footer()).html(wedTotal);
    },
  });
  $(".compareaudit").DataTable({
    dom: '<"col-sm-12"B><"col-sm-12 mt-2 float-start"f><"col-sm-12"p>t',
    dom: "Bpfrti",
    dom: "Blpfrt",
    scrollY: 450,
    processing: true,
    serverSide: true,
    ajax: {
      url: hostname + "homeproses/getdatahasilcompare",
      type: "POST",
    },
    lengthMenu: [
      [6000, -1],
      [6000, "All"],
    ],
    paging: true,
    ordering: false,
    scrollX: true,
    fixedColumns: {
      leftColumns: 1,
    },
    "drawCallback": function (settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    },
    buttons: [
      {
        extend: "collection",
        text: "Export Data",
        className: "btn btn-sm btn-primary",
        buttons: [
          '<h3 style="color:black">Export Data</h3>',
          {
            extend: "copy",
            title: judul,
            className: "btn btn-sm btn-primary",
          },
          {
            extend: "excel",
            title: judul,
            multiSheet: true,
            tag: 'button',
            footer: true,
            header: true,
            className: "btn btn-sm btn-success",
            'targets': [1], visible: true,
             exportOptions: {
              columns: ':visible',
            },
          },
          {
            extend: 'print',
            text: 'Print',
            title: judul,
            autoPrint: true,
            footer: true,
            exportOptions: {
              columns: ':visible',
            },
            customize: function (win) {
              $(win.document.body).find('table').addClass('display').css('font-size', '9px');
              $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                $(this).css('background-color', '#D0D0D0');
              });
              $(win.document.body).find('h1').css('text-align', 'center');
            },
          }
        ],
      },
    ],
    'columnDefs': [
      //hide the second & fourth column
      { 'visible': false, 'targets': [3] }
    ],
    fixedHeader: true,
    fixedHeader: {
      header: true,
    },
    order: [[3, 'asc']],
    rowGroup: {
      dataSrc: [3,4]
    },
    language: {
      emptyTable: "Tidak terdapat data di tabel",
      info: "",
      infoEmpty: "",
      infoFiltered: "",
      search: "<i class='fa fa-search'></i>",
      searchPlaceholder: "Search..",
      paginate: {
        next: ">",
        previous: "<<",
      },
      zeroRecords: "Tidak ditemukan data yang sesuai",
    },
  });
  $(document).on('click', '.btnclicktable', function () {
    var isi = $(this).data('locationtujuan')
    location.href = isi
  })
  $('[data-bs-dismiss="modal"]').click(function (e) { 
    e.preventDefault();
    $(".modal").remove();
		$(".modal-backdrop").remove();
		$("body").removeClass("modal-open");
  });
});