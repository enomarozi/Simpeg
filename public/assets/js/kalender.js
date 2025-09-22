document.addEventListener('DOMContentLoaded', function () {
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
});
