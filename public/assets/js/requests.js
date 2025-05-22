function action(){
	document.getElementById("submitBtn").addEventListener("click", function(){
		const pegawai_id = document.querySelector('input[name="pegawai_id"]').value;
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
		const jalan = document.querySelector('textarea[name="jalan"]').value;
		const provinsi = document.querySelector('select[name="provinsi"]').value;
		const kabupaten_kota = document.querySelector('select[name="kabupaten-kota"]').value;
		const kecamatan = document.querySelector('select[name="kecamatan"]').value;
		const telepon = document.querySelector('input[name="telepon"]').value;
		const hp = document.querySelector('input[name="hp"]').value;
		const email = document.querySelector('input[name="email"]').value;
		const golongan_darah = document.querySelector('select[name="golongan_darah"]').value;
		const tb = document.querySelector('input[name="tb"]').value;
		const bb = document.querySelector('input[name="bb"]').value;
		const cacat = document.querySelector('input[name="cacat"]').value;
		const no_ktp = document.querySelector('input[name="no_ktp"]').value;
		const no_npwp = document.querySelector('input[name="no_npwp"]').value;
		const no_bpjs = document.querySelector('input[name="no_bpjs"]').value;
		const jenis_bank = document.querySelector('select[name="jenis_bank"]').value;
		const rekening = document.querySelector('input[name="rekening"]').value;
		const nama_penerima = document.querySelector('input[name="nama_penerima"]').value;

		//Informasi Unit Kerja
		const unit_kerja = document.querySelector('select[name="unit_kerja"]').value;
		const tgl_masuk = document.querySelector('input[name="tgl_masuk"]').value;
		const diputuskan_oleh = document.querySelector('input[name="diputuskan_oleh"]').value;
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

		fetch('/api/update_pegawai',{
			method: "POST",
			headers: {
				"Content-Type":"application/json",
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
			},

			body: JSON.stringify({ 
				gender: gender,
				agama: agama,
				perkawinan: perkawinan,
				status_kewarganegaraan: status_kewarganegaraan,
				kewarganegaraan: kewarganegaraan,
				usia_pensiun: usia_pensiun,
				jalan: jalan,
				provinsi: provinsi,
				kabupaten_kota: kabupaten_kota,
				kecamatan: kecamatan,
				telepon: telepon,
				hp: hp,
				email: email,
				golongan_darah: golongan_darah,
				tb: tb,
				bb: bb,
				cacat: cacat,
				no_ktp: no_ktp,
				no_npwp: no_npwp,
				no_bpjs: no_bpjs,
				jenis_bank: jenis_bank,
				rekening: rekening,
				nama_penerima: nama_penerima,
				unit_kerja: unit_kerja,
				tgl_masuk: tgl_masuk,
				diputuskan_oleh: diputuskan_oleh,
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
		.then(response=>response.json())		
	});
}
action()