<script> var judul = "Report AUDIT <?= $this->session->userdata('namastore'); ?>";</script>
<div class="container-fluid px-md-5 py-3">
  <div class="row min-vh-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-none">
        <h1 class="judul font-interbold">{judul}</h1>
      </div>
      <div class="card-body" style="min-height: 300px;">
        <div class="row">
          <div class="col-md-12 mb-3">
            <table class="table table-bordered reportaudit w-100">
             <thead class="bg-primary text-white">
             <tr>
                 <th colspan="8"><?= !empty($report->nama_store) ?  $report->nama_store : 'NONE' ?></th>
                 <th colspan="2">Staf name : <span class="pihak2"><?= !empty($report->pihak_2) ? $report->pihak_2 : 'NONE' ?></span></th>
               </tr>
               <tr>
                 <th colspan="8">periode : <span class="period"><?= !empty($report->periode_audit) ? $report->periode_audit : 'NONE' ?></span></th>
                 <th colspan="2"><span>Status :</span> <span class="status"><?= !empty($report->status_audit) ? $report->status_audit : 'BELUM DI AUDIT' ?></span></th>
               </tr>
               <tr>
                 <th>ean</th>
                 <th>item description</th>
                 <th>item ID</th>
                 <th>Kelas</th>
                 <th>Category</th>
                 <th>Waist</th>
                 <th>Inseam</th>
                 <th>onhand_qty</th>
                 <th>onhand_scan</th>
                 <th>Different</th>
               </tr>
             </thead>
              <tbody>
              </tbody>
               <tfoot>
               <tr>
                 <th>Total </th>
                 <th> </th>
                 <th> </th>
                 <th> </th>
                 <th> </th>
                 <th> </th>
                 <th> </th>
                 <th>20</th>
                 <th>30</th>
                 <th>30</th>
               </tr>
             </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></div>