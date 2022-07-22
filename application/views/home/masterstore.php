<script> var judul = "Master Store";</script>
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
            <table class="table table-bordered tablestore w-100">
              <thead>
                <tr>
                  <th nowrap>Nama Store</th>
                  <th nowrap>Kode Store</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($store as  $value) : ?>
                <tr>
                  <td><?= $value->nama_store ?></td> 
                  <td><?= $value->kode_store ?></td> 
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></div>