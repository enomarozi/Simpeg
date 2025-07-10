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
