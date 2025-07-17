function skp(){
    document.addEventListener('DOMContentLoaded', function () {
        const periodeSelect = document.getElementById('status_kepegawaian');
        const hiddenPeriodeInput = document.getElementById('periode_id_hidden');

        if (periodeSelect && hiddenPeriodeInput) {
            periodeSelect.addEventListener('change', function () {
                hiddenPeriodeInput.value = this.value;
            });
            hiddenPeriodeInput.value = periodeSelect.value;
        }

        const modalTambah = document.getElementById('modalTambahPoin');
        if (modalTambah) {
            const tambahModal = new bootstrap.Modal(modalTambah);
            document.querySelectorAll('.btn-tambah-poin').forEach(button => {
                button.addEventListener('click', () => {
                    const skpId = button.getAttribute('data-skp-id');
                    const inputSkpId = document.getElementById('modalSkpId');
                    if (inputSkpId) inputSkpId.value = skpId;
                    tambahModal.show();
                });
            });
        }

        const modalEdit = document.getElementById('modalEditSkp');
        if (modalEdit) {
            modalEdit.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const skpId = button.getAttribute('data-skp-id');
                const skpText = button.getAttribute('data-skp');
                const jenisSkp = button.getAttribute('data-jenis-skp');

                const form = document.getElementById('formEditSkp');
                const textarea = document.getElementById('edit_skp');
                const jenisSelect = document.getElementById('edit_jenis_skp');

                if (form) form.action = `/skp/skpEdit/${skpId}`;
                if (textarea) textarea.value = skpText;
                if (jenisSelect && jenisSkp) jenisSelect.value = jenisSkp;
            });
        }

        const modalHapus = document.getElementById('modalHapusSkp');
        if (modalHapus) {
            modalHapus.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const skpId = button.getAttribute('data-skp-id');
                const skpNama = button.getAttribute('data-skp');

                const namaElem = document.getElementById('namaSkp');
                const formElem = document.getElementById('formHapusSkp');
                if (namaElem) namaElem.textContent = skpNama;
                if (formElem) formElem.action = `/skp/skpDelete/${skpId}`;
            });
        }

        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
}

skp();

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-hapus-indikator');
    const skpInputDel = document.getElementById('hapusSkpId');
    const indikatorSelectDel = document.getElementById('indikatorSelectDel');
    const formDel = document.getElementById('formHapusPoin');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const skpId = this.getAttribute('data-skp-id');
            skpInputDel.value = skpId;
            formDel.setAttribute('action', `/skp/skpIndikatorDelete`);

            if (indikatorSelectDel) {
                indikatorSelectDel.innerHTML = '<option disabled selected>Memuat indikator...</option>';
            }

            fetch(`/skp/skpIndikatorGet/${skpId}`) 
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data indikator.');
                    }
                    return response.json();
                })
                .then(data => {
                    indikatorSelectDel.innerHTML = '';

                    if (!data || data.length === 0) {
                        indikatorSelectDel.innerHTML = '<option disabled selected>Tidak ada indikator</option>';
                        return;
                    }

                    data.forEach(indikator => {
                        const option = document.createElement('option');
                        option.value = indikator.id;
                        option.textContent = indikator.indikator;
                        indikatorSelectDel.appendChild(option);
                    });
                })
                .catch(error => {
                    indikatorSelectDel.innerHTML = '<option disabled selected>Gagal memuat indikator</option>';
                    console.error('Fetch error:', error);
                });
        });
    });

    const editButtons = document.querySelectorAll('.btn-edit-indikator');
    const skpInputEdit = document.getElementById('editSkpId');
    const indikatorSelectEdit = document.getElementById('indikatorSelectEdit');
    const formEdit = document.getElementById('formEditPoin');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const skpId = this.getAttribute('data-skp-id');
            skpInputEdit.value = skpId;

            formEdit.setAttribute('action', `/skp/skpIndikatorEdit`);

            if (indikatorSelectEdit) {
                indikatorSelectEdit.innerHTML = '<option disabled selected>Memuat indikator...</option>';
            }

            // Fetch indikator dari server
            fetch(`/skp/skpIndikatorGet/${skpId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data indikator.');
                    }
                    return response.json();
                })
                .then(data => {
                    indikatorSelectEdit.innerHTML = '';

                    if (!data || data.length === 0) {
                        indikatorSelectEdit.innerHTML = '<option disabled selected>Tidak ada indikator</option>';
                        return;
                    }

                    data.forEach(indikator => {
                        const option = document.createElement('option');
                        option.value = indikator.id;
                        option.textContent = indikator.indikator;
                        indikatorSelectEdit.appendChild(option);
                    });
                })
                .catch(error => {
                    indikatorSelectEdit.innerHTML = '<option disabled selected>Gagal memuat indikator</option>';
                    console.error('Fetch error:', error);
                });
        });
    });
});
