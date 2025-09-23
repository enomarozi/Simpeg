document.addEventListener('DOMContentLoaded', function () {
  modalDetailLog();
  modalEditLog();
  modalHapusLog();
});

function modalDetailLog(){
  const modelDetailLog = document.getElementById('modelDetailLog');

  modelDetailLog.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const pegawai_id = button.getAttribute('data-pegawai_id').trim();
    const tanggal = button.getAttribute('data-tanggal');
    const nama_aktivitas = button.getAttribute('data-nama_aktivitas');
    const deskripsi = button.getAttribute('data-deskripsi');
    const skp = button.getAttribute('data-skp');
    const link = button.getAttribute('data-link');

    modelDetailLog.querySelector('#modal-pegawai_id').value = pegawai_id;
    modelDetailLog.querySelector('#modal-tanggal').value = tanggal;
    modelDetailLog.querySelector('#modal-nama_aktivitas').value = nama_aktivitas;
    modelDetailLog.querySelector('#modal-deskripsi').value = deskripsi;
    modelDetailLog.querySelector('#modal-skp').value = skp;
    modelDetailLog.querySelector('#modal-link').value = link;
  });
}

function modalEditLog(){
  const modelEditLog = document.getElementById('modelEditLog');

  modelEditLog.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const log_id = button.getAttribute('data-edit_id');
    const edit_nama_aktivitas = button.getAttribute('data-edit_nama_aktivitas');
    const edit_deskripsi = button.getAttribute('data-edit_deskripsi');
    const edit_skp = button.getAttribute('data-edit_skp');
    const edit_link = button.getAttribute('data-edit_link');

    modelEditLog.querySelector('#modal_edit_id').value = log_id;
    modelEditLog.querySelector('#modal-edit_nama_aktivitas').value = edit_nama_aktivitas;
    modelEditLog.querySelector('#modal-edit_deskripsi').value = edit_deskripsi;
    modelEditLog.querySelector('#modal-edit_skp').value = edit_skp;
    modelEditLog.querySelector('#modal-edit_link').value = edit_link;
  });
}

function modalHapusLog(){
  const modelHapusLog = document.getElementById('modelHapusLog');
  modelHapusLog.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const log_id = button.getAttribute('data-hapus_id');
    const tanggal = button.getAttribute('data-hapus_tanggal');
    modelHapusLog.querySelector('#modal_hapus_id').value = log_id;
    modelHapusLog.querySelector('#modal-hapus_tanggal').innerText = `Apa anda yakin untuk menghapus Log Tanggal ${tanggal}`;
  });
}