function action(){
	gender = document.querySelector('input[name="gender"]:checked').value;
	agama = document.querySelector('select[name="agama"]').value;
	perkawinan = document.querySelector('select[name="perkawinan"]').value;
	status_kewarganegaraan = document.querySelector('select[name="status_kewarganegaraan"]').value;
	let kewarganegaraan_check = document.querySelector('select[name="kewarganegaraan"]');
	if (kewarganegaraan_check) {
	    kewarganegaraan = document.querySelector('select[name="kewarganegaraan"]').value;
	}
	usia_pensiun = document.querySelector('input[name="usia_pensiun"]').value;
	jalan = document.querySelector('textarea[name="jalan"]').value;
	provinsi = document.querySelector('select[name="provinsi"]').value;
	kabupaten_kota = document.querySelector('select[name="kabupaten-kota"]').value;
	kecamatan = document.querySelector('select[name="kecamatan"]').value;
	telepon = document.querySelector('input[name="telepon"]').value;
	hp = document.querySelector('input[name="hp"]').value;
	email = document.querySelector('input[name="email"]').value;
	golongan_darah = document.querySelector('select[name="golongan_darah"]').value;
	tb = document.querySelector('input[name="tb"]').value;
	bb = document.querySelector('input[name="bb"]').value;
	cacat = document.querySelector('input[name="cacat"]').value;
	no_ktp = document.querySelector('input[name="no_ktp"]').value;
	no_npwp = document.querySelector('input[name="no_npwp"]').value;
	no_bpjs = document.querySelector('input[name="no_bpjs"]').value;
	jenis_bank = document.querySelector('select[name="jenis_bank"]').value;
	rekening = document.querySelector('input[name="rekening"]').value;
	atas_nama = document.querySelector('input[name="atas_nama"]').value;
}
action()