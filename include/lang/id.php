<?php 
$this->errorMsg =  array();
 

// ERROR MSG
$this->systemErrorMsg[404] = 'Halaman tidak ditemukan.';

// DB CONNECTION 
$this->errorMsg[100] = 'Koneksi gagal.';

// UDPATE DATA ERROR
$this->errorMsg[200] = 'Item tidak valid.';
$this->errorMsg[201] = 'Perubahan status gagal.'; 
$this->errorMsg[202] = 'Data tidak dapat diubah ke status MENUNGGU.'; 
$this->errorMsg[203] = 'Data tidak dalam status MENUNGGU.'; 
$this->errorMsg[204] = 'Data tidak dalam status KONFIRMASI.';  
$this->errorMsg[205] = 'Data tidak dalam status SELESAI.'; 
$this->errorMsg[206] = 'Data tidak dalam status AKTIF.'; 
$this->errorMsg[207] = 'Data tidak dalam status NONAKTIF.'; 
$this->errorMsg[210] = 'Data tidak dapat dihapus.';   
$this->errorMsg[211] = 'Data <em>predefined</em> tidak dapat dihapus.'; 
$this->errorMsg[212] = 'Update data gagal.'; 

// MEMBER LOGIN, LOGOUT, PROFILE, ACTIVATION etc 
$this->errorMsg[300] = 'Login gagal. Login ID dan Password tidak cocok.';
$this->errorMsg[301] = '';
$this->errorMsg[302] = 'Akun tidak ditemukan.';
$this->errorMsg[303] = 'Link telah kadaluarsa.';
$this->errorMsg[304] = '';

//STOCK
$this->errorMsg[400] = 'Gudang telah memiliki data pergerakan.';
$this->errorMsg[401] = 'Item telah memiliki data pergerakan.';
$this->errorMsg[402] = 'Stok tidak mencukupi.';

//TRANSACTION
$this->errorMsg[500] = 'Jumlah transaksi dan harga unit harus lebih besar dari 0.';
$this->errorMsg[501] = 'Detail transaksi tidak boleh kosong.';
$this->errorMsg[502] = 'Pembayaran tidak mencukupi.';
$this->errorMsg[503] = 'Jumlah transaksi harus lebih besar dari 0.';
$this->errorMsg[504] = 'Kesalahan GL.';

// ETC
$this->errorMsg[900] = 'Perubahan status gagal karena sedang aktif terhubung ke data lain.';
$this->errorMsg[901] = 'Email gagal dikirim.'; 
 

// EMPTY FIELD
//general
$this->errorMsg['username'][1] = 'Username harus diisi.';
$this->errorMsg['username'][2] = 'Username Anda telah terdaftar. Silahkan memilih username lain.';
$this->errorMsg['username'][3] = 'Username harus diantara 5 - 30 karakter.';
$this->errorMsg['username'][4] = 'Username hanya dapat diisi huruf, angka, titik dan garis bawah.'; 
$this->errorMsg['username'][5] = 'Username dan password tidak cocok.';

$this->errorMsg['code'][1] = 'Kode harus diisi.';
$this->errorMsg['code'][2] = 'Kode Anda telah terdaftar. Silahkan memilih kode lain.';

$this->errorMsg['name'][1] = 'Nama harus diisi.';
$this->errorMsg['name'][2] = 'Nama Anda telah terdaftar. Silahkan memilih username lain.';


// particular field
$this->errorMsg['address'][1] = 'Alamat harus diisi.';

$this->errorMsg['amount'][1] = 'Jumlah harus diisi.';
$this->errorMsg['amount'][2] = 'Jumah harus lebih besar dari 0.'; 

$this->errorMsg['ap'][1] = 'Hutang harus diisi.';
$this->errorMsg['ap'][2] = 'Hutang tidak dalam status OPEN.';
$this->errorMsg['ap'][3] = 'Hutang akan berubah menjadi PARTIAL secara otomatis jika terjadi pembayaran hutang.';
$this->errorMsg['ap'][4] = 'Hutang tidak dapat dibatalkan karena terhubung dengan transaksi pembelian. Hutang ini akan otomatis dibatalkan jika pembelian dibatalkan.';

$this->errorMsg['apPayment'][2] = 'Jumlah pembayaran hutang harus lebih besar dari 0.';

$this->errorMsg['ar'][1] = 'Piutang harus diisi.';
$this->errorMsg['ar'][2] = 'Piutang tidak dalam status OPEN.';
$this->errorMsg['ar'][3] = 'Piutang akan berubah menjadi PARTIAL secara otomatis jika terjadi pembayaran piutang.';
$this->errorMsg['ar'][4] = 'Piutang tidak dapat dibatalkan karena terhubung dengan transaksi penjualan. Piutang ini akan otomatis dibatalkan jika penjualan dibatalkan.';

/*
$this->errorMsg['ar'][5] = 'Piutang tidak dapat dibatalkan karena telah memiliki pembayaran. Silahkan membatalkan pembayaran untuk piutang ini terlebih dahulu.';
$this->errorMsg['ar'][6] = 'Piutang tidak dapat diubah menjadi PARTIAL karena pembayaran piutang sudah penuh.';
$this->errorMsg['ar'][7] = 'Piutang tidak dapat diubah menjadi PARTIAL karena belum memiliki pembayaran.';
*/

$this->errorMsg['arPayment'][2] = 'Jumlah pembayaran piutang harus lebih besar dari 0.';

$this->errorMsg['article'][1] = 'Judul artikel harus diisi.';
$this->errorMsg['article'][2] = 'Judul artikel telah terdaftar. Silahkan memilih judul artikel lain.';

$this->errorMsg['banner'][1] = 'Nama banner harus diisi.';
$this->errorMsg['banner'][2] = 'Nama banner telah terdaftar. Silahkan memilih nama banner lain.';
 
$this->errorMsg['bank'][1] = 'Nama bank harus diisi.';

$this->errorMsg['bankaccountname'][1] = 'Nama pemegang rekening harus diisi.';

$this->errorMsg['bankaccountnumber'][1] = 'Nomor rekening harus diisi.';

$this->errorMsg['brand'][1] = 'Nama merk harus diisi.';
$this->errorMsg['brand'][2] = 'Nama merk telah terdaftar. Silahkan memilih nama merk lain.';

$this->errorMsg['buyingPrice'][1] = 'Harga beli harus diisi.';
$this->errorMsg['buyingPrice'][2] = 'Harga beli harus lebih besar atau sama dengan 0.'; 
$this->errorMsg['buyingPrice'][3] = 'Harga beli harus lebih besar dari 0.'; 

$this->errorMsg['cart'][1] = 'Anda belum memiliki daftar belanja.'; 

$this->errorMsg['category'][1] = 'Nama kategori harus diisi.';
$this->errorMsg['category'][2] = 'Nama kategori telah terdaftar. Silahkan memilih nama kategori lain.';

$this->errorMsg['captcha'][1] = 'CAPTCHA tidak valid.'; 

$this->errorMsg['coa'][1] = 'Nama akun harus diisi.';
$this->errorMsg['coa'][2] = 'Nama akun telah terdaftar. Silahkan memilih nama akun lain.';
$this->errorMsg['coa'][3] = 'Link akun tidak terdaftar.';

$this->errorMsg['coatransfer'][1] = 'Akun asal dan akun tujuan tidak boleh sama.';

$this->errorMsg['currency'][1] = 'Nama mata uang harus diisi.';
$this->errorMsg['currency'][2] = 'Nama mata uang telah terdaftar. Silahkan memilih nama mata uang lain.';

$this->errorMsg['customer'][1] = 'Nama pelanggan harus diisi.';
$this->errorMsg['customer'][2] = 'Nama pelanggan telah terdaftar. Silahkan memilih nama pelanggan lain.';

$this->errorMsg['city'][1] = 'Kota harus diisi.';
$this->errorMsg['city'][2] = 'Nama kota telah terdaftar. Silahkan memilih nama kota lain.';
$this->errorMsg['city'][3] = 'Kota tidak valid.';

$this->errorMsg['codeVariant'][1] = 'Nama variasi harus diisi.';
$this->errorMsg['codeVariant'][2] = 'Nama variasi untuk group yang sama telah terdaftar. Silahkan memilih nama variasi lain.'; 
  
$this->errorMsg['date'][1] = 'Tanggal harus diisi.';
$this->errorMsg['date'][2] = 'Tanggal telah terdaftar. Silahkan memilih tanggal lain.'; 
$this->errorMsg['date'][3] = 'Tanggal mulai harus lebih kecil daripada tanggal selesai.'; 
   
$this->errorMsg['division'][1] = 'Nama divisi harus diisi.';
$this->errorMsg['division'][2] = 'Nama divisi telah terdaftar. Silahkan memilih nama divisi lain.';

$this->errorMsg['duedays'][1] = 'Jatuh tempo harus diisi.';   
$this->errorMsg['duedays'][2] = 'Jatuh tempo harus lebih besar dari 0.';   

$this->errorMsg['email'][1] = 'Email harus diisi.';
$this->errorMsg['email'][2] = 'Email Anda telah terdaftar. Silahkan memilih email lain.'; 
$this->errorMsg['email'][3] = 'Email tidak valid.';
$this->errorMsg['email'][4] = 'Email tidak terdaftar, mohon memasukkan email lain.';

$this->errorMsg['employee'][1] = 'Nama karyawan harus diisi.';
$this->errorMsg['employee'][2] = 'Nama karyawan telah terdaftar. Silahkan memilih nama karyawan lain.'; 

$this->errorMsg['eta'][1] = 'ETA harus diisi.'; 

$this->errorMsg['event'][1] = 'Judul event harus diisi.';
$this->errorMsg['event'][2] = 'Judul event telah terdaftar. Silahkan memilih judul event lain.'; 

$this->errorMsg['generalJournal'][1] = 'Jumlah debit dan kredit harus sama.';

$this->errorMsg['gramasi'][1] = 'Gramasi harus diisi.';
$this->errorMsg['gramasi'][2] = 'Gramasi harus lebih besar atau sama dengan 0.'; 

$this->errorMsg['invoice'][1] = 'Invoice harus diisi.';

$this->errorMsg['item'][1] = 'Nama item harus diisi.';
$this->errorMsg['item'][2] = 'Nama item telah terdaftar. Silahkan memilih nama item lain.';

$this->errorMsg['itemAdjustment'][1] = 'Stok barang telah berubah.'; 

$this->errorMsg['itemFilter'][1] = 'Filter item harus diisi.';

$this->errorMsg['itemUnit'][1] = 'Nama unit harus diisi.';  
$this->errorMsg['itemUnit'][2] = 'Nama unit telah terdaftar. Silahkan memilih nama unit lain.';  

$this->errorMsg['itemParent'][1] = 'Item <em>parent</em> harus diisi.'; 

$this->errorMsg['limit'][1] = 'Anda sudah mencapai batas maksimum untuk data.';
$this->errorMsg['limit'][2] = 'Anda sudah mencapai batas maksimum untuk foto.';
$this->errorMsg['limit'][3] = 'Anda sudah mencapai batas maksimum untuk file.';
$this->errorMsg['limit'][4] = 'Ukuran foto terlalu besar.';   
$this->errorMsg['limit'][5] = 'Ukuran file terlalu besar.';   

$this->errorMsg['login'][1] = 'Login gagal. Akun Anda belum diaktivasi.';
$this->errorMsg['login'][2] = 'Login gagal. Akun Anda dalam keadaan terblokir.';  
$this->errorMsg['login'][3] = 'Terlalu banyak kesalahan login. Silahkan mencoba login kembali dalam {{LOCKOUT_MINUTES}} menit.';  
 
$this->errorMsg['maxStockQty'][1] = 'Stok Maks. harus diisi.';
$this->errorMsg['maxStockQty'][2] = 'Stok Maks. harus lebih besar atau sama dengan 0.'; 

$this->lang['max'] = 'Maks.';
$this->errorMsg['message'][1] = 'Pesan harus diisi.';

$this->errorMsg['minStockQty'][1] = 'Stok Min. harus diisi.';
$this->errorMsg['minStockQty'][2] = 'Stok Min. harus lebih besar atau sama dengan 0.'; 

$this->errorMsg['news'][1] = 'Judul berita harus diisi.';  
$this->errorMsg['news'][2] = 'Judul berita telah terdaftar. Silahkan memilih judul berita lain.';  

$this->errorMsg['orderList'][1] = 'No. urut harus diisi.'; 
$this->errorMsg['orderList'][2] = 'No. urut harus berupa angka.'; 

$this->errorMsg['page'][1] = 'Nama page harus diisi'; 
$this->errorMsg['page'][2] = 'Nama page telah terdaftar. Silahkan memilih nama page lain.'; 

$this->errorMsg['paymentConfirmation'][1] = 'Sales order tidak ditemukan.'; 
$this->errorMsg['paymentConfirmation'][2] = 'Sales order telah dibayar.';

$this->errorMsg['password'][1] = 'Password harus diisi.';
$this->errorMsg['password'][2] = 'Password harus diantara 5 - 30 karakter.';
$this->errorMsg['password'][3] = 'Password dan konfirmasi password tidak cocok.';

$this->errorMsg['passwordConfirmation'][1] = 'Konfirmasi password harus diisi.';
$this->errorMsg['passwordConfirmation'][2] = 'Konfirmasi password harus diantara 5 - 30 karakter.';

$this->errorMsg['paymentMethod'][1] = 'Metode pembayaran harus diisi.';  
$this->errorMsg['paymentMethod'][2] = 'Metode pembayaran telah terdaftar. Silahkan memilih nama metode pembayaran lain.';  

$this->errorMsg['phone'][1] = 'Nomor telepon harus diisi.';  

$this->errorMsg['point'][1] = 'Poin harus diisi'; 
$this->errorMsg['point'][2] = 'Nilai poin harus lebih besar dari 0.'; 
$this->errorMsg['point'][3] = 'Nilai poin tidak mencukupi.'; 

$this->errorMsg['portfolio'][1] = 'Judul portfolio harus diisi.';
$this->errorMsg['portfolio'][2] = 'Judul portfolio telah terdaftar. Silahkan memilih judul portfolio lain.';

$this->errorMsg['print'][1] = 'Anda belum memilih data yang hendak dicetak.'; 

$this->errorMsg['purchaseOrder'][1] = 'Order pembelian harus diisi.';  
$this->errorMsg['purchaseOrder'][2] = 'Order pembelian tidak dapat dibatalkan karena sudah terjadi penerimaan barang. Silahkan membatalkan penerimaan barang terlebih dahulu.';  

$this->errorMsg['purchaseReceive'][1] = 'Jumlah harus lebih besar dari 0 dan lebih kecil dari kekurangan.';
$this->errorMsg['purchaseReceive'][2] = 'Tanggal penerimaan pembelian harus lebih besar atau sama dengan tanggal order pembelian.';    
$this->errorMsg['purchaseReceive'][3] = 'Jumlah yang diterima telah berubah. Silahkan membuka dan menyimpan ulang data Anda.'; 

$this->errorMsg['qty'][1] = 'Jumlah harus lebih besar dari 0.';    

$this->errorMsg['rating'][1] = 'Rating harus bernilai antara 1 hingga 5.'; 

$this->errorMsg['review'][1] = 'Review harus diisi.'; 
 
$this->errorMsg['salesOrder'][1] = 'Order penjualan harus diisi.';  
$this->errorMsg['salesOrder'][2] = 'Order penjualan tidak dapat dibatalkan karena sudah terjadi pengiriman barang. Silahkan membatalkan pengiriman barang terlebih dahulu.';  

$this->errorMsg['salesDelivery'][1] = 'Jumlah harus lebih besar dari 0 dan lebih kecil dari kekurangan.';
$this->errorMsg['salesDelivery'][2] = 'Tanggal penerimaan pembelian harus lebih besar atau sama dengan tanggal order penjualan.';    
$this->errorMsg['salesDelivery'][3] = 'Jumlah yang diterima telah berubah. Silahkan membuka dan menyimpan ulang data Anda.'; 


$this->errorMsg['sellingPrice'][1] = 'Harga jual harus diisi.';
$this->errorMsg['sellingPrice'][2] = 'Harga jual harus lebih besar atau sama dengan 0.'; 
$this->errorMsg['sellingPrice'][3] = 'Harga jual harus lebih besar dari 0.'; 

$this->errorMsg['slot'][1] = 'Slot harus diisi.';
$this->errorMsg['slot'][2] = 'Slot harus lebih besar atau sama dengan 0.'; 
$this->errorMsg['slot'][3] = 'Slot harus lebih besar dari 0.'; 

$this->errorMsg['script'][1] = 'Script harus diisi.'; 

$this->errorMsg['shipment'][1] = 'Nama pengiriman harus diisi.';
$this->errorMsg['shipment'][2] = 'Nama pengiriman telah terdaftar. Silahkan memilih nama pengiriman lain.'; 

$this->errorMsg['shipmentTracking'][1] = 'nomor tracking harus diisi.'; 

$this->errorMsg['subject'][1] = 'Subyek harus diisi.';
  
$this->errorMsg['supplier'][1] = 'Nama pemasok harus diisi.';  

$this->errorMsg['title'][1] = 'Judul harus diisi.';
$this->errorMsg['title'][2] = 'Judul telah terdaftar. Silahkan memilih judul lain.'; 

$this->errorMsg['top'][1] = 'Cara pembayaran harus diisi.';  
$this->errorMsg['top'][2] = 'Cara pembayaran telah terdaftar. Silahkan memilih nama cara pembayaran lain.';    

$this->errorMsg['url'][1] = 'URL harus diisi.';  
$this->errorMsg['url'][2] = 'URL telah terdaftar. Silahkan memilih URL lain.';   
$this->errorMsg['url'][3] = 'URL tidak valid';   

$this->errorMsg['warehouse'][1] = 'Nama gudang harus diisi.';
$this->errorMsg['warehouse'][2] = 'Nama gudang telah terdaftar. Silahkan memilih nama gudang lain.';

$this->errorMsg['youtube'][1] = 'Judul youtube harus diisi.';
$this->errorMsg['youtube'][2] = 'Judul youtube telah terdaftar. Silahkan memilih judul youtube lain.';



// WEB CONTENT   
$this->lang['aboutus'] = 'Tentang Kami' ;
$this->lang['accountsPayable'] = 'Hutang' ;
$this->lang['accountsPayablePayment'] = 'Pembayaran Hutang' ; 
$this->lang['accountsReceivable'] = 'Piutang' ;
$this->lang['accountsReceivablePayment'] = 'Pembayaran Piutang' ;
$this->lang['accountsPayableReport'] = 'Laporan Hutang' ;
$this->lang['addToCart'] = 'Tambah ke Kereta' ;
$this->lang['APReport'] = 'Laporan Hutang' ;
$this->lang['accountsPayablePaymentReport'] = 'Laporan Pembayaran Hutang' ; 
$this->lang['APPaymentReport'] = 'Laporan Pembayaran Hutang' ;
$this->lang['accountsReceivableReport'] = 'Laporan Piutang' ;
$this->lang['ARReport'] = 'Laporan Piutang' ;
$this->lang['accountsReceivablePaymentReport'] = 'Laporan Pembayaran Piutang' ;
$this->lang['ARPaymentReport'] = 'Laporan Pembayaran Piutang' ;
$this->lang['activationEmail'] = 'Email Aktifasi' ; 
$this->lang['accountActivation'] = 'Aktifasi Akun' ;
$this->lang['accountActivationSuccessful'] = 'Selamat, akun Anda telah berhasil diaktifasi!<br>Anda sekarang dapat mengakses fitur member kami. Terima Kasih.';
$this->lang['accountRecovery'] = 'Pemulihan Akun' ;
$this->lang['add'] = 'Tambah' ;
$this->lang['addSearchFilter'] = 'Tambah Filter Pencarian';
$this->lang['address'] = 'Alamat' ;
$this->lang['addRows'] = 'Tambah Baris' ;
$this->lang['addToCart'] = 'Tambahkan ke Kereta' ;
$this->lang['allCategories'] = 'Semua Kategori' ;
$this->lang['allProducts'] = 'Semua Produk';
$this->lang['amount'] = 'Jumlah';
$this->lang['article'] = 'Artikel';
$this->lang['articleCategory'] = 'Kategori Artikel'; 
$this->lang['articleNewsAndMedia'] = 'Artikel, Berita &amp; Media';  
$this->lang['ar/ap'] = 'Hutang / Piutang' ;
$this->lang['availability'] = 'Ketersediaan';

$this->lang['backTo'] = 'Kembali ke';
$this->lang['backToTop'] = 'Kembali ke Atas';
$this->lang['balanceSheetReport'] = 'Laporan Neraca';
$this->lang['banner'] = 'Banner';
$this->lang['bankName'] = 'Nama Bank';
$this->lang['bankAccountName'] = 'Nama Pemegang Rekening';
$this->lang['bankAccountNumber'] = 'No. Rekening';
$this->lang['billingStatement'] = 'Tagihan'; 
$this->lang['brand'] = 'Merk';
$this->lang['businessPartner'] = 'Rekan Usaha';  

$this->lang['cart'] = 'Kereta Belanja';
$this->lang['cartSubmitSuccessful'] = 'Pesanan Anda telah berhasil terkirim. Anda akan menerima faktur dan detail cara pembayaran di email Anda segera.';
$this->lang['chartOfAccount'] = 'Daftar Akun';
$this->lang['cashBankTransfer'] = 'Transfer Kas Bank';
$this->lang['cashIn'] = 'Kas Masuk';
$this->lang['cashMovementReport'] = 'Laporan Pergerakan Kas'; 
$this->lang['cashOut'] = 'Kas Keluar'; 
$this->lang['clearTag'] = 'Hilangkan Tag';
$this->lang['edit'] = 'Edit';
$this->lang['checkOut'] = 'Check Out';
$this->lang['changeStatus'] = 'Ubah Status';
$this->lang['chooseStatus'] = 'Pilih Status';
$this->lang['clickHere'] = 'Klik disini'; 
$this->lang['close'] = 'Tutup'; 
$this->lang['closed'] = 'Telah ditutup'; 
$this->lang['closingDate'] = 'Tgl. Tutup'; 
$this->lang['code'] = 'Kode';
$this->lang['codeSetting'] = 'Pengaturan Kode';
$this->lang['confirm'] = 'Konfirmasi';
$this->lang['contact'] = 'Kontak';
$this->lang['contactUs'] = 'Hubungi Kami';
$this->lang['contactUsSuccessful'] =  'Pesan Anda telah terkirim dan akan kami balas secepatnya.'; 
$this->lang['currencyList'] = 'Daftar Mata Uang';    
$this->lang['currencyRate'] = 'Kurs Mata Uang';    
$this->lang['currentPassword'] = 'Password saat ini';
$this->lang['customer'] = 'Pelanggan';  

$this->lang['dataHasBeenSuccessfullyUpdated'] = 'Data telah berhasil diubah.'; 
$this->lang['date'] = 'Tanggal';
$this->lang['delete'] = 'Hapus';
$this->lang['deselectAll'] = 'Batalkan Semua Pilihan';
$this->lang['discount'] = 'Diskon';

$this->lang['edit'] = 'Ubah';
$this->lang['email'] = 'Email';
$this->lang['emailSentSuccessful'] = 'Email telah berhasil terkirim.';
$this->lang['employee'] = 'Karyawan';  
$this->lang['employeeDivision'] = 'Divisi Karyawan';  
$this->lang['emptyFieldPasswordDontChange'] = 'Kosongkan field <strong>Password Baru</strong> jika Anda tidak ingin merubah password.';
$this->lang['eta'] = 'ETA';
$this->lang['etccost'] = 'Biaya Lain'; 
$this->lang['event'] = 'Event';
 
$this->lang['filterCategory'] = 'Kategori Filter';
$this->lang['finance'] = 'Keuangan';
$this->lang['followUs'] = 'Follow Kami';

$this->lang['forgotPassword'] = 'Lupa Password';
$this->lang['forgotPasswordMessage'] = 'Mohon masukkan alamat email yang Anda gunakan ketika melakukan registrasi.';
 
$this->lang['gallery'] = 'Galleri'; 

$this->lang['GL'] = 'GL';
$this->lang['generalJournal'] = 'Jurnal Umum';
$this->lang['generalJournalReport'] = 'Laporan Jurnal Umum'; 

$this->lang['hideNotAvailableItem'] = 'Sembunyikan Stok Kosong';

$this->lang['hideDetail'] = 'Sembunyikan Detil';
$this->lang['home'] = 'Beranda';

$this->lang['import'] = 'Import'; 
$this->lang['incomeStatementReport'] = 'Laporan Laba Rugi'; 
$this->lang['indexRandomProductTitle'] = 'Produk Kami';
$this->lang['inThousand'] = 'dalam Ribuan';  
$this->lang['invoice'] = 'Faktur';
$this->lang['invoiceId'] = 'No. Faktur';
$this->lang['item'] = 'Item';
$this->lang['itemAdjustment'] = 'Penyesuain Stok Barang'; 
$this->lang['itemReport'] = 'Laporan Item';
$this->lang['itemCategory'] = 'Kategori Item';
$this->lang['itemFilter'] = 'Filter Item';
$this->lang['itemFilterReport'] = 'Laporan Filter Item'; 
$this->lang['itemIn'] = 'Pemasukan Barang'; 
$this->lang['itemInReport'] = 'Laporan Pemasukan Barang'; 
$this->lang['itemMovement'] = 'Pergerakan Item';
$this->lang['itemName'] = 'Nama Item';
$this->lang['itemOut'] = 'Pengeluaran Barang'; 
$this->lang['itemOutReport'] = 'Laporan Pengeluaran Barang'; 
$this->lang['itemUnit'] = 'Unit Item';
$this->lang['item(s)'] = 'Item';
$this->lang['inStock'] = 'Stok Tersedia';
$this->lang['insurance'] = 'Asuransi';
$this->lang['inventory'] = 'Inventori';
$this->lang['inventoryList'] = 'Daftar Item';
$this->lang['inventoryPreorderList'] = 'Item PO'; 
 
$this->lang['limited'] = 'Terbatas';
$this->lang['loading'] = 'Loading';
$this->lang['login'] = 'Login';
$this->lang['loginRequired'] = 'Anda harus login terlebih dahulu.';
$this->lang['loginSuccessful'] = 'Login berhasil. Anda akan di <em>redirect</em> ke halaman utama.';
$this->lang['logout'] = 'Logout';
$this->lang['lowStock'] = 'Stok Terbatas';

$this->lang['message'] = 'Pesan';

$this->lang['name'] = 'Nama';
$this->lang['newPassword'] = 'Password Baru';
$this->lang['newPasswordConfirmation'] = 'Konfirmasi Password Baru';
$this->lang['news'] = 'Berita';
$this->lang['newsCategory'] = 'Kategori Berita'; 
$this->lang['nextPage'] = 'Halaman Selanjutnya';
$this->lang['noDescriptionAvailable'] = 'Deskripsi tidak tersedia'; 
$this->lang['noDataFound'] = 'Data tidak ditemukan.';
$this->lang['normalPrice'] = 'Harga Normal';
$this->lang['note'] = 'Catatan';
$this->lang['notificationSuccessMessage'] = 'Kami akan menghubungi Anda ketika stok tersedia.';
$this->lang['notifyMe'] = 'Informasikan saya ketika tersedia.';

$this->lang['orderList'] = 'Daftar Belanja';
$this->lang['others'] = 'Lain-Lain';
$this->lang['outOfStock'] = 'Stok Kosong';
$this->lang['overdueAccountsPayable'] = 'Hutang Jatuh Tempo';
$this->lang['overdueAccountsReceivable'] = 'Piutang Jatuh Tempo';
$this->lang['overStock'] = 'Stok berlebih';

$this->lang['page'] = 'Halaman';
$this->lang['pawn'] = 'Gadai';
$this->lang['paymentConfirmation'] = 'Konfirmasi Pembayaran';
$this->lang['paymentConfirmationSuccessful'] =  'Konfirmasi Anda sudah kami terima dan akan kami proses secepatnya.'; 
$this->lang['paymentDate'] = 'Tanggal Pembayaran';
$this->lang['pleaseReopenAndSaveTheData']= 'Mohon dibuka dan simpan ulang data Anda';
$this->lang['password'] = 'Password';
$this->lang['passwordConfirmation'] = 'Konfirmasi Password';
$this->lang['paymentMethod'] = 'Metode Pembayaran';
$this->lang['productDescription'] = 'Deskripsi Produk';
$this->lang['phone'] = 'Telepon';
$this->lang['poList'] = 'Daftar PO';
$this->lang['point'] = 'Poin';
$this->lang['pointofsales'] = 'Point of Sales';
$this->lang['pointReport'] = 'Laporan Poin';
$this->lang['pointValue'] = 'Nilai Poin';
$this->lang['poPrice'] = 'Harga PO';
$this->lang['portfolio'] = 'Portfolio';
$this->lang['portfolioCategory'] = 'Kategori Portfolio'; 
$this->lang['products'] = 'Produk';
$this->lang['profit'] = 'Laba';
$this->lang['preorderSales'] = 'Penjualan PO';
$this->lang['productCategories'] = 'Kategori Produk';
$this->lang['profile'] = 'Profil';
$this->lang['promoAndCampaign'] = 'Promo &amp; Campaign';
$this->lang['promoItem'] = 'Item Promo'; 
$this->lang['promoTitle'] = 'Promo Minggu Ini';
$this->lang['preorder'] = 'Pre-Order';
$this->lang['price'] = 'Harga';
$this->lang['pricelist'] = 'Daftar Harga';
$this->lang['print'] = 'Cetak';
$this->lang['printInvoice'] = 'Cetak Faktur';
$this->lang['purchase'] = 'Pembelian';
$this->lang['purchaseOrder'] = 'Order Pembelian';
$this->lang['purchaseReceive'] = 'Penerimaan Pembelian';
$this->lang['purchaseReturn'] = 'Retur Pembelian';
$this->lang['purchaseReport'] = 'Laporan Pembelian';

$this->lang['qty'] = 'Jml.';
$this->lang['quickSearch'] = 'Pencarian Cepat';

$this->lang['registration'] = 'Registrasi';
$this->lang['registrationReActivation'] = 'Jika Anda telah pernah registrasi, Anda tidak perlu registrasi ulang. Silahkan klik <a href="/resend-activation">link ini</a> untuk mengirimkan ulang email aktifasi.';
$this->lang['register'] = 'Daftar' ;
$this->lang['registrationSuccessMessage'] = 'Registrasi Anda telah berhasil. Anda akan menerima email yang memuat instruksi selanjutnya untuk proses aktifasi.';
$this->lang['report'] = 'Laporan'; 
$this->lang['resendActivation'] = 'Aktifasi Ulang';
$this->lang['resendActivationMessage'] = 'Mohon masukkan alamat email yang Anda gunakan ketika melakukan registrasi.';
$this->lang['resendActivationSuccessMessage'] = 'Permohonan Anda telah berhasil diproses. Kami telah mengirimkan email yang berisi instruksi untuk melakukan aktifasi ulang. Terima Kasih.';
$this->lang['resetPassword'] = 'Reset Password';
$this->lang['resetPasswordSuccessful'] = 'Password Anda berhasil di reset! Password baru Anda telah dikirim ke email Anda.';
$this->lang['resetPasswordSuccessMessage'] = 'Permohonan Anda telah berhasil diproses. Kami telah mengirimkan email yang berisi instruksi untuk melakukan reset password. Terima Kasih.';

$this->lang['refresh'] = 'Refresh'; 
$this->lang['restockList'] = 'List Restock'; 
$this->lang['reward'] = 'Reward';
$this->lang['rewardPoints'] = 'Reward Points'; 

$this->lang['sales'] = 'Penjualan'; 
$this->lang['salesDelivery'] = 'Pengiriman Penjualan';
$this->lang['salesOrder'] = 'Order Penjualan';
$this->lang['salesReturn'] = 'Retur Penjualan';
$this->lang['salesGraph'] = 'Grafik Penjualan';
$this->lang['salesReport'] = 'Laporan Penjualan';
$this->lang['save'] = 'Simpan';
$this->lang['search'] = 'Cari';
$this->lang['searchFilter'] = 'Filter Pencarian';
$this->lang['searchResult'] = 'Hasil Pencarian'; 
$this->lang['selectAll'] = 'Pilih Semua';
$this->lang['send'] = 'Kirim';
$this->lang['services'] = 'Layanan'; 
$this->lang['setting'] = 'Pengaturan';
$this->lang['settlementType'] = 'Jenis Pelunasan'; 
$this->lang['shipment'] = 'Pengiriman';
$this->lang['shipmentFee'] = 'Ongkos Kirim';
$this->lang['shipmentReceipt'] = 'No. Pengiriman';
$this->lang['shippingInformation'] = 'Informasi Pengiriman';
$this->lang['showDetail'] = 'Tampikan Detil';
$this->lang['showInvoice'] = 'Lihat Faktur';
$this->lang['slot'] = 'Slot';
$this->lang['stock'] = 'Stok';
$this->lang['stockCardReport'] = 'Laporan Kartu Stok';
$this->lang['status'] = 'Status';
$this->lang['subject'] = 'Subyek';
$this->lang['subtotal'] = 'Subtotal';
$this->lang['supplier'] = 'Pemasok';

$this->lang['tag'] = 'Tag';
$this->lang['tax'] = 'Pajak';
$this->lang['testimonial'] = 'Testimonial';
$this->lang['total'] = 'Total';
$this->lang['totalData'] = 'Total Data';
$this->lang['totalPoint'] = 'Total Poin'; 
$this->lang['transactionHistory'] = 'Histori Transaksi';

$this->lang['underMaintenance'] = 'Dalam Perbaikan';
$this->lang['unproccesedSalesOrder'] = 'Penjualan Belum Diproses'; 
$this->lang['unproccesedPurchaseOrder'] = 'Pembelian Belum Diproses'; 
$this->lang['updateSearchFilter'] = 'Ubah Filter Pencarian';
$this->lang['username'] = 'Username'; 
$this->lang['useInsurance'] = 'Gunakan Asuransi'; 

$this->lang['variableSetting'] = 'Pengaturan Variabel';
$this->lang['viewOrEdit'] = 'Lihat / Ubah';

$this->lang['warehouse'] = 'Gudang';
$this->lang['warehouseTransfer'] = 'Transfer Gudang'; 
$this->lang['warehouseTransferReport'] = 'Laporan Transfer Gudang'; 
$this->lang['webpage'] = 'Halaman Situs';
$this->lang['welcome'] = 'Selamat Datang';
$this->lang['workingSheetReport'] = 'Laporan Neraca Lajur';

$this->lang['youtube'] = 'Youtube';

$this->lang['activationEmailContent'] = 'Hi {{CUSTOMER_NAME}},
									 <br>
									Terima kasih telah melakukan registrasi. Untuk menyelesaikan proses registrasi silahkan klik link dibawah ini untuk melakukan verifikasi akun dan email Anda.
									<br><br> 
									{{ACTIVATION_LINK}}
									<br><br> 
									Salam,<br>
									{{COMPANY_NAME}}
								';
								
												
$this->lang['resetPasswordRequestEmailContent'] = 'Hi {{CUSTOMER_NAME}},
			 <br>
			 Anda atau seseorang telah mengajukan permohonan untuk melakukan reset password. Silahkan klik link dibawah ini untuk melakukan reset password.<br> 
			{{RESET_PASSWORD_LINK}}
			 <br><br> 
			Salam,<br>
			{{COMPANY_NAME}}';
			
			
$this->lang['resetPasswordContent'] =  '
					Hi  {{CUSTOMER_NAME}},
					 <br>
					  Password Anda telah diubah menjadi <strong>{{NEW_PASSWORD}}</strong><br><br>
					  Salam,<br>
					{{COMPANY_NAME}}';
				';';			
?>
