function action(){
	document.getElementById("submitBtn").addEventListener("click", function(){
		const pegawai_id = document.querySelector('input[name="pegawai_id"]').value;
		// Data Pegawai
		const nip = document.querySelector('input[name="nip"]').value;
		const gelar_depan = document.querySelector('input[name="gelar_depan"]').value;
		const nama = document.querySelector('input[name="nama"]').value;
		const gelar_belakang = document.querySelector('input[name="gelar_belakang"]').value;
		const tempat_lahir = document.querySelector('input[name="tempat_lahir"]').value;
		const tanggal_lahir = document.querySelector('input[name="tanggal_lahir"]').value;
		const status_kepegawaian = document.querySelector('select[name="status_kepegawaian"]').value;
		const jabatan_id = document.querySelector('select[name="jabatan_id"]').value;
		const fakultas_id = document.querySelector('select[name="fakultas_id"]').value;
		const departemen_id = document.querySelector('select[name="departemen_id"]').value;
		// Biodata Pribadi
		const gender = document.querySelector('input[name="gender"]:checked').value;
		const agama = document.querySelector('select[name="agama"]').value;
		const perkawinan = document.querySelector('select[name="perkawinan"]').value;
		const status_kewarganegaraan = document.querySelector('select[name="status_kewarganegaraan"]').value;
		let kewarganegaraan_check = document.querySelector('select[name="kewarganegaraan"]');
		if (kewarganegaraan_check) {
		    kewarganegaraan = document.querySelector('select[name="kewarganegaraan"]').value;
		}else{
				kewarganegaraan = 106;
		}
		const usia_pensiun = document.querySelector('input[name="usia_pensiun"]').value;
		const alamat_lengkap = document.querySelector('textarea[name="alamat_lengkap"]').value;
		const provinsi = document.querySelector('select[name="provinsi"]').value;
		const kabupaten_kota = document.querySelector('select[name="kabupaten-kota"]').value;
		const kecamatan = document.querySelector('select[name="kecamatan"]').value;
		const telepon = document.querySelector('input[name="telepon"]').value;
		const hp = document.querySelector('input[name="hp"]').value;
		const email = document.querySelector('input[name="email"]').value;
		const golongan_darah_id = document.querySelector('select[name="golongan_darah_id"]').value;
		const tinggi_badan = document.querySelector('input[name="tinggi_badan"]').value;
		const berat_badan = document.querySelector('input[name="berat_badan"]').value;
		const cacat = document.querySelector('input[name="cacat"]').value;
		const no_ktp = document.querySelector('input[name="no_ktp"]').value;
		const no_npwp = document.querySelector('input[name="no_npwp"]').value;
		const no_bpjs_tenaga_kerja = document.querySelector('input[name="no_bpjs_tenaga_kerja"]').value;
		const bank_id = document.querySelector('select[name="bank_id"]').value;
		const no_rekening = document.querySelector('input[name="no_rekening"]').value;
		const nama_penerima = document.querySelector('input[name="nama_penerima"]').value;

		//Informasi Unit Kerja
		const tgl_masuk = document.querySelector('input[name="tgl_masuk"]').value;
		const putusan = document.querySelector('input[name="putusan"]').value;
		const no_surat_u = document.querySelector('input[name="no_surat_u"]').value;
		const tgl_sk = document.querySelector('input[name="tgl_sk"]').value;

		//Pangkat dan Golongan
		const pangkat = document.querySelector('select[name="pangkat"]').value;
		const tmt_pangkat = document.querySelector('input[name="tmt_pangkat"]').value;

		//Jabatan
		const jabatan_f = document.querySelector('select[name="jabatan_f"]').value;
		const tmt_jabatan_f = document.querySelector('input[name="tmt_jabatan_f"]').value;
		const diputuskan_jabatan_f = document.querySelector('input[name="diputuskan_jabatan_f"]').value;
		const no_surat_f = document.querySelector('input[name="no_surat_f"]').value;
		const tgl_sk_f = document.querySelector('input[name="tgl_sk_f"]').value;

		const jabatan_s = document.querySelector('select[name="jabatan_s"]').value;
		const tmt_jabatan_s = document.querySelector('input[name="tmt_jabatan_s"]').value;
		const diputuskan_jabatan_s = document.querySelector('input[name="diputuskan_jabatan_s"]').value;
		const no_surat_s = document.querySelector('input[name="no_surat_s"]').value;
		const tgl_sk_s = document.querySelector('input[name="tgl_sk_s"]').value;
		fetch(`/admin/pegawai/update/${pegawai_id}`,{
			method: "POST",
			headers: {
				"Content-Type":"application/json",
				"Accept": "application/json",
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
			},

			body: JSON.stringify({
				pegawai_id: pegawai_id,
				nip: nip,
				gelar_depan: gelar_depan,
				nama: nama,
				gelar_belakang: gelar_belakang,
				tempat_lahir: tempat_lahir,
				tanggal_lahir: tanggal_lahir,
				status_kepegawaian: status_kepegawaian,
				jabatan_id: jabatan_id,
				fakultas_id: fakultas_id,
				departemen_id: departemen_id, 
				gender: gender,
				agama: agama,
				perkawinan: perkawinan,
				status_kewarganegaraan: status_kewarganegaraan,
				kewarganegaraan: kewarganegaraan,
				usia_pensiun: usia_pensiun,
				alamat_lengkap: alamat_lengkap,
				provinsi: provinsi,
				kabupaten_kota: kabupaten_kota,
				kecamatan: kecamatan,
				telepon: telepon,
				hp: hp,
				email: email,
				golongan_darah_id: golongan_darah_id,
				tinggi_badan: tinggi_badan,
				berat_badan: berat_badan,
				cacat: cacat,
				no_ktp: no_ktp,
				no_npwp: no_npwp,
				no_bpjs_tenaga_kerja: no_bpjs_tenaga_kerja,
				bank_id: bank_id,
				no_rekening: no_rekening,
				nama_penerima: nama_penerima,
				tgl_masuk: tgl_masuk,
				putusan: putusan,
				no_surat_u: no_surat_u,
				tgl_sk: tgl_sk,
				pangkat: pangkat,
				tmt_pangkat: tmt_pangkat,
				jabatan_f: jabatan_f,
				tmt_jabatan_f: tmt_jabatan_f,
				diputuskan_jabatan_f: diputuskan_jabatan_f,
				no_surat_f: no_surat_f,
				tgl_sk_f: tgl_sk_f,
				jabatan_s: jabatan_s,
				tmt_jabatan_s: tmt_jabatan_s,
				diputuskan_jabatan_s: diputuskan_jabatan_s,
				no_surat_s: no_surat_s,
				tgl_sk_s: tgl_sk_s,
			})
		})
		.then(async (response) => {
		    const data = await response.json();
		    if (!response.ok) {
		        throw new Error(data.message || 'Terjadi kesalahan.');
		    }
		    Swal.fire({
	        icon: 'success',
	        title: 'Sukses!',
	        text: data.message || 'Berhasil.',
		    });
		})
		.catch(error => {
		    Swal.fire({
		        icon: 'error',
		        title: 'Gagal!',
		        text: error.message || 'Terjadi kesalahan.',
		    });
		});
	});
}

action();

function reqDepartemen(fakultas_id, selectedDepartemenId = null){
	fetch(`/admin/pegawai/getDepartemen/${fakultas_id}`,{
		method: "GET",
		headers: {
			"Content-Type":"application/json",
		}
	})
	.then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    const departemenSelect = document.getElementById('departemen-id');
    departemenSelect.innerHTML = '<option value="">-- Pilih Departemen --</option>';

    data.forEach(dept => {
      const option = document.createElement('option');
      option.value = dept.id;
      option.textContent = dept.nama_departemen;
      if (selectedDepartemenId && dept.id == selectedDepartemenId) {
        option.selected = true;
      }
      departemenSelect.appendChild(option);
    });
  })
  .catch(error => {
    console.error("Gagal mengambil data departemen:", error);
  });
}