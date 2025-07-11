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

                if (form) form.action = `/skpEdit/${skpId}`;
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
                if (formElem) formElem.action = `/skpDelete/${skpId}`;
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
    const skpInput = document.getElementById('hapusSkpId');
    const indikatorSelect = document.getElementById('indikatorSelect');
    const form = document.getElementById('formHapusPoin');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const skpId = this.getAttribute('data-skp-id');
            skpInput.value = skpId;

            form.setAttribute('action', `/skpIndikatorDelete`);

            if (indikatorSelect) {
                indikatorSelect.innerHTML = '<option disabled selected>Memuat indikator...</option>';
            }

            // Fetch indikator dari server
            fetch(`/skpIndikatorGet/${skpId}`)  // ✅ Perbaiki URL agar sesuai endpoint
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data indikator.');
                    }
                    return response.json();
                })
                .then(data => {
                    indikatorSelect.innerHTML = ''; // Kosongkan sebelum isi baru

                    if (!data || data.length === 0) {
                        indikatorSelect.innerHTML = '<option disabled selected>Tidak ada indikator</option>';
                        return;
                    }

                    data.forEach(indikator => {
                        const option = document.createElement('option');
                        option.value = indikator.id;
                        option.textContent = indikator.indikator;
                        indikatorSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    indikatorSelect.innerHTML = '<option disabled selected>Gagal memuat indikator</option>';
                    console.error('Fetch error:', error);
                });
        });
    });
});
