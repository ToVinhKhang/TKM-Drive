/* Cau 1 */
CREATE TABLE NhanVien(
	MSNV CHAR(5) NOT NULL,
	HoTen NVARCHAR(80) NOT NULL,
	NgaySinh DATE,
	CMND VARCHAR(12) NOT NULL UNIQUE,
	DiaChi NVARCHAR(100),
	constraint PK_NhanVien_MSNV primary key(MSNV),
);

ALTER TABLE NhanVien
ADD constraint CHECK_MSNV
CHECK ((MSNV LIKE 'SA[0-9][0-9][0-9]') OR (MSNV LIKE 'PG[0-9][0-9][0-9]') OR (MSNV LIKE 'SL[0-9][0-9][0-9]') OR (MSNV LIKE 'TP[0-9][0-9][0-9]') OR (MSNV LIKE 'TD[0-9][0-9][0-9]') OR (MSNV LIKE 'VP[0-9][0-9][0-9]'))

/* Cau 2 */
CREATE TABLE DienThoaiNV(
	MSNV INT IDENTITY(1,1),
	DienThoai CHAR(15) NOT NULL,
	constraint PK_DienThoaiNV_MSNV_DienThoai primary key(MSNV,DienThoai),
);

ALTER TABLE DienThoaiNV
ADD constraint CHECK_DienThoai
CHECK (DienThoai LIKE '+84([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])')

/* Cau 3 */
CREATE TABLE ThoSuaAnh(
	MS_ThoSuaAnh CHAR(5) NOT NULL,
	constraint PK_ThoSuaAnh_MSTSA primary key(MS_ThoSuaAnh),
	constraint FK_ThoSuaAnh_MSTSA_NHANVIEN foreign key(MS_ThoSuaAnh) references NhanVien(MSNV),
);

/* Cau 4 */
CREATE TABLE Photographer_ChupKiSu(
	MS_PhotographerKiSu CHAR(5) NOT NULL,
	KienThucPS CHAR(1),
	KinhNghiem INT,
	constraint PK_Photographer_ChupKiSu_MSPKS primary key(MS_PhotographerKiSu),
	constraint FK_Photographer_ChupKiSu_MSPKS_NHANVIEN foreign key(MS_PhotographerKiSu) references NhanVien(MSNV),
);

/* Cau 5 */
CREATE TABLE Photographer_ChupAlbumCuoi(
	MS_PhotographerAlbum CHAR(5) NOT NULL,
	KienThucPS CHAR(1),
	KinhNghiem INT,
	constraint PK_Photographer_ChupAlbumCuoi_MSPAB primary key(MS_PhotographerAlbum),
	constraint FK_Photographer_ChupAlbumCuoi_MSPAB_NHANVIEN foreign key(MS_PhotographerAlbum) references NhanVien(MSNV),
);

/* Cau 6 */
CREATE TABLE Stylist(
	MS_Stylist CHAR(5) NOT NULL,
	constraint PK_Stylist_MSSTL primary key(MS_Stylist),
	constraint FK_Stylist_MSSTL_NHANVIEN foreign key(MS_Stylist) references NhanVien(MSNV),
);

/* Cau 7 */
CREATE TABLE ThoPhu(
	MS_ThoPhu CHAR(5) NOT NULL,
	constraint PK_ThoPhu_MSTPh primary key(MS_ThoPhu),
	constraint FK_ThoPhu_MSTPh_NHANVIEN foreign key(MS_ThoPhu) references NhanVien(MSNV),
);

/* Cau 8 */
CREATE TABLE CVTrangDiem(
	MS_CVTrangDiem CHAR(5) NOT NULL,
	GiaCoDau INT,
	GiaNguoiNha INT,
	constraint PK_CVTrangDiem_MSCVTD primary key(MS_CVTrangDiem),
	constraint FK_CVTrangDiem_MSCVTD_NHANVIEN foreign key(MS_CVTrangDiem) references NhanVien(MSNV),
);

/* Cau 9 */
CREATE TABLE PhongCach_CVTrangDiem(
	MS_CVTrangDiem CHAR(5) NOT NULL,
	PhongCach NVARCHAR(20),
	constraint PK_PhongCach_CVTrangDiem_MSCVTD_PhongCach primary key(MS_CVTrangDiem,PhongCach),
	constraint FK_PhongCach_CVTrangDiem_MSCVTD_CVTrangDiem foreign key(MS_CVTrangDiem) references CVTrangDiem(MS_CVTrangDiem),
);

/* Cau 10 */
CREATE TABLE NVVanPhong(
	MS_VanPhong CHAR(5) NOT NULL,
	ViTri NVARCHAR(20),
	KiNang NVARCHAR(20),
	constraint PK_NVVanPhong_MSNVVP primary key(MS_VanPhong),
	constraint FK_NVVanPhong_MSVPh_NHANVIEN foreign key(MS_VanPhong) references NhanVien(MSNV),
);

/* Cau 11 */
CREATE TABLE KhachHang(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSKH AS (CAST('KH' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	DiaChi NVARCHAR(100),
	NgayCuoi DATE NOT NULL,
	HoTenCR NVARCHAR(50) NOT NULL,
	HoTenCD NVARCHAR(50) NOT NULL,
	NgaySinhCR DATE,
	NgaySinhCd DATE,
	DienThoaiCR VARCHAR(15),
	DienThoaiCD VARCHAR(15),
	EmailCR VARCHAR(50),
	EmailCD VARCHAR(50),
	constraint PK_KhachHang_MSKH primary key(MSKH),
);

ALTER TABLE KhachHang
ADD constraint CHECK_NgayCuoi
CHECK (NgayCuoi > GETDATE())

ALTER TABLE KhachHang
ADD constraint CHECK_DienThoaiChuanCuaCR
CHECK (DienThoaiCR LIKE '+84([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])')

ALTER TABLE KhachHang
ADD constraint CHECK_DienThoaiChuanCuaCD
CHECK (DienThoaiCd LIKE '+84([0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9])')

ALTER TABLE KhachHang
ADD constraint CHECK_DienThoaiCDCR
CHECK (((DienThoaiCR != NULL) AND (DienThoaiCD != NULL)) OR ((DienThoaiCR = NULL) AND (DienThoaiCD != NULL)) OR ((DienThoaiCR != NULL) AND (DienThoaiCD = NULL)))

ALTER TABLE KhachHang
ADD constraint CHECK_EmailCDCR
CHECK (((EmailCR != NULL) AND (EmailCD != NULL) AND EmailCR LIKE '%@%' AND EmailCD LIKE '%@%') OR ((EmailCR = NULL) AND (EmailCD != NULL) AND EmailCD LIKE '%@%') OR ((EmailCR != NULL) AND (EmailCD = NULL) AND EmailCR LIKE '%@%'))

/* Cau 12 */
CREATE TABLE HopDong(
	ID INT NOT NULL IDENTITY(1,1),
	MSHD AS (CAST('HD' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	ThoiDiemKi DATE NOT NULL,
	TongGia INT NOT NULL,
	MSKH CHAR(5) NOT NULL,
	MS_VanPhong CHAR(5) NOT NULL,
	constraint PK_HopDong_MSHD primary key(MSHD),
	constraint FK_HopDong_MSKH_KhachHang foreign key(MSKH) references KhachHang(MSKH),
	constraint FK_HopDong_MSVPh_NVVanPhong foreign key(MS_VanPhong) references NVVanPhong(MS_VanPhong),
);

/* Cau 13 */
CREATE TABLE HopDong_LanThanhToan(
	MSHD CHAR(5) NOT NULL,
	ThoiDiem DATE,
	SoTien INT,
	constraint PK_HopDong_LanThanhToan_MSHD_ThoiDiem primary key(MSHD,ThoiDiem),
	constraint FK_HopDong_LanThanhToan_MSHD_HopDong foreign key(MSHD) references HopDong(MSHD),
);

ALTER TABLE HopDong_LanThanhToan
ADD constraint CHECK_ThoiDiem
CHECK (DAY(ThoiDiem) > DAY(GETDATE()))

/* Cau 14 */
CREATE TABLE DVAlbumCuoi(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSDVAlbum AS (CAST('DVA' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	MSHD CHAR(5) NOT NULL,
	MS_PhotographerAlbum CHAR(5) NOT NULL,
	MS_Stylist CHAR(5) NOT NULL,
	MS_ThoPhu CHAR(5) NOT NULL,
	MS_CVTrangDiem CHAR(5) NOT NULL,
	MSVest1 CHAR(5),
	MSVest2 CHAR(5),
	TongGia INT NOT NULL,
	constraint PK_DVAlbumCuoi_MSDVAlbum primary key(MSDVAlbum),
	constraint FK_DVAlbumCuoi_MSHD_HopDong foreign key(MSHD) references HopDong(MSHD),
	constraint FK_DVAlbumCuoi_MS_PhotographerAlbum_Photographer_ChupAlbumCuoi foreign key(MS_PhotographerAlbum) references Photographer_ChupAlbumCuoi(MS_PhotographerAlbum),
	constraint FK_DVAlbumCuoi_MS_Stylist_Stylist foreign key(MS_Stylist) references Stylist(MS_Stylist),
	constraint FK_DVAlbumCuoi_MS_ThoPhu_ThoPhu foreign key(MS_ThoPhu) references ThoPhu(MS_ThoPhu),
	constraint FK_DVAlbumCuoi_MS_CVTrangDiem_CVTrangDiem foreign key(MS_CVTrangDiem) references CVTrangDiem(MS_CVTrangDiem),
);

ALTER TABLE DVAlbumCuoi
ADD constraint CHECK_MSVest
CHECK (((MSVest1 != NULL) AND (MSVest2 != NULL)) AND (MSVest1 != MSVest2))

/* Cau 15 */
CREATE TABLE AoVest(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSVest AS (CAST('Ve' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	Kieu NVARCHAR(10),
	Mau NVARCHAR(10),
	KichCo VARCHAR(3) NOT NULL,
	Soluong INT DEFAULT 0,
	GiaThue INT,
	constraint PK_AoVest_MSVest primary key(MSVest),
);

ALTER TABLE AoVest
ADD constraint CHECK_KichCo
CHECK (KichCo = 'XS' OR  KichCo = 'S' OR KichCo = 'M' OR KichCo = 'L' OR  KichCo = 'XL' OR KichCo = 'XXL')

/* Cau 16 */
CREATE TABLE DaoCu(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSDC AS (CAST('DC' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	Ten NVARCHAR(100),
	Gia INT,
	Soluong INT DEFAULT 0,
	constraint PK_DaoCu_MSDC primary key(MSDC),
);

/* Cau 17 */
CREATE TABLE DVAlbum_DaoCu(
	MSDVAlbum CHAR(5) NOT NULL,
	MSDC CHAR(5) NOT NULL,
	constraint PK_DVAlbum_DaoCu_MSDVAlbum_MSDC primary key(MSDVAlbum,MSDC),
	constraint FK_DVAlbum_DaoCu_MSDVAlbum_DVAlbumCuoi foreign key(MSDVAlbum) references DVAlbumCuoi(MSDVAlbum),
	constraint FK_DVAlbum_DaoCu_MSDC_DaoCu foreign key(MSDC) references DaoCu(MSDC),
);

/* Cau 18 */
CREATE TABLE DiaDiem(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSDD AS (CAST('DD' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	Ten NVARCHAR(100) NOT NULL UNIQUE,
	Gia INT,
	ViTri NVARCHAR(20),
	TongThoiGianChup FLOAT,
	GiaBoSung INT,
	GiaGoc INT,
	constraint PK_DiaDiem_MSDD primary key(MSDD),
);

/* Cau 19 */
CREATE TABLE DVAlbum_DiaDiem(
	MSDVAlbum CHAR(5) NOT NULL,
	MSDD CHAR(5) NOT NULL,
	ThoiDiemChup DATE,
	constraint PK_DVAlbum_DiaDiem_MSDVAlbum_MSDD primary key(MSDVAlbum,MSDD),
	constraint FK_DVAlbum_DiaDiem_DaoCu_MSDVAlbum_DVAlbumCuoi foreign key(MSDVAlbum) references DVAlbumCuoi(MSDVAlbum),
	constraint FK_DVAlbum_DiaDiem_DaoCu_MSDC_DaoCu foreign key(MSDD) references DiaDiem(MSDD),
);

/* Cau 20 */
CREATE TABLE GocChup(
	MSDD CHAR(5) NOT NULL,
	TenGocChup NVARCHAR(100) NOT NULL UNIQUE,
	constraint PK_GocChup_MSDD_TenGocChup primary key(MSDD,TenGocChup),
	constraint FK_GocChup_MSDVAlbum_DVAlbumCuoi foreign key(MSDD) references DiaDiem(MSDD),
);

/* Cau 22 */
CREATE TABLE Vay(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSV AS (CAST('Va' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	HinhAnh VARCHAR(100) NOT NULL,
	TinhTrang CHAR(1) NOT NULL,
	constraint PK_Vay_MSV primary key(MSV),
);

ALTER TABLE Vay
ADD constraint CHECK_TinhTrang
CHECK (TinhTrang = 'B' OR  TinhTrang = 'T' OR TinhTrang = 'K' OR TinhTrang = 'G' OR  TinhTrang = 'U')

/* Cau 23 */
CREATE TABLE VayChupHinh(
	MSVChup CHAR(5) NOT NULL,
	constraint PK_VayChupHinh_MSVChup primary key(MSVChup),
	constraint FK_VayChupHinh_MSVChup_Vay foreign key(MSVChup) references Vay(MSV),
);

/* Cau 21 */
CREATE TABLE DV_Goc_Vay(
	MSDVAlbum CHAR(5) NOT NULL,
	MSDD CHAR(5) NOT NULL,
	TenGocChup NVARCHAR(100) NOT NULL,
	MSVChup CHAR(5) NOT NULL,
	GocBoSung CHAR(1),
	constraint PK_DV_Goc_Vay_MSDVAlbum_MSDD_TenGocChup primary key(MSDVAlbum,MSDD,TenGocChup),
	constraint FK_DV_Goc_Vay_MSDVAlbum_DVAlbumCuoi foreign key(MSDVAlbum) references DVAlbumCuoi(MSDVAlbum),
	constraint FK_DV_Goc_Vay_MSDD_DiaDiem foreign key(MSDD) references DiaDiem(MSDD),
	constraint FK_DV_Goc_Vay_TenGocChup_GocChup foreign key(TenGocChup) references GocChup(TenGocChup),
	constraint FK_DV_Goc_Vay_MSVChup_VayChupHinh foreign key(MSVChup) references VayChupHinh(MSVChup),
);

/* Cau 28 */
CREATE TABLE DVVayCuoi(
	MSDVVay CHAR(5) NOT NULL,
	MSHD CHAR(5) NOT NULL,
	TongGia INT NOT NULL,
	constraint PK_DVVayCuoi_MSDVVay primary key(MSDVVay),
	constraint FK_VayNgayCuoi_MSHD_HopDong foreign key(MSHD) references HopDong(MSHD),
);

/* Cau 24 */
CREATE TABLE VayNgayCuoi(
	MSVCuoi CHAR(5) NOT NULL,
	GiaThue INT NOT NULL,
	GiaBan INT NOT NULL,
	SoLanThue INT DEFAULT 0,
	MSDVVay CHAR(5) NOT NULL,
	NgayBan DATE NOT NULL,
	Discount VARCHAR(3) NOT NULL,
	
	constraint PK_VayNgayCuoi_MSVCuoi primary key(MSVCuoi),
	constraint FK_VayNgayCuoi_MSVCuoi_Vay foreign key(MSVCuoi) references Vay(MSV),
	constraint FK_VayNgayCuoi_MSDVVay_DVVayCuoi foreign key(MSDVVay) references DVVayCuoi(MSDVVay),
);

ALTER TABLE VayNgayCuoi
ADD constraint CHECK_GiaBanGiaThue
CHECK (GiaBan > GiaThue)

/* Cau 26 */
CREATE TABLE Bia(
	MSBia CHAR(5) NOT NULL,
	Ten NVARCHAR(100) NOT NULL,
	Gia INT NOT NULL,
	Mau NVARCHAR(20),
	ChatLieu VARCHAR(10) NOT NULL,
	constraint PK_Bia_MSBia primary key(MSBia),
);

/* Cau 27 */
CREATE TABLE GiayIn(
	MSGiay CHAR(5) NOT NULL,
	ChatLieu VARCHAR(10) NOT NULL,
	Gia INT NOT NULL,
	SoTo INT NOT NULL,
	constraint PK_GiayIn_MSGiay primary key(MSGiay),
);

/* Cau 25 */
CREATE TABLE Album(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSAlbum AS (CAST('Al' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	SoTo INT NOT NULL,
	MSDVAlbum CHAR(5) NOT NULL,
	MSBia CHAR(5) NOT NULL,
	MSGiay CHAR(5) NOT NULL,
	
	constraint PK_Album_MSAlbum primary key(MSAlbum),
	constraint FK_Album_MSDVAlbum_DVAlbumCuoi foreign key(MSDVAlbum) references DVAlbumCuoi(MSDVAlbum),
	constraint FK_Album_MSBiay_Bia foreign key(MSBia) references Bia(MSBia),
	constraint FK_Album_MSBiay_GiayIn foreign key(MSGiay) references GiayIn(MSGiay),
);

/* Cau 29 */
CREATE TABLE DVVayCuoi_Thue(
	MSDVVay CHAR(5) NOT NULL,
	MSVCuoi CHAR(5) NOT NULL,
	NgayBatDau DATE NOT NULL,
	NgayKetThuc DATE NOT NULL,

	constraint PK_DVVayCuoi_Thue_MSDVVay_MSVCuoi primary key(MSDVVay,MSVCuoi),
	constraint FK_DVVayCuoi_Thue_MSDVVay_DVAlbumCuoi foreign key(MSDVVay) references DVVayCuoi(MSDVVay),
	constraint FK_DVVayCuoi_Thue_MSVCuoi_Bia foreign key(MSVCuoi) references VayNgayCuoi(MSVCuoi),
);

ALTER TABLE DVVayCuoi_Thue
ADD constraint CHECK_NgayBatDauNgayKetThuc
CHECK (NgayKetThuc > NgayBatDau)

/* Cau 30 */
CREATE TABLE DVNgayCuoi(
	ID INT NOT NULL IDENTITY(1,1) ,
	MSDVNgay AS (CAST('DVN' AS CHAR(2)) + CAST(ID AS CHAR(3))) PERSISTED NOT NULL,
	SoLuongNguoiNha INT DEFAULT 0,
	DiaDiem NVARCHAR(100) NOT NULL,
	ThoiDiem TIME NOT NULL,
	Gia INT NOT NULL,
	MSHD CHAR(5) NOT NULL,
	MS_PhotographerKiSu CHAR(5) NOT NULL,
	MS_ThoPhu CHAR(5) NOT NULL,
	TongGia INT NOT NULL,

	constraint PK_DVNgayCuoi_MSDVNgay primary key(MSDVNgay),
	constraint FK_DVNgayCuoi_MSHD_HopDong foreign key(MSHD) references HopDong(MSHD),
	constraint FK_DVNgayCuoi_MS_PhotographerKiSu_Photographer_ChupKiSu foreign key(MS_PhotographerKiSu) references Photographer_ChupKiSu(MS_PhotographerKiSu),
	constraint FK_DVNgayCuoi_MS_ThoPhu_ThoPhu foreign key(MS_ThoPhu) references ThoPhu(MS_ThoPhu),
);

/* Cau 31 */
CREATE TABLE NgayCuoi_TrangDiem(
	MSDVNgay CHAR(5) NOT NULL,
	MS_CVTrangDiem CHAR(5) NOT NULL,
	ThoiDiem TIME NOT NULL,
	CoDauNguoiNha CHAR(1) NOT NULL,

	constraint PK_NgayCuoi_TrangDiem_MSDVNgay_MS_CVTrangDiem_ThoiDiem primary key(MSDVNgay,MS_CVTrangDiem,ThoiDiem),
	constraint FK_NgayCuoi_TrangDiem_MSDVNgay_DVNgayCuoi foreign key(MSDVNgay) references DVNgayCuoi(MSDVNgay),
	constraint FK_NgayCuoi_TrangDiem_MS_CVTrangDiem_CVTrangDiem foreign key(MS_CVTrangDiem) references CVTrangDiem(MS_CVTrangDiem),
);